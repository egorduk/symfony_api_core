<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309105619 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.issue\'');
        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.redeem\'');

        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('This is an automated message. Please do not reply to this e-mail!\r\n\r\nVoucher {{ voucher.code }} was created.\r\n\r\nSincerely,\r\n\r\nExmarkets', 'This is an automated message. Please do not reply to this e-mail!\r\n\r\nVoucher {{ voucher.code }} was created.\r\n\r\nSincerely,\r\n\r\nExmarkets', 'voucher.issue', 'Voucher Issue', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
EOC;
        $this->addSql($sql);

        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('This is an automated message. Please do not reply to this e-mail!\r\n\r\nVoucher {{ voucher.code }} was redeemed.\r\n\r\nSincerely,\r\n\r\nExmarkets', 'This is an automated message. Please do not reply to this e-mail!\r\n\r\nVoucher {{ voucher.code }} was redeemed.\r\n\r\nSincerely,\r\n\r\nExmarkets', 'voucher.redeem', 'Voucher Redeem', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
EOC;
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
