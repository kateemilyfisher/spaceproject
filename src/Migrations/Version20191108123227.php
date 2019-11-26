<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108123227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE space_station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organisation ADD space_station_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B42722A664 FOREIGN KEY (space_station_id) REFERENCES space_station (id)');
        $this->addSql('CREATE INDEX IDX_E6E132B42722A664 ON organisation (space_station_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE organisation DROP FOREIGN KEY FK_E6E132B42722A664');
        $this->addSql('DROP TABLE space_station');
        $this->addSql('DROP INDEX IDX_E6E132B42722A664 ON organisation');
        $this->addSql('ALTER TABLE organisation DROP space_station_id');
    }
}
