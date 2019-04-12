<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411134939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F357C0A59');
        $this->addSql('CREATE TABLE categoriechambre (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('ALTER TABLE chambre DROP nomchambre');
        $this->addSql('DROP INDEX IDX_AF86866F357C0A59 ON offre');
        $this->addSql('ALTER TABLE offre ADD categoriechambre_id INT DEFAULT NULL, ADD tariflocal VARCHAR(255) NOT NULL, DROP tarif_id');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F7BD4D14E FOREIGN KEY (categoriechambre_id) REFERENCES categoriechambre (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F7BD4D14E ON offre (categoriechambre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F7BD4D14E');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, prix VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE categoriechambre');
        $this->addSql('ALTER TABLE chambre ADD nomchambre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_AF86866F7BD4D14E ON offre');
        $this->addSql('ALTER TABLE offre ADD tarif_id INT NOT NULL, DROP categoriechambre_id, DROP tariflocal');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F357C0A59 ON offre (tarif_id)');
    }
}
