<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Bank;
use Btc\CoreBundle\Entity\Deposit\Deposit;
use Btc\CoreBundle\Entity\Transfer;
use Btc\CoreBundle\Entity\Wallet;
use Btc\CoreBundle\Entity\Withdraw\Withdraw;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWithdrawHistoryData implements FixtureInterface, OrderedFixtureInterface
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
            $withdraw = new Withdraw();
            $withdraw->setBank($banks[array_rand($banks)]);
            $withdraw->setWallet($wallets[array_rand($wallets)]);
            $withdraw->setStatus($this->statuses[array_rand($this->statuses)]);
            $withdraw->setCreatedAt(new \DateTime());
            $withdraw->setUpdatedAt(new \DateTime());
            $withdraw->setAmount(rand(0, 1000));
            $withdraw->setFeeAmount(rand(0, 1000));
            $manager->persist($withdraw);
        }

        $manager->flush();
    }
}
