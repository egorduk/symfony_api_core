<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180517105619 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'user.new_pin\'');
        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.issue\'');
        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.redeem\'');

        $emailTpl = <<< EOC
<table style="width:100%;background-color: #192B41;border-spacing:0;border-collapse:collapse;font-family:Verdana,sans-serif">
    <tbody>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center"><img src="https://demo4-dev.exmarkets.com/static/logo.png"></td>
    </tr>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center" style="padding:0 10px">
            <table align="center" style="background:#1C3049;width:600px;margin:0 auto;font-size:16px;color:#333333;border-spacing:0;border-collapse:collapse">
                <tbody>
                <tr>
                    <td colspan="3" height="140" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:140px"></div></td>
                </tr>

                <tr>
                    <td style="color: #ffffff;padding:0 10px 0;text-align:center;line-height:50px;vertical-align:top;font-size:38px;font-weight:normal;">Notification</td>
                </tr>
                <tr>
                    <td colspan="3" height="50" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:50px"></div></td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align:center;color:#7B8898">New Pin:</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align:center;font-size:20px;color: #fff;">{{ user.pin }}</p>
                    </td>
                </tr>
                <tr style="background:transparent">
                    <td colspan="3" height="20" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:20px"></div></td>
                </tr>
                <tr>
                    <td style="padding:60px 10px;text-align:center;line-height:40px">
                        <a href="{{ host }}/login/pin?email={{ encoded_email }}" style="font-family:Tahoma,Verdana,sans-serif; border: 10px solid #138DEC;border-left: 35px solid #138DEC; border-right: 35px solid #138DEC; text-align: center; width: 120px; height: 30px; text-decoration: none; background: #138DEC; font-size: 16px; color: #FFFFFF;border-radius: 4px;" target="_blank">
                            SIGN IN
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" height="40" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:40px"></div></td>
    </tr>
    <tr>
        <td colspan="3" height="85" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:85px"></div></td>
    </tr>
    </tbody>
</table>
EOC;
        $emailTpl = $this->connection->quote($emailTpl);
        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ user.pin }}</strong></li></ul>', $emailTpl, 'user.new_pin', 'New Pin', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
EOC;
        $this->addSql($sql);

        $emailTpl = <<< EOC
<table style="width:100%;background-color: #192B41;border-spacing:0;border-collapse:collapse;font-family:Verdana,sans-serif">
    <tbody>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center"><img src="https://demo4-dev.exmarkets.com/static/logo.png"></td>
    </tr>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center" style="padding:0 10px">
            <table align="center" style="background:#1C3049;width:600px;margin:0 auto;font-size:16px;color:#333333;border-spacing:0;border-collapse:collapse">
                <tbody>
                <tr>
                    <td colspan="3" height="140" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:140px"></div></td>
                </tr>

                <tr>
                    <td style="color: #ffffff;padding:0 10px 0;text-align:center;line-height:50px;vertical-align:top;font-size:38px;font-weight:normal;">Notification</td>
                </tr>
                <tr>
                    <td colspan="3" height="50" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:50px"></div></td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align:center;color:#7B8898">Voucher was created:</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align:center;font-size:20px;color: #fff;">{{ voucher.code }}</p>
                    </td>
                </tr>
                <tr style="background:transparent">
                    <td colspan="3" height="20" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:20px"></div></td>
                </tr>
                <tr>
                    <td style="padding:60px 10px;text-align:center;line-height:40px">
                        <a href="{{ host }}/login/pin?email={{ encoded_email }}" style="font-family:Tahoma,Verdana,sans-serif; border: 10px solid #138DEC;border-left: 35px solid #138DEC; border-right: 35px solid #138DEC; text-align: center; width: 120px; height: 30px; text-decoration: none; background: #138DEC; font-size: 16px; color: #FFFFFF;border-radius: 4px;" target="_blank">
                            SIGN IN
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" height="40" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:40px"></div></td>
    </tr>
    <tr>
        <td colspan="3" height="85" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:85px"></div></td>
    </tr>
    </tbody>
</table>
EOC;
        $emailTpl = $this->connection->quote($emailTpl);
        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ voucher.code }}</strong></li></ul>', $emailTpl, 'voucher.issue', 'Voucher Issue', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
EOC;
        $this->addSql($sql);

        $emailTpl = <<< EOC
<table style="width:100%;background-color: #192B41;border-spacing:0;border-collapse:collapse;font-family:Verdana,sans-serif">
    <tbody>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center"><img src="https://demo4-dev.exmarkets.com/static/logo.png"></td>
    </tr>
    <tr>
        <td colspan="3" height="60" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:60px"></div></td>
    </tr>
    <tr>
        <td align="center" style="padding:0 10px">
            <table align="center" style="background:#1C3049;width:600px;margin:0 auto;font-size:16px;color:#333333;border-spacing:0;border-collapse:collapse">
                <tbody>
                <tr>
                    <td colspan="3" height="140" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:140px"></div></td>
                </tr>

                <tr>
                    <td style="color: #ffffff;padding:0 10px 0;text-align:center;line-height:50px;vertical-align:top;font-size:38px;font-weight:normal;">Notification</td>
                </tr>
                <tr>
                    <td colspan="3" height="50" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:50px"></div></td>
                </tr>

                <tr>
                    <td>
                        <p style="text-align:center;color:#7B8898">Voucher:</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align:center;font-size:20px;color: #fff;">{{ voucher.code }}</p>
                    </td>
                </tr>
                <tr style="background:transparent">
                    <td colspan="3" height="20" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:20px"></div></td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align:center;color:#7B8898">was redeemed by:</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align:center;font-size:20px;color: #138DEC;">{{ redeemer }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:60px 10px;text-align:center;line-height:40px">
                        <a href="{{ host }}/login/pin?email={{ encoded_email }}" style="font-family:Tahoma,Verdana,sans-serif; border: 10px solid #138DEC;border-left: 35px solid #138DEC; border-right: 35px solid #138DEC; text-align: center; width: 120px; height: 30px; text-decoration: none; background: #138DEC; font-size: 16px; color: #FFFFFF;border-radius: 4px;" target="_blank">
                            SIGN IN
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" height="40" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:40px"></div></td>
    </tr>
    <tr>
        <td colspan="3" height="85" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:1px;height:85px"></div></td>
    </tr>
    </tbody>
</table>
EOC;
        $emailTpl = $this->connection->quote($emailTpl);
        $sql = <<< EOC
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ voucher.code }}</strong></li><li><strong>{{ redeemer }}</strong></li></ul>', $emailTpl, 'voucher.redeem', 'Voucher Redeem', '2017-09-27 12:45:36', '2017-09-27 12:45:36');
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

        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'user.new_pin\'');
        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.issue\'');
        $this->addSql('DELETE FROM `email_template` WHERE `name` = \'voucher.redeem\'');
    }
}
