<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321192648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /**
         * Remove old tables, until execution of the migration we shouldn't have that tables
         */
        $this->addSql('SET FOREIGN_KEY_CHECKS = 0;');
        $this->addSql('DROP TABLE IF EXISTS withdraw;');
        $this->addSql('DROP TABLE IF EXISTS deposit;');
        $this->addSql('DROP TABLE IF EXISTS deposit_log;');
        $this->addSql('DROP TABLE IF EXISTS wire_withdraw;');
        $this->addSql('DROP TABLE IF EXISTS wallet_operation;');
        $this->addSql('DROP TABLE IF EXISTS coin_transaction;');
        $this->addSql('DROP TABLE IF EXISTS wire_deposit;');
        $this->addSql('DROP TABLE IF EXISTS virtual_withdraw;');
        $this->addSql('DROP TABLE IF EXISTS withdraw_log;');
        $this->addSql('DROP TABLE IF EXISTS virtual_deposit;');
        $this->addSql('DROP TABLE IF EXISTS deposit_only;');
        $this->addSql('DROP TABLE IF EXISTS manual_withdraw;');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1;');

        $this->addSql('CREATE TABLE withdraw (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, bank_id INT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, amount NUMERIC(16, 8) NOT NULL, fee_amount NUMERIC(16, 8) NOT NULL, foreign_account VARCHAR(255) DEFAULT NULL, foreign_status VARCHAR(255) DEFAULT NULL, foreign_tx_reference VARCHAR(255) DEFAULT NULL, payment_method VARCHAR(255) NOT NULL, INDEX IDX_6D2D3B45712520F3 (wallet_id), INDEX IDX_6D2D3B4511C8FB41 (bank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wire_withdraw (id INT NOT NULL, beneficiary_account_country_id INT NOT NULL, beneficiary_bank_country_id INT NOT NULL, correspondent_bank_country_id INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, beneficiary_account_number VARCHAR(255) NOT NULL, beneficiary_account_name VARCHAR(255) NOT NULL, beneficiary_account_address VARCHAR(255) NOT NULL, beneficiary_account_city VARCHAR(255) NOT NULL, beneficiary_account_state VARCHAR(255) DEFAULT NULL, beneficiary_account_postal_code VARCHAR(255) NOT NULL, beneficiary_bank_code VARCHAR(255) NOT NULL, beneficiary_bank_name VARCHAR(255) NOT NULL, beneficiary_bank_address VARCHAR(255) NOT NULL, beneficiary_bank_city VARCHAR(255) NOT NULL, beneficiary_bank_state VARCHAR(255) DEFAULT NULL, beneficiary_bank_postal_code VARCHAR(255) NOT NULL, correspondent_bank_account VARCHAR(255) DEFAULT NULL, correspondent_bank_code VARCHAR(255) DEFAULT NULL, correspondent_bank_name VARCHAR(255) DEFAULT NULL, correspondent_bank_address VARCHAR(255) DEFAULT NULL, correspondent_bank_city VARCHAR(255) DEFAULT NULL, correspondent_bank_state VARCHAR(255) DEFAULT NULL, correspondent_bank_postal_code VARCHAR(255) DEFAULT NULL, INDEX IDX_67BD0E3E6CE7F7BB (beneficiary_account_country_id), INDEX IDX_67BD0E3E7EBB339D (beneficiary_bank_country_id), INDEX IDX_67BD0E3E8BBA3C8B (correspondent_bank_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit_log (id INT AUTO_INCREMENT NOT NULL, deposit_id INT NOT NULL, tx_reference_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, data LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_581596A89815E4B1 (deposit_id), INDEX IDX_581596A8C1AFEBD9 (tx_reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coin_transaction (id INT AUTO_INCREMENT NOT NULL, currency_id INT DEFAULT NULL, amount VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, confirmations VARCHAR(255) NOT NULL, block_hash VARCHAR(255) NOT NULL, block_index VARCHAR(255) NOT NULL, block_time VARCHAR(255) NOT NULL, txId VARCHAR(255) NOT NULL, wallet_conflicts VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, time_received VARCHAR(255) NOT NULL, details LONGTEXT NOT NULL, account VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6B45239938248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, bank_id INT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, amount NUMERIC(16, 8) NOT NULL, fee_amount NUMERIC(16, 8) NOT NULL, foreign_account VARCHAR(255) DEFAULT NULL, foreign_status VARCHAR(255) DEFAULT NULL, foreign_tx_reference VARCHAR(255) DEFAULT NULL, payment_method VARCHAR(255) NOT NULL, INDEX IDX_95DB9D39712520F3 (wallet_id), INDEX IDX_95DB9D3911C8FB41 (bank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wire_deposit (id INT NOT NULL, comment LONGTEXT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE virtual_withdraw (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE withdraw_log (id INT AUTO_INCREMENT NOT NULL, withdraw_id INT NOT NULL, tx_reference_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, data LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5589944B697D393B (withdraw_id), INDEX IDX_5589944BC1AFEBD9 (tx_reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE virtual_deposit (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit_only (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet_operation (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, deposit_id INT DEFAULT NULL, withdraw_id INT DEFAULT NULL, balance NUMERIC(16, 8) NOT NULL, total_reserved NUMERIC(16, 8) NOT NULL, expense NUMERIC(16, 8) NOT NULL, debit NUMERIC(16, 8) NOT NULL, credit NUMERIC(16, 8) NOT NULL, reserve NUMERIC(16, 8) NOT NULL, type VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4E1DB6FC712520F3 (wallet_id), INDEX IDX_4E1DB6FC9815E4B1 (deposit_id), INDEX IDX_4E1DB6FC697D393B (withdraw_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        $this->addSql('CREATE TABLE manual_withdraw (id INT NOT NULL, country_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, address VARCHAR(255) NULL, province VARCHAR(255) NULL, phone VARCHAR(255) NULL, ip VARCHAR(100) NULL, INDEX IDX_65C0C18AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE wire_withdraw ADD CONSTRAINT FK_67BD0E3E6CE7F7BB FOREIGN KEY (beneficiary_account_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE wire_withdraw ADD CONSTRAINT FK_67BD0E3E7EBB339D FOREIGN KEY (beneficiary_bank_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE wire_withdraw ADD CONSTRAINT FK_67BD0E3E8BBA3C8B FOREIGN KEY (correspondent_bank_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE wire_withdraw ADD CONSTRAINT FK_67BD0E3EBF396750 FOREIGN KEY (id) REFERENCES withdraw (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deposit_log ADD CONSTRAINT FK_581596A89815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id)');
        $this->addSql('ALTER TABLE deposit_log ADD CONSTRAINT FK_581596A8C1AFEBD9 FOREIGN KEY (tx_reference_id) REFERENCES coin_transaction (id)');
        $this->addSql('ALTER TABLE coin_transaction ADD CONSTRAINT FK_6B45239938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D3911C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE wire_deposit ADD CONSTRAINT FK_606734CABF396750 FOREIGN KEY (id) REFERENCES deposit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE virtual_withdraw ADD CONSTRAINT FK_93AA984DBF396750 FOREIGN KEY (id) REFERENCES withdraw (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deposit_only ADD CONSTRAINT FK_D30D044BBF396750 FOREIGN KEY (id) REFERENCES deposit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE withdraw_log ADD CONSTRAINT FK_5589944B697D393B FOREIGN KEY (withdraw_id) REFERENCES withdraw (id)');
        $this->addSql('ALTER TABLE withdraw_log ADD CONSTRAINT FK_5589944BC1AFEBD9 FOREIGN KEY (tx_reference_id) REFERENCES coin_transaction (id)');
        $this->addSql('ALTER TABLE virtual_deposit ADD CONSTRAINT FK_A3AC4EF6BF396750 FOREIGN KEY (id) REFERENCES deposit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE withdraw ADD CONSTRAINT FK_6D2D3B45712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE withdraw ADD CONSTRAINT FK_6D2D3B4511C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE manual_withdraw ADD CONSTRAINT FK_65C0C18ABF396750 FOREIGN KEY (id) REFERENCES withdraw (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manual_withdraw ADD CONSTRAINT FK_65C0C18AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE manual_withdraw CHANGE phone phone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE deposit ADD comment LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE wallet_operation ADD CONSTRAINT FK_4E1DB6FC9815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id)');
        $this->addSql('ALTER TABLE wallet_operation ADD CONSTRAINT FK_4E1DB6FC697D393B FOREIGN KEY (withdraw_id) REFERENCES withdraw (id);');
        $this->addSql('ALTER TABLE wallet_operation CHANGE balance balance NUMERIC(24, 8) NOT NULL, CHANGE total_reserved total_reserved NUMERIC(24, 8) NOT NULL, CHANGE expense expense NUMERIC(24, 8) NOT NULL, CHANGE debit debit NUMERIC(24, 8) NOT NULL, CHANGE credit credit NUMERIC(24, 8) NOT NULL, CHANGE reserve reserve NUMERIC(24, 8) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_6D2D3B45712520F3');
        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_6D2D3B4511C8FB41');
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D39712520F3');
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D3911C8FB41');
        $this->addSql('ALTER TABLE virtual_withdraw DROP FOREIGN KEY FK_93AA984DBF396750');
        $this->addSql('ALTER TABLE withdraw_log DROP FOREIGN KEY FK_5589944B697D393B');
        $this->addSql('ALTER TABLE deposit_log DROP FOREIGN KEY FK_581596A8C1AFEBD9');
        $this->addSql('ALTER TABLE withdraw_log DROP FOREIGN KEY FK_5589944BC1AFEBD9');
        $this->addSql('ALTER TABLE deposit_log DROP FOREIGN KEY FK_581596A89815E4B1');
        $this->addSql('ALTER TABLE wire_deposit DROP FOREIGN KEY FK_606734CABF396750');
        $this->addSql('ALTER TABLE deposit_only DROP FOREIGN KEY FK_D30D044BBF396750');
        $this->addSql('ALTER TABLE virtual_deposit DROP FOREIGN KEY FK_A3AC4EF6BF396750');
        $this->addSql('ALTER TABLE wire_withdraw DROP FOREIGN KEY FK_67BD0E3E6CE7F7BB');
        $this->addSql('ALTER TABLE wire_withdraw DROP FOREIGN KEY FK_67BD0E3E7EBB339D');
        $this->addSql('ALTER TABLE wire_withdraw DROP FOREIGN KEY FK_67BD0E3E8BBA3C8B');
        $this->addSql('ALTER TABLE wire_withdraw DROP FOREIGN KEY FK_67BD0E3EBF396750');
        $this->addSql('ALTER TABLE wallet_operation DROP FOREIGN KEY FK_4E1DB6FC9815E4B1');
        $this->addSql('ALTER TABLE wallet_operation DROP FOREIGN KEY FK_4E1DB6FC697D393B');
        $this->addSql('ALTER TABLE coin_transaction DROP FOREIGN KEY FK_6B45239938248176');
        $this->addSql('ALTER TABLE manual_withdraw DROP FOREIGN KEY FK_65C0C18ABF396750');
        $this->addSql('ALTER TABLE manual_withdraw DROP FOREIGN KEY FK_65C0C18AF92F3E70');

        $this->addSql('DROP TABLE coin_transaction');
        $this->addSql('DROP TABLE wallet_operation');

        $this->addSql('DROP TABLE deposit_log');
        $this->addSql('DROP TABLE deposit_only');
        $this->addSql('DROP TABLE deposit');
        $this->addSql('DROP TABLE wire_deposit');
        $this->addSql('DROP TABLE virtual_deposit');

        $this->addSql('DROP TABLE virtual_withdraw');
        $this->addSql('DROP TABLE withdraw');
        $this->addSql('DROP TABLE wire_withdraw');
        $this->addSql('DROP TABLE withdraw_log');
        $this->addSql('DROP TABLE manual_withdraw');
    }
}
