<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250224084331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, type_of_device_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_92FB68E2483DDD7 (type_of_device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indicator (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, type_of_device_id INT NOT NULL, name VARCHAR(255) NOT NULL, max_iterations INT NOT NULL, required TINYINT(1) NOT NULL, tolerance DOUBLE PRECISION DEFAULT NULL, INDEX IDX_D1349DB3727ACA70 (parent_id), INDEX IDX_D1349DB3F8BD700D (unit_id), INDEX IDX_D1349DB32483DDD7 (type_of_device_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, device_id INT NOT NULL, indicator_id INT NOT NULL, iteration INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_9F74B89894A4C7D4 (device_id), INDEX IDX_9F74B8984402854A (indicator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_device (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, symbol VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E2483DDD7 FOREIGN KEY (type_of_device_id) REFERENCES type_of_device (id)');
        $this->addSql('ALTER TABLE indicator ADD CONSTRAINT FK_D1349DB3727ACA70 FOREIGN KEY (parent_id) REFERENCES indicator (id)');
        $this->addSql('ALTER TABLE indicator ADD CONSTRAINT FK_D1349DB3F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE indicator ADD CONSTRAINT FK_D1349DB32483DDD7 FOREIGN KEY (type_of_device_id) REFERENCES type_of_device (id)');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B89894A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B8984402854A FOREIGN KEY (indicator_id) REFERENCES indicator (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B89894A4C7D4');
        $this->addSql('ALTER TABLE indicator DROP FOREIGN KEY FK_D1349DB3727ACA70');
        $this->addSql('ALTER TABLE setting DROP FOREIGN KEY FK_9F74B8984402854A');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E2483DDD7');
        $this->addSql('ALTER TABLE indicator DROP FOREIGN KEY FK_D1349DB32483DDD7');
        $this->addSql('ALTER TABLE indicator DROP FOREIGN KEY FK_D1349DB3F8BD700D');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE indicator');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE type_of_device');
        $this->addSql('DROP TABLE unit');
    }
}
