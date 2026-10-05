<?php

namespace App\Controller;

use App\Blog\CoverFiles;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/api/blog', name: 'blog_list', methods: ['GET'])]
    public function list(Request $request, ArticleRepository $articles): JsonResponse
    {
        $locale = (string) $request->query->get('locale', '');
        if (!in_array($locale, Article::LOCALES, true)) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $category = $request->query->get('category');
        $category = is_string($category) && $category !== '' ? $category : null;
        if ($category !== null && !in_array($category, Article::CATEGORIES, true)) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        return $this->json(
            array_map(fn (Article $article) => $this->card($article), $articles->published($locale, $category)),
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/blog/covers/{name}', name: 'blog_cover', methods: ['GET'], requirements: ['name' => '[a-z0-9-]+'])]
    public function cover(string $name, CoverFiles $covers): Response
    {
        $svg = $covers->read($name);
        if ($svg === null) {
            return new Response('', 404, ['Cache-Control' => 'no-store']);
        }

        return new Response($svg, 200, [
            'Content-Type' => 'image/svg+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
            'X-Content-Type-Options' => 'nosniff',
            'Content-Security-Policy' => "default-src 'none'; style-src 'unsafe-inline'",
        ]);
    }

    #[Route('/api/blog/{locale}/{slug}', name: 'blog_article', methods: ['GET'], requirements: ['locale' => 'pt-br|fr|en|es', 'slug' => '[a-z0-9-]+'])]
    public function article(string $locale, string $slug, ArticleRepository $articles): JsonResponse
    {
        $article = $articles->findPublished($locale, $slug);
        if ($article === null) {
            return $this->json(['reason' => 'missing'], 404, ['Cache-Control' => 'no-store']);
        }

        $translations = [];
        foreach ($articles->findTranslations($article->getTranslationKey()) as $translation) {
            if ($translation->getLocale() !== $article->getLocale()) {
                $translations[$translation->getLocale()] = $translation->getSlug();
            }
        }

        return $this->json([
            ...$this->card($article),
            'body' => $article->getBody(),
            'sources' => $article->getSources(),
            'translations' => $translations,
        ], headers: ['Cache-Control' => 'no-store']);
    }

    /** @return array<string, mixed> */
    private function card(Article $article): array
    {
        $date = $article->getPublishedAt() ?? $article->getCreatedAt();

        return [
            'slug' => $article->getSlug(),
            'locale' => $article->getLocale(),
            'category' => $article->getCategory(),
            'title' => $article->getTitle(),
            'summary' => $article->getSummary(),
            'cover' => $article->getCover(),
            'date' => $date->format('Y-m-d'),
        ];
    }
}
