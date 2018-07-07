<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180605134600 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', "Migration can only be executed safely on 'mysql'.");

        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'user.password.new'");

        $emailTpl = <<< EOC
<table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
    <tr>
        <td height="30px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:30px"></div></td>
    </tr>
    <tr>
        <td align="center" border="0" style="border:0;padding: 0;">
            <img src="https://demo4-dev.exmarkets.com/static/images/admin.png" alt="Admin"/>
        </td>
    </tr>
    <tr>
        <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;width: 492px;font-family:Tahoma,Verdana,sans-serif;font-size: 22px;color: #FFFFFF;line-height: 34px;margin: 0 auto">
                You have been set up as administrator with the following credentials:
            </p>
        </td>
    </tr>
    <tr>
        <td height="12px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:12px"></div></td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                login:
            </p>
        </td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                {{ user.username }}
            </p>
        </td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                password:
            </p>
        </td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                {{ user.plainPassword }}
            </p>
        </td>
    </tr>
    <tr>
        <td height="50px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:50px"></div></td>
    </tr>
    <tr>
        <td align="center" height="1" border="0" style="border:0;padding: 0;"><div style="background-color: #465069;line-height:0;width:422px;height:1px"></div></td>
    </tr>
    <tr>
        <td height="10px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:10px"></div></td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                Details:
            </p>
        </td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                Date: {{ timestamp|date('Y-m-d H:i:s', 'GMT') }} (GMT)
            </p>
        </td>
    </tr>
    <tr>
        <td height="37px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:37px"></div></td>
    </tr>
    <tr>
        <td border="0" style="border:0;padding: 0;">
            <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                Question about exmarket? Get into out
                <a href="" style="font-family:Tahoma,Verdana,sans-serif; text-decoration: underline;color:#4a90e2;">
                    chat
                </a>.
            </p>
        </td>
    </tr>
    <tr>
        <td height="6px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:6px"></div></td>
    </tr>
</table>
EOC;

        $emailTpl = $this->connection->quote($emailTpl);
        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ user.username }}</strong></li><li><strong>{{ user.plainPassword }}</strong></li><li><strong>{{ timestamp }}</strong></li></ul>', $emailTpl, 'user.password.new', 'New password for user', '2018-05-17 16:57:00', '2018-06-05 13:46:00');
EOC;
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', "Migration can only be executed safely on 'mysql'.");
    }
}
