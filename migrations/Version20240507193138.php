<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507193138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD composante_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AC12F1AD FOREIGN KEY (composante_id) REFERENCES composante (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3AC12F1AD ON utilisateur (composante_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AC12F1AD');
        $this->addSql('DROP INDEX IDX_1D1C63B3AC12F1AD ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP composante_id');
    }
}
