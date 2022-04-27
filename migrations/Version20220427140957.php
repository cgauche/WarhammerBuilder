<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427140957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animals_vehicles (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Price VARCHAR(10) DEFAULT NULL, Clutter INT NOT NULL COMMENT \'Encombrement\', Contents INT DEFAULT NULL, Availability VARCHAR(10) DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_AV_SOURCE (ID_Source), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE armoury (ID INT AUTO_INCREMENT NOT NULL, TypeGear VARCHAR(10) DEFAULT NULL COMMENT \'Arme, Armure\', GroupGear VARCHAR(20) DEFAULT NULL COMMENT \'à distance, cuir...\', Name VARCHAR(20) DEFAULT NULL, Price VARCHAR(10) DEFAULT NULL, Clutter INT NOT NULL COMMENT \'Encombrement\', Availability VARCHAR(10) DEFAULT NULL, RangeGear VARCHAR(10) DEFAULT NULL, Damage VARCHAR(10) DEFAULT NULL, Advantage_flaw VARCHAR(10) DEFAULT NULL, Penalty VARCHAR(10) DEFAULT NULL, LocationGear VARCHAR(10) DEFAULT NULL, PA VARCHAR(10) DEFAULT NULL, Description VARCHAR(10) DEFAULT NULL, ID_Source INT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bags_containers (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Price VARCHAR(10) DEFAULT NULL, Clutter INT NOT NULL COMMENT \'Encombrement\', Contents INT DEFAULT NULL, Availability VARCHAR(10) DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_BC_SOURCE (ID_Source), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE careers (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) NOT NULL, Description VARCHAR(2047) DEFAULT NULL, ID_Class INT DEFAULT NULL, ID_Source INT DEFAULT NULL, resume VARCHAR(255) DEFAULT NULL, INDEX FK_CAREER_SOURCE (ID_Source), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_caracteristics (ID INT AUTO_INCREMENT NOT NULL, Init_val INT NOT NULL, Inc_val INT NOT NULL, Talent INT NOT NULL, ID_Char INT NOT NULL, ID_Caracteristics INT NOT NULL, INDEX FK_CARAC_CARAC (ID_Caracteristics), INDEX FK_CARAC_CHAR (ID_Char), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_spells (ID INT AUTO_INCREMENT NOT NULL, ID_Char INT NOT NULL, ID_Spell INT NOT NULL, INDEX FK_CHAR_CHAR (ID_Char), INDEX FK_CHAR_SPELL (ID_Spell), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_trapping (ID INT AUTO_INCREMENT NOT NULL, ID_Char INT NOT NULL, Description VARCHAR(1000) DEFAULT NULL, ID_Armoury INT DEFAULT NULL, ID_Bags_containers INT DEFAULT NULL, ID_Animals_vehicles INT DEFAULT NULL, ID_Trapping INT DEFAULT NULL, Quantity INT DEFAULT NULL, INDEX FK_TRAP_ARM (ID_Armoury), INDEX FK_TRAP_AV (ID_Animals_vehicles), INDEX FK_TRAP_CHAR (ID_Char), INDEX FK_TRAP_BAGS (ID_Bags_containers), INDEX FK_TRAP_TRAP (ID_Trapping), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characteristics (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(10) DEFAULT NULL, Abridged VARCHAR(4) DEFAULT NULL, Description VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(50) DEFAULT NULL, Description VARCHAR(2500) DEFAULT NULL, Fate INT DEFAULT NULL, Luck INT DEFAULT NULL, Resilience INT DEFAULT NULL, Determination INT DEFAULT NULL, ID_Species INT NOT NULL, ID_Career INT DEFAULT NULL, INDEX FK_CHAR_SPECIE (ID_Species), INDEX FK_CHAR_CAREER (ID_Career), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) NOT NULL, Description VARCHAR(1000) DEFAULT NULL, id_source INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) NOT NULL, Description VARCHAR(1000) NOT NULL, ID_Char INT NOT NULL, INDEX FK_EVE_CHAR (ID_Char), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ranks (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) NOT NULL, Description VARCHAR(1000) DEFAULT NULL, ID_Career INT DEFAULT NULL, INDEX FK_RANK_CAREER (ID_Career), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Type VARCHAR(20) DEFAULT NULL COMMENT \'Base ou Avancée\', Description VARCHAR(1000) DEFAULT NULL, Specs TINYINT(1) NOT NULL, ID_Caracteristics INT DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_SKILL_SOURCE (ID_Source), INDEX FK_SKILL_CARAC (ID_Caracteristics), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skillspecs (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Description VARCHAR(1000) DEFAULT NULL, ID_Skill INT DEFAULT NULL, INDEX FK_SSpec_SKILL (ID_Skill), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Year INT DEFAULT NULL, ISBN BIGINT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spec_careers (ID INT AUTO_INCREMENT NOT NULL, ID_Species INT NOT NULL, ID_Career INT NOT NULL, rollmin INT NOT NULL, rollmax INT NOT NULL, INDEX FK_SCAREER_CAREER (ID_Career), INDEX FK_SCAREER_SPECIE (ID_Species), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Rollmin INT DEFAULT 101 NOT NULL, Rollmax INT DEFAULT 101 NOT NULL, Description VARCHAR(2500) DEFAULT NULL, Randomtalents INT DEFAULT NULL, Age INT DEFAULT NULL, Rollage INT DEFAULT NULL, Height INT DEFAULT NULL, Rollheight INT DEFAULT NULL, Fate INT DEFAULT NULL, Resilience INT DEFAULT NULL, FR_spend INT DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_Specie_SOURCE (ID_Source), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell_family (ID INT AUTO_INCREMENT NOT NULL, Type VARCHAR(20) DEFAULT NULL, Name VARCHAR(20) DEFAULT NULL, Real_name VARCHAR(20) DEFAULT NULL, Color VARCHAR(20) DEFAULT NULL, Description VARCHAR(1000) DEFAULT NULL, id_source INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spells (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) NOT NULL, TypeSpell VARCHAR(20) DEFAULT NULL COMMENT \'Bénédiction, Miracle, Sortilège\', NI INT DEFAULT NULL, RangeSpell VARCHAR(10) DEFAULT NULL, TargetSpell VARCHAR(10) DEFAULT NULL, LengthSpell VARCHAR(10) DEFAULT NULL, Damage VARCHAR(10) DEFAULT NULL, Description VARCHAR(10) DEFAULT NULL, ID_Spell_type INT DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_SPELL_SOURCE (ID_Source), INDEX FK_SPELL_TYPE (ID_Spell_type), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talents (ID INT AUTO_INCREMENT NOT NULL, Name VARCHAR(20) DEFAULT NULL, Description VARCHAR(1000) DEFAULT NULL, ID_Skill INT DEFAULT NULL, ID_Caracteristics INT DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_TALENT_SKILL (ID_Skill), INDEX FK_TALENT_SOURCE (ID_Source), INDEX FK_TALENT_CARAC (ID_Caracteristics), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trapping (ID INT AUTO_INCREMENT NOT NULL, Type VARCHAR(20) DEFAULT NULL COMMENT \'Catégorie\', Name VARCHAR(20) DEFAULT NULL, Price VARCHAR(10) DEFAULT NULL, Clutter INT NOT NULL COMMENT \'Encombrement\', Availability VARCHAR(10) DEFAULT NULL, ID_Source INT DEFAULT NULL, INDEX FK_TRAP_SOURCE (ID_Source), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wattr_armoury (id INT AUTO_INCREMENT NOT NULL, id_weapon_attr INT DEFAULT NULL, rank INT DEFAULT NULL, id_armoury INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon_attr (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(1023) DEFAULT NULL, id_source INT DEFAULT NULL, with_rank TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE xp (ID INT AUTO_INCREMENT NOT NULL, Actual INT NOT NULL, Spent INT NOT NULL, Total INT NOT NULL, ID_char INT NOT NULL, INDEX FK_XP_CHAR (ID_char), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animals_vehicles');
        $this->addSql('DROP TABLE armoury');
        $this->addSql('DROP TABLE bags_containers');
        $this->addSql('DROP TABLE careers');
        $this->addSql('DROP TABLE char_caracteristics');
        $this->addSql('DROP TABLE char_spells');
        $this->addSql('DROP TABLE char_trapping');
        $this->addSql('DROP TABLE characteristics');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE ranks');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE skillspecs');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE spec_careers');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE spell_family');
        $this->addSql('DROP TABLE spells');
        $this->addSql('DROP TABLE talents');
        $this->addSql('DROP TABLE trapping');
        $this->addSql('DROP TABLE wattr_armoury');
        $this->addSql('DROP TABLE weapon_attr');
        $this->addSql('DROP TABLE xp');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
