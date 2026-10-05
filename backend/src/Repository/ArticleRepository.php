<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Article> */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /** @return list<Article> */
    public function published(string $locale, ?string $category): array
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.locale = :locale')
            ->andWhere('a.status = :status')
            ->setParameter('locale', $locale)
            ->setParameter('status', 'published')
            ->orderBy('a.publishedAt', 'DESC');

        if ($category !== null) {
            $query->andWhere('a.category = :category')->setParameter('category', $category);
        }

        return $query->setMaxResults(100)->getQuery()->getResult();
    }

    public function findPublished(string $locale, string $slug): ?Article
    {
        return $this->findOneBy([
            'locale' => $locale,
            'slug' => $slug,
            'status' => 'published',
        ]);
    }

    /** @return list<Article> */
    public function findTranslations(string $translationKey): array
    {
        if ($translationKey === '') {
            return [];
        }

        return $this->findBy(['translationKey' => $translationKey, 'status' => 'published']);
    }

    public function slugTaken(string $locale, string $slug, ?int $exceptId = null): bool
    {
        $found = $this->findOneBy(['locale' => $locale, 'slug' => $slug]);

        return $found !== null && $found->getId() !== $exceptId;
    }

    /** @return list<Article> */
    public function latest(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
}
