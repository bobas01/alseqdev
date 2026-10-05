<?php

namespace App\Blog;

use App\Entity\Article;

final class ArticleInput
{
    /**
     * @param list<array{title: string, url: string}> $sources
     */
    public function __construct(
        public string $locale,
        public string $category,
        public string $title,
        public string $summary,
        public string $body,
        public array $sources,
        public string $translationKey,
        public string $status,
        public string $cover,
    ) {
    }

    public static function fromPayload(array $payload): ?self
    {
        $locale = $payload['locale'] ?? '';
        $category = $payload['category'] ?? '';
        $title = self::clean($payload['title'] ?? '', 160);
        $summary = self::clean($payload['summary'] ?? '', 320);
        $body = self::clean($payload['body'] ?? '', 20000, true);
        $status = $payload['status'] ?? 'draft';
        $translationKey = self::clean($payload['translationKey'] ?? '', 80);
        $sources = self::sources($payload['sources'] ?? null);
        $cover = self::cover($payload['cover'] ?? '');

        if (!in_array($locale, Article::LOCALES, true)
            || !in_array($category, Article::CATEGORIES, true)
            || !in_array($status, ['draft', 'published'], true)
            || mb_strlen($title) < 3
            || mb_strlen($body) < 20
            || $sources === null
            || $cover === null
            || ($status === 'published' && self::distinctHosts($sources) < 2)
        ) {
            return null;
        }

        return new self($locale, $category, $title, $summary, $body, $sources, $translationKey, $status, $cover);
    }

    private static function cover(mixed $value): ?string
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
    private static function distinctHosts(array $sources): int
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
    private static function sources(mixed $value): ?array
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
            $title = self::clean($source['title'] ?? '', 160);
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

    private static function clean(mixed $value, int $max, bool $keepLines = false): string
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
}
