<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613133024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B964398FED07355');
        $this->addSql('DROP INDEX UNIQ_2B964398FED07355 ON sections');
        $this->addSql('ALTER TABLE sections DROP lessons_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sections ADD lessons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B964398FED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B964398FED07355 ON sections (lessons_id)');
    }
}
