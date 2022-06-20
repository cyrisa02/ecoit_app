<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617144504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lessons_sections (lessons_id INT NOT NULL, sections_id INT NOT NULL, INDEX IDX_34140A2CFED07355 (lessons_id), INDEX IDX_34140A2C577906E4 (sections_id), PRIMARY KEY(lessons_id, sections_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lessons_sections ADD CONSTRAINT FK_34140A2CFED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lessons_sections ADD CONSTRAINT FK_34140A2C577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lessons_sections');
    }
}
