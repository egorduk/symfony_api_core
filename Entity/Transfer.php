<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\MappedSuperclass
 */
abstract class Transfer {
    const STATUS_NEW = 'new';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * User's wallet to which money is being transferred.
     *
     * @ORM\ManyToOne(targetEntity="Wallet")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id", nullable=false)
     */
    private $wallet;

    /**
     * @ORM\ManyToOne(targetEntity="UserAddress")
     * @ORM\JoinColumn(name="user_address_id", referencedColumnName="id", nullable=false)
     */
    private $userAddress;

    /**
     * @ORM\ManyToOne(targetEntity="WalletTransaction")
     * @ORM\JoinColumn(name="wallet_transaction_id", referencedColumnName="id", nullable=false)
     */
    private $walletTransaction;

    /**
     * The amount which is being transferred.
     *
     * @ORM\Column(name="amount", type="decimal", precision=16, scale=8, nullable=false)
     */
    protected $amount;

    /**
     * Fee amount to be taken from transferred amount.
     *
     * @ORM\Column(name="fee_amount", type="decimal", precision=16, scale=8, nullable=false)
     */
    protected $feeAmount;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;


    public function __construct()
    {
        $this->status = self::STATUS_NEW;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @param double $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return double
     */
    public function getAmount()
    {
        return (double)$this->amount;
    }

    public function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;

        return $this;
    }

    public function getFeeAmount()
    {
        return (double)$this->feeAmount;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdatedAt($updated)
    {
        $this->updatedAt = $updated;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \Btc\CoreBundle\Entity\Wallet $wallet
     */
    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return \Btc\CoreBundle\Entity\Wallet
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    public function getCurrency() {
        return $this->wallet->getCurrency();
    }

    public function getCurrencyCode()
    {
        return $this->wallet->getCurrency()->getCode();
    }

    public function __toString()
    {
        if (empty($this->getId()) || empty($this->getWallet()) || empty($this->getAmount())) {
            return '';
        }

        $description = sprintf(
            'Exmarkets.com: #%s; %s; %01.2f %s',
            $this->getId(),
            $this->getWallet()->getUser()->getUsername(),
            $this->getAmount(),
            $this->getWallet()->getCurrency()->getCode()
        );

        return $description;
    }

    public function getAmountAfterFee()
    {
        return bcsub(number_format($this->getAmount(),8, '.', ''), number_format($this->getFeeAmount(),8, '.', ''), 8);
    }

    public function getUser()
    {
        return $this->wallet->getUser();
    }

    /**
     * @return UserAddress
     */
    public function getUserAddress()
    {
        return $this->userAddress;
    }

    public function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;
    }

    /**
     * @return WalletTransaction
     */
    public function getWalletTransaction()
    {
        return $this->walletTransaction;
    }

    public function setWalletTransaction($walletTransaction)
    {
        $this->walletTransaction = $walletTransaction;
    }
}
