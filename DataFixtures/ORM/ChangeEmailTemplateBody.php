<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChangeEmailTemplateBody implements FixtureInterface, OrderedFixtureInterface
{
    private $templates = [
        // template name, new body
        [
            'user.register',
           <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exmarkets</title>
</head>

<body style="margin:0; padding:0; >
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" >
  <tr>
    <td style="padding:20px 0;">
    	<table width="600" align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 20px; background: #fff; border: 1px #dddddd solid;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
          </tr>
          <tr>
            <td colspan="2" style="padding:5px 20px 5px 20px;">

This is an automated message. Please do not reply to this e-mail!<br />
<p>
Congratulations, you have successfully opened an account. Below are your login credentials:
            Client ID: {{ user.username }}
            Password:  {{ user.plainPassword }}
</p>
<p>Sincerely,<br />
Exmarkets</p>
            </td>
          </tr>
          <tr>
          	<td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; color:#777; padding: 15px 20px;">
             Copyrights © Exmarkets
            </td>
            <td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; text-align: center; color:#777; padding: 15px 20px; text-align: right;"><a style="text-decoration: none; color:#777;" href="http://www.exmarkets.com">www.exmarkets.com</a></td>
          </tr>
        </table>
    </td>
  </tr>
</table>

</body>
</html>
EOD
    ],
        [
            'user.reset_request',
           <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exmarkets</title>
</head>

<body style="margin:0; padding:0; >
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" >
  <tr>
    <td style="padding:20px 0;">
    	<table width="600" align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 20px; background: #fff; border: 1px #dddddd solid;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
          </tr>
          <tr>
            <td colspan="2" style="padding:5px 20px 5px 20px;">

This is an automated message. Please do not reply to this e-mail!<br />
<p>
Hello {{ user.username }}!

To reset your password - please visit {{ confirmationUrl }}
</p>
<p>Sincerely,<br />
Exmarkets</p>
            </td>
          </tr>
          <tr>
          	<td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; color:#777; padding: 15px 20px;">
             Copyrights © Exmarkets
            </td>
            <td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; text-align: center; color:#777; padding: 15px 20px; text-align: right;"><a style="text-decoration: none; color:#777;" href="http://www.exmarkets.com">www.exmarkets.com</a></td>
          </tr>
        </table>
    </td>
  </tr>
</table>

</body>
</html>
EOD
            ]
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10; // templates need to be loaded first
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->templates as $template) {
            list($name, $body) = $template;

            $email = $manager->getRepository('BtcCoreBundle:EmailTemplate')
                ->findOneBy(['name' => $name]);
            $email->setBody($body);

            $manager->persist($email);
        }
        $manager->flush();
    }
}
