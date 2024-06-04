<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528061128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_type ADD quan_name VARCHAR(255) DEFAULT NULL, ADD quan_status VARCHAR(255) DEFAULT NULL, DROP name, DROP status');
        $this->addSql('ALTER TABLE sale_items CHANGE profit profit INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_type ADD name VARCHAR(255) DEFAULT NULL, ADD status VARCHAR(255) DEFAULT NULL, DROP quan_name, DROP quan_status');
        $this->addSql('ALTER TABLE sale_items CHANGE profit profit VARCHAR(255) DEFAULT NULL');
    }
}
