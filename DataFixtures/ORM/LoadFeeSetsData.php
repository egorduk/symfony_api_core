<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Btc\CoreBundle\Entity\FeeSet;
use Btc\CoreBundle\Entity\FeeAction;
use Btc\CoreBundle\Entity\Fee;

class LoadFeeSetsData implements FixtureInterface, OrderedFixtureInterface
{
    private $feeSets = [
        //name   default    type                       rule(amount)      fee type,  fee value   parent set
        ['Volume Based',  1,           FeeSet::TYPE_STANDARD,       null, 'percent', 0.3, null],
        ['Starter',  0,           FeeSet::TYPE_VOLUME_BASED,       0, 'percent', 0.3, 'Volume Based'],
        ['Trader', 0,             FeeSet::TYPE_VOLUME_BASED, 50000, 'percent', 0.25, 'Volume Based'],
        ['Enterprise', 0,         FeeSet::TYPE_VOLUME_BASED, 300000, 'percent', 0.2, 'Volume Based'],
        ['Volume Based (50%)', 0,      FeeSet::TYPE_STANDARD,       null, 'percent', 0.15, null],
        ['Starter (50%)', 0,      FeeSet::TYPE_VOLUME_BASED,       0, 'percent', 0.15, 'Volume Based (50%)'],
        ['Trader (50%)', 0,       FeeSet::TYPE_VOLUME_BASED, 50000, 'percent', 0.125, 'Volume Based (50%)'],
        ['Enterprise (50%)', 0,   FeeSet::TYPE_VOLUME_BASED, 300000, 'percent', 0.1, 'Volume Based (50%)'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20; // low priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $feeSetRepo = $manager->getRepository('Btc\CoreBundle\Entity\FeeSet');
        $marketRepo = $manager->getRepository('Btc\CoreBundle\Entity\Market');
        $markets = $marketRepo->findAll();
        $feeActionRepo = $manager->getRepository('Btc\CoreBundle\Entity\FeeAction');
        $feeActions = $feeActionRepo->findAll();

        foreach ($this->feeSets as $set) {
            list($name, $default, $type, $rule, $feeType, $feeValue, $parent) = $set;
            $feeSet = new FeeSet;
            $feeSet->setName($name);
            $feeSet->setType($type);
            $feeSet->setDefault($default);

            if ($rule !== null) {
                $feeSet->setRule($rule);
            }

            if ($parent) {
                $parentFeeSet = $feeSetRepo->findOneBy(['name' => $parent]);
                $feeSet->setParentFeeSet($parentFeeSet);
            }

            $manager->persist($feeSet);

            foreach ($feeActions as $feeAction) {
                if ($feeAction->isForMarket()) {
                    foreach ($markets as $market) {
                        $fee = new Fee;
                        $fee->setFeeAction($feeAction);
                        $fee->setMarket($market);
                        $fee->setFeeSet($feeSet);
                        $this->setFeeAmounts($fee, $feeType, $feeValue);

                        $manager->persist($fee);
                    }
                } else {
                    $fee = new Fee;
                    $fee->setFeeAction($feeAction);
                    $fee->setFeeSet($feeSet);
                    $this->setFeeAmounts($fee, $feeType, $feeValue);

                    $manager->persist($fee);
                }
            }

            $manager->flush();
        }
    }

    /**
     * @param Fee $fee
     * @param string $feeType percent or fixed
     * @param float $feeValue
     */
    private function setFeeAmounts(Fee $fee, $feeType, $feeValue)
    {
        if ($feeType == 'percent') {
            $fee->setPercent($feeValue);
            $fee->setFixed(0);
        } else {
            $fee->setFixed($feeValue);
            $fee->setPercent(0);
        }
    }
}
