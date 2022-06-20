<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617120421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizes_questions (quizes_id INT NOT NULL, questions_id INT NOT NULL, INDEX IDX_F9B5D565E0AE9030 (quizes_id), INDEX IDX_F9B5D565BCB134CE (questions_id), PRIMARY KEY(quizes_id, questions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizes_questions ADD CONSTRAINT FK_F9B5D565E0AE9030 FOREIGN KEY (quizes_id) REFERENCES quizes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quizes_questions ADD CONSTRAINT FK_F9B5D565BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formations CHANGE updated_at updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5E0AE9030');
        $this->addSql('DROP INDEX IDX_8ADC54D5E0AE9030 ON questions');
        $this->addSql('ALTER TABLE questions DROP quizes_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quizes_questions');
        $this->addSql('ALTER TABLE formations CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE questions ADD quizes_id INT NOT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5E0AE9030 FOREIGN KEY (quizes_id) REFERENCES quizes (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5E0AE9030 ON questions (quizes_id)');
    }
}
