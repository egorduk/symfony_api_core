<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdditionalSettingsData implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug             name                value       description
        ['maintenance-fiat-deposits', 'Fiat deposits maintenance', '0', 'Switch ON or OFF fiat currency deposits maintenance'],
        ['maintenance-crypto-deposits', 'Crypto deposits maintenance', '0', 'Switch ON or OFF crypto currency deposits maintenance'],
        ['maintenance-fiat-withdrawals', 'Fiat withdrawals maintenance', '0', 'Switch ON or OFF fiat currency withdrawals maintenance'],
        ['maintenance-crypto-withdrawals', 'Crypto withdrawals maintenance', '0', 'Switch ON or OFF crypto currency withdrawals maintenance'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
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
