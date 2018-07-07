<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Market;

use Btc\CoreBundle\Entity\Fee;
use Btc\CoreBundle\Entity\Market;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CreateLtcBtc implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createCryptoMarket($manager, 'LTC', 'BTC', false);

        $this->createCryptoMarket($manager, 'ETH', 'BTC');
        $this->createCryptoMarket($manager, 'ETH', 'LTC');
        $this->createCryptoMarket($manager, 'ETH', 'BNK');

        $this->createCryptoMarket($manager, 'BNK', 'BTC');
        $this->createCryptoMarket($manager, 'BNK', 'LTC');
    }

    private function createCryptoMarket($manager, $codeFrom, $codeTo, $isInternal = false)
    {
        $market = new Market();
        $market->setWithCurrency($manager->getRepository('BtcCoreBundle:Currency')->findOneBy(['code' => $codeTo]));
        $market->setCurrency($manager->getRepository('BtcCoreBundle:Currency')->findOneBy(['code' => $codeFrom]));
        $name = $codeFrom . '-' . $codeTo;
        $market->setSlug(strtolower($name));
        $market->setName($name);
        $market->setInternal($isInternal);
        $market->setBasePrecision(0);
        $market->setQuotePrecision(0);
        $market->setPricePrecision(0);
        $manager->persist($market);

        $feeSets = $manager->getRepository('BtcCoreBundle:FeeSet')->findAll();
        $feeActions = $manager->getRepository('BtcCoreBundle:FeeAction')->findAll();

        foreach ($feeSets as $feeSet) {
            foreach ($feeActions as $feeAction) {
                $fee = new Fee();
                $fee->setFeeAction($feeAction);
                $fee->setFeeSet($feeSet);
                $fee->setFixed(0);
                $fee->setMarket($market);
                $fee->setPercent(0.03);
                $manager->persist($fee);
            }
        }
        $manager->flush();
    }
}


