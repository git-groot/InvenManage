<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524111056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale_items DROP FOREIGN KEY FK_31C2B1CE9F3DBB1F');
        $this->addSql('DROP INDEX IDX_31C2B1CE9F3DBB1F ON sale_items');
        $this->addSql('ALTER TABLE sale_items CHANGE saleitem_id sale_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sale_items ADD CONSTRAINT FK_31C2B1CE4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)');
        $this->addSql('CREATE INDEX IDX_31C2B1CE4A7E4868 ON sale_items (sale_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale_items DROP FOREIGN KEY FK_31C2B1CE4A7E4868');
        $this->addSql('DROP INDEX IDX_31C2B1CE4A7E4868 ON sale_items');
        $this->addSql('ALTER TABLE sale_items CHANGE sale_id saleitem_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sale_items ADD CONSTRAINT FK_31C2B1CE9F3DBB1F FOREIGN KEY (saleitem_id) REFERENCES sale (id)');
        $this->addSql('CREATE INDEX IDX_31C2B1CE9F3DBB1F ON sale_items (saleitem_id)');
    }
}
