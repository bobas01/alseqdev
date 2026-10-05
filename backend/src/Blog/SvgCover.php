<?php

namespace App\Blog;

final class SvgCover
{
    public function accepts(string $svg): bool
    {
        $svg = trim($svg);
        if ($svg === '' || strlen($svg) > 20000 || !str_starts_with($svg, '<svg') || !str_ends_with($svg, '</svg>')) {
            return false;
        }

        return preg_match('/<script|<\/script|on[a-z]+\s*=|javascript:|foreignObject|<iframe|<embed|<object|<link|<meta|<!ENTITY/i', $svg) !== 1;
    }
}
