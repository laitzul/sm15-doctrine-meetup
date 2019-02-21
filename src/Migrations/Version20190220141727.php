<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220141727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE weather_notification (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', district VARCHAR(255) NOT NULL, degrees NUMERIC(6, 2) NOT NULL, alert_level INT NOT NULL, rain_quantity_liters NUMERIC(10, 3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_notification (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', product_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', old_price NUMERIC(10, 3) NOT NULL, new_price NUMERIC(10, 3) NOT NULL, is_campaign TINYINT(1) NOT NULL, INDEX IDX_32F054A14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weather_notification ADD CONSTRAINT FK_B1E12A04BF396750 FOREIGN KEY (id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_notification ADD CONSTRAINT FK_32F054A14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_notification ADD CONSTRAINT FK_32F054A1BF396750 FOREIGN KEY (id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA4584665A');
        $this->addSql('DROP INDEX IDX_BF5476CA4584665A ON notification');
        $this->addSql('ALTER TABLE notification DROP product_id, DROP old_price, DROP new_price, DROP is_campaign, DROP district, DROP degrees, DROP alert_level, DROP rain_quantity_liters, CHANGE user_id user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE message message VARCHAR(500) DEFAULT NULL, CHANGE deleted_at deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE weather_notification');
        $this->addSql('DROP TABLE product_notification');
        $this->addSql('ALTER TABLE notification ADD product_id CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:guid)\', ADD old_price NUMERIC(10, 3) DEFAULT \'NULL\', ADD new_price NUMERIC(10, 3) DEFAULT \'NULL\', ADD is_campaign TINYINT(1) DEFAULT \'NULL\', ADD district VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, ADD degrees NUMERIC(6, 2) DEFAULT \'NULL\', ADD alert_level INT DEFAULT NULL, ADD rain_quantity_liters NUMERIC(10, 3) DEFAULT \'NULL\', CHANGE user_id user_id CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:guid)\', CHANGE message message VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE deleted_at deleted_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA4584665A ON notification (product_id)');
    }
}
