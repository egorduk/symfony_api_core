<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Settings;

use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddLtcBtcPriceMarginSettings implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug                           name                value       description
        ['bfx-bid-price-margin', 'BFX BID price margin', '0.1', 'Bitfinex BID price margin percent'],
        ['bfx-ask-price-margin', 'BFX ASK price margin', '0.1', 'Bitfinex ASK price margin percent'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 105; // after ltc-btc market is created
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $market = $manager->getRepository('BtcCoreBundle:Market')->findOneBySlug('ltc-btc');
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
        $manager->flush();
    }
}


