<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171208123229 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $emailTpl = <<< EOC
<table style="width:100%;background:url('https://exchange.bankera.com/images/mail/bg.jpg?v=2') no-repeat top center #5ed0b1;border-spacing:0;border-collapse:collapse;font-family:Verdana,sans-serif">
    <tbody>
    <tr>
        <td align="center" style="padding:60px 0"><img src="https://exchange.bankera.com/images/mail/logo.png?v=2" class="CToWUd"></td>
    </tr>
    <tr>
        <td align="center" style="padding:0 10px">
            <table align="center" style="background:#ffffff;width:600px;margin:0 auto;font-size:16px;color:#333333;border-spacing:0;border-collapse:collapse">
                <tbody>
                <tr>
                    <td style="padding:140px 10px 50px;text-align:center;line-height:50px;vertical-align:top;font-size:56px;font-weight:bold;text-transform:uppercase">Welcome!</td>
                </tr>
                <tr>
                    <td style="padding:15px 10px;text-align:center;line-height:24px">
                        <div style="color:#777777">Client Email:</div>
                        <div style="font-size:20px"><a href="mailto:{{ user.email }}" target="_blank">{{ user.email }}</a></div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:15px 10px;text-align:center;line-height:24px">
                        <div style="color:#777777">PIN:</div>
                        <div style="font-size:20px">{{ user.pin }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:60px 10px;text-align:center;line-height:40px"><a href="{{ host }}/login/pin?email={{ encoded_email }}" style="text-decoration:none;font-size:22px;font-weight:bold;color:#333333;line-height:35px;display:inline-block;vertical-align:top;border-bottom:2px solid #333333" target="_blank">SIGN IN</a></td>
                </tr>
                <tr>
                    <td style="padding:0 10px 50px;text-align:center;line-height:20px">
                        <div style="color:#dddddd">Questions about Bankera? Get into our <a href="https://chat.bankera.com/channel/community" style="text-decoration:underline;color:#dddddd" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://chat.bankera.com/channel/community&amp;source=gmail&amp;ust=1515762712409000&amp;usg=AFQjCNFzfkmc7mDJJ_lEzjfGYvnIoG0lEA">chat</a>.</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding:40px 10px 85px"><a href="https://twitter.com/Bankeracom" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://twitter.com/Bankeracom&amp;source=gmail&amp;ust=1515762712409000&amp;usg=AFQjCNGLzUjZddhVlES9lEQbVBxTpw9SNQ"><img src="https://exchange.bankera.com/images/mail/twitter.png?v=2" alt="tw" class="CToWUd"></a> <a href="https://www.facebook.com/bankeracom/" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.facebook.com/bankeracom/&amp;source=gmail&amp;ust=1515762712409000&amp;usg=AFQjCNGLe0x5FKxHckwlC0T-eoPummwNaQ"><img src="https://ci3.googleusercontent.com/proxy/59eRyGfdapeWziD66iDNC9tMY2-Td9OWqZ-Bdg7q7ch5MQ9Y_fkyrM7dANb7PlY-mbAdRe9p8AKH1VA7CZrLPTEYsicIIztXzaRSh7wK1w=s0-d-e1-ft#https://exchange.bankera.com/images/mail/facebook.png?v=2" alt="fb" class="CToWUd"></a> <a href="https://www.linkedin.com/company-beta/25000232/" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.linkedin.com/company-beta/25000232/&amp;source=gmail&amp;ust=1515762712409000&amp;usg=AFQjCNH0t75dmNg97z0o6dtjiiaAdxTGvQ"><img src="https://ci4.googleusercontent.com/proxy/xTIq-9DUaiUk6F3SdJ9guExPWwy4p83gMjaX5PGmqU5Jd38tDDQ_Hezj0eo8l1RxG_taFCEIMGi1Z2u6HVSxi5oPePUtp_EtAholw_9agg=s0-d-e1-ft#https://exchange.bankera.com/images/mail/linkedin.png?v=2" alt="in" class="CToWUd"></a> <a href="https://blog.bankera.com/" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://blog.bankera.com/&amp;source=gmail&amp;ust=1515762712409000&amp;usg=AFQjCNGArfcbkZrNHoxQokm9UltBbg9yjw"><img src="https://ci3.googleusercontent.com/proxy/lZcsu0SmmNvoVN5lxzndSX-2bYosq1OAUlaeg1DlARybQh_59MrvZMYGedkuOYQxNAUknFUbZLbM2_9IZ9qkb_yTbbt0iGNRJ67Z=s0-d-e1-ft#https://exchange.bankera.com/images/mail/book.png?v=2" alt="bk" class="CToWUd"></a> <a href="https://www.youtube.com/channel/UC3lEI3rq1W4fPFYPu9ZezFg" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.youtube.com/channel/UC3lEI3rq1W4fPFYPu9ZezFg&amp;source=gmail&amp;ust=1515762712410000&amp;usg=AFQjCNHLOgjoJKcH9hhxuiHsf1xYkFYCHg"><img src="https://ci3.googleusercontent.com/proxy/Nk6DJrcXrWlN2PSQj3Ea5zjNJeX7uFrRezo1dAxr3Sf-UkaRGTSlMJxdWz4MrikGq-eno6yTM_2swq4xKKqXguDV46ipr3YX6fv_9WOZ=s0-d-e1-ft#https://exchange.bankera.com/images/mail/youtube.png?v=2" alt="yt" class="CToWUd"></a> <a href="https://t.me/bankera" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://t.me/bankera&amp;source=gmail&amp;ust=1515762712410000&amp;usg=AFQjCNF6s6LpAX6nMWTuYTnDHdobaToP6g"><img src="https://ci6.googleusercontent.com/proxy/cpGv9vTNy7YEvDXoOnfaBsv66kdDWx4OaIN0uKPoRCMue6y8oXqaWXoqSu7BBAe9ok3vgmv0tS53BBcUZuNGKoyIlJe8ThbLPZo9HO3y-w=s0-d-e1-ft#https://exchange.bankera.com/images/mail/telegram.png?v=2" alt="tm" class="CToWUd"></a> <a href="https://chat.bankera.com/channel/community" style="width:36px;height:20px;text-align:center;text-decoration:none;padding:8px 0;border-radius:50%;background:#222222;color:#ffffff;margin:0 5px;display:inline-block;vertical-align:top" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://chat.bankera.com/channel/community&amp;source=gmail&amp;ust=1515762712410000&amp;usg=AFQjCNHXBALK_V_EnzNM8CPSLHVDAgI23w"><img src="https://ci5.googleusercontent.com/proxy/GOR27lQ-uOYfUOCM6CdzX31Jd8sCunuYQ8bWwm1cF9bPi7WqJTSgA6ApGhTvYC_09aCs74aFrKw9yDV6ytHs4-5F4jB4J1XWCKTOq82d=s0-d-e1-ft#https://exchange.bankera.com/images/mail/comment.png?v=2" alt="cm" class="CToWUd"></a></td>
    </tr>
    </tbody>
</table>
EOC;
        $emailTpl = $this->connection->quote($emailTpl);
        $this->addSql("INSERT INTO `email_template` (`id`, `name`, `description`, `subject`, `body`, `created_at`, `updated_at`) VALUES (NULL, 'user.new_pin', '<p>We sent new pin for you.</p>\r\n<ul>\r\n<li><strong>{{ user.pin}}</strong></li>\r\n</ul>', 'Your pin', $emailTpl, '2017-09-27 12:45:36', '2017-09-27 12:45:39');");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
