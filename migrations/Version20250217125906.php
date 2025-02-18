<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217125906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_users_groups (idgroupusr INT NOT NULL, iduser BIGINT NOT NULL, INDEX IDX_192BEE425A21DF6 (idgroupusr), INDEX IDX_192BEE45E5C27E9 (iduser), PRIMARY KEY(idgroupusr, iduser)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_users_groups ADD CONSTRAINT FK_192BEE425A21DF6 FOREIGN KEY (idgroupusr) REFERENCES auth_groupes (IdGroupUsr)');
        $this->addSql('ALTER TABLE auth_users_groups ADD CONSTRAINT FK_192BEE45E5C27E9 FOREIGN KEY (iduser) REFERENCES auth_users (IdUser)');
        $this->addSql('ALTER TABLE auth_groupes CHANGE GroupShow GroupShow TINYINT(1) DEFAULT NULL COMMENT \'Display: 1 -> Yes, 0 -> No\'');
        $this->addSql('ALTER TABLE auth_users DROP IdGroupUsr, CHANGE AD_login AD_login VARCHAR(150) DEFAULT NULL COMMENT \'Example: ESB\\\\admin.roland\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auth_users_groups');
        $this->addSql('ALTER TABLE auth_groupes CHANGE GroupShow GroupShow TINYINT(1) DEFAULT NULL COMMENT \'Display :
        1 -> Yes
        0 -> No\'');
        $this->addSql('ALTER TABLE auth_users ADD IdGroupUsr INT DEFAULT NULL, CHANGE AD_login AD_login VARCHAR(150) DEFAULT NULL COMMENT \'Example : ESB\\\\admin.roland\'');
    }
}
