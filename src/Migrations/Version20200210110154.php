<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210110154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, title, content, created_at, is_published, is_deleted, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, author_id INTEGER NOT NULL, is_published BOOLEAN DEFAULT \'1\' NOT NULL, is_deleted BOOLEAN DEFAULT \'0\' NOT NULL)');
        $this->addSql('INSERT INTO post (id, title, content, created_at, is_published, is_deleted, author_id) SELECT id, title, content, created_at, is_published, is_deleted, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, lastname, email, is_active, is_blocked FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, lastname VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, is_active BOOLEAN DEFAULT \'1\' NOT NULL, is_blocked BOOLEAN DEFAULT \'0\' NOT NULL)');
        $this->addSql('INSERT INTO user (id, name, lastname, email, is_active, is_blocked) SELECT id, name, lastname, email, is_active, is_blocked FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, content, created_at, is_deleted, post_id, author_id FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, is_deleted BOOLEAN DEFAULT \'0\' NOT NULL)');
        $this->addSql('INSERT INTO comment (id, content, created_at, is_deleted, post_id, author_id) SELECT id, content, created_at, is_deleted, post_id, author_id FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, content, created_at, is_deleted, post_id, author_id FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, is_deleted BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO comment (id, content, created_at, is_deleted, post_id, author_id) SELECT id, content, created_at, is_deleted, post_id, author_id FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, title, content, created_at, is_published, is_deleted, author_id FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, created_at DATETIME NOT NULL, author_id INTEGER NOT NULL, is_published BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO post (id, title, content, created_at, is_published, is_deleted, author_id) SELECT id, title, content, created_at, is_published, is_deleted, author_id FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, lastname, email, is_active, is_blocked FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, is_blocked BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, name, lastname, email, is_active, is_blocked) SELECT id, name, lastname, email, is_active, is_blocked FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
