<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Btc\CoreBundle\Entity\Settings;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RenameSettingsData implements FixtureInterface, OrderedFixtureInterface
{
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
        $cryptoWithdrawal = $manager->getRepository('BtcCoreBundle:Settings')->findOneBySlug('maintenance-crypto-withdrawals');
        $cryptoWithdrawal->setName('Crypto withdrawals maintenance');
        $manager->persist($cryptoWithdrawal);
        $manager->flush();
    }
}
