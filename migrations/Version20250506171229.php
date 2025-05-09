<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506171229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testa_tvalidacion (id INT AUTO_INCREMENT NOT NULL, id_testamento INT DEFAULT NULL, num_validacion INT NOT NULL, validaciones LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_92307FF2EF4B25C0 (id_testamento), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_vimagen (ID INT DEFAULT 0 NOT NULL, des_imagen VARCHAR(100) NOT NULL, num_testamento INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_vnotario (id INT AUTO_INCREMENT NOT NULL, des_notario VARCHAR(200) NOT NULL, num_testamento INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_vtestaotorgante (id INT AUTO_INCREMENT NOT NULL, id_testamento INT NOT NULL, id_otorgante INT NOT NULL, num_orden SMALLINT UNSIGNED DEFAULT 1 NOT NULL, anno SMALLINT NOT NULL, mes SMALLINT NOT NULL, dia SMALLINT NOT NULL, mancomunado TINYINT(1) NOT NULL, textoilegible TINYINT(1) NOT NULL, num_protocolo INT NOT NULL, num_folio INT NOT NULL, id_poblacion INT DEFAULT NULL, id_notario INT DEFAULT NULL, id_imagen INT DEFAULT NULL, id_parentesco INT DEFAULT NULL, nombre VARCHAR(100) NOT NULL, apellido1 VARCHAR(100) NOT NULL, apellido2 VARCHAR(100) NOT NULL, id_oficio INT NOT NULL, des_poblacion VARCHAR(100) NOT NULL, DES_NOTARIO VARCHAR(200) NOT NULL, des_imagen VARCHAR(100) NOT NULL, des_parentesco VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE testa_tvalidacion ADD CONSTRAINT FK_92307FF2EF4B25C0 FOREIGN KEY (id_testamento) REFERENCES testa_ttestamento (id)');
        $this->addSql('ALTER TABLE testa_ttestaotorgante DROP FOREIGN KEY FK_97BD8E3FEF4B25C0');
        $this->addSql('DROP INDEX UNIQ_97BD8E3FEF4B25C0 ON testa_ttestaotorgante');
        $this->addSql('ALTER TABLE testa_ttestaotorgante ADD ID_OTORGANTE INT NOT NULL, CHANGE num_orden num_orden SMALLINT UNSIGNED DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE testa_ttestaotorgante ADD CONSTRAINT FK_97BD8E3FB0CD57A4 FOREIGN KEY (ID_OTORGANTE) REFERENCES testa_totorgante (id)');
        $this->addSql('CREATE INDEX IDX_97BD8E3F4F9BA8F2 ON testa_ttestaotorgante (ID_TESTAMENTO)');
        $this->addSql('CREATE INDEX IDX_97BD8E3FB0CD57A4 ON testa_ttestaotorgante (ID_OTORGANTE)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_tvalidacion DROP FOREIGN KEY FK_92307FF2EF4B25C0');
        $this->addSql('DROP TABLE testa_tvalidacion');
        $this->addSql('DROP TABLE testa_vimagen');
        $this->addSql('DROP TABLE testa_vnotario');
        $this->addSql('DROP TABLE testa_vtestaotorgante');
        $this->addSql('ALTER TABLE testa_ttestaotorgante DROP FOREIGN KEY FK_97BD8E3FB0CD57A4');
        $this->addSql('DROP INDEX IDX_97BD8E3F4F9BA8F2 ON testa_ttestaotorgante');
        $this->addSql('DROP INDEX IDX_97BD8E3FB0CD57A4 ON testa_ttestaotorgante');
        $this->addSql('ALTER TABLE testa_ttestaotorgante DROP ID_OTORGANTE, CHANGE num_orden num_orden SMALLINT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97BD8E3FEF4B25C0 ON testa_ttestaotorgante (id_testamento)');
    }
}
