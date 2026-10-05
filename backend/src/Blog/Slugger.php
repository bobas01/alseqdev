<?php

namespace App\Blog;

use App\Repository\ArticleRepository;

final class Slugger
{
    public function fromTitle(string $title): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $title);
        $slug = strtolower((string) $slug);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
        $slug = trim($slug, '-');

        return $slug !== '' ? $slug : 'article';
    }

    public function unique(ArticleRepository $articles, string $locale, string $base): string
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
