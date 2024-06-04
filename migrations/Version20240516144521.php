<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516144521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, quantity VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, total_price VARCHAR(255) DEFAULT NULL, buying_price VARCHAR(255) DEFAULT NULL, profit VARCHAR(255) DEFAULT NULL, INDEX IDX_7A2119E34584665A (product_id), INDEX IDX_7A2119E39EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E34584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E34584665A');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E39EEA759');
        $this->addSql('DROP TABLE bill');
    }
}
