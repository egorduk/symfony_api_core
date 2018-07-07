<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Bank;
use Btc\CoreBundle\Entity\Deposit\Deposit;
use Btc\CoreBundle\Entity\Transfer;
use Btc\CoreBundle\Entity\Wallet;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDepositHistoryData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 30;
    }

    private $statuses = [
        Transfer::STATUS_NEW,
    ];

    public function load(ObjectManager $manager)
    {
        $banks = $manager->getRepository(Bank::class)->findAll();
        $wallets = $manager->getRepository(Wallet::class)->findAll();

        for($i = 0; $i < 50; $i++) {
            $deposit = new Deposit();
            $deposit->setBank($banks[array_rand($banks)]);
            $deposit->setWallet($wallets[array_rand($wallets)]);
            $deposit->setStatus($this->statuses[array_rand($this->statuses)]);
            $deposit->setCreatedAt(new \DateTime());
            $deposit->setUpdatedAt(new \DateTime());
            $deposit->setAmount(rand(0, 1000));
            $deposit->setFeeAmount(rand(0, 1000));
            $manager->persist($deposit);
        }

        $manager->flush();
    }
}
