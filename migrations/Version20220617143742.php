<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617143742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B9643983BF5B0C2');
        $this->addSql('DROP INDEX IDX_2B9643983BF5B0C2 ON sections');
        $this->addSql('ALTER TABLE sections DROP formations_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sections ADD formations_id INT NOT NULL');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B9643983BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_2B9643983BF5B0C2 ON sections (formations_id)');
    }
}
