<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409221427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre ADD categoriechambre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F7BD4D14E FOREIGN KEY (categoriechambre_id) REFERENCES categoriechambre (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F7BD4D14E ON offre (categoriechambre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F7BD4D14E');
        $this->addSql('DROP INDEX IDX_AF86866F7BD4D14E ON offre');
        $this->addSql('ALTER TABLE offre DROP categoriechambre_id');
    }
}
