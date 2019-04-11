<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190404142552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre ADD tarif_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F357C0A59 ON offre (tarif_id)');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C94CC8505A');
        $this->addSql('DROP INDEX IDX_E7189C94CC8505A ON tarif');
        $this->addSql('ALTER TABLE tarif DROP offre_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F357C0A59');
        $this->addSql('DROP INDEX IDX_AF86866F357C0A59 ON offre');
        $this->addSql('ALTER TABLE offre DROP tarif_id');
        $this->addSql('ALTER TABLE tarif ADD offre_id INT NOT NULL');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C94CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_E7189C94CC8505A ON tarif (offre_id)');
    }
}
