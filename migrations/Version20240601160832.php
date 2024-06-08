<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601160832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressource ADD IF NOT EXISTS typologie_id INT NOT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454442F4634A FOREIGN KEY (typologie_id) REFERENCES typologie (id)');
        $this->addSql('CREATE INDEX IDX_939F454442F4634A ON ressource (typologie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454442F4634A');
        $this->addSql('DROP INDEX IDX_939F454442F4634A ON ressource');
        $this->addSql('ALTER TABLE ressource DROP typologie_id');
    }
}
