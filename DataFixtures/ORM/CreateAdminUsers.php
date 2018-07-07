<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Btc\CoreBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreateAdminUsers implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    private $admins = [
        'Q999991' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin1@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => 'SWDN2INCLFPIH6FC4ETIRXVHYUN6L5GV',
        ],
        'Q999992' => [
            'firstname' => 'DATA-DOG',
            'lastname' => 'Admin',
            'email' => 'datadog@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => '5YOXBNWL7OQSE74QKWJZRH3GB4EQJBPB',
        ],
        'Q999993' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin2@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => '3JCZOTHF7K5KB22PTJW7LS6JLZ76IUKY',
        ],
        'Q999994' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin3@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => '5ZVZFNPSQNXWPGCTXC4LYKDAHKURR46L',
        ],
        'Q999995' => [
            'firstname' => 'User',
            'lastname' => 'Admin',
            'email' => 'admin4@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'V1rt3xTradeM4nager',
            'authKey' => 'UTXYTI7U2OMRT7DDLQZP6UXKJ5NC3CHO',
        ],
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
