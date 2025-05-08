<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331170511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_timagen (id INT AUTO_INCREMENT NOT NULL, des_imagen VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_tnotario (id INT AUTO_INCREMENT NOT NULL, des_notario VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_toficio (id INT AUTO_INCREMENT NOT NULL, des_oficio VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_totorgante (id INT AUTO_INCREMENT NOT NULL, id_oficio_id INT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido1 VARCHAR(100) NOT NULL, apellido2 VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D19B56A5D4BD549 (id_oficio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_tparentesco (id INT AUTO_INCREMENT NOT NULL, des_parentesco VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_tpoblacion (id INT AUTO_INCREMENT NOT NULL, des_poblacion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_traw (id INT AUTO_INCREMENT NOT NULL, classification_id BIGINT NOT NULL, user_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', year INT NOT NULL, month INT NOT NULL, day INT NOT NULL, other_population TINYINT(1) NOT NULL, population_name VARCHAR(255) NOT NULL, grantor_surname1 VARCHAR(255) NOT NULL, grator_surname2 VARCHAR(255) NOT NULL, grantor_name VARCHAR(255) NOT NULL, office_mentioned TINYINT(1) NOT NULL, grantor_office VARCHAR(255) NOT NULL, relationship_mentioned TINYINT(1) NOT NULL, grantor_relationship VARCHAR(255) NOT NULL, document_type VARCHAR(255) NOT NULL, notary_name VARCHAR(255) NOT NULL, notary_surname VARCHAR(255) NOT NULL, protocol_number INT NOT NULL, folio_number INT NOT NULL, second_grantor TINYINT(1) NOT NULL, second_grantor_name VARCHAR(255) NOT NULL, second_grantor_surname VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, retired TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_ttestamento (id INT AUTO_INCREMENT NOT NULL, id_poblacion INT DEFAULT NULL, id_notario INT DEFAULT NULL, id_imagen INT DEFAULT NULL, anno SMALLINT NOT NULL, mes SMALLINT NOT NULL, dia SMALLINT NOT NULL, mancomunado TINYINT(1) NOT NULL, textoilegible TINYINT(1) NOT NULL, num_protocolo INT NOT NULL, num_folio INT NOT NULL, INDEX IDX_393EEAD7EE3862E (id_poblacion), INDEX IDX_393EEADD0553A49 (id_notario), UNIQUE INDEX UNIQ_393EEADA52E675E (id_imagen), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_ttestamento_testa_tparentesco (id_parentesco INT NOT NULL, testa_tparentesco_id INT NOT NULL, INDEX IDX_114D35873B94B0C1 (id_parentesco), INDEX IDX_114D3587582CC65 (testa_tparentesco_id), PRIMARY KEY(id_parentesco, testa_tparentesco_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_ttestaotorgante (id INT AUTO_INCREMENT NOT NULL, id_testamento_id INT DEFAULT NULL, num_orden SMALLINT NOT NULL, UNIQUE INDEX UNIQ_97BD8E3FFE131B60 (id_testamento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_ttestaotorgante_testa_totorgante (testa_ttestaotorgante_id INT NOT NULL, testa_totorgante_id INT NOT NULL, INDEX IDX_577FA3459A61DFE (testa_ttestaotorgante_id), INDEX IDX_577FA3432CEEA74 (testa_totorgante_id), PRIMARY KEY(testa_ttestaotorgante_id, testa_totorgante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testa_tuser (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES testa_tuser (id)');
        $this->addSql('ALTER TABLE testa_totorgante ADD CONSTRAINT FK_D19B56A5D4BD549 FOREIGN KEY (id_oficio_id) REFERENCES testa_toficio (id)');
        $this->addSql('ALTER TABLE testa_ttestamento ADD CONSTRAINT FK_393EEAD7EE3862E FOREIGN KEY (id_poblacion) REFERENCES testa_tpoblacion (id)');
        $this->addSql('ALTER TABLE testa_ttestamento ADD CONSTRAINT FK_393EEADD0553A49 FOREIGN KEY (id_notario) REFERENCES testa_tnotario (id)');
        $this->addSql('ALTER TABLE testa_ttestamento ADD CONSTRAINT FK_393EEADA52E675E FOREIGN KEY (id_imagen) REFERENCES testa_timagen (id)');
        $this->addSql('ALTER TABLE testa_ttestamento_testa_tparentesco ADD CONSTRAINT FK_114D35873B94B0C1 FOREIGN KEY (id_parentesco) REFERENCES testa_ttestamento (id)');
        $this->addSql('ALTER TABLE testa_ttestamento_testa_tparentesco ADD CONSTRAINT FK_114D3587582CC65 FOREIGN KEY (testa_tparentesco_id) REFERENCES testa_tparentesco (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante ADD CONSTRAINT FK_97BD8E3FFE131B60 FOREIGN KEY (id_testamento_id) REFERENCES testa_ttestamento (id)');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante ADD CONSTRAINT FK_577FA3459A61DFE FOREIGN KEY (testa_ttestaotorgante_id) REFERENCES testa_ttestaotorgante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante ADD CONSTRAINT FK_577FA3432CEEA74 FOREIGN KEY (testa_totorgante_id) REFERENCES testa_totorgante (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE testa_totorgante DROP FOREIGN KEY FK_D19B56A5D4BD549');
        $this->addSql('ALTER TABLE testa_ttestamento DROP FOREIGN KEY FK_393EEAD7EE3862E');
        $this->addSql('ALTER TABLE testa_ttestamento DROP FOREIGN KEY FK_393EEADD0553A49');
        $this->addSql('ALTER TABLE testa_ttestamento DROP FOREIGN KEY FK_393EEADA52E675E');
        $this->addSql('ALTER TABLE testa_ttestamento_testa_tparentesco DROP FOREIGN KEY FK_114D35873B94B0C1');
        $this->addSql('ALTER TABLE testa_ttestamento_testa_tparentesco DROP FOREIGN KEY FK_114D3587582CC65');
        $this->addSql('ALTER TABLE testa_ttestaotorgante DROP FOREIGN KEY FK_97BD8E3FFE131B60');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante DROP FOREIGN KEY FK_577FA3459A61DFE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante DROP FOREIGN KEY FK_577FA3432CEEA74');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE testa_timagen');
        $this->addSql('DROP TABLE testa_tnotario');
        $this->addSql('DROP TABLE testa_toficio');
        $this->addSql('DROP TABLE testa_totorgante');
        $this->addSql('DROP TABLE testa_tparentesco');
        $this->addSql('DROP TABLE testa_tpoblacion');
        $this->addSql('DROP TABLE testa_traw');
        $this->addSql('DROP TABLE testa_ttestamento');
        $this->addSql('DROP TABLE testa_ttestamento_testa_tparentesco');
        $this->addSql('DROP TABLE testa_ttestaotorgante');
        $this->addSql('DROP TABLE testa_ttestaotorgante_testa_totorgante');
        $this->addSql('DROP TABLE testa_tuser');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
