<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029114646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_parameters_site_sise_data CHANGE idAppParamSiteData idAppParamSiteData INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE auth_authorization CHANGE IdAuthAuthor IdAuthAuthor BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE auth_features CHANGE IdAuthFeature IdAuthFeature INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE auth_groupes CHANGE IdGroupUsr IdGroupUsr INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE auth_users CHANGE IdUser IdUser BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE config_device_types CHANGE iddevice_type iddevice_type INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE config_machines CHANGE idCfgMachine idCfgMachine BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE config_tool_versions CHANGE idCfgToolVersion idCfgToolVersion BIGINT AUTO_INCREMENT NOT NULL, CHANGE Archived Archived TINYINT(1) DEFAULT NULL COMMENT \'Archived :
        0 -> No
        1 -> Yes
        \'');
        $this->addSql('ALTER TABLE config_tools CHANGE idCfgTool idCfgTool BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE config_value_type CHANGE idconfig_value_type idconfig_value_type INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE generic_country CHANGE currency_id currency_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE generic_material CHANGE name name VARCHAR(255) NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE generic_site_materials CHANGE site_id site_id INT DEFAULT NULL, CHANGE material_id material_id INT DEFAULT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE last_data_import CHANGE idLastDataImp idLastDataImp BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE log_application CHANGE idLog idLog BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE log_modifications CHANGE idLogModif idLogModif BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE opc_parameters CHANGE IdOpcParameter IdOpcParameter BIGINT AUTO_INCREMENT NOT NULL, CHANGE Coeff_A Coeff_A DOUBLE PRECISION DEFAULT NULL, CHANGE Coeff_B Coeff_B DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE opc_servers CHANGE IdOpcServer IdOpcServer BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE opc_types CHANGE IdOpcType IdOpcType INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE parameters CHANGE idparameters idparameters BIGINT AUTO_INCREMENT NOT NULL, CHANGE ParamNbDecimals ParamNbDecimals SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE parameters_template CHANGE IdParameter IdParameter BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE picture_molds CHANGE idPictMold idPictMold BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE picture_parameters CHANGE idPictParam idPictParam BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE records CHANGE idrecords idrecords BIGINT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE app_parameters_site_sise_data CHANGE idAppParamSiteData idAppParamSiteData INT NOT NULL');
        $this->addSql('ALTER TABLE auth_authorization CHANGE IdAuthAuthor IdAuthAuthor BIGINT NOT NULL');
        $this->addSql('ALTER TABLE auth_features CHANGE IdAuthFeature IdAuthFeature INT NOT NULL');
        $this->addSql('ALTER TABLE auth_groupes CHANGE IdGroupUsr IdGroupUsr INT NOT NULL');
        $this->addSql('ALTER TABLE auth_users CHANGE IdUser IdUser BIGINT NOT NULL');
        $this->addSql('ALTER TABLE config_device_types CHANGE iddevice_type iddevice_type INT NOT NULL');
        $this->addSql('ALTER TABLE config_machines CHANGE idCfgMachine idCfgMachine BIGINT NOT NULL');
        $this->addSql('ALTER TABLE config_tool_versions CHANGE idCfgToolVersion idCfgToolVersion BIGINT NOT NULL, CHANGE Archived Archived TINYINT(1) DEFAULT 0 COMMENT \'Archived :
        0 -> No
        1 -> Yes
        \'');
        $this->addSql('ALTER TABLE config_tools CHANGE idCfgTool idCfgTool BIGINT NOT NULL');
        $this->addSql('ALTER TABLE config_value_type CHANGE idconfig_value_type idconfig_value_type INT NOT NULL');
        $this->addSql('ALTER TABLE generic_country CHANGE currency_id currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_material CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE generic_site_materials CHANGE material_id material_id INT NOT NULL, CHANGE site_id site_id INT NOT NULL, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE last_data_import CHANGE idLastDataImp idLastDataImp BIGINT NOT NULL');
        $this->addSql('ALTER TABLE log_application CHANGE idLog idLog BIGINT NOT NULL');
        $this->addSql('ALTER TABLE log_modifications CHANGE idLogModif idLogModif BIGINT NOT NULL');
        $this->addSql('ALTER TABLE opc_parameters CHANGE IdOpcParameter IdOpcParameter BIGINT NOT NULL, CHANGE Coeff_A Coeff_A DOUBLE PRECISION DEFAULT \'0\', CHANGE Coeff_B Coeff_B DOUBLE PRECISION DEFAULT \'0\'');
        $this->addSql('ALTER TABLE opc_servers CHANGE IdOpcServer IdOpcServer BIGINT NOT NULL');
        $this->addSql('ALTER TABLE opc_types CHANGE IdOpcType IdOpcType INT NOT NULL');
        $this->addSql('ALTER TABLE parameters CHANGE idparameters idparameters BIGINT NOT NULL, CHANGE ParamNbDecimals ParamNbDecimals SMALLINT DEFAULT 0');
        $this->addSql('ALTER TABLE parameters_template CHANGE IdParameter IdParameter BIGINT NOT NULL');
        $this->addSql('ALTER TABLE picture_molds CHANGE idPictMold idPictMold BIGINT NOT NULL');
        $this->addSql('ALTER TABLE picture_parameters CHANGE idPictParam idPictParam BIGINT NOT NULL');
        $this->addSql('ALTER TABLE records CHANGE idrecords idrecords BIGINT NOT NULL');
    }
}
