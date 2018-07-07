<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChangeUserBlockEmailTemplate implements FixtureInterface, OrderedFixtureInterface
{
    private $template = [
<<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear {{user.username}},

Your account has been suspended for the following reason:

            {{ blockReason }}

For more information please submit a ticket at [support.exmarkets.com](http://support.exmarkets.com)

Sincerely,

Exmarkets
EOD
            ,
            <<<EOD
<p>Email to be sent when user account is suspended</p>
Available template variables:
<ul>
    <li>
        <strong>{{ blockReason }}</strong> - reason user was blocked
    </li>
</ul>
EOD
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 105; // templates need to be loaded first
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        list($body, $desc) = $this->template;

        $email = $manager->getRepository('BtcCoreBundle:EmailTemplate')
            ->findOneBy(['name' => 'user.suspended']);
        $email->setBody($body);
        $email->setDescription($desc);

        $manager->persist($email);

        $manager->flush();
    }
}
