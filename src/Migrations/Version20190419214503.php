<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419214503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detailsoffre DROP FOREIGN KEY FK_A218887B357C0A59');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP INDEX IDX_A218887B357C0A59 ON detailsoffre');
        $this->addSql('ALTER TABLE detailsoffre ADD tarif VARCHAR(255) NOT NULL, DROP tarif_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, prix VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE detailsoffre ADD tarif_id INT NOT NULL, DROP tarif');
        $this->addSql('ALTER TABLE detailsoffre ADD CONSTRAINT FK_A218887B357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('CREATE INDEX IDX_A218887B357C0A59 ON detailsoffre (tarif_id)');
    }
}
