<?php

namespace Btc\CoreBundle\Entity\Plan;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Btc\CoreBundle\Entity\User;

/**
 * @ORM\MappedSuperclass
 */
abstract class Assignment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * The mapping must be overrided
     *
     * @var \Btc\CoreBundle\Entity\Plan\Plan
     */
    protected $plan;

    /**
     * The mapping must be overrided
     * NOTE: expirable plans should always have a fallback to stable plan
     *
     * @var \Btc\CoreBundle\Entity\Plan\Plan
     */
    protected $fallbackPlan;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="assigned_at")
     */
    private $assignedAt;

    /**
     * @ORM\Column(type="datetime", name="expires_at", nullable=true)
     */
    private $expiresAt;

    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setAssignedAt(\DateTime $assignedAt)
    {
        $this->assignedAt = $assignedAt;
        return $this;
    }

    public function getAssignedAt()
    {
        return $this->assignedAt;
    }

    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setPlan(Plan $plan)
    {
        $assign = function() use ($plan) {
            $this->plan = $plan;
            $this->setExpiresAt($plan->expirationDate());
            $this->setAssignedAt(new \DateTime());

            return $this;
        };

        // if new plan is durable, current moves to fallback
        if ($plan->isDurable() && !$this->plan->isDurable()) {
            $this->setFallbackPlan($this->plan);
        }

        // reset fallback plan if not durable
        if (!$plan->isDurable()) {
            $this->setFallbackPlan(null);
        }

        return $assign();
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function setFallbackPlan(Plan $fallbackPlan = null)
    {
        // if new fallback plan weight is worse than current, skip update
        if ($this->fallbackPlan !== null && $fallbackPlan !== null) {
            if ($this->fallbackPlan->getWeight() > $fallbackPlan->getWeight()) {
                return $this;
            }
        }

        $this->fallbackPlan = $fallbackPlan;

        return $this;
    }

    public function getFallbackPlan()
    {
        return $this->fallbackPlan;
    }
}
