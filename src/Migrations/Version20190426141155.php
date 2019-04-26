<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426141155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detailsoffre (id INT AUTO_INCREMENT NOT NULL, chambre_id INT NOT NULL, pension_id INT NOT NULL, categoriechambre_id INT DEFAULT NULL, offre_id INT NOT NULL, lien_offre VARCHAR(255) NOT NULL, tarif VARCHAR(255) NOT NULL, INDEX IDX_A218887B9B177F54 (chambre_id), INDEX IDX_A218887B6DB67326 (pension_id), INDEX IDX_A218887B7BD4D14E (categoriechambre_id), INDEX IDX_A218887B4CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, contenu_element VARCHAR(255) NOT NULL, type_element VARCHAR(255) NOT NULL, INDEX IDX_41405E39C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, hotel_id INT NOT NULL, imagehotel VARCHAR(255) NOT NULL, INDEX IDX_C53D045F3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, agence_id INT NOT NULL, nomoffre VARCHAR(255) NOT NULL, datedebut DATETIME NOT NULL, datefin DATETIME NOT NULL, INDEX IDX_AF86866F3243BB18 (hotel_id), INDEX IDX_AF86866FD725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, typepage VARCHAR(255) NOT NULL, titrepage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, administrateur_id INT DEFAULT NULL, nomparametre VARCHAR(255) NOT NULL, typeparametre VARCHAR(255) NOT NULL, valeurparametre VARCHAR(255) NOT NULL, INDEX IDX_ACC790417EE5403C (administrateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pension (id INT AUTO_INCREMENT NOT NULL, typepension VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B6DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B7BD4D14E FOREIGN KEY (categoriechambre_id) REFERENCES categoriechambre (id)');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE parametre ADD CONSTRAINT FK_ACC790417EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parametre DROP FOREIGN KEY FK_ACC790417EE5403C');
        $this->addSql('ALTER TABLE detailsoffre DROP FOREIGN KEY FK_A218887B4CC8505A');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39C4663E4');
        $this->addSql('ALTER TABLE detailsoffre DROP FOREIGN KEY FK_A218887B6DB67326');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE detailsoffre');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE pension');
    }
}
