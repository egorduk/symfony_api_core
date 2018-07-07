<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180604165700 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', "Migration can only be executed safely on 'mysql'.");

        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'user.new_pin'");

        $emailTpl = <<< EOC
<table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
                            <tr>
                                <td height="24px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:24px"></div></td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <img src="https://demo4-dev.exmarkets.com/static/images/big-mail.png" alt="Voucher"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 28px;color: #FFFFFF;line-height: 30px; ">
                                        Welcome back!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="12px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:12px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Client Email:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <a style="font-family:Tahoma,Verdana,sans-serif; text-decoration: none;color:#fff;">{{ user.email }}</a>
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
                                        PIN:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                                        {{ user.pin }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="37px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:37px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Question about exmarket? Get into our
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
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ user.pin }}</strong></li><li><strong>{{ user.email }}</strong></li></ul>', $emailTpl, 'user.new_pin', 'New pin for user', '2018-05-17 16:57:00', '2018-05-17 16:57:00');
EOC;
        $this->addSql($sql);


        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'voucher.redeem'");

        $emailTpl = <<< EOC
<table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
                            <tr>
                                <td height="20px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:20px"></div></td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <img src="https://demo4-dev.exmarkets.com/static/images/voucher-used.png" alt="Voucher"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 28px;color: #FFFFFF;line-height: 30px; ">
                                        The voucher has been used!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="12px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:12px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Voucher number:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                                        {{ voucher.code }}
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
                                        Date: {{ voucher.redeemedAt|date('Y-m-d H:i:s') }} (GMT)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="37px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:37px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Question about exmarket? Get into our
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
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ voucher.code }}</strong></li><li><strong>{{ voucher.redeemedAt }}</strong></li></ul>', $emailTpl, 'voucher.redeem', 'Voucher Redeem', '2018-05-17 16:57:00', '2018-05-17 16:57:00');
EOC;
        $this->addSql($sql);


        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'voucher.issue'");

        $emailTpl = <<< EOC
<table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
                            <tr>
                                <td height="20px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:20px"></div></td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <img src="https://demo4-dev.exmarkets.com/static/images/voucher-created.png" alt="Voucher"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 28px;color: #FFFFFF;line-height: 30px; ">
                                        The voucher is created!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="12px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:12px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Voucher number:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 16px;color: #FFFFFF;line-height: 30px;margin: 0;">
                                        {{ voucher.code }}
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
                                        Date: {{ voucher.createdAt|date('Y-m-d H:i:s') }} (GMT)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="37px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:37px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Question about exmarket? Get into our
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
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ voucher.code }}</strong></li><li><strong>{{ voucher.createdAt }}</strong></li></ul>', $emailTpl, 'voucher.issue', 'Voucher Issue', '2018-05-17 16:57:00', '2018-05-17 16:57:00');
EOC;
        $this->addSql($sql);


        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'verification.notification'");
        $emailTpl = <<< EOC
 <table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
                            <tr>
                                <td height="20px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:20px"></div></td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <img src="https://demo4-dev.exmarkets.com/static/images/user-data.png" alt="Voucher"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 28px;color: #FFFFFF;line-height: 30px; ">
                                        Verification details has <br />
                                        been changed!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="34px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:34px"></div></td>
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
                                        Date: {{ verification.updatedAt|date('Y-m-d H:i:s') }} (GMT)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="37px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:37px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin-bottom: 12px">
                                        Question about exmarket? Get into our
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
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ verification.updatedAt }}</strong></li></ul>', $emailTpl, 'verification.notification', 'Verification notification', '2018-05-17 16:57:00', '2018-05-17 16:57:00');
EOC;
        $this->addSql($sql);


        $this->addSql("DELETE FROM `email_template` WHERE `name` = 'withdrawal.notification'");
        $emailTpl = <<< EOC
 <table align="center" style="background:#1C3049;width:522px;margin: 0 auto;border: 1px solid #465069;border-spacing: 0;border-collapse: collapse;">
                            <tr>
                                <td height="40px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:40px"></div></td>
                            </tr>
                            <tr>
                                <td align="center" border="0" style="border:0;padding: 0;">
                                    <img src="https://demo4-dev.exmarkets.com/static/images/withdraw.png" alt="Withdrawal"/>
                                </td>
                            </tr>
                            <tr>
                                <td height="16px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:16px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" style="border:0;padding: 0;">
                                    <p style="text-align: center;font-family:Tahoma,Verdana,sans-serif;font-size: 28px;color: #FFFFFF;line-height: 30px; ">
                                        Withdrawal was submitted!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="34px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:34px"></div></td>
                            </tr>
                            <tr>
                                <td height="10px" width="100%" border="0" style="border:0;padding: 0;"><div style="line-height:0;width:100%;height:10px"></div></td>
                            </tr>
                            <tr>
                                <td border="0" height="30" width="422" style="border:0;padding: 0;">
                                    <p style="text-align: left;font-family:Tahoma,Verdana,sans-serif;font-size: 14px;color: #7B8898;line-height: 16px;margin: 0 auto;width: 422px;">
                                        Details:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" border="0" width="422" style="border:0;padding: 0;">
                                    <table align="center" width="422" style="width: 422px;margin: 0 auto;border-spacing: 0;border-collapse: collapse;color: #FFFFFF;">
                                        <tr>
                                            <td align="left" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                Amount
                                            </td>
                                            <td align="right" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                {{ withdrawal.amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                Currency
                                            </td>
                                            <td align="right" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                {{ currency.code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                Date
                                            </td>
                                            <td align="right" height="30" border="0" style="border:0;padding: 0;border-top: solid 1px #465069;font-family: Tahoma,Verdana,sans-serif;font-size: 12px;letter-spacing: 0;">
                                                {{ withdrawal.createdAt|date('Y-m-d H:i:s') }} (GMT)
                                            </td>
                                        </tr>
                                    </table>
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
INSERT INTO `email_template` (`description`, `body`, `name`, `subject`, `created_at`, `updated_at`) VALUES ('<p>Available template variables:</p><ul><li><strong>{{ withdrawal.amount }}</strong></li><li><strong>{{ withdrawal.createdAt }}</strong></li><li><strong>{{ currency.code }}</strong></li></ul>', $emailTpl, 'withdrawal.notification', 'Withdrawal notification', '2018-05-17 16:57:00', '2018-05-17 16:57:00');
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
