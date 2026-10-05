<?php

namespace App\Blog;

use App\Entity\Article;

final class ArticlePresenter
{
    /** @return array<string, mixed> */
    public function card(Article $article): array
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

    /** @return array<string, mixed> */
    public function admin(Article $article): array
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
