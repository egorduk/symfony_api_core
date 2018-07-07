<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="address_transaction")
 */
class AddressTransaction
{
    const DEPOSIT_TYPE = 1;
    const WITHDRAW_TYPE = 2;
    const ANY = 0;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="WalletTransaction", inversedBy="addressTransactions")
     * @ORM\JoinColumn(name="wallet_transaction_id", referencedColumnName="id")
     */
    private $walletTransaction;

    /**
     * @ORM\ManyToOne(targetEntity="UserAddress", inversedBy="addressTransactions")
     * @ORM\JoinColumn(name="user_address_id", referencedColumnName="id")
     */
    private $userAddress;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Type("float")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     * @Type("float")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Type("DateTime")
     */
    private $createdAt;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getWalletTransaction()
    {
        return $this->walletTransaction;
    }

    public function setWalletTransaction($walletTransaction)
    {
        $this->walletTransaction = $walletTransaction;
    }

    public function getUserAddress()
    {
        return $this->userAddress;
    }

    public function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setDepositType()
    {
        $this->type = self::DEPOSIT_TYPE;
    }

    public function setWithdrawType()
    {
        $this->type = self::WITHDRAW_TYPE;
    }
}
