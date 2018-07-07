<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171214092142 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE wallet_changes_notify');
        $this->addSql('DROP TRIGGER IF EXISTS `update_wallet`');
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE wallet_changes_notify (wallet_id INT NOT NULL, user_id INT NOT NULL, currency_id INT NOT NULL, amount_total NUMERIC(16, 8) NOT NULL, amount_reserved NUMERIC(16, 8) NOT NULL, amount_available NUMERIC(16, 8) NOT NULL, changed DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(wallet_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TRIGGER IF EXISTS `update_wallet`');
        $this->addSql('CREATE TRIGGER `update_wallet` AFTER UPDATE on `wallet`
FOR EACH ROW
      INSERT INTO wallet_changes_notify (`wallet_id`, `user_id`, `currency_id`, `amount_total`, `amount_reserved`, `amount_available`)
      VALUES (NEW.id, NEW.user_id, NEW.currency_id, NEW.amount_total, NEW.amount_reserved, NEW.amount_available)
      ON DUPLICATE KEY UPDATE
        amount_total = NEW.amount_total, amount_reserved = NEW.amount_reserved, amount_available = NEW.amount_available, `changed` = CURRENT_TIMESTAMP()');

    }
}
