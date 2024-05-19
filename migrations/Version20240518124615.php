<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518124615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprentissage_critique DROP FOREIGN KEY FK_A3F4F1F515761DAB');
        $this->addSql('ALTER TABLE apprentissage_critique DROP FOREIGN KEY FK_A3F4F1F55582E9C0');
        $this->addSql('DROP INDEX IDX_A3F4F1F515761DAB ON apprentissage_critique');
        $this->addSql('DROP INDEX IDX_A3F4F1F55582E9C0 ON apprentissage_critique');
        $this->addSql('ALTER TABLE apprentissage_critique DROP bloc_id, DROP competence_id');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B5582E9C0');
        $this->addSql('DROP INDEX IDX_4BDFF36B5582E9C0 ON niveau');
        $this->addSql('ALTER TABLE niveau DROP bloc_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE niveau ADD bloc_id INT NOT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B5582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id)');
        $this->addSql('CREATE INDEX IDX_4BDFF36B5582E9C0 ON niveau (bloc_id)');
        $this->addSql('ALTER TABLE apprentissage_critique ADD bloc_id INT DEFAULT NULL, ADD competence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apprentissage_critique ADD CONSTRAINT FK_A3F4F1F515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE apprentissage_critique ADD CONSTRAINT FK_A3F4F1F55582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id)');
        $this->addSql('CREATE INDEX IDX_A3F4F1F515761DAB ON apprentissage_critique (competence_id)');
        $this->addSql('CREATE INDEX IDX_A3F4F1F55582E9C0 ON apprentissage_critique (bloc_id)');
    }
}
