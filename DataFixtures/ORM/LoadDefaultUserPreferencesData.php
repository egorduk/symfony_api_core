<?php

namespace DataFixtures\ORM;

use Btc\CoreBundle\Entity\Preference;
use Btc\CoreBundle\Entity\UserPreference;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadDefaultUserPreferencesData implements FixtureInterface, OrderedFixtureInterface
{
    private $preference =
        //            name                                      slug
        ['Different IP email notification', 'preference.email_ip_notification'];
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 30;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        list($name, $slug) = $this->preference;

        $preference = new Preference();
        $preference->setSlug($slug);
        $preference->setName($name);

        $users = $manager->getRepository('BtcCoreBundle:User')->findAll();

        foreach ($users as $user)
        {
            $ipPreference = new UserPreference();
            $ipPreference->setPreference($preference);
            $ipPreference->setUser($user);
            $ipPreference->setValue(1);

            $manager->persist($ipPreference);
        }

        $manager->flush();
    }
}
