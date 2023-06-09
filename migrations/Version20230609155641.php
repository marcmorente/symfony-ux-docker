<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609155641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE priority (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo (id INT AUTO_INCREMENT NOT NULL, priority_id INT NOT NULL, task VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5A0EB6A0497B19F9 (priority_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todo ADD CONSTRAINT FK_5A0EB6A0497B19F9 FOREIGN KEY (priority_id) REFERENCES priority (id)');
        //Inserting data into priority table
        $this->addSql('INSERT INTO priority (name) VALUES (\'Low\')');
        $this->addSql('INSERT INTO priority (name) VALUES (\'Medium\')');
        $this->addSql('INSERT INTO priority (name) VALUES (\'High\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo DROP FOREIGN KEY FK_5A0EB6A0497B19F9');
        $this->addSql('DROP TABLE priority');
        $this->addSql('DROP TABLE todo');
        //Deleting data from priority table
        $this->addSql('DELETE FROM priority WHERE name = \'Low\'');
        $this->addSql('DELETE FROM priority WHERE name = \'Medium\'');
        $this->addSql('DELETE FROM priority WHERE name = \'High\'');
    }
}
