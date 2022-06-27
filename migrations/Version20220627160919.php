<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627160919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP updated_at, DROP image_name');
        $this->addSql('ALTER TABLE users DROP updated_at, DROP reset_token, DROP image_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD reset_token VARCHAR(190) NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL');
    }
}
