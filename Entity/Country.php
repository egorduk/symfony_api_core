<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="country")
 * @ORM\Entity
 */
class Country implements RestEntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=255)
     * @Groups({"api"})
     * @Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255", min="3")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(length=2)
     * @Groups({"api"})
     * @Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Country()
     */
    private $iso2;

    /**
     * @var string
     *
     * @ORM\Column(length=3)
     * @Groups({"api"})
     * @Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="3")
     */
    private $iso3;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hidden;

    /**
     * @ORM\Column(type="boolean")
     */
    private $restricted;

    public function __construct()
    {
        $this->hidden = false;
        $this->restricted = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;
        return $this;
    }

    public function getIso2()
    {
        return $this->iso2;
    }

    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
        return $this;
    }

    public function getIso3()
    {
        return $this->iso3;
    }

    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    public function isHidden()
    {
        return $this->hidden;
    }

    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;
    }

    public function isRestricted()
    {
        return $this->restricted;
    }
}
