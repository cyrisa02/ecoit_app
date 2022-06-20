<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617144744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizes DROP FOREIGN KEY FK_8E40FA13577906E4');
        $this->addSql('DROP INDEX UNIQ_8E40FA13577906E4 ON quizes');
        $this->addSql('ALTER TABLE quizes DROP sections_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizes ADD sections_id INT NOT NULL');
        $this->addSql('ALTER TABLE quizes ADD CONSTRAINT FK_8E40FA13577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8E40FA13577906E4 ON quizes (sections_id)');
    }
}
