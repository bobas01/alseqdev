<?php

namespace App\Controller;

use App\Blog\CoverFiles;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;

final class DraftDepositController extends AbstractController
{
    public function __construct(
        private RateLimiterFactory $draftDepositLimiter,
        private CoverFiles $covers,
        #[Autowire('%env(default:app.empty:DRAFT_DEPOSIT_KEY)%')]
        private string $depositKey,
    ) {
    }

    #[Route('/api/blog/drafts', name: 'blog_draft_deposit', methods: ['POST'])]
    public function create(Request $request, ArticleRepository $articles, EntityManagerInterface $entityManager): JsonResponse
    {
        $expected = trim($this->depositKey);
        $given = trim(substr($request->headers->get('Authorization', ''), 7));
        if ($expected === '' || !str_starts_with($request->headers->get('Authorization', ''), 'Bearer ') || !hash_equals($expected, $given)) {
            return $this->json(['reason' => 'missing'], 404, ['Cache-Control' => 'no-store']);
        }

        if (!$this->draftDepositLimiter->create($request->getClientIp() ?? 'unknown')->consume()->isAccepted()) {
            return $this->json(['reason' => 'rate'], Response::HTTP_TOO_MANY_REQUESTS, ['Cache-Control' => 'no-store']);
        }

        if (strlen($request->getContent()) > 80000) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        try {
            $payload = json_decode($request->getContent(), true, 8, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }
        if (!is_array($payload)) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $locale = $payload['locale'] ?? 'fr';
        $category = $payload['category'] ?? '';
        $title = $this->clean($payload['title'] ?? '', 160);
        $summary = $this->clean($payload['summary'] ?? '', 320);
        $body = $this->clean($payload['body'] ?? '', 20000, true);
        $sources = $this->sources($payload['sources'] ?? null);
        $translationKey = $this->clean($payload['translationKey'] ?? '', 80);

        if (!in_array($locale, Article::LOCALES, true)
            || !in_array($category, ['developpement', 'devops', 'cybersecurite', 'ia'], true)
            || mb_strlen($title) < 3
            || mb_strlen($body) < 800
            || $sources === null
            || $this->distinctHosts($sources) < 2
        ) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $slug = $this->uniqueSlug($articles, $locale, $this->slugify($title));
        $cover = $this->cover($payload['cover'] ?? '', $payload['coverSvg'] ?? '', $slug);
        if ($cover === null) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $article = new Article(
            $locale,
            $category,
            $slug,
            $title,
            $summary,
            $body,
            $sources,
            $translationKey !== '' ? $translationKey : $slug,
            'draft',
            $cover,
        );
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json([
            'id' => $article->getId(),
            'slug' => $article->getSlug(),
            'status' => 'draft',
        ], 201, ['Cache-Control' => 'no-store']);
    }

    private function cover(mixed $path, mixed $svg, string $slug): ?string
    {
        $drawing = trim((string) $svg);
        if ($drawing !== '') {
            return $this->covers->store($slug, $drawing) ? '/api/blog/covers/'.$slug : null;
        }

        $cover = trim((string) $path);
        if ($cover === '') {
            return '';
        }

        return preg_match('#^/blog/[a-z0-9-]+\\.svg$#', $cover) === 1 ? $cover : null;
    }

    /** @param list<array{title: string, url: string}> $sources */
    private function distinctHosts(array $sources): int
    {
        $hosts = [];
        foreach ($sources as $source) {
            $host = strtolower((string) parse_url($source['url'], PHP_URL_HOST));
            $host = preg_replace('/^www\./', '', $host) ?? $host;
            if ($host !== '') {
                $hosts[$host] = true;
            }
        }

        return count($hosts);
    }

    /** @return list<array{title: string, url: string}>|null */
    private function sources(mixed $value): ?array
    {
        if (!is_array($value) || count($value) > 8) {
            return null;
        }

        $sources = [];
        foreach ($value as $source) {
            if (!is_array($source)) {
                return null;
            }
            $url = trim((string) ($source['url'] ?? ''));
            $title = $this->clean($source['title'] ?? '', 160);
            if ($url === '' && $title === '') {
                continue;
            }
            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                return null;
            }
            $scheme = parse_url($url, PHP_URL_SCHEME);
            if ($scheme !== 'https') {
                return null;
            }
            $sources[] = ['title' => $title !== '' ? $title : $url, 'url' => $url];
        }

        return $sources;
    }

    private function clean(mixed $value, int $max, bool $keepLines = false): string
    {
        $text = str_replace(["\r\n", "\r"], "\n", (string) $value);
        if ($keepLines) {
            $text = preg_replace("/[ \t]+/u", ' ', $text) ?? '';
            $text = preg_replace("/\n{3,}/", "\n\n", $text) ?? '';
        } else {
            $text = preg_replace('/\s+/u', ' ', $text) ?? '';
        }
        $text = trim($text);

        return mb_strlen($text) > $max ? mb_substr($text, 0, $max) : $text;
    }

    private function slugify(string $title): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $title);
        $slug = strtolower((string) $slug);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
        $slug = trim($slug, '-');

        return $slug !== '' ? $slug : 'article';
    }

    private function uniqueSlug(ArticleRepository $articles, string $locale, string $base): string
    {
        $slug = $base;
        $suffix = 2;
        while ($articles->slugTaken($locale, $slug)) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
