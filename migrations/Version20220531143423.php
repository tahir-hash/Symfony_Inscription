<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531143423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande ADD inscription_id INT NOT NULL, ADD rp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A55DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5B70FF80C FOREIGN KEY (rp_id) REFERENCES rp (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A55DAC5993 ON demande (inscription_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5B70FF80C ON demande (rp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A55DAC5993');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5B70FF80C');
        $this->addSql('DROP INDEX IDX_2694D7A55DAC5993 ON demande');
        $this->addSql('DROP INDEX IDX_2694D7A5B70FF80C ON demande');
        $this->addSql('ALTER TABLE demande DROP inscription_id, DROP rp_id');
    }
}
