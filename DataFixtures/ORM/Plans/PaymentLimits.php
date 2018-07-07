<?php

namespace Btc\CoreBundle\DataFixtures\ORM\Plans;

use Btc\CoreBundle\Entity\Plan\Payment\LimitDeposit;
use Btc\CoreBundle\Entity\Plan\Payment\LimitPlan;
use Btc\CoreBundle\Entity\Plan\Payment\LimitAssignment;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PaymentLimits implements FixtureInterface, OrderedFixtureInterface
{
    private $plans = [
        'Unverified' => [
            'custom' => false,
            'expires' => '', // unlimited
            'weight' => 0, // very low, since it is a standard plan
            'deposit_limits' => [
                'USD' => [
                    'daily' => '10000',
                    'weekly' => '50000',
                    'monthly' => '100000',
                ],
                'EUR' => [
                    'daily' => '10000',
                    'weekly' => '50000',
                    'monthly' => '100000',
                ],
            ],
            'withdrawal_limits' => [
                'USD' => [
                    'daily' => '10000',
                    'weekly' => '50000',
                    'monthly' => '100000',
                ],
                'EUR' => [
                    'daily' => '10000',
                    'weekly' => '50000',
                    'monthly' => '100000',
                ],
                'BTC' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'LTC' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'ETH' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'BNK' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
            ],
        ],

        'Verified Personal' => [
            'custom' => false,
            'expires' => '', // unlimited
            'weight' => 0, // very low, since it is a standard plan
            'deposit_limits' => [
                 'USD' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'EUR' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
            ],
            'withdrawal_limits' => [
                'USD' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'EUR' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'BTC' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'LTC' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'ETH' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'BNK' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
            ],
        ],

        'Verified Business' => [
            'custom' => false,
            'expires' => '', // unlimited
            'weight' => 0, // very low, since it is a standard plan
            'deposit_limits' => [
                 'USD' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'EUR' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
            ],
            'withdrawal_limits' => [
                'USD' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'EUR' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'BTC' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'LTC' => [
                    'daily' => 0,
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'ETH' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
                'BNK' => [
                    'daily' => '0',
                    'weekly' => '0',
                    'monthly' => '0',
                ],
            ],
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 21; // after fee sets and currencies are loaded
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $currencies = $manager->getRepository('BtcCoreBundle:Currency')->findAll();
        foreach ($this->plans as $name => $entry) {
            // create a plan
            $plan = new LimitPlan();
            $plan->setWeight($entry['weight']);
            $plan->setName($name);
            $plan->setCustom($entry['custom']);

            if ($entry['expires']) {
                list($duration, $unit) = explode(' ', $entry['expires']);
                $plan->setDuration(intval($duration));
                $plan->setDurationUnit($unit);
            }

            $manager->persist($plan);

            // overwrire plan list
            $this->plans[$name] = $plan;
        }
        $manager->flush();

        // keep only plan ids, since we will clear entity manager on batches
        $ids = [];
        foreach ($this->plans as $plan) {
            $ids[$plan->getName()] = $plan->getId();
        }
        $this->plans = $ids;

        // update all user plans
        $count = $manager->createQuery('SELECT COUNT(u) FROM Btc\CoreBundle\Entity\User u')->getSingleScalarResult();
        $batchSize = 500;
        $tail = $count % $batchSize;
        $numBatches = ($count - $tail) / $batchSize + ($tail ? 1 : 0);

        for ($batch = 0; $batch < $numBatches; $batch++) {
            $offset = $batch * $batchSize;
            $this->update($manager, $offset, $batchSize);
        }
    }

    private function update(ObjectManager $em, $offset, $limit)
    {
        $users = $em->createQueryBuilder()
            ->select('u')
            ->from('Btc\CoreBundle\Entity\User', 'u')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $class = 'Btc\CoreBundle\Entity\Plan\Payment\LimitPlan';
        $legacy = ['ROLE_TIER_LIEUTENANT', 'ROLE_TIER_COMMANDER', 'ROLE_TIER_ENSIGN'];

        foreach ($users as $user) {
            if ($user->hasRole('ROLE_TIER_COMMANDER')) {
                $user->addRole('ROLE_VERIFIED_BUSINESS');
                $plan = $em->find($class, $this->plans['Verified Business']);
            } elseif ($user->hasRole('ROLE_TIER_LIEUTENANT')) {
                $user->addRole('ROLE_VERIFIED_PERSONAL');
                $plan = $em->find($class, $this->plans['Verified Personal']);
            } elseif ($user->hasRole('ROLE_VERIFIED_BUSINESS')) {
                $plan = $em->find($class, $this->plans['Verified Business']);
            } elseif ($user->hasRole('ROLE_VERIFIED_PERSONAL')) {
                $plan = $em->find($class, $this->plans['Verified Personal']);
            } else {
                $plan = $em->find($class, $this->plans['Unverified']);
            }

            $assignment = new LimitAssignment();
            $assignment->setPlan($plan);
            $assignment->setUser($user);
            $assignment->setExpiresAt($plan->expirationDate());

            $em->persist($assignment);

            // remove legacy roles
            foreach ($legacy as $role) {
                $user->removeRole($role);
            }

            $em->persist($user);
        }

        $em->flush();
        $em->clear();
    }
}



