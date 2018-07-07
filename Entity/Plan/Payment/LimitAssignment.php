<?php

namespace Btc\CoreBundle\Entity\Plan\Payment;

use Doctrine\ORM\Mapping as ORM;
use Btc\CoreBundle\Entity\Plan\Assignment;

/**
 * @ORM\Entity
 * @ORM\Table(name="plan_payment_limit_assignments")
 */
class LimitAssignment extends Assignment
{
    /**
     * @ORM\ManyToOne(targetEntity="LimitPlan", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $plan;

    /**
     * @ORM\ManyToOne(targetEntity="LimitPlan")
     * @ORM\JoinColumn(name="fallback_plan_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $fallbackPlan;
}
