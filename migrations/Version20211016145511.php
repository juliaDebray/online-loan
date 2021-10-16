<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016145511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO users(id, email, roles, password, status, type) VALUES ("56", "admin@admin.com", "[\"ROLE_ADMIN\"]", "$2y$13$6isO0d6TewmVC01CgmvM5uCKF9XXTRaWfU5SF9VFwJjxzBsP2V0zK", "validated", "administrator")');
        $this->addSql('INSERT INTO administrators(id) VALUES ("56")');
    }

    public function down(Schema $schema): void

    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
