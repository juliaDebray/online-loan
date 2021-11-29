<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021183155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

//        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23916A2B381');
//        $this->addSql('ALTER TABLE administrators DROP FOREIGN KEY FK_73A716FBF396750');
//        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E21BF396750');
//        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300BF396750');
//        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A76ED395');
//        $this->addSql('DROP TABLE IF EXISTS administrators');
//        $this->addSql('DROP TABLE IF EXISTS books');
//        $this->addSql('DROP TABLE IF EXISTS customers');
//        $this->addSql('DROP TABLE IF EXISTS employees');
//        $this->addSql('DROP TABLE IF EXISTS reservations');
//        $this->addSql('DROP TABLE IF EXISTS users');

        $this->addSql('CREATE TABLE administrators (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, literary_genre VARCHAR(255) NOT NULL, release_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, book_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_4DA239A76ED395 (user_id), UNIQUE INDEX UNIQ_4DA23916A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrators ADD CONSTRAINT FK_73A716FBF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customers ADD CONSTRAINT FK_62534E21BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23916A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');


    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23916A2B381');
        $this->addSql('ALTER TABLE administrators DROP FOREIGN KEY FK_73A716FBF396750');
        $this->addSql('ALTER TABLE customers DROP FOREIGN KEY FK_62534E21BF396750');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300BF396750');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239A76ED395');
        $this->addSql('DROP TABLE administrators');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE users');
    }
}
