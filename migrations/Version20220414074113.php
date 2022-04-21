<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414074113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animals_vehicles CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Clutter Clutter INT NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE armoury CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Clutter Clutter INT NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE bags_containers CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Clutter Clutter INT NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE caracteristics CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE careers CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE char_caracteristics CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Inc_val Inc_val INT NOT NULL, CHANGE Talent Talent INT NOT NULL');
        $this->addSql('ALTER TABLE char_spells CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE char_trapping CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE characters CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE classes CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE events CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ranks CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE skills CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Specs Specs TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE skillspecs CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE source CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE spec_careers CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE species CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE FR_spend FR_spend INT DEFAULT NULL');
        $this->addSql('ALTER TABLE spell_type CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE spells CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE NI NI INT DEFAULT NULL');
        $this->addSql('ALTER TABLE talents CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE trapping CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Clutter Clutter INT NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE xp CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE Actual Actual INT NOT NULL, CHANGE Spent Spent INT NOT NULL, CHANGE Total Total INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE animals_vehicles CHANGE ID ID INT NOT NULL, CHANGE Clutter Clutter INT DEFAULT 0 NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE armoury CHANGE ID ID INT NOT NULL, CHANGE Clutter Clutter INT DEFAULT 0 NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE bags_containers CHANGE ID ID INT NOT NULL, CHANGE Clutter Clutter INT DEFAULT 0 NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE caracteristics CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE careers CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE char_caracteristics CHANGE ID ID INT NOT NULL, CHANGE Inc_val Inc_val INT DEFAULT 0 NOT NULL, CHANGE Talent Talent INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE char_spells CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE char_trapping CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE characters CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE classes CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE events CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE ranks CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE skills CHANGE ID ID INT NOT NULL, CHANGE Specs Specs TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE skillspecs CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE source CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE spec_careers CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE species CHANGE ID ID INT NOT NULL, CHANGE FR_spend FR_spend INT DEFAULT 0');
        $this->addSql('ALTER TABLE spell_type CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE spells CHANGE ID ID INT NOT NULL, CHANGE NI NI INT DEFAULT 0');
        $this->addSql('ALTER TABLE talents CHANGE ID ID INT NOT NULL');
        $this->addSql('ALTER TABLE trapping CHANGE ID ID INT NOT NULL, CHANGE Clutter Clutter INT DEFAULT 0 NOT NULL COMMENT \'Encombrement\'');
        $this->addSql('ALTER TABLE xp CHANGE ID ID INT NOT NULL, CHANGE Actual Actual INT DEFAULT 0 NOT NULL, CHANGE Spent Spent INT DEFAULT 0 NOT NULL, CHANGE Total Total INT DEFAULT 0 NOT NULL');
    }
}
