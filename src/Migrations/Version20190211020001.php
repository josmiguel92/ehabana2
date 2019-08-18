<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211020001 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking ADD pickup_date DATE NOT NULL, ADD return_pickup_date DATE DEFAULT NULL, CHANGE airport_pickup airport_pickup TINYINT(1) DEFAULT NULL, CHANGE fly_number fly_number VARCHAR(15) DEFAULT NULL, CHANGE campaign campaign VARCHAR(100) DEFAULT NULL, CHANGE pickup_place pickup_place VARCHAR(800) DEFAULT NULL, CHANGE pickup_time pickup_time TIME NOT NULL, CHANGE booking_lang booking_lang VARCHAR(255) DEFAULT NULL, CHANGE return_travel return_travel TINYINT(1) DEFAULT NULL, CHANGE return_pickup_place return_pickup_place VARCHAR(255) DEFAULT NULL, CHANGE return_pickup_time return_pickup_time TIME DEFAULT NULL, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP pickup_date, DROP return_pickup_date, CHANGE airport_pickup airport_pickup TINYINT(1) DEFAULT \'NULL\', CHANGE fly_number fly_number VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE campaign campaign VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE pickup_place pickup_place VARCHAR(800) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE pickup_time pickup_time DATETIME NOT NULL, CHANGE booking_lang booking_lang VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE return_travel return_travel TINYINT(1) DEFAULT \'NULL\', CHANGE return_pickup_place return_pickup_place VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE return_pickup_time return_pickup_time DATETIME DEFAULT \'NULL\', CHANGE telephone telephone VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
