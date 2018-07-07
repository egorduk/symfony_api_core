<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet_operation")
 */
class WalletOperation implements RestEntityInterface
{
    const TYPE_DEPOSIT = 1;
    const TYPE_DEPOSIT_FEE = 2;
    const TYPE_WITHDRAWAL = 3;
    const TYPE_WITHDRAWAL_FEE = 4;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Wallet", inversedBy="walletOperations")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id", nullable=false)
     */
    private $wallet;

    /**
     * @ORM\Column(name="balance", type="decimal", precision=24, scale=8)
     */
    private $balance;

    /**
     * @ORM\Column(name="total_reserved", type="decimal", precision=24, scale=8)
     */
    private $totalReserved;

    /**
     * @ORM\Column(name="expense", type="decimal", precision=24, scale=8)
     */
    private $expense;

    /**
     * @ORM\Column(name="debit", type="decimal", precision=24, scale=8)
     */
    private $debit;

    /**
     * @ORM\Column(name="credit", type="decimal", precision=24, scale=8)
     */
    private $credit;

    /**
     * @ORM\Column(name="reserve", type="decimal", precision=24, scale=8)
     */
    private $reserve;

    /**
     * TODO: fix table type in mysql
     * @ORM\Column(type="string", length=30)
     */
    private $type;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Deposit\Deposit",inversedBy="walletOperations")
     * @ORM\JoinColumn(name="deposit_id", referencedColumnName="id")
     */
    private $deposit;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Withdraw\Withdraw",inversedBy="walletOperations")
     * @ORM\JoinColumn(name="withdraw_id", referencedColumnName="id")
     */
    private $withdraw;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->balance = (double)0;
        $this->credit = (double)0;
        $this->debit = (double)0;
        $this->reserve = (double)0;
        $this->expense = (double)0;
        $this->totalReserved = (double)0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param mixed $wallet
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getTotalReserved()
    {
        return $this->totalReserved;
    }

    /**
     * @param mixed $totalReserved
     */
    public function setTotalReserved($totalReserved)
    {
        $this->totalReserved = $totalReserved;
    }

    /**
     * @return mixed
     */
    public function getExpense()
    {
        return $this->expense;
    }

    /**
     * @param mixed $expense
     */
    public function setExpense($expense)
    {
        $this->expense = $expense;
    }

    /**
     * @return mixed
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * @param mixed $debit
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;
    }

    /**
     * @return mixed
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param mixed $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return mixed
     */
    public function getReserve()
    {
        return $this->reserve;
    }

    /**
     * @param mixed $reserve
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * @param mixed $deposit
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * @return mixed
     */
    public function getWithdraw()
    {
        return $this->withdraw;
    }

    /**
     * @param mixed $withdraw
     */
    public function setWithdraw($withdraw)
    {
        $this->withdraw = $withdraw;
    }
}