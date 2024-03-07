<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307082623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, name, location, theme, attendee, price, date FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(80) NOT NULL, location VARCHAR(255) NOT NULL, theme VARCHAR(80) NOT NULL, attendee INTEGER DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO event (id, name, location, theme, attendee, price, date) SELECT id, name, location, theme, attendee, price, date FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event AS SELECT id, name, location, theme, price, date, attendee FROM event');
        $this->addSql('DROP TABLE event');
        $this->addSql('CREATE TABLE event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(80) NOT NULL, location VARCHAR(255) NOT NULL, theme VARCHAR(80) NOT NULL, price NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL, attendee INTEGER NOT NULL)');
        $this->addSql('INSERT INTO event (id, name, location, theme, price, date, attendee) SELECT id, name, location, theme, price, date, attendee FROM __temp__event');
        $this->addSql('DROP TABLE __temp__event');
    }
}
