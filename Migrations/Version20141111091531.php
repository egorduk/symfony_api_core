<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141111091531 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        //$this->addSql('CREATE TABLE hw_deposits (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, address VARCHAR(255) NOT NULL, amount NUMERIC(16, 8) NOT NULL, tx VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_1952952038248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE hw_deposits ADD CONSTRAINT FK_1952952038248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        //$this->addSql('DROP TABLE hw_deposits');
    }
}
