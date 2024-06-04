<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521150911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E39EEA759');
        $this->addSql('DROP INDEX IDX_7A2119E39EEA759 ON bill');
        $this->addSql('ALTER TABLE bill DROP inventory_id');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A3636F84596');
        $this->addSql('DROP INDEX IDX_B12D4A3636F84596 ON inventory');
        $this->addSql('ALTER TABLE inventory ADD quantitytype_id INT DEFAULT NULL, CHANGE buying_price buying_price VARCHAR(255) NOT NULL, CHANGE quantity_type_id company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36979B1AD6 FOREIGN KEY (company_id) REFERENCES ref_company (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3631C72602 FOREIGN KEY (quantitytype_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_B12D4A36979B1AD6 ON inventory (company_id)');
        $this->addSql('CREATE INDEX IDX_B12D4A3631C72602 ON inventory (quantitytype_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD inventory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E39EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('CREATE INDEX IDX_7A2119E39EEA759 ON bill (inventory_id)');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36979B1AD6');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A3631C72602');
        $this->addSql('DROP INDEX IDX_B12D4A36979B1AD6 ON inventory');
        $this->addSql('DROP INDEX IDX_B12D4A3631C72602 ON inventory');
        $this->addSql('ALTER TABLE inventory ADD quantity_type_id INT DEFAULT NULL, DROP company_id, DROP quantitytype_id, CHANGE buying_price buying_price VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3636F84596 FOREIGN KEY (quantity_type_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_B12D4A3636F84596 ON inventory (quantity_type_id)');
    }
}
