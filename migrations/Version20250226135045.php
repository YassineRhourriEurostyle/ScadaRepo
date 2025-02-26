<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226135045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX idx_rec_site_mac_mould_date ON records');
        $this->addSql('DROP INDEX idx_tabRec_idparameter ON records');
        $this->addSql('ALTER TABLE settings_standard ADD ImageFilename VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX idx_rec_site_mac_mould_date ON records (idSite, idMac, idMould, DateRecord)');
        $this->addSql('CREATE INDEX idx_tabRec_idparameter ON records (idParameter)');
        $this->addSql('ALTER TABLE settings_standard DROP ImageFilename');
    }
}
