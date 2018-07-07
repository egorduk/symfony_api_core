<?php namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\Bank;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AddWireTransferBank implements FixtureInterface, OrderedFixtureInterface
{
    private $newBanks = [
        //name                          slug                           fiat  method
        ['Wire Transfer',               'international-wire-transfer',                    true, 'wire']
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
