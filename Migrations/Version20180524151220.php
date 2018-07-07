<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180524151220 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D3911C8FB41');
        $this->addSql('ALTER TABLE deposit DROP bank_id');
        $this->addSql('ALTER TABLE deposit DROP foreign_account');
        $this->addSql('ALTER TABLE deposit DROP foreign_status');
        $this->addSql('ALTER TABLE deposit DROP foreign_tx_reference');
        $this->addSql('ALTER TABLE deposit DROP payment_method');
        $this->addSql('ALTER TABLE deposit DROP comment');
        $this->addSql('ALTER TABLE deposit ADD user_address_id INT NOT NULL');
        $this->addSql('ALTER TABLE deposit ADD wallet_transaction_id INT NOT NULL');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_D9AE7B3438248113 FOREIGN KEY (user_address_id) REFERENCES user_address (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_D9AE7B3438248114 FOREIGN KEY (wallet_transaction_id) REFERENCES wallet_transaction (id)');

        $this->addSql('ALTER TABLE user_activity CHANGE ip_address ip_address VARCHAR(255) NULL');

        $this->addSql('CREATE UNIQUE INDEX address_indx ON user_address (address)');

        $this->addSql('DROP TABLE wallet_operation');

        $this->addSql('CREATE TABLE plan_payment_limit_deposits (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, plan_id INT NOT NULL, daily NUMERIC(24, 8) NOT NULL, weekly NUMERIC(24, 8) NOT NULL, monthly NUMERIC(24, 8) NOT NULL, INDEX IDX_5599922F38248176 (currency_id), INDEX IDX_5599922FE899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('DROP TABLE bank');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX address_indx ON user_address');

        $this->addSql('DROP TABLE plan_payment_limit_deposits');
    }
}