<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121172645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE toilet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE toilet (id INT NOT NULL, type VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, gps_coordinates TEXT NOT NULL, price INT NOT NULL, opening_times VARCHAR(255) DEFAULT NULL, is_accessible BOOLEAN DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN toilet.gps_coordinates IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE toilet_id_seq CASCADE');
        $this->addSql('DROP TABLE toilet');
    }
}
