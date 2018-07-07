<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Users;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChangeTwoFactorForAdmins implements FixtureInterface, OrderedFixtureInterface
{
    private $admins = [
        'Q999991' => 'OGJ44JT5CSBZWBLMZ3LZDQBCAF77FFH2',
        'Q999993' => 'U7YXRMXCDVOHTVFPDJ2WPWXD26LYQAST',
        'Q999994' => 'U6HZDHEUX6HXBUGZ3CDKA6BP4UCCGR6X',
        'Q999995' => 'SA7P3EWHQUCEOWHKCPSR3CFLCHYVR5AQ',
        'Q999996' => '55RJ6F7ADKT5F74AOBYDJF6DN6VKOO3K',
        'Q999997' => 'S2O5WBVG2SAPEC3SIB3VI2DRJG5ZWW62',
    ];

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
        $qb = $manager->createQueryBuilder();
        $admins = $qb->select('u')
            ->from('BtcCoreBundle:User', 'u')
            ->where($qb->expr()->in('u.username', array_keys($this->admins)))
            ->getQuery()
            ->getResult();

        foreach ($admins as $admin) {
            $admin->setAuthKey($this->admins[$admin->getUsername()]);
            $manager->persist($admin);
        }
        $manager->flush();
    }
}
