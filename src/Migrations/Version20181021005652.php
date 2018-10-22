<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181021005652 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE study_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certificate (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, code VARCHAR(255) NOT NULL, number INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_219CDA4AB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, other VARCHAR(255) NOT NULL, body VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', password_requested_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, study_level_id INT NOT NULL, deleted_by_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, cne VARCHAR(255) NOT NULL, birth_place VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, stop_date DATE DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_B723AF33FC385E2E (study_level_id), INDEX IDX_B723AF33C76F1F52 (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4AB03A8386 FOREIGN KEY (created_by_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33FC385E2E FOREIGN KEY (study_level_id) REFERENCES study_level (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES student (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33FC385E2E');
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4AB03A8386');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C76F1F52');
        $this->addSql('DROP TABLE study_level');
        $this->addSql('DROP TABLE certificate');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE student');
    }
}
