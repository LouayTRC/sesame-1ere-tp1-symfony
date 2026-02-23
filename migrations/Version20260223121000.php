<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260223121000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make category.libelle unique (DB)';
    }

    public function up(Schema $schema): void
    {
        // If the column is already unique this will fail; adjust if necessary.
        $this->addSql('ALTER TABLE category MODIFY libelle VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category ADD UNIQUE INDEX UNIQ_CATEGORY_LIBELLE (libelle)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category DROP INDEX UNIQ_CATEGORY_LIBELLE');
    }
}
