<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122094743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vw_sites_machines_molds_versions (id_sett_std_file BIGINT NOT NULL, id_site INT DEFAULT NULL, id_machine BIGINT DEFAULT NULL, id_tool BIGINT DEFAULT NULL, id_tool_version BIGINT DEFAULT NULL, active_file TINYINT(1) DEFAULT NULL, site_ref VARCHAR(50) NOT NULL, site_sapcode VARCHAR(10) DEFAULT NULL, site_description VARCHAR(50) DEFAULT NULL, mac_reference VARCHAR(50) DEFAULT NULL, tool_reference VARCHAR(50) DEFAULT NULL, tool_version_text VARCHAR(50) DEFAULT NULL, archived TINYINT(1) DEFAULT NULL, pict_mold_main VARCHAR(100) NOT NULL, PRIMARY KEY(id_sett_std_file)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vw_sites_machines_molds_versions');
    }
}
