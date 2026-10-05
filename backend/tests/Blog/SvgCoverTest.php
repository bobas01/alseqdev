<?php

namespace App\Tests\Blog;

use App\Blog\SvgCover;
use PHPUnit\Framework\TestCase;

final class SvgCoverTest extends TestCase
{
    public function testAcceptsAPlainDrawing(): void
    {
        self::assertTrue((new SvgCover())->accepts('<svg viewBox="0 0 10 10"><rect width="10" height="10"/></svg>'));
    }

    public function testRejectsAScript(): void
    {
        $cover = new SvgCover();

        self::assertFalse($cover->accepts('<svg><script>alert(1)</script></svg>'));
        self::assertFalse($cover->accepts('<svg><rect onload="alert(1)"/></svg>'));
        self::assertFalse($cover->accepts('<svg><a href="javascript:alert(1)"></a></svg>'));
    }

    public function testRejectsAnEmptyOrUnclosedFile(): void
    {
        $cover = new SvgCover();

        self::assertFalse($cover->accepts(''));
        self::assertFalse($cover->accepts('<svg><rect/></svg><script></script>'));
    }
}
