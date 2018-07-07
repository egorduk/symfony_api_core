<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreateMoreAdminUsers implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    private $admins = [
        'Q999998' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin7@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => 'P66HXRV7ZN4GFYA5HXUONJTNNHP2ILXF',
        ],
        'Q999999' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin8@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => '5UPIUACCUDEVD2I7WLOS5M3ISI6DJG5V',
        ],
        'Q999990' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin9@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => '5CDCDVLVPXC7YYGE66ZMJJRMIAGDTAQS',
        ]
    ];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 25; // low priority, countries and feesets need to be set
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // @TODO: wallet service and encoder should be moved to core bundle
        $country = $manager->getRepository("Btc\CoreBundle\Entity\Country")->findOneByName('LITHUANIA');
        foreach ($this->admins as $username => $props) {
            extract($props);
            $admin = new User;
            $admin->setUsername($username);
            $admin->setEmail($email);
            $admin->setPlainPassword($plainPassword);
            //$admin->setCountry($country);
            //$admin->setFirstname($firstname);
            //$admin->setLastname($lastname);
            $admin->setRoles($roles);
            $admin->setAuthKey($authKey);

            $encoder = $this->container->get('security.encoder_factory')->getEncoder($admin);
            $admin->setPassword($encoder->encodePassword($admin->getPlainPassword(), $admin->getSalt()));
            $this->container->get('core.user_registration_service')->createWallets($manager, $admin);
            $this->container->get('core.user_registration_service')->assignDefaultPlans($admin);

            $manager->persist($admin);
        }
        $manager->flush();
    }
}
