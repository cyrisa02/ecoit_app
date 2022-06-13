<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613131718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons ADD sections_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F4218D9577906E4 ON lessons (sections_id)');
        $this->addSql('ALTER TABLE sections ADD lessons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B964398FED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B964398FED07355 ON sections (lessons_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D9577906E4');
        $this->addSql('DROP INDEX UNIQ_3F4218D9577906E4 ON lessons');
        $this->addSql('ALTER TABLE lessons DROP sections_id');
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B964398FED07355');
        $this->addSql('DROP INDEX UNIQ_2B964398FED07355 ON sections');
        $this->addSql('ALTER TABLE sections DROP lessons_id');
    }
}
