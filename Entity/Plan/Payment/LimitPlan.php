<?php

namespace Btc\CoreBundle\Entity\Plan\Payment;

use Btc\CoreBundle\Entity\Plan\Plan;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="plan_payment_limits")
 */
class LimitPlan extends Plan
{
}
