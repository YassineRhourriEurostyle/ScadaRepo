<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126084827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generic_country CHANGE currency_id currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE generic_site_materials CHANGE site_id site_id INT NOT NULL, CHANGE material_id material_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generic_country CHANGE currency_id currency_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE generic_site_materials CHANGE site_id site_id INT DEFAULT NULL, CHANGE material_id material_id INT DEFAULT NULL');
    }
}
