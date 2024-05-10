<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507193009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces_mention (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, mention_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_47635C65FB88E14F (utilisateur_id), INDEX IDX_47635C657A4147F0 (mention_id), INDEX IDX_47635C65D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apprentissage_critique (id INT AUTO_INCREMENT NOT NULL, bloc_id INT NOT NULL, niveau_id INT NOT NULL, libelle VARCHAR(150) NOT NULL, INDEX IDX_A3F4F1F55582E9C0 (bloc_id), INDEX IDX_A3F4F1F5B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, mention_id INT NOT NULL, libelle LONGTEXT NOT NULL, INDEX IDX_C778955A7A4147F0 (mention_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composante (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, grade VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mention (id INT AUTO_INCREMENT NOT NULL, resp_id INT NOT NULL, grade_id INT NOT NULL, composante_id INT NOT NULL, titre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rncp VARCHAR(10) DEFAULT NULL, INDEX IDX_E20259CDF2EFA634 (resp_id), INDEX IDX_E20259CDFE19A1A8 (grade_id), INDEX IDX_E20259CDAC12F1AD (composante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, bloc_id INT NOT NULL, niveau INT NOT NULL, description VARCHAR(50) NOT NULL, INDEX IDX_4BDFF36B5582E9C0 (bloc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, mention_id INT NOT NULL, resp_id INT NOT NULL, titre VARCHAR(255) NOT NULL, referent VARCHAR(50) DEFAULT NULL, min_stage INT DEFAULT NULL, max_stage INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_99B1DEE37A4147F0 (mention_id), INDEX IDX_99B1DEE3F2EFA634 (resp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours_bloc (parcours_id INT NOT NULL, bloc_id INT NOT NULL, INDEX IDX_57BD33906E38C0DB (parcours_id), INDEX IDX_57BD33905582E9C0 (bloc_id), PRIMARY KEY(parcours_id, bloc_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(11) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(40) NOT NULL, nom VARCHAR(40) NOT NULL, mail VARCHAR(100) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_MAIL (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acces_mention ADD CONSTRAINT FK_47635C65FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE acces_mention ADD CONSTRAINT FK_47635C657A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE acces_mention ADD CONSTRAINT FK_47635C65D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE apprentissage_critique ADD CONSTRAINT FK_A3F4F1F55582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id)');
        $this->addSql('ALTER TABLE apprentissage_critique ADD CONSTRAINT FK_A3F4F1F5B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE bloc ADD CONSTRAINT FK_C778955A7A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CDF2EFA634 FOREIGN KEY (resp_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CDFE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CDAC12F1AD FOREIGN KEY (composante_id) REFERENCES composante (id)');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B5582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE37A4147F0 FOREIGN KEY (mention_id) REFERENCES mention (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3F2EFA634 FOREIGN KEY (resp_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE parcours_bloc ADD CONSTRAINT FK_57BD33906E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parcours_bloc ADD CONSTRAINT FK_57BD33905582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_mention DROP FOREIGN KEY FK_47635C65FB88E14F');
        $this->addSql('ALTER TABLE acces_mention DROP FOREIGN KEY FK_47635C657A4147F0');
        $this->addSql('ALTER TABLE acces_mention DROP FOREIGN KEY FK_47635C65D60322AC');
        $this->addSql('ALTER TABLE apprentissage_critique DROP FOREIGN KEY FK_A3F4F1F55582E9C0');
        $this->addSql('ALTER TABLE apprentissage_critique DROP FOREIGN KEY FK_A3F4F1F5B3E9C81');
        $this->addSql('ALTER TABLE bloc DROP FOREIGN KEY FK_C778955A7A4147F0');
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY FK_E20259CDF2EFA634');
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY FK_E20259CDFE19A1A8');
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY FK_E20259CDAC12F1AD');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B5582E9C0');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE37A4147F0');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3F2EFA634');
        $this->addSql('ALTER TABLE parcours_bloc DROP FOREIGN KEY FK_57BD33906E38C0DB');
        $this->addSql('ALTER TABLE parcours_bloc DROP FOREIGN KEY FK_57BD33905582E9C0');
        $this->addSql('DROP TABLE acces_mention');
        $this->addSql('DROP TABLE apprentissage_critique');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE composante');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE mention');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE parcours_bloc');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
