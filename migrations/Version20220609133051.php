<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609133051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE directories (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, title VARCHAR(190) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(190) NOT NULL, is_ended TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_861FE08F67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE directories ADD CONSTRAINT FK_861FE08F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE formations ADD directories_id INT NOT NULL');
        $this->addSql('ALTER TABLE formations ADD CONSTRAINT FK_409021375F5E6712 FOREIGN KEY (directories_id) REFERENCES directories (id)');
        $this->addSql('CREATE INDEX IDX_409021375F5E6712 ON formations (directories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formations DROP FOREIGN KEY FK_409021375F5E6712');
        $this->addSql('DROP TABLE directories');
        $this->addSql('DROP INDEX IDX_409021375F5E6712 ON formations');
        $this->addSql('ALTER TABLE formations DROP directories_id');
    }
}
