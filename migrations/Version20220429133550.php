<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429133550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX FK_TALENT_SKILL ON talents');
        $this->addSql('DROP INDEX FK_TALENT_CARAC ON talents');
        $this->addSql('ALTER TABLE talents DROP ID_Skill, DROP ID_Caracteristics');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE talents ADD ID_Skill INT DEFAULT NULL, ADD ID_Caracteristics INT DEFAULT NULL');
        $this->addSql('CREATE INDEX FK_TALENT_SKILL ON talents (ID_Skill)');
        $this->addSql('CREATE INDEX FK_TALENT_CARAC ON talents (ID_Caracteristics)');
    }
}
