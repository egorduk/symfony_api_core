<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Btc\CoreBundle\Entity\FeeAction;

class LoadFeeActionsData implements FixtureInterface
{
    private $feeActions = [
        ['Buy', 1],
        ['Sell', 1],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->feeActions as $data) {
            list($name, $forMarket) = $data;
            $action = new FeeAction;
            $action->setName($name);
            $action->setForMarket($forMarket);

            $manager->persist($action);
        }
        $manager->flush();
    }
}
