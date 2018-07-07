<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170920085527 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE promotional_email (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, registered TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C5287FD1E7927C74 (email), INDEX hash_idx (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_C912ED9D4E645A7E ON api_key (`key`)');
        $this->addSql('ALTER TABLE currency ADD eth TINYINT(1) NOT NULL, ADD is_erc_token TINYINT(1) NOT NULL, ADD contract_address VARCHAR(255) NOT NULL, ADD contract_abi LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B5C5284390');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B5C5284390 FOREIGN KEY (fee_set_id) REFERENCES fee_set (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE promotional_email');
        //$this->addSql('DROP INDEX UNIQ_C912ED9D4E645A7E ON api_key');
        $this->addSql('ALTER TABLE bank CHANGE deposit_available deposit_available TINYINT(1) DEFAULT \'1\', CHANGE withdrawal_available withdrawal_available TINYINT(1) DEFAULT \'1\'');
        $this->addSql('ALTER TABLE currency DROP eth, DROP is_erc_token, DROP contract_address, DROP contract_abi');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B5C5284390');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B5C5284390 FOREIGN KEY (fee_set_id) REFERENCES fee_set (id) ON DELETE CASCADE');
    }
}
