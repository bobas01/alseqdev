<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class AdminArticleController extends AbstractController
{
    #[Route('/api/admin/articles', name: 'admin_articles', methods: ['GET'])]
    public function list(ArticleRepository $articles): JsonResponse
    {
        return $this->json(
            array_map(fn (Article $article) => $this->adminView($article), $articles->latest()),
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article', methods: ['GET'])]
    public function show(Article $article): JsonResponse
    {
        return $this->json($this->adminView($article), headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles', name: 'admin_article_create', methods: ['POST'])]
    public function create(Request $request, ArticleRepository $articles, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $this->read($request);
        if ($data === null) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $slug = $this->uniqueSlug($articles, $data['locale'], $this->slugify($data['title']));
        $article = new Article(
            $data['locale'],
            $data['category'],
            $slug,
            $data['title'],
            $data['summary'],
            $data['body'],
            $data['sources'],
            $data['translationKey'] !== '' ? $data['translationKey'] : $slug,
            $data['status'],
            $data['cover'],
        );
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json($this->adminView($article), 201, headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article_update', methods: ['PUT'])]
    public function update(Article $article, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $this->read($request);
        if ($data === null) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $article->revise(
            $data['locale'],
            $data['category'],
            $data['title'],
            $data['summary'],
            $data['body'],
            $data['sources'],
            $data['translationKey'] !== '' ? $data['translationKey'] : $article->getTranslationKey(),
            $data['status'],
            $data['cover'],
        );
        $entityManager->flush();

        return $this->json($this->adminView($article), headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article_delete', methods: ['DELETE'])]
    public function delete(Article $article, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->json(['ok' => true], headers: ['Cache-Control' => 'no-store']);
    }

    /** @return array{locale: string, category: string, title: string, summary: string, body: string, sources: list<array{title: string, url: string}>, translationKey: string, status: string}|null */
    private function read(Request $request): ?array
    {
        try {
            $payload = json_decode($request->getContent(), true, 8, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return null;
        }
        if (!is_array($payload)) {
            return null;
        }

        $locale = $payload['locale'] ?? '';
        $category = $payload['category'] ?? '';
        $title = $this->clean($payload['title'] ?? '', 160);
        $summary = $this->clean($payload['summary'] ?? '', 320);
        $body = $this->clean($payload['body'] ?? '', 20000, true);
        $status = $payload['status'] ?? 'draft';
        $translationKey = $this->clean($payload['translationKey'] ?? '', 80);
        $sources = $this->sources($payload['sources'] ?? null);
        $cover = $this->cover($payload['cover'] ?? '');

        if (!in_array($locale, Article::LOCALES, true)
            || !in_array($category, Article::CATEGORIES, true)
            || !in_array($status, ['draft', 'published'], true)
            || mb_strlen($title) < 3
            || mb_strlen($body) < 20
            || $sources === null
            || $cover === null
            || ($status === 'published' && $this->distinctHosts($sources) < 2)
        ) {
            return null;
        }

        return [
            'locale' => $locale,
            'category' => $category,
            'title' => $title,
            'summary' => $summary,
            'body' => $body,
            'sources' => $sources,
            'translationKey' => $translationKey,
            'status' => $status,
            'cover' => $cover,
        ];
    }

    private function cover(mixed $value): ?string
    {
        $cover = trim((string) $value);
        if ($cover === '') {
            return '';
        }
        if (preg_match('#^/blog/[a-z0-9-]+\\.svg$#', $cover) !== 1) {
            return null;
        }

        return $cover;
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
        if (!is_array($value)) {
            return [];
        }
        if (count($value) > 8) {
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
            if ($scheme !== 'http' && $scheme !== 'https') {
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
        if (mb_strlen($text) > $max) {
            return mb_substr($text, 0, $max);
        }

        return $text;
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

    /** @return array<string, mixed> */
    private function adminView(Article $article): array
    {
        return [
            'id' => $article->getId(),
            'locale' => $article->getLocale(),
            'category' => $article->getCategory(),
            'slug' => $article->getSlug(),
            'title' => $article->getTitle(),
            'summary' => $article->getSummary(),
            'cover' => $article->getCover(),
            'body' => $article->getBody(),
            'sources' => $article->getSources(),
            'translationKey' => $article->getTranslationKey(),
            'status' => $article->getStatus(),
            'date' => ($article->getPublishedAt() ?? $article->getCreatedAt())->format(\DateTimeInterface::ATOM),
        ];
    }
}
