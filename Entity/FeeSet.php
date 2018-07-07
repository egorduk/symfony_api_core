<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="fee_set")
 */
class FeeSet
{
    const TYPE_USER_SPECIFIC = 0;
    const TYPE_VIP = 1;
    const TYPE_STANDARD = 2; // single default set to apply for now
    const TYPE_VOLUME_BASED = 3;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\Column(type="boolean", name="`default`")
     */
    private $default;

    /**
     * @ORM\ManyToOne(targetEntity="FeeSet", inversedBy="children")
     * @ORM\JoinColumn(name="parent_fee_set_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parentFeeSet;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8, nullable=true)
     * @Groups({"system"})
     */
    private $rule;

    /**
     * @ORM\OneToMany(targetEntity="Fee", mappedBy="feeSet", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $fees;

    /**
     * @ORM\OneToMany(targetEntity="FeeSet", mappedBy="parentFeeSet")
     * @var ArrayCollection
     */
    private $children;

    public function __construct()
    {
        $this->fees = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function addFee(Fee $fee)
    {
        $this->fees->add($fee);
        $fee->setFeeSet($this);
    }

    public function getFees()
    {
        return $this->fees;
    }

    public function addChild(FeeSet $child)
    {
        $this->children->add($child);
        $child->setParentFeeSet($this);
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function isUserSpecific()
    {
        return $this->type === self::TYPE_USER_SPECIFIC;
    }

    public function isVip()
    {
        return $this->type === self::TYPE_VIP;
    }

    public function isStandard()
    {
        return $this->type === self::TYPE_STANDARD;
    }

    public function isVolumeBased()
    {
        return $this->type === self::TYPE_VOLUME_BASED;
    }

    public function setRule($rule)
    {
        $this->rule = $rule;
        
        return $this;
    }

    public function getRule()
    {
        return $this->rule;
    }
    
    public function setDefault($default)
    {
        $this->default = (bool)$default;
        
        return $this;
    }

    public function isDefault()
    {
        return (bool)$this->default;
    }

    public function setParentFeeSet($parentFeeSet)
    {
        $this->parentFeeSet = $parentFeeSet;
        
        return $this;
    }

    public function getParentFeeSet()
    {
        return $this->parentFeeSet;
    }
}
