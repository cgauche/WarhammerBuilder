<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426150443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spell_familly (ID INT AUTO_INCREMENT NOT NULL, Type VARCHAR(20) DEFAULT NULL, Name VARCHAR(20) DEFAULT NULL, Real_name VARCHAR(20) DEFAULT NULL, Color VARCHAR(20) DEFAULT NULL, Description VARCHAR(1000) DEFAULT NULL, id_source INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE spell_type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE spell_type (ID INT AUTO_INCREMENT NOT NULL, Type VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_bin`, Name VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_bin`, Real_name VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_bin`, Color VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_bin`, Description VARCHAR(1000) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_bin`, id_source INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_bin` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE spell_familly');
    }
}
