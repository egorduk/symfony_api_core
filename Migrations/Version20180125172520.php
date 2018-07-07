<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180125172520 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'user.suspended\'');

        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('This is an automated message. Please do not reply to this e-mail!\r\n\r\nDear {{user.verification.personalInfo.firstName}} {{user.verification.personalInfo.lastName}},\r\n\r\nYour account has been suspended for the following reason:\r\n            {{ blockReason }}\r\nFor more information please submit a ticket at [support.exmarkets.com](http://support.exmarkets.com)\r\n\r\nSincerely,\r\n\r\nExmarkets', 'This is an automated message. Please do not reply to this e-mail!\r\n\r\nDear {{user.verification.personalInfo.firstName}} {{user.verification.personalInfo.lastName}},\r\n\r\nYour account has been suspended for the following reason:\r\n            {{ blockReason }}\r\nFor more information please submit a ticket at [support.exmarkets.com](http://support.exmarkets.com)\r\n\r\nSincerely,\r\n\r\nExmarkets', 'user.suspended', 'Account suspended', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
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
