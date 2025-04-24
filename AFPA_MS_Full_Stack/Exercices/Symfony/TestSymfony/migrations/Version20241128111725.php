<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128111725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE plat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(128) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, image VARCHAR(128) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, active VARCHAR(6) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, SuperActive TINYINT(1) DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_plat VARCHAR(7) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, quantite VARCHAR(8) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, total VARCHAR(5) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, date_commande VARCHAR(19) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, etat VARCHAR(21) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, nom_client VARCHAR(16) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, telephone_client VARCHAR(16) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, email_client VARCHAR(18) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, adresse_client VARCHAR(21) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, active TINYINT(1) DEFAULT 1 NOT NULL, uuid CHAR(36) DEFAULT \'uuid()\' NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(258) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, telephone VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresse VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, pass VARCHAR(258) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateinscription DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, uuid CHAR(36) DEFAULT \'uuid()\' NOT NULL COMMENT \'(DC2Type:uuid)\', active TINYINT(1) DEFAULT 1 NOT NULL, resetcode INT DEFAULT 0 NOT NULL, admin TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(55) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, description VARCHAR(236) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, prix TEXT CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, image VARCHAR(25) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, id_categorie VARCHAR(12) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, active VARCHAR(6) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE base');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
