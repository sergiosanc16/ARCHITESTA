<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250420152449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testa_totorgante_testa_ttestaotorgante DROP FOREIGN KEY FK_AE8C0ADE32CEEA74');
        $this->addSql('ALTER TABLE testa_totorgante_testa_ttestaotorgante DROP FOREIGN KEY FK_AE8C0ADE59A61DFE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante DROP FOREIGN KEY FK_577FA3432CEEA74');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante DROP FOREIGN KEY FK_577FA3459A61DFE');
        $this->addSql('DROP TABLE testa_totorgante_testa_ttestaotorgante');
        $this->addSql('DROP TABLE testa_ttestaotorgante_testa_totorgante');
        $this->addSql('ALTER TABLE testa_totorgante ADD testa_ttestaotorgantes_id INT NOT NULL');
        $this->addSql('ALTER TABLE testa_totorgante ADD CONSTRAINT FK_D19B56A5BD2DC423 FOREIGN KEY (testa_ttestaotorgantes_id) REFERENCES testa_ttestaotorgante (id)');
        $this->addSql('CREATE INDEX IDX_D19B56A5BD2DC423 ON testa_totorgante (testa_ttestaotorgantes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testa_totorgante_testa_ttestaotorgante (testa_totorgante_id INT NOT NULL, testa_ttestaotorgante_id INT NOT NULL, INDEX IDX_AE8C0ADE32CEEA74 (testa_totorgante_id), INDEX IDX_AE8C0ADE59A61DFE (testa_ttestaotorgante_id), PRIMARY KEY(testa_totorgante_id, testa_ttestaotorgante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE testa_ttestaotorgante_testa_totorgante (testa_ttestaotorgante_id INT NOT NULL, testa_totorgante_id INT NOT NULL, INDEX IDX_577FA3459A61DFE (testa_ttestaotorgante_id), INDEX IDX_577FA3432CEEA74 (testa_totorgante_id), PRIMARY KEY(testa_ttestaotorgante_id, testa_totorgante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE testa_totorgante_testa_ttestaotorgante ADD CONSTRAINT FK_AE8C0ADE32CEEA74 FOREIGN KEY (testa_totorgante_id) REFERENCES testa_totorgante (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_totorgante_testa_ttestaotorgante ADD CONSTRAINT FK_AE8C0ADE59A61DFE FOREIGN KEY (testa_ttestaotorgante_id) REFERENCES testa_ttestaotorgante (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante ADD CONSTRAINT FK_577FA3432CEEA74 FOREIGN KEY (testa_totorgante_id) REFERENCES testa_totorgante (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_ttestaotorgante_testa_totorgante ADD CONSTRAINT FK_577FA3459A61DFE FOREIGN KEY (testa_ttestaotorgante_id) REFERENCES testa_ttestaotorgante (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE testa_totorgante DROP FOREIGN KEY FK_D19B56A5BD2DC423');
        $this->addSql('DROP INDEX IDX_D19B56A5BD2DC423 ON testa_totorgante');
        $this->addSql('ALTER TABLE testa_totorgante DROP testa_ttestaotorgantes_id');
    }
}
