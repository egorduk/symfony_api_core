<?php namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet")
 */
class Wallet implements RestEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="wallets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", cascade={"persist"})
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Currency")
     */
    private $currency;

    /**
     * @ORM\Column(name="amount_total", type="decimal", precision=24, scale=8, nullable=false)
     * @Groups({"api"})
     * @SerializedName("total")
     * @Type("float")
     */
    private $amountTotal;

    /**
     * @ORM\Column(name="amount_reserved", type="decimal", precision=24, scale=8, nullable=false)
     * @Groups({"api"})
     * @SerializedName("reserved")
     * @Type("float")
     */
    private $amountReserved;

    /**
     * @ORM\Column(name="amount_available", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @SerializedName("balance")
     * @Type("float")
     */
    private $amountAvailable;

    /**
     * @ORM\Column(name="fee_percent", type="decimal", precision=24, scale=8)
     */
    private $feePercent;

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


    public function __construct()
    {
        $this->amountAvailable = (double)0;
        $this->amountReserved = (double)0;
        $this->amountTotal = (double)0;
        $this->feePercent = (double)0;
    }

    /**
     * @param float $amountAvailable
     * @return $this
     */
    public function setAmountAvailable($amountAvailable)
    {
        $this->amountAvailable = $amountAvailable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmountAvailable()
    {
        return (double)$this->amountAvailable;
    }

    /**
     * @param mixed $amountReserved
     * @return $this
     */
    public function setAmountReserved($amountReserved)
    {
        $this->amountReserved = $amountReserved;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmountReserved()
    {
        return $this->amountReserved;
    }

    /**
     * @param mixed $amountTotal
     * @return $this
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    public function setFeePercent($feePercent)
    {
        $this->feePercent = $feePercent;
        return $this;
    }

    public function getFeePercent()
    {
        return $this->feePercent;
    }

    /**
     * @param \DateTime $created
     * @return $this
     */
    public function setCreatedAt(\DateTime $created)
    {
        $this->createdAt = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param Currency $currency
     * @return $this
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $updated
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updated)
    {
        $this->updatedAt = $updated;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Adds amount to total and available
     *
     * @param $amount
     * @return $this
     */
    public function credit($amount)
    {
        $this->amountTotal = (double)bcadd($this->amountTotal, $amount, 8);
        $this->amountAvailable = (double)bcadd($this->amountAvailable, $amount, 8);

        return $this;
    }

    public function reserve($amount)
    {
        $this->amountReserved = (double)bcadd($this->amountReserved, $amount, 8);
        $this->amountAvailable = (double)bcsub($this->amountAvailable, $amount, 8);

        return $this;
    }

    public function reduceReserve($amount)
    {
        $this->amountReserved = (double)bcsub($this->amountReserved, $amount, 8);
        $this->amountTotal = (double)bcsub($this->amountTotal, $amount, 8);

        return $this;
    }

    public function refundReserve($amount)
    {
        $this->amountReserved = (double)bcsub($this->amountReserved, $amount, 8);
        $this->amountAvailable = (double)bcadd($this->amountAvailable, $amount, 8);

        return $this;
    }

    public function debit($amount)
    {
        $this->amountAvailable = (double)bcsub($this->amountAvailable, $amount, 8);
        $this->amountTotal = (double)bcsub($this->amountTotal, $amount, 8);

        return $this;
    }
}