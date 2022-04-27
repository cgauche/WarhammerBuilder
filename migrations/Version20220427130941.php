<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427130941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spells ADD RangeSpell VARCHAR(10) DEFAULT NULL, ADD TargetSpell VARCHAR(10) DEFAULT NULL, ADD LengthSpell VARCHAR(10) DEFAULT NULL, DROP `Range`, DROP Target, DROP Length, CHANGE Type TypeSpell VARCHAR(20) DEFAULT NULL COMMENT \'Bénédiction, Miracle, Sortilège\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spells ADD `Range` VARCHAR(10) DEFAULT NULL, ADD Target VARCHAR(10) DEFAULT NULL, ADD Length VARCHAR(10) DEFAULT NULL, DROP RangeSpell, DROP TargetSpell, DROP LengthSpell, CHANGE TypeSpell Type VARCHAR(20) DEFAULT NULL COMMENT \'Bénédiction, Miracle, Sortilège\'');
    }
}
