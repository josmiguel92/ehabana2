<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190208203338 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking CHANGE airport_pickup airport_pickup TINYINT(1) DEFAULT NULL, CHANGE fly_number fly_number VARCHAR(15) DEFAULT NULL, CHANGE campaign campaign VARCHAR(100) DEFAULT NULL, CHANGE pickup_place pickup_place VARCHAR(800) DEFAULT NULL, CHANGE booking_lang booking_lang VARCHAR(255) DEFAULT NULL, CHANGE return_travel return_travel TINYINT(1) DEFAULT NULL, CHANGE return_pickup_place return_pickup_place VARCHAR(255) DEFAULT NULL, CHANGE return_pickup_time return_pickup_time DATETIME DEFAULT NULL, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE booking CHANGE airport_pickup airport_pickup TINYINT(1) DEFAULT \'NULL\', CHANGE fly_number fly_number VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE campaign campaign VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE pickup_place pickup_place VARCHAR(800) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE booking_lang booking_lang VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE return_travel return_travel TINYINT(1) DEFAULT \'NULL\', CHANGE return_pickup_place return_pickup_place VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE return_pickup_time return_pickup_time DATETIME DEFAULT \'NULL\', CHANGE telephone telephone VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
