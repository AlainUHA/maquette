<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525201806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, mention_id INT NOT NULL, libelle VARCHAR(150) NOT NULL, typologie VARCHAR(20) DEFAULT NULL, ci NUMERIC(5, 1) DEFAULT NULL, cm NUMERIC(5, 1) DEFAULT NULL, td NUMERIC(5, 1) DEFAULT NULL, tp NUMERIC(5, 1) DEFAULT NULL, projet_autonomie INT DEFAULT NULL, ct_expression TINYINT(1) DEFAULT NULL, ct_internationale TINYINT(1) DEFAULT NULL, ct_numerique_pix TINYINT(1) DEFAULT NULL, ct_teds TINYINT(1) DEFAULT NULL, ct_mtu TINYINT(1) DEFAULT NULL, ct_professionnelle TINYINT(1) DEFAULT NULL, ct_informationnelle TINYINT(1) DEFAULT NULL, vssh TINYINT(1) DEFAULT NULL, ct_numerique TINYINT(1) DEFAULT NULL, ct_recherche TINYINT(1) DEFAULT NULL, ct_collaboratif TINYINT(1) DEFAULT NULL, INDEX IDX_939F45447A4147F0 (mention_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F45447A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F45447A4147F0');
        $this->addSql('DROP TABLE ressource');
    }
}
