<?php

namespace App\Tests\Blog;

use App\Blog\ArticleInput;
use PHPUnit\Framework\TestCase;

final class ArticleInputTest extends TestCase
{
    public function testDraftWithoutSourcesIsAccepted(): void
    {
        $input = ArticleInput::fromPayload($this->payload());

        self::assertNotNull($input);
        self::assertSame('draft', $input->status);
        self::assertSame('', $input->cover);
    }

    public function testPublishNeedsTwoDifferentSites(): void
    {
        $oneSite = ArticleInput::fromPayload($this->payload([
            'status' => 'published',
            'sources' => [
                ['title' => 'Un', 'url' => 'https://www.exemple.fr/a'],
                ['title' => 'Deux', 'url' => 'https://exemple.fr/b'],
            ],
        ]));
        $twoSites = ArticleInput::fromPayload($this->payload([
            'status' => 'published',
            'sources' => [
                ['title' => 'Un', 'url' => 'https://exemple.fr/a'],
                ['title' => 'Deux', 'url' => 'https://autre.org/b'],
            ],
        ]));

        self::assertNull($oneSite);
        self::assertNotNull($twoSites);
    }

    public function testRejectsACoverOutsideTheBlogFolder(): void
    {
        self::assertNull(ArticleInput::fromPayload($this->payload([
            'cover' => 'https://exemple.fr/logo.svg',
        ])));
        self::assertNull(ArticleInput::fromPayload($this->payload([
            'cover' => '/blog/../secret.svg',
        ])));
    }

    public function testRejectsAScriptAddressAsSource(): void
    {
        self::assertNull(ArticleInput::fromPayload($this->payload([
            'sources' => [
                ['title' => 'Lien', 'url' => 'javascript:alert(1)'],
            ],
        ])));
    }

    public function testKeepsArticleTextInsteadOfStrippingWords(): void
    {
        $input = ArticleInput::fromPayload($this->payload([
            'body' => "Un paragraphe assez long.\n\n## Titre\n\n- une ligne de liste",
        ]));

        self::assertNotNull($input);
        self::assertStringContainsString('## Titre', $input->body);
    }

    /** @param array<string, mixed> $extra */
    private function payload(array $extra = []): array
    {
        return array_merge([
            'locale' => 'fr',
            'category' => 'developpement',
            'title' => 'Un titre clair',
            'summary' => 'Un resume',
            'body' => 'Un paragraphe assez long pour passer.',
            'sources' => [],
            'translationKey' => '',
            'status' => 'draft',
            'cover' => '',
        ], $extra);
    }
}
