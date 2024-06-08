<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608121150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprentissage_critique CHANGE libelle libelle LONGTEXT NOT NULL');
        $this->addSql('DROP INDEX typologie_id ON ressource');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX typologie_id ON ressource (typologie_id)');
        $this->addSql('ALTER TABLE apprentissage_critique CHANGE libelle libelle VARCHAR(255) NOT NULL');
    }
}
