<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203082259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_books_user DROP FOREIGN KEY FK_97DB08A9D554820');
        $this->addSql('ALTER TABLE user_books_user DROP FOREIGN KEY FK_97DB08AA76ED395');
        $this->addSql('DROP TABLE user_books');
        $this->addSql('DROP TABLE user_books_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_books (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, author VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_books_user (user_books_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_97DB08A9D554820 (user_books_id), INDEX IDX_97DB08AA76ED395 (user_id), PRIMARY KEY(user_books_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_books_user ADD CONSTRAINT FK_97DB08A9D554820 FOREIGN KEY (user_books_id) REFERENCES user_books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_books_user ADD CONSTRAINT FK_97DB08AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
