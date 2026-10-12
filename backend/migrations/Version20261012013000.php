<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261012013000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Publie les quatre articles de la semaine du 12 octobre 2026, dans les quatre langues.';
    }

    public function up(Schema $schema): void
    {
        $rows = array_merge(
            require __DIR__.'/data/week-20261012-fr.php',
            require __DIR__.'/data/week-20261012-en.php',
            require __DIR__.'/data/week-20261012-pt.php',
            require __DIR__.'/data/week-20261012-es.php',
        );

        foreach ($rows as $row) {
            $this->connection->insert('article', [
                'locale' => $row['locale'],
                'category' => $row['category'],
                'slug' => $row['slug'],
                'title' => $row['title'],
                'summary' => $row['summary'],
                'cover' => $row['cover'],
                'body' => $row['body'],
                'sources' => json_encode($row['sources'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR),
                'translation_key' => $row['translation_key'],
                'status' => 'published',
                'created_at' => $row['published_at'],
                'published_at' => $row['published_at'],
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM article WHERE translation_key IN ('python-315', 'github-actions-5-oct', 'wordpress-713', 'chatgpt-marque-ue')");
    }
}
