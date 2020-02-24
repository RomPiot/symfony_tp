<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200222230153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, lastname, email, is_active, is_blocked, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, lastname VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, is_active BOOLEAN DEFAULT \'1\' NOT NULL, is_blocked BOOLEAN DEFAULT \'0\' NOT NULL, password VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE BINARY, roles CLOB DEFAULT \'[]\' NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO user (id, name, lastname, email, is_active, is_blocked, password) SELECT id, name, lastname, email, is_active, is_blocked, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, lastname, email, is_active, is_blocked, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT \'1\' NOT NULL, is_blocked BOOLEAN DEFAULT \'0\' NOT NULL, password VARCHAR(255) DEFAULT \'\' NOT NULL)');
        $this->addSql('INSERT INTO user (id, name, lastname, email, is_active, is_blocked, password) SELECT id, name, lastname, email, is_active, is_blocked, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
