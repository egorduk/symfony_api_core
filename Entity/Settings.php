<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Validator\Constraints as Assertions;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="settings")
 * @Assertions\Setting
 */
class Settings
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(length=32)
     * @Assert\NotBlank(message="settings.slug.blank")
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Market", inversedBy="settings")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id")
     */
    private $market;

    /**
     * @ORM\Column(length=32)
     * @Assert\NotBlank(message="settings.name.blank")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="settings.value.blank")
     */
    private $value;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="settings.description.blank")
     */
    private $description;

    public function getId()
    {
        return $this->id;
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

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setMarket(Market $market = null)
    {
        $this->market = $market;
        return $this;
    }

    public function getMarket()
    {
        return $this->market;
    }
}
