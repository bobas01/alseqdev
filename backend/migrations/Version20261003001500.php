<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261003001500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crée la table des articles du blog.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, category VARCHAR(32) NOT NULL, slug VARCHAR(160) NOT NULL, title VARCHAR(160) NOT NULL, summary VARCHAR(320) NOT NULL, body CLOB NOT NULL, sources CLOB NOT NULL, translation_key VARCHAR(80) NOT NULL, status VARCHAR(12) NOT NULL, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX article_locale_slug ON article (locale, slug)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE article');
    }
}
