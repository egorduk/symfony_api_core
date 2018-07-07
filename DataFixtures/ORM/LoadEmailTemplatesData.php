<?php namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEmailTemplatesData implements FixtureInterface, OrderedFixtureInterface
{
    private $templates = [
        // template name, template description, subject, body
        [
            'user.register',
            '<p>Email is sent when user registers to the system, we should send him a username and password. </p>

Available template variables:
<ul>
<li><strong>{{ user.username }}</strong> - freshly created username for user </li>
<li><strong>{{ user.plainPassword }}</strong> - random generated password for user</li>
</ul>',
            'Your credentials',
            'Congratulations, you have successfully opened an account. Below are your login credentials:
            Client ID: {{ user.username }}
            Password:  {{ user.plainPassword }}'],

        ['user.reset_request',
            '<p>Email is sent when user requests password reset. Email should be sent with a link which points where to go to reset the password.</p>

Available variables:
<ul>
 <li><strong>{{ user.username }}</strong> - the username of user</li>
 <li><strong>{{ confirmationUrl }}</strong> - the url where user has to click to confirm the reset</li>
</ul>
',
            'Password reset requested',
            "Hello {{ user.username }}!

To reset your password - please visit {{ confirmationUrl }}

Regards,
the Team."
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
