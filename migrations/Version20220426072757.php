<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426072757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE armoury CHANGE Type TypeGear VARCHAR(10) DEFAULT NULL COMMENT \'Arme, Armure\', CHANGE `Group` GroupGear VARCHAR(20) DEFAULT NULL COMMENT \'à distance, cuir...\', CHANGE Location LocationGear VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE armoury CHANGE TypeGear Type VARCHAR(10) DEFAULT NULL COMMENT \'Arme, Armure\', CHANGE GroupGear `Group` VARCHAR(20) DEFAULT NULL COMMENT \'à distance, cuir...\', CHANGE LocationGear Location VARCHAR(10) DEFAULT NULL');
    }
}
