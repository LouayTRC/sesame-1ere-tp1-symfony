<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260223122000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add image_filename column to product';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product ADD image_filename VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP image_filename');
    }
}
