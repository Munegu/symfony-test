<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220910101911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, times_id INTEGER NOT NULL, start_date DATE NOT NULL, name VARCHAR(255) NOT NULL, price_sold INTEGER NOT NULL, type VARCHAR(255) NOT NULL, technology VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, workers VARCHAR(255) NOT NULL, CONSTRAINT FK_2FB3D0EE5624BEDC FOREIGN KEY (times_id) REFERENCES time (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE5624BEDC ON project (times_id)');
        $this->addSql('CREATE TABLE time (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, estimated_time_to_completion INTEGER NOT NULL, spent_time INTEGER NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE time');
    }
}
