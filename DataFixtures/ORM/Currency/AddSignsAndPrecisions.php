<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Currency;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddSignsAndPrecisions implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($manager->getRepository('BtcCoreBundle:Currency')->findAll() as $currency) {
            switch ($currency->getCode()) {
                case 'BTC':
                    $currency->setSign('฿');
                    $currency->setPrecision(8);
                    break;
                case 'LTC':
                    $currency->setSign('Ł');
                    $currency->setPrecision(8);
                    break;
                case 'USD':
                    $currency->setSign('$');
                    $currency->setPrecision(2);
                    break;
                case 'EUR':
                    $currency->setSign('€');
                    $currency->setPrecision(2);
                    break;
                case 'ETH':
                    $currency->setSign('Ξ');
                    $currency->setPrecision(8);
                    break;
                case 'BNK':
                    $currency->setSign('B');
                    $currency->setPrecision(2);
                    break;
            }
            $manager->persist($currency);
        }
        $manager->flush();
    }
}


