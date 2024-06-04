<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522042000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, date DATE NOT NULL, before_tax VARCHAR(255) DEFAULT NULL, total_tax VARCHAR(255) DEFAULT NULL, total_amount VARCHAR(255) DEFAULT NULL, INDEX IDX_E54BC005979B1AD6 (company_id), INDEX IDX_E54BC0059395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_items (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, sale_id INT DEFAULT NULL, quantitiys VARCHAR(255) NOT NULL, hsncode VARCHAR(255) DEFAULT NULL, unit_price VARCHAR(255) DEFAULT NULL, cgst VARCHAR(255) DEFAULT NULL, sgst VARCHAR(255) DEFAULT NULL, total_price VARCHAR(255) DEFAULT NULL, INDEX IDX_31C2B1CE4584665A (product_id), INDEX IDX_31C2B1CE9EEA759 (inventory_id), INDEX IDX_31C2B1CE4A7E4868 (sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005979B1AD6 FOREIGN KEY (company_id) REFERENCES ref_company (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE sale_items ADD CONSTRAINT FK_31C2B1CE4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE sale_items ADD CONSTRAINT FK_31C2B1CE9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE sale_items ADD CONSTRAINT FK_31C2B1CE4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E39395C3F3');
        $this->addSql('ALTER TABLE bill_details DROP FOREIGN KEY FK_86E53F951A8C12F5');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE bill_details');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, quantity LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', price VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, total_price VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, buying_price VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, profit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7A2119E39395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bill_details (id INT AUTO_INCREMENT NOT NULL, bill_id INT DEFAULT NULL, date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, total_amount VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, total_profit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_86E53F951A8C12F5 (bill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE bill_details ADD CONSTRAINT FK_86E53F951A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC005979B1AD6');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0059395C3F3');
        $this->addSql('ALTER TABLE sale_items DROP FOREIGN KEY FK_31C2B1CE4584665A');
        $this->addSql('ALTER TABLE sale_items DROP FOREIGN KEY FK_31C2B1CE9EEA759');
        $this->addSql('ALTER TABLE sale_items DROP FOREIGN KEY FK_31C2B1CE4A7E4868');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE sale_items');
    }
}
