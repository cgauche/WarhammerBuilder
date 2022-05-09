<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506122936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skills_rank (id INT AUTO_INCREMENT NOT NULL, id_ranks INT DEFAULT NULL, id_skills INT DEFAULT NULL, specs VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talents_rank (id INT AUTO_INCREMENT NOT NULL, id_ranks INT DEFAULT NULL, id_talents INT DEFAULT NULL, specs VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trapping_rank (id INT AUTO_INCREMENT NOT NULL, id_ranks INT DEFAULT NULL, id_trapping INT DEFAULT NULL, type INT DEFAULT NULL, specs VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ranks ADD status VARCHAR(255) DEFAULT NULL, DROP Description');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE skills_rank');
        $this->addSql('DROP TABLE talents_rank');
        $this->addSql('DROP TABLE trapping_rank');
        $this->addSql('ALTER TABLE ranks ADD Description VARCHAR(1000) DEFAULT NULL, DROP status');
    }
}
