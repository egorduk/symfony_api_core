<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLimitSettingsData implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug             name                value       description
        ['upper-btc-limit', 'BTC hot-wallet upper limit', '50', 'Change BTC hot-wallet upper limit'],
        ['upper-ltc-limit', 'LTC hot-wallet upper limit', '500', 'Change LTC hot-wallet upper limit'],
        ['lower-btc-limit', 'BTC hot-wallet lower limit', '5', 'Change BTC hot-wallet lower limit'],
        ['lower-ltc-limit', 'LTC hot-wallet lower limit', '50', 'Change LTC hot-wallet lower limit'],
        ['notification-email', 'Notifications email address', '', 'You will get notifications to this email address']
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 25;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->settings as $data) {
            list($slug, $name, $value, $description) = $data;
            $settings = new Settings;
            $settings
                ->setSlug($slug)
                ->setName($name)
                ->setValue($value)
                ->setDescription($description);

            $manager->persist($settings);
        }
        $manager->flush();
    }
}
