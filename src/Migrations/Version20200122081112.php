<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122081112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sejour ADD emplacement_id INT DEFAULT NULL, DROP emplacement, CHANGE start_date start_date VARCHAR(255) NOT NULL, CHANGE end_date end_date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id)');
        $this->addSql('CREATE INDEX IDX_96F52028C4598A51 ON sejour (emplacement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028C4598A51');
        $this->addSql('DROP INDEX IDX_96F52028C4598A51 ON sejour');
        $this->addSql('ALTER TABLE sejour ADD emplacement INT NOT NULL, DROP emplacement_id, CHANGE start_date start_date DATETIME NOT NULL, CHANGE end_date end_date DATETIME NOT NULL');
    }
}
