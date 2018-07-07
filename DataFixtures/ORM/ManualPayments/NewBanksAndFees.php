<?php

namespace Btc\CoreBundle\DataFixtures\ORM\ManualPayments;

use Btc\CoreBundle\Entity\Bank;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NewBanksAndFees implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 110;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $bankRepository = $manager->getRepository('BtcCoreBundle:Bank');

        $this->updateBankAvailableSettings($bankRepository, $manager);
        $manager->flush();

        list($usd, $eur) = $this->getUsdEurCurrencies($manager);
        $currencies = [$usd, $eur];

        $banks = [
            'paypal' => [
                'name' => 'PayPal',
                'slug' => 'paypal',
                'fiat' => 1,
                'payment_method' => 'manual',
                'deposit_available' => 1,
                'withdrawal_available' => 1,
                'fee' => [
                    'name' => 'Withdrawal',
                    'percent' => '3.5',
                    'currencies' => $currencies
                ]
            ],
            'moneygram' => [
                'name' => 'MoneyGram',
                'slug' => 'moneygram',
                'fiat' => 1,
                'payment_method' => 'manual',
                'deposit_available' => 1,
                'withdrawal_available' => 1,
                'fee' => [
                    'name' => 'Withdrawal',
                    'percent' => '3.5',
                    'currencies' => $currencies
                ]
            ],
            'westernunion' => [
                'name' => 'Western Union',
                'slug' => 'westernunion',
                'fiat' => 1,
                'payment_method' => 'manual',
                'deposit_available' => 1,
                'withdrawal_available' => 1,
                'fee' => [
                    'name' => 'Withdrawal',
                    'percent' => '3.5',
                    'currencies' => $currencies
                ]
            ]
        ];

        $this->persistNewBanks($manager, $banks);
        $manager->flush();
    }

    /**
     * @param $bankRepository
     * @return mixed
     */
    private function updateBankAvailableSettings($bankRepository, $manager)
    {
        foreach ($bankRepository->findAll() as $bank) {
            if ($bank->getSlug() == 'astropay') {
                $bank->setDepositAvailable();
                continue;
            }

            $bank->setDepositAvailable();
            $bank->setWithdrawalAvailable();

            $manager->persist($bank);
        }
    }

    /**
     * @param ObjectManager $manager
     * @return array
     */
    private function getUsdEurCurrencies(ObjectManager $manager)
    {
        $currencyRepository = $manager->getRepository('BtcCoreBundle:Currency');
        $usd = $currencyRepository->findOneByCode('USD');
        $eur = $currencyRepository->findOneByCode('EUR');

        return array($usd, $eur);
    }

    /**
     * @param ObjectManager $manager
     * @param $banks
     * @return mixed
     */
    private function persistNewBanks(ObjectManager $manager, $banks)
    {
        foreach ($banks as $bank) {
            $b = new Bank();
            $b->setName($bank['name']);
            $b->setSlug($bank['slug']);
            $b->setFiat(true);
            $b->setPaymentMethod('manual');
            $b->setDepositAvailable();
            $b->setWithdrawalAvailable();
            $manager->persist($b);
        }
    }
}


