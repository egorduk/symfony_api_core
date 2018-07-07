<?php namespace Btc\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddAdditionalVariableToEmailTemplate implements FixtureInterface, OrderedFixtureInterface
{
    protected $templates = [
        'user.verification.denied' => <<<EOD
<p>Email to be sent when user verification is denied</p>

Available template variables:
<ul>
<li><strong>{{ reasonDeclined }}</strong> - Reason why verification was declined </li>
</ul>
EOD
    ];

    protected $templateBody = [
        'user.verification.denied' => <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exmarkets</title>
</head>

<body >
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" >
  <tr>
    <td style="padding:20px 0;">
    	<table width="600" align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 20px; background: #fff; border: 1px #dddddd solid;" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" style="padding:5px 20px 5px 20px;">

<p>This is an automated message. Please do not reply to this e-mail!</p>
<p>
Dear {{user.username}}, <br />
Your verification request has been denied:
"{{ reasonDeclined }}"
</p>
<p>
What should you do now? <br />
1) Check that all of the documents you submitted are entirely visible and are in latin letters <br />
2) Re-submit your verification request <br />
3) Wait for approval <br />
4) In case you got denied again please submit a ticket at our support center at: support.exmarkets.com <br />
</p>
<p>Sincerely,<br />
Exmarkets</p>
        </td>
          </tr>
          <tr>
          	<td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; color:#777; padding: 15px 20px;">
             Copyrights © Exmarkets
            </td>
            <td style="border-top: 1px #ededed solid; text-transform: uppercase; font-size: 11px; text-align: center; color:#777; padding: 15px 20px; text-align: right;"><a style="text-decoration: none; color:#777;" href="https://exmarkets.com">exmarkets.com</a></td>
          </tr>
        </table>
    </td>
  </tr>
</table>

</body>
</html>
EOD
    ];

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 100;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        foreach ($this->templates as $template => $description) {
            $email = $manager->getRepository('BtcCoreBundle:EmailTemplate')
                ->findOneBy(['name' => $template]);
            $email->setDescription($description);
            $email->setBody($this->templateBody[$template]);
            $manager->persist($email);
        }
        $manager->flush();
    }
}
