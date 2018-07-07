<?php

namespace Btc\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Btc\CoreBundle\Entity\Country;

class LoadAdditionalCountryData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 40;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $countries = $manager->getRepository("Btc\CoreBundle\Entity\Country")->findAll();
        foreach ($countries as $country) {
            $country->setRestricted(false);
            $country->setHidden(false);

            $manager->persist($country);
        }
        $manager->flush();
    }
}
