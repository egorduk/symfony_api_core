<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180213140629 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bitfinex_orders');
        $this->addSql('DROP TABLE coin_deposit_address');
        //$this->addSql('DROP TABLE hw_deposits');
        $this->addSql('DROP TABLE hw_withdrawals');
        $this->addSql('DROP TABLE kraken_orders');
        $this->addSql('DROP TABLE page_translations');
        $this->addSql('DROP TABLE plan_payment_limit_deposits');
        $this->addSql('DROP TABLE plan_payment_limit_withdrawals');
        $this->addSql('DROP TABLE promotional_email');
        $this->addSql('ALTER TABLE orders DROP old_ref');
        $this->addSql('ALTER TABLE payment_fee DROP FOREIGN KEY FK_A12AA58111C8FB41');
        $this->addSql('ALTER TABLE payment_fee DROP FOREIGN KEY FK_A12AA58138248176');
        $this->addSql('DROP TABLE payment_fee');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
