<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Market;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PrecisionSettings implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 105;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($manager->getRepository('BtcCoreBundle:Market')->findAll() as $market) {
            switch ($market->getSlug()) {
                //fiat markets
                case 'btc-usd':
                case 'btc-eur':
                case 'ltc-usd':
                case 'ltc-eur':
                case 'eth-usd':
                case 'eth-eur':
                case 'bnk-usd':
                case 'bnk-eur':
                    $market->setBasePrecision(8);
                    $market->setQuotePrecision(2);
                    $market->setPricePrecision(5);
                    break;
                //crypt markets
                case 'ltc-btc':
                case 'eth-btc':
                case 'eth-ltc':
                case 'eth-bnk':
                case 'bnk-btc':
                case 'bnk-ltc':
                    $market->setBasePrecision(8);
                    $market->setQuotePrecision(8);
                    $market->setPricePrecision(5);
                    break;
            }
            $manager->persist($market);
        }
        $manager->flush();
    }
}


