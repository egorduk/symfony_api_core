<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_address")
 */
class UserAddress
{
    const UNITS_BTC = 'btc';
    const UNITS_LTC = 'ltc';
    const UNITS_ETH = 'eth';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Type("integer")
     * @Groups({"api"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="addresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MuhhamadWallet", inversedBy="muhhamadWallets")
     * @ORM\JoinColumn(name="muhhamad_wallet_id", referencedColumnName="id", nullable=false)
     */
    private $muhhamadWallet;

    /**
     * @ORM\Column(type="string", length=100)
     * @Type("string")
     * @Groups({"api"})
     */
    private $address;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Type("DateTime")
     * @Groups({"api"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", name="is_used")
     * @Type("integer")
     * @Groups({"api"})
     */
    private $isUsed;

    /**
     * @ORM\OneToMany(targetEntity="AddressTransaction", mappedBy="userAddress")
     */
    private $addressTransactions;


    public function __construct()
    {
        $this->addressTransactions = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isUsed = 1;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getAddressTransactions()
    {
        return $this->addressTransactions;
    }

    public function setAddressTransactions($addressTransactions)
    {
        $this->addressTransactions = $addressTransactions;
    }

    /**
     * @return MuhhamadWallet
     */
    public function getMuhhamadWallet()
    {
        return $this->muhhamadWallet;
    }

    public function setMuhhamadWallet($muhhamadWallet)
    {
        $this->muhhamadWallet = $muhhamadWallet;
    }

    public function getIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @param int $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;
    }

    public function setNotUsed()
    {
        $this->setIsUsed(0);
    }
}
