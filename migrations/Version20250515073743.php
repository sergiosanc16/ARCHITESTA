<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515073743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testa_vtestavalidacion (id INT AUTO_INCREMENT NOT NULL, id_poblacion INT DEFAULT NULL, id_notario INT DEFAULT NULL, id_imagen INT DEFAULT NULL, id_parentesco INT DEFAULT NULL, num_validacion INT DEFAULT NULL, validaciones LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', id_testamento INT NOT NULL, id_otorgante INT NOT NULL, num_orden SMALLINT UNSIGNED NOT NULL, anno SMALLINT NOT NULL, mes VARCHAR(255) NOT NULL, dia SMALLINT NOT NULL, mancomunado TINYINT(1) NOT NULL, textoilegible TINYINT(1) NOT NULL, num_protocolo INT NOT NULL, num_folio INT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido1 VARCHAR(100) NOT NULL, apellido2 VARCHAR(100) NOT NULL, id_oficio INT NOT NULL, des_poblacion VARCHAR(100) NOT NULL, des_notario VARCHAR(200) NOT NULL, des_imagen VARCHAR(100) NOT NULL, des_parentesco VARCHAR(100) NOT NULL, INDEX IDX_50C06137EE3862E (id_poblacion), INDEX IDX_50C0613D0553A49 (id_notario), UNIQUE INDEX UNIQ_50C0613A52E675E (id_imagen), INDEX IDX_50C06133B94B0C1 (id_parentesco), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD CONSTRAINT FK_50C06137EE3862E FOREIGN KEY (id_poblacion) REFERENCES testa_tpoblacion (id)');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD CONSTRAINT FK_50C0613D0553A49 FOREIGN KEY (id_notario) REFERENCES testa_tnotario (id)');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD CONSTRAINT FK_50C0613A52E675E FOREIGN KEY (id_imagen) REFERENCES testa_timagen (id)');
        $this->addSql('ALTER TABLE testa_vtestavalidacion ADD CONSTRAINT FK_50C06133B94B0C1 FOREIGN KEY (id_parentesco) REFERENCES testa_tparentesco (id)');
        $this->addSql('ALTER TABLE testa_totorgante ADD id_parentesco INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testa_totorgante ADD CONSTRAINT FK_D19B56A53B94B0C1 FOREIGN KEY (id_parentesco) REFERENCES testa_tparentesco (id)');
        $this->addSql('CREATE INDEX IDX_D19B56A53B94B0C1 ON testa_totorgante (id_parentesco)');
        $this->addSql('ALTER TABLE testa_ttestamento DROP FOREIGN KEY FK_393EEAD3B94B0C1');
        $this->addSql('DROP INDEX IDX_393EEAD3B94B0C1 ON testa_ttestamento');
        $this->addSql('ALTER TABLE testa_ttestamento DROP id_parentesco');
        $this->addSql('ALTER TABLE testa_ttestaotorgante ADD CONSTRAINT FK_97BD8E3F4F9BA8F2 FOREIGN KEY (ID_TESTAMENTO) REFERENCES testa_ttestamento (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP FOREIGN KEY FK_50C06137EE3862E');
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP FOREIGN KEY FK_50C0613D0553A49');
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP FOREIGN KEY FK_50C0613A52E675E');
        $this->addSql('ALTER TABLE testa_vtestavalidacion DROP FOREIGN KEY FK_50C06133B94B0C1');
        $this->addSql('DROP TABLE testa_vtestavalidacion');
        $this->addSql('ALTER TABLE testa_totorgante DROP FOREIGN KEY FK_D19B56A53B94B0C1');
        $this->addSql('DROP INDEX IDX_D19B56A53B94B0C1 ON testa_totorgante');
        $this->addSql('ALTER TABLE testa_totorgante DROP id_parentesco');
        $this->addSql('ALTER TABLE testa_ttestamento ADD id_parentesco INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testa_ttestamento ADD CONSTRAINT FK_393EEAD3B94B0C1 FOREIGN KEY (id_parentesco) REFERENCES testa_tparentesco (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_393EEAD3B94B0C1 ON testa_ttestamento (id_parentesco)');
        $this->addSql('ALTER TABLE testa_ttestaotorgante DROP FOREIGN KEY FK_97BD8E3F4F9BA8F2');
    }
}
