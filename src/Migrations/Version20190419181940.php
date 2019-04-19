<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419181940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F6DB67326');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F7BD4D14E');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F9B177F54');
        $this->addSql('DROP INDEX IDX_AF86866F6DB67326 ON offre');
        $this->addSql('DROP INDEX IDX_AF86866F7BD4D14E ON offre');
        $this->addSql('DROP INDEX IDX_AF86866F9B177F54 ON offre');
        $this->addSql('ALTER TABLE offre DROP pension_id, DROP chambre_id, DROP categoriechambre_id, DROP tariflocal, DROP lienoffre, CHANGE datedebut datedebut DATETIME NOT NULL, CHANGE datefin datefin DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre ADD pension_id INT DEFAULT NULL, ADD chambre_id INT NOT NULL, ADD categoriechambre_id INT DEFAULT NULL, ADD tariflocal VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD lienoffre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE datedebut datedebut VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE datefin datefin VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F6DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F7BD4D14E FOREIGN KEY (categoriechambre_id) REFERENCES categoriechambre (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F6DB67326 ON offre (pension_id)');
        $this->addSql('CREATE INDEX IDX_AF86866F7BD4D14E ON offre (categoriechambre_id)');
        $this->addSql('CREATE INDEX IDX_AF86866F9B177F54 ON offre (chambre_id)');
    }
}
