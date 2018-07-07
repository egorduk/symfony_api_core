<?php

namespace DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class RemoveCountries implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10; // banks need to be created first
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /*$norway = $manager->getRepository('BtcCoreBundle:Country')->findOneByName('NORWAY');
        $countries = ['ALGERIA', 'ECUADOR', 'ETHIOPIA', 'INDONESIA', 'IRAN, ISLAMIC REPUBLIC OF',
                     'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'MYANMAR', 'PAKISTAN', 'SYRIAN ARAB REPUBLIC',
                     'TURKEY', 'YEMEN'];
        foreach ($countries as $country) {
            $current = $manager->getRepository('BtcCoreBundle:Country')->findOneByName($country);
            $users = $manager->getRepository('BtcCoreBundle:User')->findBy(['country' => $current]);
            foreach ($users as $user) {
                $user->setCountry($norway);
                $manager->persist($user);
            }
            $businesses =  $manager->getRepository('BtcCoreBundle:UserBusinessInfo')->findBy(['country' => $current]);
            foreach ($businesses as $business) {
                $business->setCountry($norway);
                $manager->persist($business);
            }
            $manager->remove($current);
        }
        $manager->flush();*/
    }
}
