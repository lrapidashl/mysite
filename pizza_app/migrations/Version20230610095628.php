<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610095628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939810F3034D FOREIGN KEY (imageId) REFERENCES image (image_id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_F529939810F3034D ON `order` (imageId)');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(200) NOT NULL, ADD role INT NOT NULL, ADD imageId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64910F3034D FOREIGN KEY (imageId) REFERENCES image (image_id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_8D93D64910F3034D ON user (imageId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939810F3034D');
        $this->addSql('DROP INDEX IDX_F529939810F3034D ON `order`');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64910F3034D');
        $this->addSql('DROP INDEX IDX_8D93D64910F3034D ON user');
        $this->addSql('ALTER TABLE user DROP password, DROP role, DROP imageId');
    }
}
