<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180226095036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE transactions CHANGE amount amount NUMERIC(24, 8) NOT NULL, CHANGE fee fee NUMERIC(24, 8) NOT NULL, CHANGE price price NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE fee_set CHANGE rule rule NUMERIC(24, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders CHANGE current_amount current_amount NUMERIC(24, 8) NOT NULL, CHANGE asked_unit_price asked_unit_price NUMERIC(24, 8) NOT NULL, CHANGE fee_percent fee_percent NUMERIC(24, 8) NOT NULL, CHANGE fee_amount_reserved fee_amount_reserved NUMERIC(24, 8) NOT NULL, CHANGE fee_amount_taken fee_amount_taken NUMERIC(24, 8) NOT NULL, CHANGE amount amount NUMERIC(24, 8) NOT NULL, CHANGE reserve_total reserve_total NUMERIC(24, 8) NOT NULL, CHANGE reserve_spent reserve_spent NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE fee CHANGE fixed fixed NUMERIC(24, 8) NOT NULL, CHANGE percent percent NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE currency_rate CHANGE rate rate NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE operations CHANGE available available NUMERIC(24, 8) NOT NULL, CHANGE reserved reserved NUMERIC(24, 8) NOT NULL, CHANGE total total NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE wallet CHANGE amount_total amount_total NUMERIC(24, 8) NOT NULL, CHANGE amount_reserved amount_reserved NUMERIC(24, 8) NOT NULL, CHANGE amount_available amount_available NUMERIC(24, 8) NOT NULL, CHANGE fee_percent fee_percent NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE price_notifications CHANGE price price NUMERIC(24, 8) NOT NULL, CHANGE current_price current_price NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE vouchers CHANGE amount amount NUMERIC(24, 8) NOT NULL');
        $this->addSql('ALTER TABLE `wallet_changes_notify` CHANGE `amount_total` `amount_total` DECIMAL(24,8) NOT NULL, CHANGE `amount_reserved` `amount_reserved` DECIMAL(24,8) NOT NULL, CHANGE `amount_available` `amount_available` DECIMAL(24,8) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE currency_rate CHANGE rate rate NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE fee CHANGE fixed fixed NUMERIC(16, 8) NOT NULL, CHANGE percent percent NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE fee_set CHANGE rule rule NUMERIC(16, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE operations CHANGE available available NUMERIC(16, 8) NOT NULL, CHANGE reserved reserved NUMERIC(16, 8) NOT NULL, CHANGE total total NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE orders CHANGE current_amount current_amount NUMERIC(16, 8) NOT NULL, CHANGE asked_unit_price asked_unit_price NUMERIC(16, 8) NOT NULL, CHANGE fee_percent fee_percent NUMERIC(16, 8) NOT NULL, CHANGE fee_amount_reserved fee_amount_reserved NUMERIC(16, 8) NOT NULL, CHANGE fee_amount_taken fee_amount_taken NUMERIC(16, 8) NOT NULL, CHANGE amount amount NUMERIC(16, 8) NOT NULL, CHANGE reserve_total reserve_total NUMERIC(16, 8) NOT NULL, CHANGE reserve_spent reserve_spent NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE price_notifications CHANGE price price NUMERIC(16, 8) NOT NULL, CHANGE current_price current_price NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE transactions CHANGE amount amount NUMERIC(16, 8) NOT NULL, CHANGE fee fee NUMERIC(16, 8) NOT NULL, CHANGE price price NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE vouchers CHANGE amount amount NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE wallet CHANGE amount_total amount_total NUMERIC(16, 8) NOT NULL, CHANGE amount_reserved amount_reserved NUMERIC(16, 8) NOT NULL, CHANGE amount_available amount_available NUMERIC(16, 8) NOT NULL, CHANGE fee_percent fee_percent NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE `wallet_changes_notify` CHANGE `amount_total` `amount_total` DECIMAL(16,8) NOT NULL, CHANGE `amount_reserved` `amount_reserved` DECIMAL(16,8) NOT NULL, CHANGE `amount_available` `amount_available` DECIMAL(16,8) NOT NULL');
    }
}
