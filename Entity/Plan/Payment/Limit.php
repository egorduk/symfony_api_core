<?php

namespace Btc\CoreBundle\Entity\Plan\Payment;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Btc\CoreBundle\Entity\Currency;
use Btc\CoreBundle\Validator\Constraints\PaymentLimit as AssertLimits;

/**
 * @ORM\MappedSuperclass
 * @AssertLimits
 */
class Limit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="LimitPlan", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $plan;

    /**
     * 0 - unlimited
     *
     * @Assert\NotBlank(message="core_payment_limit.limitation.blank")
     * @Assert\GreaterThanOrEqual(message="core_payment_limit.limitation.invalid", value=0)
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $daily = 0;

    /**
     * 0 - unlimited
     *
     * @Assert\NotBlank(message="core_payment_limit.limitation.blank")
     * @Assert\GreaterThanOrEqual(message="core_payment_limit.limitation.invalid", value=0)
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $weekly = 0;

    /**
     * 0 - unlimited
     *
     * @Assert\NotBlank(message="core_payment_limit.limitation.blank")
     * @Assert\GreaterThanOrEqual(message="core_payment_limit.limitation.invalid", value=0)
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $monthly = 0;

    public function getId()
    {
        return $this->id;
    }

    public function setDaily($daily)
    {
        $this->daily = $daily;
        return $this;
    }

    public function getDaily()
    {
        return $this->daily;
    }

    public function setWeekly($weekly)
    {
        $this->weekly = $weekly;
        return $this;
    }

    public function getWeekly()
    {
        return $this->weekly;
    }

    public function setMonthly($monthly)
    {
        $this->monthly = $monthly;
        return $this;
    }

    public function getMonthly()
    {
        return $this->monthly;
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setPlan(LimitPlan $plan)
    {
        $this->plan = $plan;
        return $this;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function isUnlimited()
    {
        return bccomp($this->daily, 0, 8) === 0;
    }
}
