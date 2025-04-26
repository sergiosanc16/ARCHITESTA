<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250420092052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_totorgante DROP INDEX UNIQ_D19B56A51DA84AFB, ADD INDEX IDX_D19B56A51DA84AFB (id_oficio)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_totorgante DROP INDEX IDX_D19B56A51DA84AFB, ADD UNIQUE INDEX UNIQ_D19B56A51DA84AFB (id_oficio)');
    }
}
