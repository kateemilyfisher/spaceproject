<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191112142412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F54A2FC60');
        $this->addSql('DROP INDEX UNIQ_462CE4F54A2FC60 ON position');
        $this->addSql('ALTER TABLE position ADD space_station_id INT DEFAULT NULL, DROP space_station_id_id');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F52722A664 FOREIGN KEY (space_station_id) REFERENCES space_station (id)');
        $this->addSql('CREATE INDEX IDX_462CE4F52722A664 ON position (space_station_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F52722A664');
        $this->addSql('DROP INDEX IDX_462CE4F52722A664 ON position');
        $this->addSql('ALTER TABLE position ADD space_station_id_id INT NOT NULL, DROP space_station_id');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F54A2FC60 FOREIGN KEY (space_station_id_id) REFERENCES space_station (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_462CE4F54A2FC60 ON position (space_station_id_id)');
    }
}
