<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260223120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at column to category';
    }

    public function up(Schema $schema): void
    {
        // add created_at with default current timestamp to avoid null for existing rows
        $this->addSql('ALTER TABLE category ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category DROP created_at');
    }
}
