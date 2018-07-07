<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateRevaluationSettings implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 30; // later than original settings
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $slug = 'unit-price-margin';
        $value = 5;
        $settings = $manager->getRepository('BtcCoreBundle:Settings')->findBy(compact('slug'));
        foreach ($settings as $setting) {
            $setting->setValue($value);
            $manager->persist($setting);
        }
        $manager->flush();
    }
}
