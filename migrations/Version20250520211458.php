<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250520211458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_ttestamento ADD tipo_doc VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE testa_vtestaotorgante DROP id_parentesco, DROP des_parentesco');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_ttestamento DROP tipo_doc');
        $this->addSql('ALTER TABLE testa_vtestaotorgante ADD id_parentesco INT DEFAULT NULL, ADD des_parentesco VARCHAR(100) NOT NULL');
    }
}
