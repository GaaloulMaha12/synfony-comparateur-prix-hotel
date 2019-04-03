<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403133821 extends AbstractMigration
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
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, offre_id INT NOT NULL, nom_agence VARCHAR(255) NOT NULL, lien_agence VARCHAR(255) NOT NULL, INDEX IDX_64C19AA94CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, offre_id INT DEFAULT NULL, tarif_id INT NOT NULL, typechambre VARCHAR(255) NOT NULL, nomchambre VARCHAR(255) NOT NULL, INDEX IDX_C509E4FF4CC8505A (offre_id), INDEX IDX_C509E4FF357C0A59 (tarif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, nomhotel VARCHAR(255) NOT NULL, positionhotel VARCHAR(255) NOT NULL, typehotel VARCHAR(255) NOT NULL, note VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, pension_id INT DEFAULT NULL, nomoffre VARCHAR(255) NOT NULL, datedebut VARCHAR(255) NOT NULL, datefin VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, INDEX IDX_AF86866F6DB67326 (pension_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, typepage VARCHAR(255) NOT NULL, titrepage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pension (id INT AUTO_INCREMENT NOT NULL, tarif_id INT NOT NULL, typepension VARCHAR(255) NOT NULL, INDEX IDX_79DC9C7A357C0A59 (tarif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, pension_id INT NOT NULL, offre_id INT NOT NULL, prix VARCHAR(255) NOT NULL, INDEX IDX_E7189C96DB67326 (pension_id), INDEX IDX_E7189C94CC8505A (offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F6DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('ALTER TABLE pension ADD CONSTRAINT FK_79DC9C7A357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C96DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA94CC8505A');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF4CC8505A');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C94CC8505A');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F6DB67326');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C96DB67326');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF357C0A59');
        $this->addSql('ALTER TABLE pension DROP FOREIGN KEY FK_79DC9C7A357C0A59');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE pension');
        $this->addSql('DROP TABLE tarif');
    }
}
