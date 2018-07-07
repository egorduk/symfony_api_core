<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Market;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMarketData implements FixtureInterface, OrderedFixtureInterface
{
    private $markets = [
        // curr vsCurr   name    internal slug
        ['BTC', 'USD', 'BTC-USD', false, 'btc-usd'],
        ['BTC', 'EUR', 'BTC-EUR', false, 'btc-eur'],

        ['LTC', 'USD', 'LTC-USD', false, 'ltc-usd'],
        ['LTC', 'EUR', 'LTC-EUR', false, 'ltc-eur'],

        ['ETH', 'EUR', 'ETH-EUR', false, 'eth-eur'],
        ['ETH', 'USD', 'ETH-USD', false, 'eth-usd'],

        ['BNK', 'EUR', 'BNK-EUR', false, 'bnk-eur'],
        ['BNK', 'USD', 'BNK-USD', false, 'bnk-usd'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15; // low priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $currencyRepo = $manager->getRepository('Btc\CoreBundle\Entity\Currency');

        foreach ($this->markets as $data) {
            list($currency, $withCurrency, $name, $internal, $slug) = $data;
            $market = new Market;
            $market
                ->setName($name)
                ->setCurrency($currencyRepo->findOneByCode($currency))
                ->setWithCurrency($currencyRepo->findOneByCode($withCurrency))
                ->setInternal($internal)
                ->setSlug($slug)
                ->setBasePrecision(0)
                ->setQuotePrecision(0)
                ->setPricePrecision(0);

            $manager->persist($market);
        }

        $manager->flush();
    }
}
