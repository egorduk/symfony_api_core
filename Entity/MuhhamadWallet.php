<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="muhhamad_wallet")
 */
class MuhhamadWallet implements RestEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * @Type("integer")
     * @Groups({"api"})
     */
    private $id;

    /**
     * @ORM\Column(length=100)
     * @Type("string")
     * @Groups({"api"})
     */
    private $name;

    /**
     * @ORM\Column(length=100, name="key_store")
     * @Type("string")
     * @Groups({"api"})
     */
    private $keyStore;

    /**
     * @ORM\OneToMany(targetEntity="UserAddress", mappedBy="muhhamadWallet")
     */
    private $muhhamadWallets;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Type("Btc\CoreBundle\Entity\Currency")
     * @Groups({"api"})
     */
    private $currency;

    /**
     * @ORM\Column(type="integer", name="is_test")
     * @Type("integer")
     * @Groups({"api"})
     */
    private $isTest;

    /**
     * @ORM\Column(type="integer", name="is_cold")
     * @Type("integer")
     * @Groups({"api"})
     */
    private $isCold;


    public function __construct()
    {
        $this->muhhamadWallets = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getMuhhamadWallets()
    {
        return $this->muhhamadWallets;
    }

    public function setMuhhamadWallets($muhhamadWallets)
    {
        $this->muhhamadWallets = $muhhamadWallets;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getKeyStore()
    {
        return $this->keyStore;
    }

    public function setKeyStore($keyStore)
    {
        $this->keyStore = $keyStore;
    }

    public function getIsTest()
    {
        return $this->isTest;
    }

    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    public function getIsCold()
    {
        return $this->isCold;
    }

    public function setIsCold($isCold)
    {
        $this->isCold = $isCold;
    }
}
