<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260223123000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create qualite table and modify product to use qualite_id instead of qualite string';
    }

    public function up(Schema $schema): void
    {
        // Create qualite table
        $this->addSql('CREATE TABLE qualite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, couleur VARCHAR(7) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_QUALITE_LIBELLE (libelle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Add qualite_id to product table
        $this->addSql('ALTER TABLE product ADD qualite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA7C41D6F FOREIGN KEY (qualite_id) REFERENCES qualite (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA7C41D6F ON product (qualite_id)');

        // Drop old qualite column
        $this->addSql('ALTER TABLE product DROP qualite');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA7C41D6F');
        $this->addSql('DROP TABLE qualite');
        $this->addSql('DROP INDEX IDX_D34A04ADA7C41D6F ON product');
        $this->addSql('ALTER TABLE product DROP qualite_id');
        $this->addSql('ALTER TABLE product ADD qualite VARCHAR(255) DEFAULT NULL');
    }
}
