<?php

namespace App\Tests\Blog;

use App\Blog\Slugger;
use PHPUnit\Framework\TestCase;

final class SluggerTest extends TestCase
{
    public function testBuildsASlugFromTheTitle(): void
    {
        self::assertSame('hello-world', (new Slugger())->fromTitle('Hello, World!'));
    }

    public function testFallsBackWhenTheTitleHasNoLetters(): void
    {
        self::assertSame('article', (new Slugger())->fromTitle('...'));
    }
}
