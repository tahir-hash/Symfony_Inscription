<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531154044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F87BF96A4D60759 ON classe (libelle)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C242628A4D60759 ON module (libelle)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8F87BF96A4D60759 ON classe');
        $this->addSql('DROP INDEX UNIQ_C242628A4D60759 ON module');
    }
}
