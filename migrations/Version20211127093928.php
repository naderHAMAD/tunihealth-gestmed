<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127093928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, nompatient VARCHAR(255) NOT NULL, autre LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance_medication (ordonnance_id INT NOT NULL, medication_id INT NOT NULL, INDEX IDX_3E0FD3A42BF23B8F (ordonnance_id), INDEX IDX_3E0FD3A42C4DE6DA (medication_id), PRIMARY KEY(ordonnance_id, medication_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance_disease (ordonnance_id INT NOT NULL, disease_id INT NOT NULL, INDEX IDX_D9204EC2BF23B8F (ordonnance_id), INDEX IDX_D9204ECD8355341 (disease_id), PRIMARY KEY(ordonnance_id, disease_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordonnance_medication ADD CONSTRAINT FK_3E0FD3A42BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_medication ADD CONSTRAINT FK_3E0FD3A42C4DE6DA FOREIGN KEY (medication_id) REFERENCES medication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_disease ADD CONSTRAINT FK_D9204EC2BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_disease ADD CONSTRAINT FK_D9204ECD8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordonnance_medication DROP FOREIGN KEY FK_3E0FD3A42BF23B8F');
        $this->addSql('ALTER TABLE ordonnance_disease DROP FOREIGN KEY FK_D9204EC2BF23B8F');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE ordonnance_medication');
        $this->addSql('DROP TABLE ordonnance_disease');
    }
}
