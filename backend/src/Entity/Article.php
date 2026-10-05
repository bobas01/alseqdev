<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: 'article')]
#[ORM\UniqueConstraint(name: 'article_locale_slug', columns: ['locale', 'slug'])]
class Article
{
    public const CATEGORIES = ['developpement', 'devops', 'cybersecurite', 'ia', 'produit'];

    public const LOCALES = ['pt-br', 'fr', 'en', 'es'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    private string $locale;

    #[ORM\Column(length: 32)]
    private string $category;

    #[ORM\Column(length: 160)]
    private string $slug;

    #[ORM\Column(length: 160)]
    private string $title;

    #[ORM\Column(length: 320)]
    private string $summary;

    #[ORM\Column(length: 180)]
    private string $cover = '';

    #[ORM\Column(type: Types::TEXT)]
    private string $body;

    /** @var list<array{title: string, url: string}> */
    #[ORM\Column(type: Types::JSON)]
    private array $sources = [];

    #[ORM\Column(length: 80)]
    private string $translationKey;

    #[ORM\Column(length: 12)]
    private string $status = 'draft';

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishedAt = null;

    /**
     * @param list<array{title: string, url: string}> $sources
     */
    public function __construct(
        string $locale,
        string $category,
        string $slug,
        string $title,
        string $summary,
        string $body,
        array $sources,
        string $translationKey,
        string $status,
        string $cover = '',
    ) {
        $this->locale = $locale;
        $this->category = $category;
        $this->slug = $slug;
        $this->title = $title;
        $this->summary = $summary;
        $this->cover = $cover;
        $this->body = $body;
        $this->sources = $sources;
        $this->translationKey = $translationKey;
        $this->status = $status;
        $this->createdAt = new \DateTimeImmutable();
        if ($status === 'published') {
            $this->publishedAt = $this->createdAt;
        }
    }

    /**
     * @param list<array{title: string, url: string}> $sources
     */
    public function revise(
        string $locale,
        string $category,
        string $title,
        string $summary,
        string $body,
        array $sources,
        string $translationKey,
        string $status,
        string $cover = '',
    ): void {
        $this->locale = $locale;
        $this->category = $category;
        $this->title = $title;
        $this->summary = $summary;
        $this->cover = $cover;
        $this->body = $body;
        $this->sources = $sources;
        $this->translationKey = $translationKey;
        $wasPublished = $this->status === 'published';
        $this->status = $status;
        if ($status === 'published' && !$wasPublished) {
            $this->publishedAt = new \DateTimeImmutable();
        }
        if ($status === 'draft') {
            $this->publishedAt = null;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /** @return list<array{title: string, url: string}> */
    public function getSources(): array
    {
        return $this->sources;
    }

    public function getTranslationKey(): string
    {
        return $this->translationKey;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }
}
