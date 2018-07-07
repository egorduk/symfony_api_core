<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Bank;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class AddBankPaymentMethods implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var array banks
     */
    private $updateBanks = [
        //name            payment method
        ['EgoPay',        'e-currency'],
        ['Payza',         'e-currency'],
        ['OKPay',         'e-currency'],
        ['Perfect Money', 'e-currency'],
        ['BTC',           'virtual-currency'],
        ['LTC',           'virtual-currency'],
        ['ETH',           'virtual-currency'],
        ['BNK',           'virtual-currency'],
    ];

    private $newBanks = [
        //name                          slug                           fiat  method
        ['AstroPay',                    'astropay',                    true, 'deposit-only']
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $bankRepo = $manager->getRepository('BtcCoreBundle:Bank');

        foreach ($this->updateBanks as $data) {
            list($name, $method) = $data;
            $bank = $bankRepo->findOneBy(['name' => $name]);
            $bank->setPaymentMethod($method);
            $manager->persist($bank);
        }

        foreach ($this->newBanks as $data) {
            list($name, $slug, $isFiat, $method) = $data;
            $bank = new Bank();
            $bank->setName($name);
            $bank->setFiat($isFiat);
            $bank->setSlug($slug);
            $bank->setPaymentMethod($method);
            $manager->persist($bank);
        }

        $manager->flush();
    }
}
