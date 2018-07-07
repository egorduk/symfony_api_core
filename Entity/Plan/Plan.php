<?php

namespace Btc\CoreBundle\Entity\Plan;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class Plan
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Plan name
     *
     * @Assert\Length(min=2, max=32)
     * @Assert\NotBlank(message="core_plan.name.blank")
     * @ORM\Column(length=32)
     */
    private $name;

    /**
     * @Assert\Length(min=2, max=32)
     * @Gedmo\Slug(fields={"name"}, updatable=false)
     * @ORM\Column(length=32, unique=true)
     */
    private $slug;

    /**
     * Plan weight, in other words - priority. The higher the number
     * is - the higher priority is.
     *
     * @Assert\NotBlank(message="core_plan.weight.blank")
     * @Assert\Type(type="integer", message="core_plan.weight.invalid")
     * @Assert\GreaterThanOrEqual(message="core_plan.weight.invalid", value=0)
     * @ORM\Column(type="integer")
     */
    private $weight = 0;

    /**
     * @Assert\GreaterThanOrEqual(message="core_plan.duration.invalid", value=0)
     * @Assert\Type(type="integer", message="core_plan.duration.invalid")
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * Duration unit like 'minutes' or 'hours' or 'days'
     *
     * @Assert\Length(min=2, max=16)
     * @ORM\Column(length=16, name="duration_unit", nullable=true)
     */
    private $durationUnit;

    /**
     * Whether or not the plan is a core plan, which cannot be removed by admin
     *
     * @ORM\Column(type="boolean")
     */
    private $custom;


    public function __construct()
    {
        $this->duration = 0;
        $this->weight = 0;
        $this->custom = true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDurationUnit($durationUnit)
    {
        $this->durationUnit = $durationUnit;
        return $this;
    }

    public function getDurationUnit()
    {
        return $this->durationUnit;
    }

    public function isDurable()
    {
        return $this->durationUnit !== null;
    }

    /**
     * If plan is durable, returns new expiration datetime
     * otherwise - null
     *
     * @return \DateTime or null
     */
    public function expirationDate()
    {
        return $this->isDurable() ? new \DateTime(sprintf('+%d %s', $this->duration, $this->durationUnit)) : null;
    }

    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    public function isCustom()
    {
        return $this->custom;
    }
}
