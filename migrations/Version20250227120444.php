<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227120444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data_cycle (id INT AUTO_INCREMENT NOT NULL, id_cfg_machine INT DEFAULT NULL, id_cfg_tool INT DEFAULT NULL, data_cycle_no INT DEFAULT NULL, data_cycle_date_utc DATETIME DEFAULT NULL, data_cycle_date_creation_utc DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE data_record (id INT AUTO_INCREMENT NOT NULL, id_data_cycle INT DEFAULT NULL, id_param_mac INT DEFAULT NULL, data_value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameters_server (id INT AUTO_INCREMENT NOT NULL, id_param_std INT DEFAULT NULL, id_server_type INT DEFAULT NULL, param_registry VARCHAR(255) DEFAULT NULL, param_node VARCHAR(255) DEFAULT NULL, id_param_convert INT DEFAULT NULL, param_server_date_creation_utc DATETIME DEFAULT NULL, param_server_date_modification_utc VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE data_cycle');
        $this->addSql('DROP TABLE data_record');
        $this->addSql('DROP TABLE parameters_server');
    }
}
