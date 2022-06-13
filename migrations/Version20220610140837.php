<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610140837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D967B3B43D');
        $this->addSql('DROP INDEX IDX_3F4218D967B3B43D ON lessons');
        $this->addSql('ALTER TABLE lessons DROP users_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lessons ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D967B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_3F4218D967B3B43D ON lessons (users_id)');
    }
}
