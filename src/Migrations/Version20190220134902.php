<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220134902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notification ADD deleted_at DATETIME DEFAULT NULL, CHANGE user_id user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE product_id product_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE message message VARCHAR(500) DEFAULT NULL, CHANGE old_price old_price NUMERIC(10, 3) DEFAULT NULL, CHANGE new_price new_price NUMERIC(10, 3) DEFAULT NULL, CHANGE is_campaign is_campaign TINYINT(1) DEFAULT NULL, CHANGE district district VARCHAR(255) DEFAULT NULL, CHANGE degrees degrees NUMERIC(6, 2) DEFAULT NULL, CHANGE alert_level alert_level INT DEFAULT NULL, CHANGE rain_quantity_liters rain_quantity_liters NUMERIC(10, 3) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notification DROP deleted_at, CHANGE user_id user_id CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:guid)\', CHANGE product_id product_id CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:guid)\', CHANGE message message VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE district district VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE degrees degrees NUMERIC(6, 2) DEFAULT \'NULL\', CHANGE alert_level alert_level INT DEFAULT NULL, CHANGE rain_quantity_liters rain_quantity_liters NUMERIC(10, 3) DEFAULT \'NULL\', CHANGE old_price old_price NUMERIC(10, 3) DEFAULT \'NULL\', CHANGE new_price new_price NUMERIC(10, 3) DEFAULT \'NULL\', CHANGE is_campaign is_campaign TINYINT(1) DEFAULT \'NULL\'');
    }
}
