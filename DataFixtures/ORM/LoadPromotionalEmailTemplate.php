<?php namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPromotionalEmailTemplate implements FixtureInterface, OrderedFixtureInterface
{
    private $templates = [
        // template name, template description, subject, body
        [
            'promotional.email',
            '<p>Email with a registration link for subscribers, who will get 50% off trading fees.</p>

Available template variables:
<ul>
<li><strong>{{ registrationLink }}</strong> - registration link </li>
</ul>',
            'Promotional registration link at Exmarkets',
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
Dear user,</p>

<p>You have subscribed to our newsletter, so you are entitled for 50% off trading fees for 3 months.</p>
<p>To register and get 50% off trading fees, please follow this link: {{ registrationLink }}</p>

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
        return 0; // very high priority
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

