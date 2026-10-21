<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261021174000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Publie les cinq notes de la semaine du 18 octobre, dans les quatre langues.';
    }

    public function up(Schema $schema): void
    {
        foreach (['fr', 'en', 'pt', 'es'] as $code) {
            foreach (require __DIR__.'/data/week-20261018-'.$code.'.php' as $row) {
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
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM article WHERE translation_key IN ('postgresql-19', 'lambda-web', 'nextjs-20261014', 'gemini-4-argon', 'actions-lock')");
    }
}
