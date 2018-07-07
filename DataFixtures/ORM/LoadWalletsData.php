<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Currency;
use Btc\CoreBundle\Entity\MuhhamadWallet;
use Btc\CoreBundle\Entity\Wallet;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWalletsData implements FixtureInterface
{
    private $wallets = [
        'BTC' => [
            'exmarkets-bitcoind_primary' => [0, 1],
            'exmarkets-bitcoind_hot' => 0,
            'exmarkets-bitcoind_testnet_test' => 1,
        ],
        'LTC' => [
            'exmarkets-litecoind_primary' => [0, 1],
            'exmarkets-litecoind_hot' => 0,
        ],
        'ETH' => [
            'exmarkets-ethereum_primary' => [0, 1],
            'exmarkets-ethereum_hot' => 0,
        ],
        'DASH' => [
            'exmarkets-dashd_primary' => [0, 1],
            'exmarkets-dashd_hot' => 0,
        ],
        'BCH' => [
            'exmarkets-bch_primary' => [0, 1],
            'exmarkets-bch_hot' => 0,
            'exmarkets-bch_testnet_test' => 1,
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->wallets as $key => $wallets) {
            $currencyRepository = $manager->getRepository(Currency::class);
            $currency = $currencyRepository->findOneByCode($key);

            if ($currency instanceof Currency) {
                foreach ($wallets as $ind => $wallet) {
                    $muhhamadWallet = new MuhhamadWallet();
                    $muhhamadWallet->setCurrency($currency);

                    $isTest = $wallet;
                    $isCold = 0;

                    if (is_array($wallet)) {
                        $isTest = $wallet[0];
                        $isCold = $wallet[1];
                    }

                    $muhhamadWallet->setIsTest($isTest);
                    $muhhamadWallet->setIsCold($isCold);
                    $muhhamadWallet->setName($ind);
                    $muhhamadWallet->setKeyStore($ind);

                    $manager->persist($muhhamadWallet);
                }
            }
        }

        $manager->flush();
    }
}
