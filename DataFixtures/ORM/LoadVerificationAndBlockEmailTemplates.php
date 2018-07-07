<?php namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadVerificationAndBlockEmailTemplates implements FixtureInterface, OrderedFixtureInterface
{
    private $templates = [
        // template name, template description, subject, body
        [
            'user.suspended',
            '<p>Email to be sent when user account is suspended</p>

Available template variables:
<ul>
</ul>',
            'Account suspended',
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

            Account suspended for Term violation
This is an automated message. Please do not reply to this e-mail!
Your account has been suspended for Term violation. For more information please submit a ticket at support.exmarkets.com

Sincerely,
Exmarkets</td>
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
            'user.verification.denied',
            '<p>Email to be sent when user verification is denied</p>

Available template variables:
<ul>
</ul>',
            'Verification denied',
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

Verification denied:
This is an automated message. Please do not reply to this e-mail!
Dear {user.username},
Your verification request has been denied.

What should you do now?
1) Check that all of the documents you submitted are entirely visible and are in latin letters
2) Re-submit your verification request
3) Wait for approval
4) In case you got denied again please submit a ticket at our support center at: support.exmarkets.com

Sincerely,
Exmarkets
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
            'user.verification.approved',
            '<p>Email to be sent when user verification is approved</p>

Available template variables:
<ul>
</ul>',
            'Verification approved',
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

        Verification approved:
This is an automated message. Please do not reply to this e-mail!
Dear {user.username},
Your verification request has been approved!
You can now start trading by depositing through our various deposit methods and placing an order in our market. For more information please refer to our “How to start” (hyperlink į How to start) guide.
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
        return 1; // very high priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->templates as $template) {
            list($name, $description, $subject, $body) = $template;

            $email = new EmailTemplate();
            $email->setName($name);
            $email->setDescription($description);
            $email->setSubject($subject);
            $email->setBody($body);

            $manager->persist($email);
        }
        $manager->flush();
    }
}


