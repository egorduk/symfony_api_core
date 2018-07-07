<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Settings;

use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PriceMargins implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug                           name                value       description
        ['bfx-bid-price-margin', 'BFX BID price margin', '0.25', 'Bitfinex BID price margin percent'],
        ['bfx-ask-price-margin', 'BFX ASK price margin', '0.25', 'Bitfinex ASK price margin percent'],
        ['krk-bid-price-margin', 'KRK BID price margin', '0.25', 'Kraken BID price margin percent'],
        ['krk-ask-price-margin', 'KRK ASK price margin', '0.25', 'Kraken ASK price margin percent'],
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
        $markets = $manager->getRepository('BtcCoreBundle:Market')->findAll();
        foreach ($markets as $market) {
            foreach ($this->settings as $data) {
                list($slug, $name, $value, $description) = $data;
                $settings = new Settings;
                $settings
                    ->setSlug($slug)
                    ->setMarket($market)
                    ->setName($name)
                    ->setValue($value)
                    ->setDescription($description);

                $manager->persist($settings);
            }
        }
        $manager->flush();
    }
}


