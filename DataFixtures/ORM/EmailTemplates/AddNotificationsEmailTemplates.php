<?php

namespace Btc\CoreBundle\DataFixtures\ORM\EmailTemplates;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddNotificationsEmailTemplates implements FixtureInterface, OrderedFixtureInterface
{
    private $templates =[
        // template name, template description, subject, body
        [
            'limit.external',
            '<p>Available template variables:</p>
<ul>
<li><strong>{{ platform }}</strong> - platform </li>
</ul>',
            'Balance is too low',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

{{ platform }} balance is lower than limit.

Sincerely,

Exmarkets
EOD
        ],
        [
            'verification.notification',
            '<p>Available template variables:</p>
<ul>
<li><strong>{{ verification.type }}</strong> - verification type </li>
</ul>',
            'Verification was submitted',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

New {{ verification.type }} verification was submitted:

Sincerely,

Exmarkets
EOD
        ],
        [
            'deposit.notification',
            '<p>Available template variables:</p>
<ul>
<li><strong>{{ deposit.amount }}</strong> - amount </li>
<li><strong>{{ currency.code }}</strong> - currency </li>
<li><strong>{{ bank.name }}</strong> - bank </li>
</ul>',
            'Deposit was submitted',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Deposit was submitted:

            Amount: {{ deposit.amount }}

            Currency:  {{ currency.code }}

            Bank: {{ bank.name }}

Sincerely,

Exmarkets
EOD
        ]
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 110;
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
            $manager->flush();
        }
    }
}
