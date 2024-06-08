<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601112207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, mention_id INT NOT NULL, niveau_id INT NOT NULL, code_ue VARCHAR(20) NOT NULL, libelle_ue VARCHAR(255) NOT NULL, coeff INT DEFAULT NULL, ects INT DEFAULT NULL, m3c VARCHAR(255) DEFAULT NULL, m3c_assiduite VARCHAR(255) DEFAULT NULL, m3c_session2 VARCHAR(255) DEFAULT NULL, INDEX IDX_2E490A9B7A4147F0 (mention_id), INDEX IDX_2E490A9BB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_ressource (ue_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_DB3686DE62E883B1 (ue_id), INDEX IDX_DB3686DEFC6CD52A (ressource_id), PRIMARY KEY(ue_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_parcours (ue_id INT NOT NULL, parcours_id INT NOT NULL, INDEX IDX_82440F4462E883B1 (ue_id), INDEX IDX_82440F446E38C0DB (parcours_id), PRIMARY KEY(ue_id, parcours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B7A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9BB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE ue_ressource ADD CONSTRAINT FK_DB3686DE62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_ressource ADD CONSTRAINT FK_DB3686DEFC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_parcours ADD CONSTRAINT FK_82440F4462E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_parcours ADD CONSTRAINT FK_82440F446E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B7A4147F0');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9BB3E9C81');
        $this->addSql('ALTER TABLE ue_ressource DROP FOREIGN KEY FK_DB3686DE62E883B1');
        $this->addSql('ALTER TABLE ue_ressource DROP FOREIGN KEY FK_DB3686DEFC6CD52A');
        $this->addSql('ALTER TABLE ue_parcours DROP FOREIGN KEY FK_82440F4462E883B1');
        $this->addSql('ALTER TABLE ue_parcours DROP FOREIGN KEY FK_82440F446E38C0DB');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE ue_ressource');
        $this->addSql('DROP TABLE ue_parcours');
    }
}
