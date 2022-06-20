<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617142955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_409021375F5E6712');
        $this->addSql('DROP INDEX IDX_409021375F5E6712 ON formations');
        $this->addSql('ALTER TABLE formations DROP directories_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD directories_id INT NOT NULL');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_409021375F5E6712 FOREIGN KEY (directories_id) REFERENCES directories (id)');
        $this->addSql('CREATE INDEX IDX_409021375F5E6712 ON formations (directories_id)');
    }
}
