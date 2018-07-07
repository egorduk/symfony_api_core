<?php

namespace Btc\CoreBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Btc\CoreBundle\Entity\Country;

class ReturnMoreCountries implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 30;
    }

    private $countries = [
        ['ALGERIA', 'DZ', 'DZA'],
        ['ECUADOR', 'EC', 'ECU'],
        ['ETHIOPIA', 'ET', 'ETH'],
        ['IRAN, ISLAMIC REPUBLIC OF', 'IR', 'IRN'],
        ['KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'KP', 'PRK'],
        ['MYANMAR', 'MM', 'MMR'],
        ['SYRIAN ARAB REPUBLIC', 'SY', 'SYR'],
        ['YEMEN', 'YE', 'YEM']
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->countries as $data) {
            list($name, $iso2, $iso3) = $data;
            $country = new Country;
            $country->setName($name);
            $country->setIso2($iso2);
            $country->setIso3($iso3);

            $manager->persist($country);
        }
        $manager->flush();
    }
}
