<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateUnitPriceMarginSlug implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 31; // later than original settings
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $bidName = 'Bid Unit Price Margin';
        $askName = 'Ask Unit Price Margin';
        $bidSlug = 'bid-unit-price-margin';
        $askSlug = 'ask-unit-price-margin';
        $bidSettings = $manager->getRepository('BtcCoreBundle:Settings')->findBy([
            'name' => $bidName
        ]);
        $askSettings = $manager->getRepository('BtcCoreBundle:Settings')->findBy([
            'name' => $askName
        ]);
        foreach ($bidSettings as $setting) {
            $setting->setSlug($bidSlug);
            $manager->persist($setting);
        }
        foreach ($askSettings as $setting) {
            $setting->setSlug($askSlug);
            $manager->persist($setting);
        }
        $manager->flush();
    }
}
