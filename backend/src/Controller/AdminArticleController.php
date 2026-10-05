<?php

namespace App\Controller;

use App\Blog\ArticleInput;
use App\Blog\ArticlePresenter;
use App\Blog\Slugger;
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
    public function list(ArticleRepository $articles, ArticlePresenter $presenter): JsonResponse
    {
        return $this->json(
            array_map(fn (Article $article) => $presenter->admin($article), $articles->latest()),
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article', methods: ['GET'])]
    public function show(Article $article, ArticlePresenter $presenter): JsonResponse
    {
        return $this->json($presenter->admin($article), headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles', name: 'admin_article_create', methods: ['POST'])]
    public function create(Request $request, ArticleRepository $articles, EntityManagerInterface $entityManager, Slugger $slugger, ArticlePresenter $presenter): JsonResponse
    {
        $data = $this->read($request);
        if ($data === null) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $slug = $slugger->unique($articles, $data->locale, $slugger->fromTitle($data->title));
        $article = new Article(
            $data->locale,
            $data->category,
            $slug,
            $data->title,
            $data->summary,
            $data->body,
            $data->sources,
            $data->translationKey !== '' ? $data->translationKey : $slug,
            $data->status,
            $data->cover,
        );
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->json($presenter->admin($article), 201, headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article_update', methods: ['PUT'])]
    public function update(Article $article, Request $request, EntityManagerInterface $entityManager, ArticlePresenter $presenter): JsonResponse
    {
        $data = $this->read($request);
        if ($data === null) {
            return $this->json(['reason' => 'invalid'], 400, ['Cache-Control' => 'no-store']);
        }

        $article->revise(
            $data->locale,
            $data->category,
            $data->title,
            $data->summary,
            $data->body,
            $data->sources,
            $data->translationKey !== '' ? $data->translationKey : $article->getTranslationKey(),
            $data->status,
            $data->cover,
        );
        $entityManager->flush();

        return $this->json($presenter->admin($article), headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/articles/{id}', name: 'admin_article_delete', methods: ['DELETE'])]
    public function delete(Article $article, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->json(['ok' => true], headers: ['Cache-Control' => 'no-store']);
    }

    private function read(Request $request): ?ArticleInput
    {
        try {
            $payload = json_decode($request->getContent(), true, 8, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return null;
        }
        if (!is_array($payload)) {
            return null;
        }

        return ArticleInput::fromPayload($payload);
    }
}
