<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMinOrderAmountSettingsData implements FixtureInterface, OrderedFixtureInterface
{
    private $settings = [
        // slug             name                value       description
        ['btc-min-order-amount', 'Min BTC order amount', '0.01', 'A float value for minimum BTC order amount'],
        ['ltc-min-order-amount', 'Min LTC order amount', '1', 'A float value for minimum LTC order amount'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 0;
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

