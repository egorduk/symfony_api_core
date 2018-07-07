<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141110135551 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plan_payment_limit_withdrawals (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, plan_id INT NOT NULL, daily NUMERIC(16, 8) NOT NULL, weekly NUMERIC(16, 8) NOT NULL, monthly NUMERIC(16, 8) NOT NULL, INDEX IDX_D9AE7B3438248176 (currency_id), INDEX IDX_D9AE7B34E899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_payment_limit_deposits (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, plan_id INT NOT NULL, daily NUMERIC(16, 8) NOT NULL, weekly NUMERIC(16, 8) NOT NULL, monthly NUMERIC(16, 8) NOT NULL, INDEX IDX_5599922F38248176 (currency_id), INDEX IDX_5599922FE899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_payment_limit_assignments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, plan_id INT NOT NULL, fallback_plan_id INT DEFAULT NULL, assigned_at DATETIME NOT NULL, expires_at DATETIME DEFAULT NULL, INDEX IDX_F4F17CC6A76ED395 (user_id), INDEX IDX_F4F17CC6E899029B (plan_id), INDEX IDX_F4F17CC67E96B76 (fallback_plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_payment_limits (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, slug VARCHAR(32) NOT NULL, weight INT NOT NULL, duration INT NOT NULL, duration_unit VARCHAR(16) DEFAULT NULL, custom TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_CC25C327989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals ADD CONSTRAINT FK_D9AE7B3438248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals ADD CONSTRAINT FK_D9AE7B34E899029B FOREIGN KEY (plan_id) REFERENCES plan_payment_limits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_payment_limit_deposits ADD CONSTRAINT FK_5599922F38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE plan_payment_limit_deposits ADD CONSTRAINT FK_5599922FE899029B FOREIGN KEY (plan_id) REFERENCES plan_payment_limits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_payment_limit_assignments ADD CONSTRAINT FK_F4F17CC6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plan_payment_limit_assignments ADD CONSTRAINT FK_F4F17CC6E899029B FOREIGN KEY (plan_id) REFERENCES plan_payment_limits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_payment_limit_assignments ADD CONSTRAINT FK_F4F17CC67E96B76 FOREIGN KEY (fallback_plan_id) REFERENCES plan_payment_limits (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE payment_limit');
        $this->addSql('DROP TABLE promotional_email');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plan_payment_limit_withdrawals DROP FOREIGN KEY FK_D9AE7B34E899029B');
        $this->addSql('ALTER TABLE plan_payment_limit_deposits DROP FOREIGN KEY FK_5599922FE899029B');
        $this->addSql('ALTER TABLE plan_payment_limit_assignments DROP FOREIGN KEY FK_F4F17CC6E899029B');
        $this->addSql('ALTER TABLE plan_payment_limit_assignments DROP FOREIGN KEY FK_F4F17CC67E96B76');
        $this->addSql('CREATE TABLE payment_limit (id INT AUTO_INCREMENT NOT NULL, bank_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, name VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, `limit` NUMERIC(16, 8) NOT NULL, INDEX IDX_28DFDED211C8FB41 (bank_id), INDEX IDX_28DFDED238248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotional_email (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, hash VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, registered TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C5287FD1E7927C74 (email), INDEX hash_idx (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_limit ADD CONSTRAINT FK_28DFDED211C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE payment_limit ADD CONSTRAINT FK_28DFDED238248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('DROP TABLE plan_payment_limit_withdrawals');
        $this->addSql('DROP TABLE plan_payment_limit_deposits');
        $this->addSql('DROP TABLE plan_payment_limit_assignments');
        $this->addSql('DROP TABLE plan_payment_limits');
    }
}
