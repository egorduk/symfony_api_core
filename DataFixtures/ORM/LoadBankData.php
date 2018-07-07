<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Bank;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBankData implements FixtureInterface
{
    /**
     * @var array banks
     */
    private $banks = [
        ['EgoPay', 'egopay', true],
        ['Payza', 'payza', true],
        ['OKPay', 'okpay', true],
        ['Perfect Money', 'perfect-money', true],
        ['BTC', 'btc', false],
        ['LTC', 'ltc', false],
        ['ETH', 'eth', false],
        ['BNK', 'bnk', false],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->banks as $data) {
            list($name, $slug, $isFiat) = $data;
            $bank = new Bank();
            $bank->setName($name);
            $bank->setFiat($isFiat);
            $bank->setSlug($slug);
            $manager->persist($bank);
        }

        $manager->flush();
    }
}
