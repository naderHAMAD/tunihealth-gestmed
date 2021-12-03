<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126085828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disease (id INT AUTO_INCREMENT NOT NULL, diseasename VARCHAR(255) NOT NULL, medicamentname VARCHAR(255) NOT NULL, cinpatient VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disease_medication (disease_id INT NOT NULL, medication_id INT NOT NULL, INDEX IDX_EA0380A2D8355341 (disease_id), INDEX IDX_EA0380A22C4DE6DA (medication_id), PRIMARY KEY(disease_id, medication_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, cin VARCHAR(255) NOT NULL, birthdate VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, workadress VARCHAR(255) NOT NULL, speciality VARCHAR(255) NOT NULL, expyears VARCHAR(255) NOT NULL, cabinname VARCHAR(255) NOT NULL, certificate VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, medicamentname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication (id INT AUTO_INCREMENT NOT NULL, medicationname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disease_medication ADD CONSTRAINT FK_EA0380A2D8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disease_medication ADD CONSTRAINT FK_EA0380A22C4DE6DA FOREIGN KEY (medication_id) REFERENCES medication (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disease_medication DROP FOREIGN KEY FK_EA0380A2D8355341');
        $this->addSql('ALTER TABLE disease_medication DROP FOREIGN KEY FK_EA0380A22C4DE6DA');
        $this->addSql('DROP TABLE disease');
        $this->addSql('DROP TABLE disease_medication');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE medication');
    }
}
