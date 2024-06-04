<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516145748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill_details (id INT AUTO_INCREMENT NOT NULL, bill_id INT DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, total_amount VARCHAR(255) DEFAULT NULL, total_profit VARCHAR(255) DEFAULT NULL, INDEX IDX_86E53F951A8C12F5 (bill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill_details ADD CONSTRAINT FK_86E53F951A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill_details DROP FOREIGN KEY FK_86E53F951A8C12F5');
        $this->addSql('DROP TABLE bill_details');
    }
}
