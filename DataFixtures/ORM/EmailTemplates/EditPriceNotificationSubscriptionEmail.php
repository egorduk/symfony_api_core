<?php

namespace Btc\CoreBundle\DataFixtures\ORM\EmailTemplates;

use Btc\CoreBundle\Entity\EmailTemplate;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EditPriceNotificationSubscriptionEmail implements FixtureInterface, OrderedFixtureInterface {

    private $template = [
        // template name, new body
            'price_notification.subscribed',
            <<<EOD
            <p>Email to be sent when user subscribes for price notification.</p>
            Available template variables:<ul>
            <li><strong>{{ .Market }}</strong> - market </li>
            <li><strong>{{ .Price }}</strong> - price </li>
            <li><strong>{{ .Hash }}</strong> - unique hash </li>
            </ul>
EOD
        ,
            <<<EOD
<h3><strong>Greetings from Exmarkets!</strong></h3>
<p>You have successfully subscribed to be notified when the price in {{ .Market }} market reaches {{ .Price }} per unit. </p>
<p>If you would like to unsubscribe from this notification <a href="https://exmarkets.com/unsubscribe/price-notification/{{ .Hash }}">click here </a></p>
<p>Sincerely,<br/>
Exmarkets</p>
EOD
    ];


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 105;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        list($name, $description, $body) = $this->template;

        $email = $manager->getRepository('BtcCoreBundle:EmailTemplate')
            ->findOneBy(['name' => $name]);
        $email->setDescription($description);
        $email->setBody($body);

        $manager->persist($email);
        $manager->flush();
    }
}
