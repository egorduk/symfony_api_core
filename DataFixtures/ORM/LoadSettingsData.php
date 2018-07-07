<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSettingsData implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug             name                value       description
        ['default-market', 'Default Market', 'BTC-USD', 'This is the default market'],
        ['maintenance-global', "Global maintenance mode", '0', 'Switch ON or OFF global maintenance mode'],
        ['maintenance-registration', "Registration maintenance", '0', "Switch ON or OFF registration maintenance mode"],
        ['maintenance-login', "Login maintenance", '0', "Switch ON or OFF login maintenance mode"],
        ['maintenance-trading', "Trade maintenance", '0', "Switch ON or OFF trading maintenance mode. Stops order placement for all markets."],
        //['maintenance-message', "Maintenance message", 'The service is currently shutdown for maintenance. Please try later.', "Message for maintenance mode."],
    ];

    private $marketSettings = [
        // slug             name             value     description
        ['revaluation-delay', 'Revaluation delay', '600', 'Revaluation delay in seconds'],
        ['unit-price-margin', 'Bid Unit Price Margin', '20', 'The margin for buy order revaluation'],
        ['unit-price-margin', 'Ask Unit Price Margin', '20', 'The margin for sell order revaluation'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // low priority
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
        $markets = $manager->getRepository('BtcCoreBundle:Market')->findAll();
        foreach ($markets as $market) {
            $this->loadMarketSettings($market, $manager);
        }
        $manager->flush();
    }

    public function loadMarketSettings(Market $market, ObjectManager $manager)
    {
        foreach ($this->marketSettings as $data) {
            list($slug, $name, $value, $description) = $data;
            $settings = new Settings;
            $settings
                ->setMarket($market)
                ->setSlug($slug)
                ->setName($name)
                ->setValue($value)
                ->setDescription($description);

            $manager->persist($settings);
        }
    }
}
