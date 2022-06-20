<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617144928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sections_quizes (sections_id INT NOT NULL, quizes_id INT NOT NULL, INDEX IDX_BEDA786577906E4 (sections_id), INDEX IDX_BEDA786E0AE9030 (quizes_id), PRIMARY KEY(sections_id, quizes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sections_quizes ADD CONSTRAINT FK_BEDA786577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sections_quizes ADD CONSTRAINT FK_BEDA786E0AE9030 FOREIGN KEY (quizes_id) REFERENCES quizes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sections_quizes');
    }
}
