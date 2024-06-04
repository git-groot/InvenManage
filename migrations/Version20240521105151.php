<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521105151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory ADD product_id INT DEFAULT NULL, ADD quantity_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A364584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A3636F84596 FOREIGN KEY (quantity_type_id) REFERENCES quantity_type (id)');
        $this->addSql('CREATE INDEX IDX_B12D4A364584665A ON inventory (product_id)');
        $this->addSql('CREATE INDEX IDX_B12D4A3636F84596 ON inventory (quantity_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A364584665A');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A3636F84596');
        $this->addSql('DROP INDEX IDX_B12D4A364584665A ON inventory');
        $this->addSql('DROP INDEX IDX_B12D4A3636F84596 ON inventory');
        $this->addSql('ALTER TABLE inventory DROP product_id, DROP quantity_type_id');
    }
}
