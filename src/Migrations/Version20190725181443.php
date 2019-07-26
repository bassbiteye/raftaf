<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725181443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, raison_sociale VARCHAR(255) NOT NULL, ninea INT NOT NULL, num_compte BIGINT NOT NULL, solde BIGINT NOT NULL, adresse_partenaire VARCHAR(255) NOT NULL, INDEX IDX_32FFA373B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT DEFAULT NULL, telephone VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, etat_utilisateur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3450FF010 (telephone), INDEX IDX_1D1C63B398DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373B03A8386 FOREIGN KEY (created_by_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B398DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B398DE13AC');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA373B03A8386');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE utilisateur');
    }
}
