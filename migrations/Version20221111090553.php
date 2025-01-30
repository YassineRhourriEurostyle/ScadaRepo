<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221111090553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indicator ADD decimals INT DEFAULT NULL');
        $this->addSql('ALTER TABLE generic_country ADD CONSTRAINT FK_EE3DEB3738248176 FOREIGN KEY (currency_id) REFERENCES generic_currency (id)');
        $this->addSql('CREATE INDEX IDX_EE3DEB3738248176 ON generic_country (currency_id)');
        $this->addSql('ALTER TABLE generic_currency CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE code code VARCHAR(3) NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE generic_language CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE code code VARCHAR(3) NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE generic_log CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user user VARCHAR(255) NOT NULL, CHANGE entity entity VARCHAR(255) NOT NULL, CHANGE field field VARCHAR(255) NOT NULL, CHANGE value value LONGTEXT NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE generic_site CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE code code VARCHAR(3) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE ldap_ip ldap_ip VARCHAR(15) DEFAULT NULL, CHANGE ldap_domain ldap_domain VARCHAR(255) DEFAULT NULL, CHANGE ldap_ou ldap_ou VARCHAR(255) DEFAULT NULL, CHANGE currency currency VARCHAR(3) NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL, CHANGE signatory signatory VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE generic_site ADD CONSTRAINT FK_5339E577A58ECB40 FOREIGN KEY (business_unit_id) REFERENCES generic_business_unit (id)');
        $this->addSql('ALTER TABLE generic_site ADD CONSTRAINT FK_5339E577F92F3E70 FOREIGN KEY (country_id) REFERENCES generic_country (id)');
        $this->addSql('ALTER TABLE generic_site ADD CONSTRAINT FK_5339E5775602A942 FOREIGN KEY (default_language_id) REFERENCES generic_language (id)');
        $this->addSql('CREATE INDEX IDX_5339E577A58ECB40 ON generic_site (business_unit_id)');
        $this->addSql('CREATE INDEX IDX_5339E577F92F3E70 ON generic_site (country_id)');
        $this->addSql('CREATE INDEX IDX_5339E5775602A942 ON generic_site (default_language_id)');
        $this->addSql('ALTER TABLE generic_user_access CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE user user VARCHAR(255) NOT NULL, CHANGE entity_field entity_field VARCHAR(255) NOT NULL, CHANGE value value VARCHAR(255) NOT NULL, CHANGE dtype dtype VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generic_country DROP FOREIGN KEY FK_EE3DEB3738248176');
        $this->addSql('DROP INDEX IDX_EE3DEB3738248176 ON generic_country');
        $this->addSql('ALTER TABLE generic_currency MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_currency DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE generic_currency CHANGE id id INT DEFAULT 0 NOT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE generic_language MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_language DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE generic_language CHANGE id id INT DEFAULT 0 NOT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE generic_log MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_log DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE generic_log CHANGE id id INT DEFAULT 0 NOT NULL, CHANGE user user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE entity entity VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE field field VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE value value LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE generic_site MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_site DROP FOREIGN KEY FK_5339E577A58ECB40');
        $this->addSql('ALTER TABLE generic_site DROP FOREIGN KEY FK_5339E577F92F3E70');
        $this->addSql('ALTER TABLE generic_site DROP FOREIGN KEY FK_5339E5775602A942');
        $this->addSql('DROP INDEX IDX_5339E577A58ECB40 ON generic_site');
        $this->addSql('DROP INDEX IDX_5339E577F92F3E70 ON generic_site');
        $this->addSql('DROP INDEX IDX_5339E5775602A942 ON generic_site');
        $this->addSql('ALTER TABLE generic_site DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE generic_site CHANGE id id INT DEFAULT 0 NOT NULL, CHANGE code code VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ldap_ip ldap_ip VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ldap_domain ldap_domain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ldap_ou ldap_ou VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE currency currency VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE signatory signatory VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE generic_user_access MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_user_access DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE generic_user_access CHANGE id id INT DEFAULT 0 NOT NULL, CHANGE user user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE entity_field entity_field VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE value value VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dtype dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE indicator DROP decimals');
    }
}
