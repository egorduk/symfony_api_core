<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\MuhhamadWallet;
use Btc\CoreBundle\Entity\User;
use Btc\CoreBundle\Entity\UserAddress;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserAddressesData implements FixtureInterface
{
    private $addresses = [
        'exmarkets-bitcoind_testnet_test' => [
            '2N3ieZbo5ZSXsaSVXntPRT69AQVJFk9wAsf',
            '2N44uFQ4886STW2QaMm4rKmy7RoKc1LRLHN',
            '2NDXJVTHNTbteSySknon11Gofkq2bzfx4tM',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->addresses as $key => $address) {
            $muhhamadWalletRepository = $manager->getRepository(MuhhamadWallet::class);
            $muhhamadWallet = $muhhamadWalletRepository->findOneBy(['name' => $key]);
            $userRepository = $manager->getRepository(User::class);
            $user = $userRepository->findByUsernameOrEmail('admin10@exmarkets.com');

            foreach ($address as $adr) {
                if ($muhhamadWallet instanceof MuhhamadWallet) {
                    $userAddress = new UserAddress();
                    $userAddress->setAddress($adr);
                    $userAddress->setIsUsed(1);
                    $userAddress->setMuhhamadWallet($muhhamadWallet);
                    $userAddress->setUser($user);

                    $manager->persist($userAddress);
                }
            }
        }

        $manager->flush();
    }
}
