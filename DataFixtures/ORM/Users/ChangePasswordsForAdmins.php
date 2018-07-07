<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Users;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChangePasswordsForAdmins implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    private $admins = [
        'Q999991',
        'Q999993',
        'Q999994',
        'Q999995',
        'Q999996',
        'Q999997',
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
        return 30;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $qb = $manager->createQueryBuilder();
        $admins = $qb->select('u')
            ->from('BtcCoreBundle:User', 'u')
            ->where($qb->expr()->in('u.username', $this->admins))
            ->getQuery()
            ->getResult();

        foreach ($admins as $admin) {
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($admin);
            $admin->setPassword($encoder->encodePassword('PXj^uu.A7STq,Rr?u3uX4_<y', $admin->getSalt()));
            $manager->persist($admin);
        }
        $manager->flush();
    }
}
