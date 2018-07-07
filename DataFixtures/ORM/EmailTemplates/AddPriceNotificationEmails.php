<?php

namespace Btc\CoreBundle\DataFixtures\ORM\EmailTemplates;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 10/15/14
 * Time: 2:25 PM
 */

class AddPriceNotificationEmails implements FixtureInterface, OrderedFixtureInterface {

    private $templates = [
        // template name, new body
        [
            'price_notification.subscribed',
            <<<EOD
            <p>Email to be sent when user subscribes for price notification.</p>
            Available template variables:<ul>
            <li><strong>{{ .Market }}</strong> - market </li>
            <li><strong>{{ .Price }}</strong> - price </li>
            </ul>
EOD
            ,'Price notification subscription',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear user,

You have successfully subscribed to be notified when price in {{ .Market }} market reaches {{ .Price }} per unit.

Sincerely,

Exmarkets
EOD
        ],
        [
            'price_notification.reached',
            <<<EOD
            <p>Email to be sent when price reaches baseline</p>
            Available template variables:<ul>
            <li><strong>{{ .Market }}</strong> - market </li>
            <li><strong>{{ .Price }}</strong> - price </li>
            </ul>
EOD
            ,'Price notification',
            <<<EOD
This is an automated message. Please do not reply to this e-mail!

Dear user,

We are informing you that price in {{ .Market }} market reached {{ .Price }} per unit.

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
        return 101;
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
