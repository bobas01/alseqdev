<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260930204000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crée la table des messages de contact.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE contact_message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(80) NOT NULL, email VARCHAR(180) NOT NULL, message CLOB NOT NULL, locale VARCHAR(8) NOT NULL, ip_hash VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE contact_message');
    }
}
