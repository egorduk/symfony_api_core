<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Btc\CoreBundle\Entity\FeeSet;
use Btc\CoreBundle\Entity\FeeAction;
use Btc\CoreBundle\Entity\Fee;

class DecreaseVolumeBasedFees implements FixtureInterface, OrderedFixtureInterface
{
    private $feeSets = [
        //name          fee percent
        ['Volume Based', 0.2],
        ['Starter',      0.2],
        ['Trader',       0.18],
        ['Enterprise',   0.15],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 21; // low priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $feeSetRepo = $manager->getRepository('Btc\CoreBundle\Entity\FeeSet');
        foreach ($this->feeSets as $set) {
            list($name, $feeValue) = $set;
            $feeSet = $feeSetRepo->findOneBy(['name' => $name]);
            foreach ($feeSet->getFees() as $fee) {
                $fee->setPercent($feeValue);
            }

            $manager->persist($feeSet);
            $manager->flush();
        }
    }
}
