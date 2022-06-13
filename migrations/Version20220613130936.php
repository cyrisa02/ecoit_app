<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613130936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sections_lessons');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sections_lessons (sections_id INT NOT NULL, lessons_id INT NOT NULL, INDEX IDX_BFA2D24FFED07355 (lessons_id), INDEX IDX_BFA2D24F577906E4 (sections_id), PRIMARY KEY(sections_id, lessons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sections_lessons ADD CONSTRAINT FK_BFA2D24FFED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sections_lessons ADD CONSTRAINT FK_BFA2D24F577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id) ON DELETE CASCADE');
    }
}
