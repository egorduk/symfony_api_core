<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180522151220 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plan_payment_limit_withdrawals (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, plan_id INT NOT NULL, daily NUMERIC(24, 8) NOT NULL, weekly NUMERIC(24, 8) NOT NULL, monthly NUMERIC(24, 8) NOT NULL, INDEX IDX_D9AE7B3438248176 (currency_id), INDEX IDX_D9AE7B34E899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals ADD CONSTRAINT FK_D9AE7B3438248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals ADD CONSTRAINT FK_D9AE7B34E899029B FOREIGN KEY (plan_id) REFERENCES plan_payment_limits (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_6D2D3B4511C8FB41');
        $this->addSql('ALTER TABLE withdraw DROP bank_id');
        $this->addSql('ALTER TABLE withdraw DROP foreign_account');
        $this->addSql('ALTER TABLE withdraw DROP foreign_status');
        $this->addSql('ALTER TABLE withdraw DROP foreign_tx_reference');
        $this->addSql('ALTER TABLE withdraw DROP payment_method');
        $this->addSql('ALTER TABLE withdraw ADD user_address_id INT NOT NULL');
        $this->addSql('ALTER TABLE withdraw ADD wallet_transaction_id INT NOT NULL');
        $this->addSql('ALTER TABLE withdraw ADD CONSTRAINT FK_D9AE7B3438248111 FOREIGN KEY (user_address_id) REFERENCES user_address (id)');
        $this->addSql('ALTER TABLE withdraw ADD CONSTRAINT FK_D9AE7B3438248112 FOREIGN KEY (wallet_transaction_id) REFERENCES wallet_transaction (id)');

        $this->addSql('ALTER TABLE muhhamad_wallet ADD is_test TINYINT(1) NOT NULL DEFAULT 0');

        $this->addSql('ALTER TABLE address_transaction ADD type TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals DROP FOREIGN KEY FK_D9AE7B3438248176');
        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals DROP FOREIGN KEY FK_D9AE7B34E899029B');
        $this->addSql('DROP TABLE plan_payment_limit_withdrawals');

        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_D9AE7B3438248111');
        $this->addSql('ALTER TABLE withdraw DROP FOREIGN KEY FK_D9AE7B3438248112');
        $this->addSql('ALTER TABLE withdraw DROP user_address_id');
        $this->addSql('ALTER TABLE withdraw DROP wallet_transaction_id');

        $this->addSql('ALTER TABLE muhhamad_wallet DROP is_test');

        $this->addSql('ALTER TABLE address_transaction DROP type');
    }
}