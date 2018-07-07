<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="status_idx", columns={"status"})})
 */
class Order implements RestEntityInterface
{
    const STATUS_OPEN = 1; // is a new deal waiting for processing
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3; // order was cancelled
    const STATUS_PENDING_CANCEL = 4; // order is pending to be cancelled
    const STATUS_CLOSED = 5; // order was closed

    const TYPE_LIMIT = 1;
    const TYPE_MARKET = 2;
    const TYPE_STOP_LIMIT = 3;
    const TYPE_STOP_MARKET = 4;

    const TYPE_LIMIT_STR = 'Limit';
    const TYPE_MARKET_STR = 'Market';
    const TYPE_STOP_LIMIT_STR = 'StopLimit';
    const TYPE_STOP_MARKET_STR = 'StopMarket';

    const SIDE_SELL = 'SELL';
    const SIDE_BUY = 'BUY';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Market")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Market")
     */
    private $market;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Wallet")
     * @ORM\JoinColumn(name="in_wallet_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Wallet")
     */
    private $inWallet;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Wallet")
     * @ORM\JoinColumn(name="out_wallet_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Wallet")
     */
    private $outWallet;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="updated_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $updatedAt;

    /**
     * Updates when status changes to Deal::STATUS_COMPLETED
     *
     * @Gedmo\Timestampable(on="change", field="status", value=1)
     * @ORM\Column(type="datetime", nullable=true, name="completed_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $completedAt;

    /**
     * Updates when status changes to Deal::STATUS_CANCELLED
     *
     * @Gedmo\Timestampable(on="change", field="status", value=2)
     * @ORM\Column(type="datetime", nullable=true, name="cancelled_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $cancelledAt;

    /**
     * Default 1 - Open. 2 - Completed, 3 - Canceled, 4 - Pending cancel, 5 - Closed
     *
     * @ORM\Column(type="smallint")
     * @Groups({"api"})
     * @Type("string")
     */
    private $status;

    /**
     * An amount which was used to fulfill the deal so far
     * until it reaches $amount
     *
     * @ORM\Column(name="current_amount", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $currentAmount;

    /**
     * The price wanted for asked unit. This field can
     * be nullable and it would mean that the deal would execute
     * immediately based on the best offers. Otherwise if
     * price is set, it would wait until fitting offers
     *
     * @ORM\Column(name="asked_unit_price", type="decimal", precision=24, scale=8)
     * @Assert\NotBlank(message="core_trade.price.blank", groups={"Limit"})
     * @Assert\GreaterThan(message="core_trade.price.zero_or_negative", value=0, groups={"Limit", "StopLimit"})
     * @SerializedName("price")
     * @Groups({"api"})
     * @Type("float")
     */
    private $askedUnitPrice;

    /**
     * The price wanted for asked unit for stop-limit order.
     *
     * @ORM\Column(name="stop_price", type="decimal", precision=24, scale=8)
     * @Assert\NotBlank(message="core_trade.price.blank", groups={"Limit"})
     * @Assert\GreaterThan(message="core_trade.price.zero_or_negative", value=0, groups={"StopLimit"})
     * @SerializedName("stop_price")
     * @Groups({"api"})
     * @Type("float")
     */
    private $stopPrice;

    /**
     * @ORM\Column(name="fee_percent", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $feePercent;

    /**
     * Actual amount reserved from users account
     *
     * @ORM\Column(name="fee_amount_reserved", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $feeAmountReserved;

    /**
     * Fee that is actually already taken.
     *
     * @ORM\Column(name="fee_amount_taken", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $feeAmountTaken;

    /**
     * Default 1 - Limit. 2 - Market, 3 - Stop Limit, 4 - Stop Market
     *
     * @ORM\Column(type="smallint")
     * @Groups({"api"})
     * @Type("string")
     */
    private $type;

    /**
     * An amount of units to buy/sell.
     * Fee is consumed from $outWallet multiplied for askedUnitPrice.
     *
     * @ORM\Column(name="amount", type="decimal", precision=24, scale=8)
     * @Assert\NotBlank(message="core_trade.buy_amount.blank", groups={"Limit"})
     * @Assert\GreaterThan(message="core_trade.amount.zero_or_negative", value = 0, groups={"Limit", "Market", "StopLimit"})
     * @SerializedName("start_quantity")
     * @Groups({"api"})
     * @Type("float")
     */
    private $amount;

    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="order", cascade={"persist"})
     * @Groups({"api"})
     * @Type("array<Btc\CoreBundle\Entity\Transaction>")
     */
    private $transactions;

    /**
     * SELL or BUY order
     *
     * @ORM\Column(type="string", length=4)
     * @Groups({"api"})
     * @Type("string")
     */
    private $side;

    /**
     * Equals to amount
     *
     * @ORM\Column(name="reserve_total", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $reserveTotal;

    /**
     * @ORM\Column(name="reserve_spent", type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $reserveSpent;

    private $isBuy;

    /**
     * @Serializer\Type("float")
     * @SerializedName("quantity")
     * @Groups({"api"})
     */
    private $amountLeft;

    private $marketId;

    private $timestamp;

    /**
     * @var float
     * @Groups({"api"})
     * @Type("float")
     */
    private $totalPrice;

    /**
     * Summary of transaction totals
     *
     * @var float
     * @Groups({"api"})
     * @Type("float")
     */
    private $total;

    /**
     * @var float
     * @Groups({"api"})
     * @Type("float")
     */
    private $totalFee;

    private $feeReserved;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->reserveSpent = 0;
        $this->reserveTotal = 0;
        $this->feeAmountReserved = 0;
        $this->feeAmountTaken = 0;
        $this->feeReserved = 0;
        $this->feePercent = 0;
        $this->askedUnitPrice = 0;
        $this->stopPrice = 0;
        $this->currentAmount = 0;
        $this->totalPrice = 0;
        $this->type = self::TYPE_LIMIT;
        $this->status = self::STATUS_OPEN;
    }

    /**
     * @return Market
     */
    public function getMarket()
    {
        return $this->market;
    }

    public function setMarket(Market $market)
    {
        $this->market = $market;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    public function setCompletedAt(\DateTime $completedAt = null)
    {
        $this->completedAt = $completedAt;
        return $this;
    }

    public function getCancelledAt()
    {
        return $this->cancelledAt;
    }

    public function setCancelledAt(\DateTime $at = null)
    {
        $this->cancelledAt = $at;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFeePercent()
    {
        return $this->feePercent;
    }

    public function setFeePercent($feePercent)
    {
        $this->feePercent = $feePercent;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isMarket()
    {
        return $this->type === self::TYPE_MARKET;
    }

    public function creditInWallet($amount)
    {
        $this->getInWallet()->credit($amount);
        return $this;
    }

    /**
     * @return Wallet
     */
    public function getInWallet()
    {
        return $this->inWallet;
    }

    public function setInWallet(Wallet $inWallet)
    {
        $this->inWallet = $inWallet;
        return $this;
    }

    public function reduceReserveOutWallet($amount)
    {
        $this->getOutWallet()->reduceReserve($amount);
        return $this;
    }

    /**
     * @return Wallet
     */
    public function getOutWallet()
    {
        return $this->outWallet;
    }

    public function setOutWallet(Wallet $outWallet)
    {
        $this->outWallet = $outWallet;return $this;
    }

    public function refundReserveOutWallet($amount)
    {
        $this->getOutWallet()->refundReserve($amount);
        return $this;
    }

    public function isFulfilled()
    {
        return bccomp($this->getAmountLeft(), (double)0, 8) === 0;
    }

    public function getAmountLeft()
    {
        return (double)bcsub($this->getAmount(), $this->getCurrentAmount(), 8);
    }

    public function setAmountLeft($amount)
    {
        $this->amountLeft = $amount;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * @param mixed $side
     */
    public function setSide($side)
    {
        $this->side = $side;
    }

    public function getAskedUnitPrice()
    {
        return $this->askedUnitPrice;
    }

    public function setAskedUnitPrice($askedUnitPrice)
    {
        $this->askedUnitPrice = $askedUnitPrice;
        return $this;
    }

    /**
     * Used to make interface common for buy and sell deal
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = (double)bcadd($amount, $this->amount, 8);
        return $this;
    }

    public function getCurrentAmount()
    {
        return $this->currentAmount;
    }

    public function setCurrentAmount($currentAmount)
    {
        $this->currentAmount = $currentAmount;
        return $this;
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

    public function addTransactions(Transaction $transaction)
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
        }
    }

    public function removeTransactions(Transaction $transaction)
    {
        $this->transactions->remove($transaction);
    }

    public function getUnfulfilledOrderValueWithFee()
    {
        switch ($this->getType()) {
            case self::TYPE_MARKET:
                return doubleVal(bcsub($this->getUnfulfilledOrderValue(), $this->getFeeAmountTaken(), 8));
            default:
                return doubleVal(bcadd($this->getUnfulfilledOrderValue(), $this->getFeeAmountLeft(), 8));
        }
    }

    public function getUnfulfilledOrderValue()
    {
        $orderValue = $this->getOrderValue();
        $currentAmount = (double)bcmul($this->getCurrentAmount(), $this->getAskedUnitPrice(), 8);

        return doubleVal(bcsub($orderValue, $currentAmount, 8));
    }

    /**
     * Returns total order value
     */
    public function getOrderValue()
    {
        if ($this->type === self::TYPE_MARKET) {
            $sum = 0;

            foreach ($this->transactions as $transaction) {
                $sum += $transaction->getValue();
            }

            return $sum;
        }

        return (double)bcmul($this->getAmount(), $this->getAskedUnitPrice(), 8);
    }

    /**
     * @return mixed
     */
    public function getFeeAmountTaken()
    {
        return $this->feeAmountTaken;
    }

    /**
     * @param mixed $feeAmountTaken
     */
    public function setFeeAmountTaken($feeAmountTaken)
    {
        $this->feeAmountTaken = $feeAmountTaken;
    }

    public function getFeeAmountLeft()
    {
        return (double)bcsub($this->getFeeAmountReserved(), $this->getFeeAmountTaken(), 8);
    }

    /**
     * @return mixed
     */
    public function getFeeAmountReserved()
    {
        return $this->feeAmountReserved;
    }

    /**
     * @param mixed $feeAmountReserved
     */
    public function setFeeAmountReserved($feeAmountReserved)
    {
        $this->feeAmountReserved = $feeAmountReserved;
    }

    /**
     * @param mixed $reserveSpent
     */
    public function setReserveSpent($reserveSpent)
    {
        $this->reserveSpent = $reserveSpent;
    }

    /**
     * @return mixed
     */
    public function getReserveSpent()
    {
        return $this->reserveSpent;
    }

    /**
     * @param mixed $reserveTotal
     */
    public function setReserveTotal($reserveTotal)
    {
        $this->reserveTotal = $reserveTotal;
    }

    /**
     * @return mixed
     */
    public function getReserveTotal()
    {
        return $this->reserveTotal;
    }

    /**
     * @return mixed
     */
    public function getIsBuy()
    {
        return $this->isBuy;
    }

    /**
     * @param mixed $isBuy
     */
    public function setIsBuy($isBuy)
    {
        $this->isBuy = $isBuy;
    }

    /**
     * @return mixed
     */
    public function getMarketId()
    {
        return $this->marketId;
    }

    /**
     * @param mixed $marketId
     */
    public function setMarketId($marketId)
    {
        $this->marketId = $marketId;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return float
     */
    public function getTotalFee()
    {
        return $this->totalFee;
    }

    /**
     * @param float $totalFee
     */
    public function setTotalFee($totalFee)
    {
        $this->totalFee = $totalFee;
    }

    public function getStopPrice()
    {
        return $this->stopPrice;
    }

    public function setStopPrice($stopPrice)
    {
        $this->stopPrice = $stopPrice;
    }

    public function getFeeReserved()
    {
        return $this->feeReserved;
    }

    public function setFeeReserved($feeReserved)
    {
        $this->feeReserved = $feeReserved;
    }

    public function getAssetCurrencyCode()
    {
        if ($this->getMarket()->getSlug()) {
            return array_map('strtoupper', explode('-', $this->getMarket()->getSlug()))[0];
        }

        return '';
    }

    public function getFundsCurrencyCode()
    {
        if ($this->getMarket()->getSlug()) {
            return array_map('strtoupper', explode('-', $this->getMarket()->getSlug()))[1];
        }

        return '';
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
