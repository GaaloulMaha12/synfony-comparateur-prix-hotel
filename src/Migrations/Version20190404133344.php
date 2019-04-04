<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190404133344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA94CC8505A');
        $this->addSql('DROP INDEX IDX_64C19AA94CC8505A ON agence');
        $this->addSql('ALTER TABLE agence DROP offre_id');
        $this->addSql('ALTER TABLE chambres DROP FOREIGN KEY FK_C509E4FF357C0A59');
        $this->addSql('ALTER TABLE chambres DROP FOREIGN KEY FK_C509E4FF4CC8505A');
        $this->addSql('DROP INDEX IDX_C509E4FF357C0A59 ON chambres');
        $this->addSql('DROP INDEX IDX_C509E4FF4CC8505A ON chambres');
        $this->addSql('ALTER TABLE chambres DROP offre_id, DROP tarif_id');
        $this->addSql('ALTER TABLE hotel ADD adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD agence_id INT NOT NULL, ADD chambre_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambres (id)');
        $this->addSql('CREATE INDEX IDX_AF86866FD725330D ON offre (agence_id)');
        $this->addSql('CREATE INDEX IDX_AF86866F9B177F54 ON offre (chambre_id)');
        $this->addSql('ALTER TABLE pension DROP FOREIGN KEY FK_79DC9C7A357C0A59');
        $this->addSql('DROP INDEX IDX_79DC9C7A357C0A59 ON pension');
        $this->addSql('ALTER TABLE pension DROP tarif_id');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C96DB67326');
        $this->addSql('DROP INDEX IDX_E7189C96DB67326 ON tarif');
        $this->addSql('ALTER TABLE tarif DROP pension_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE agence ADD offre_id INT NOT NULL');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_64C19AA94CC8505A ON agence (offre_id)');
        $this->addSql('ALTER TABLE chambres ADD offre_id INT DEFAULT NULL, ADD tarif_id INT NOT NULL');
        $this->addSql('ALTER TABLE chambres ADD CONSTRAINT FK_C509E4FF357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE chambres ADD CONSTRAINT FK_C509E4FF4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF357C0A59 ON chambres (tarif_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF4CC8505A ON chambres (offre_id)');
        $this->addSql('ALTER TABLE hotel DROP adresse');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FD725330D');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F9B177F54');
        $this->addSql('DROP INDEX IDX_AF86866FD725330D ON offre');
        $this->addSql('DROP INDEX IDX_AF86866F9B177F54 ON offre');
        $this->addSql('ALTER TABLE offre DROP agence_id, DROP chambre_id');
        $this->addSql('ALTER TABLE pension ADD tarif_id INT NOT NULL');
        $this->addSql('ALTER TABLE pension ADD CONSTRAINT FK_79DC9C7A357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_79DC9C7A357C0A59 ON pension (tarif_id)');
        $this->addSql('ALTER TABLE tarif ADD pension_id INT NOT NULL');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C96DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('CREATE INDEX IDX_E7189C96DB67326 ON tarif (pension_id)');
    }
}
