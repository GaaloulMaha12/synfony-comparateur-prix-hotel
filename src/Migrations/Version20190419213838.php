<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419213838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detailsoffre ADD categoriechambre_id INT DEFAULT NULL, ADD tarif_id INT NOT NULL, DROP type_chambre, DROP categorie_chambre, DROP type_pension, DROP tarif, CHANGE chambre_id chambre_id INT NOT NULL, CHANGE pension_id pension_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B7BD4D14E FOREIGN KEY (categoriechambre_id) REFERENCES categoriechambre (id)');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_A218887B7BD4D14E ON detailsoffre (categoriechambre_id)');
        $this->addSql('CREATE INDEX IDX_A218887B357C0A59 ON detailsoffre (tarif_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detailsoffre DROP FOREIGN KEY FK_A218887B7BD4D14E');
        $this->addSql('ALTER TABLE detailsoffre DROP FOREIGN KEY FK_A218887B357C0A59');
        $this->addSql('DROP INDEX IDX_A218887B7BD4D14E ON detailsoffre');
        $this->addSql('DROP INDEX IDX_A218887B357C0A59 ON detailsoffre');
        $this->addSql('ALTER TABLE detailsoffre ADD type_chambre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD categorie_chambre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD type_pension VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD tarif VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP categoriechambre_id, DROP tarif_id, CHANGE chambre_id chambre_id INT DEFAULT NULL, CHANGE pension_id pension_id INT DEFAULT NULL');
    }
}
