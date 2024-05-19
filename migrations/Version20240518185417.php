<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518185417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE niveau_parcours (niveau_id INT NOT NULL, parcours_id INT NOT NULL, INDEX IDX_20B71E50B3E9C81 (niveau_id), INDEX IDX_20B71E506E38C0DB (parcours_id), PRIMARY KEY(niveau_id, parcours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE niveau_parcours ADD CONSTRAINT FK_20B71E50B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_parcours ADD CONSTRAINT FK_20B71E506E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcours_niveau DROP FOREIGN KEY FK_457F5AB76E38C0DB');
        $this->addSql('ALTER TABLE parcours_niveau DROP FOREIGN KEY FK_457F5AB7B3E9C81');
        $this->addSql('DROP TABLE parcours_niveau');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parcours_niveau (parcours_id INT NOT NULL, niveau_id INT NOT NULL, INDEX IDX_457F5AB7B3E9C81 (niveau_id), INDEX IDX_457F5AB76E38C0DB (parcours_id), PRIMARY KEY(parcours_id, niveau_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE parcours_niveau ADD CONSTRAINT FK_457F5AB76E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcours_niveau ADD CONSTRAINT FK_457F5AB7B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_parcours DROP FOREIGN KEY FK_20B71E50B3E9C81');
        $this->addSql('ALTER TABLE niveau_parcours DROP FOREIGN KEY FK_20B71E506E38C0DB');
        $this->addSql('DROP TABLE niveau_parcours');
    }
}
