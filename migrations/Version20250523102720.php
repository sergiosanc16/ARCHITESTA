<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250523102720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_ttestamento CHANGE estado_validacion estado_validacion VARCHAR(255) NOT NULL, CHANGE tipo_doc tipo_doc VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE testa_vtestaotorgante ADD id_parentesco INT DEFAULT NULL, ADD des_parentesco VARCHAR(100) NOT NULL, ADD tipo_doc VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD estado_validacion VARCHAR(255) NOT NULL, ADD tipo_doc VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD CONSTRAINT FK_50C06136AA21D64 FOREIGN KEY (id_otorgante) REFERENCES testa_totorgante (id)');
        $this->addSql('CREATE INDEX IDX_50C06136AA21D64 ON testa_vtestavalidacion (id_otorgante)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_ttestamento CHANGE estado_validacion estado_validacion VARCHAR(1) NOT NULL, CHANGE tipo_doc tipo_doc VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE testa_vtestaotorgante DROP id_parentesco, DROP des_parentesco, DROP tipo_doc');
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP FOREIGN KEY FK_50C06136AA21D64');
        $this->addSql('DROP INDEX IDX_50C06136AA21D64 ON testa_vtestavalidacion');
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP estado_validacion, DROP tipo_doc');
    }
}
