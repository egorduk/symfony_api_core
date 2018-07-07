<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Entity\Deposit\DepositLog;
use Btc\CoreBundle\Entity\Withdraw\WithdrawLog;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Incoming transactions to the wallets
 *
 * @ORM\Entity
 * @ORM\Table(name="coin_transaction")
 */
class CoinTransaction {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Any crypto currency
     *
     * @ORM\ManyToOne(targetEntity="Currency", cascade={"persist"})
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;

    /**
     * @ORM\Column()
     */
    private $amount;

    /**
     * @ORM\Column()
     */
    private $category;

    /**
     * @ORM\Column()
     */
    private $confirmations;
    /**
     * @ORM\Column(name="block_hash")
     */
    private $blockHash;
    /**
     * @ORM\Column(name="block_index")
     */
    private $blockIndex;
    /**
     * @ORM\Column(name="block_time")
     */
    private $blockTime;
    /**
     * @ORM\Column()
     */
    private $txId;
    /**
     * @ORM\Column(name="wallet_conflicts")
     */
    private $walletConflicts;
    /**
     * @ORM\Column()
     */
    private $time;
    /**
     * @ORM\Column(name="time_received")
     */
    private $timeReceived;
    /**
     * @ORM\Column(type="text")
     */
    private $details;
    /**
     * @ORM\Column()
     */
    private $account;
    /**
     * @ORM\Column()
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="Btc\CoreBundle\Entity\Deposit\DepositLog", mappedBy="transactionReference", cascade={"persist", "remove"})
     */
    private $depositLog;

    /**
     * @ORM\OneToMany(targetEntity="Btc\CoreBundle\Entity\Withdraw\WithdrawLog", mappedBy="transactionReference", cascade={"persist", "remove"})
     */
    private $withdrawLog;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    public function setWalletConflicts($walletConflicts)
    {
        $this->walletConflicts = serialize($walletConflicts);
    }

    public function getWalletConflicts()
    {
        return unserialize($this->walletConflicts);
    }

    public function setAccount($account)
    {
        $this->account = $account;
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setBlockHash($blockHash)
    {
        $this->blockHash = $blockHash;
    }

    public function getBlockHash()
    {
        return $this->blockHash;
    }

    public function setBlockIndex($blockIndex)
    {
        $this->blockIndex = $blockIndex;
    }

    public function getBlockIndex()
    {
        return $this->blockIndex;
    }

    public function setBlockTime($blockTime)
    {
        $this->blockTime = $blockTime;
    }

    public function getBlockTime()
    {
        return $this->blockTime;
    }

    public function setConfirmations($confirmations)
    {
        $this->confirmations = $confirmations;
    }

    public function getConfirmations()
    {
        return $this->confirmations;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setDetails($details)
    {
        $this->details = serialize($details);
    }

    public function getDetails()
    {
        return unserialize($this->details);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTimeReceived($timeReceived)
    {
        $this->timeReceived = $timeReceived;
    }

    public function getTimeReceived()
    {
        return $this->timeReceived;
    }

    public function setTxId($txId)
    {
        $this->txId = $txId;
    }

    public function getTxId()
    {
        return $this->txId;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDepositLog(DepositLog $depositLog)
    {
        $this->depositLog = $depositLog;
    }

    public function getDepositLog()
    {
        return $this->depositLog;
    }

    public function setWithdrawLog(WithdrawLog $withdrawalLog)
    {
        $this->withdrawLog = $withdrawalLog;
    }

    public function getWithdrawLog()
    {
        return $this->withdrawLog;
    }
}
