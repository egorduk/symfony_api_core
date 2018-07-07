<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Settings;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RemoveRevaluationSettings implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 40;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager
            ->createQuery("DELETE BtcCoreBundle:Settings s WHERE s.slug IN (?1, ?2, ?3)")
            ->setParameter(1, "revaluation-delay")
            ->setParameter(2, "bid-unit-price-margin")
            ->setParameter(3, "ask-unit-price-margin")
            ->execute();
    }
}


