<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet_transaction")
 */
class WalletTransaction
{
    const TRANSACTION_TYPE_IN = 'in';
    const TRANSACTION_HEALTH_OK = 'OK';
    const REDIS_WALLET_TRANSACTIONS_KEY = 'wallet.transactions';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(length=100, name="transaction_id")
     * @Type("string")
     */
    private $transactionId;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Type("float")
     */
    private $fee;

    /**
     * @ORM\Column(type="integer")
     * @Type("integer")
     */
    private $confirmations;

    /**
     * @ORM\Column(type="integer")
     * @Type("integer")
     */
    private $block;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Type("DateTime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="AddressTransaction", mappedBy="walletTransaction")
     */
    private $addressTransactions;


    public function __construct()
    {
        $this->addressTransactions = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->block = 0;
        $this->confirmations = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getFee()
    {
        return $this->fee;
    }

    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    public function getConfirmations()
    {
        return $this->confirmations;
    }

    public function setConfirmations($confirmations)
    {
        $this->confirmations = $confirmations;

        return $this;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;

        return $this;
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
}
