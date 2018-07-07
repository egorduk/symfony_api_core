<?php

namespace DataFixtures\ORM;

use Btc\CoreBundle\Entity\Activity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserActivitiesData implements FixtureInterface, OrderedFixtureInterface
{
    private $activities = [
        'btc_user.security.two_factor_enabled',
        'btc_user.security.two_factor_disabled',
        'btc_user.security.profile_edit_completed',
        'btc_user.security.registration_completed',
        'btc_user.security.login',
        'btc_user.security.limit_buy',
        'btc_user.security.limit_sell',
        'btc_user.security.market_buy',
        'btc_user.security.market_sell',
        'btc_user.security.preferences_updated',
        'btc_user.security.login_custom',
        'btc_user.security.change_password_completed',
    ];

    public function getOrder()
    {
        return 31;
    }

    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository('BtcCoreBundle:User')->findAll();

        foreach ($users as $user)
        {
            $activity = new Activity();
            $activity->setUser($user);
            $activity->setAction($this->activities[array_rand($this->activities)]);
            $activity->setIpAddress(long2ip(mt_rand()));

            $manager->persist($activity);
        }

        $manager->flush();
    }
}
