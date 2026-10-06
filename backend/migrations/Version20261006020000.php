<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261006020000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Reprend les articles déjà en ligne avec des formulations qui se disent dans chaque langue.';
    }

    public function up(Schema $schema): void
    {
        $rows = array_merge(
            require __DIR__.'/data/opening-fr.php',
            require __DIR__.'/data/opening-en.php',
            require __DIR__.'/data/opening-pt.php',
            require __DIR__.'/data/opening-es.php',
        );

        foreach ($rows as $row) {
            $this->connection->executeStatement(
                'UPDATE article SET title = ?, summary = ?, body = ?, sources = ? WHERE locale = ? AND translation_key = ?',
                [
                    $row['title'],
                    $row['summary'],
                    $row['body'],
                    json_encode($row['sources'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR),
                    $row['locale'],
                    $row['translation_key'],
                ],
            );
        }
    }

    public function down(Schema $schema): void
    {
    }
}
