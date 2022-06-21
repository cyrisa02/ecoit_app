<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617144004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formations_sections (formations_id INT NOT NULL, sections_id INT NOT NULL, INDEX IDX_9A4AB57B3BF5B0C2 (formations_id), INDEX IDX_9A4AB57B577906E4 (sections_id), PRIMARY KEY(formations_id, sections_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formations_sections ADD CONSTRAINT FK_9A4AB57B3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formations_sections ADD CONSTRAINT FK_9A4AB57B577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE formations_sections');
    }
}
