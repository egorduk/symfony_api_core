<?php

namespace Btc\CoreBundle\DataFixtures\ORM\EmailTemplates;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddWithdrawalNotificationEmailTemplate implements FixtureInterface, OrderedFixtureInterface
{
    private $template =
        // template name, template description, subject, body
        [
            'withdrawal.notification',
            '<p>Available template variables:</p>
<ul>
<li><strong>{{ withdrawal.amount }}</strong> - amount </li>
<li><strong>{{ currency.code }}</strong> - currency </li>
<li><strong>{{ bank.name }}</strong> - bank </li>
</ul>',
            'Withdrawal was submitted',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Withdrawal was submitted:

            Amount: {{ withdrawal.amount }}

            Currency:  {{ currency.code }}

            Bank: {{ bank.name }}

Sincerely,

Exmarkets
EOD
        ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // very high priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        list($name, $description, $subject, $body) = $this->template;

        $email = new EmailTemplate();
        $email->setName($name);
        $email->setDescription($description);
        $email->setSubject($subject);
        $email->setBody($body);

        $manager->persist($email);
        $manager->flush();
    }
}
