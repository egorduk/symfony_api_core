<?php

namespace DataFixtures\ORM;

use Btc\CoreBundle\Entity\Preference;
use Btc\CoreBundle\Entity\UserPreference;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadNewsletterPreferenceData implements FixtureInterface, OrderedFixtureInterface
{
    private $preference =
        //            name                                      slug
        ['Newsletter', 'preference.newsletter'];
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
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
            $newsletterPreference = new UserPreference();
            $newsletterPreference->setPreference($preference);
            $newsletterPreference->setUser($user);
            $newsletterPreference->setValue(true);
            $manager->persist($newsletterPreference);
        }
        $manager->flush();
    }
}
