<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261004223000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute le visuel de chaque article.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE article ADD COLUMN cover VARCHAR(180) NOT NULL DEFAULT ''");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE article DROP COLUMN cover');
    }
}
