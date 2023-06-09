<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609134147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE name name VARCHAR(200) NOT NULL, CHANGE img_path img_path VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE user DROP avatar_path, DROP role, CHANGE first_name first_name VARCHAR(200) NOT NULL, CHANGE second_name second_name VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE name name VARCHAR(255) NOT NULL, CHANGE img_path img_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD avatar_path VARCHAR(200) DEFAULT NULL, ADD role TINYINT(1) DEFAULT 0, CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE second_name second_name VARCHAR(255) NOT NULL');
    }
}
