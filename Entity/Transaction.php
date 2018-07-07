<?php

namespace Btc\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="transactions")
 */
class Transaction
{
    const STATUS_UNKNOWN = 0;
    const STATUS_EXECUTED = 1;
    const STATUS_COMPLETED = 2;

    const PLATFORM_EXMARKETS = 'EXM';
    const PLATFORM_BITFINEX = 'BFX';

    const TYPE_MAKER = 'maker';
    const TYPE_TAKER = 'taker';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api", "api_get_deals_by_market_id"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Deal", inversedBy="transactions")
     * @ORM\JoinColumn(name="deal_id", referencedColumnName="id", nullable=false)
     */
    private $deal;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="transactions")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="Market")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=false)
     */
    private $market;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Groups({"api", "api_get_deals_by_market_id"})
     * @Type("float")
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Groups({"api"})
     * @Type("float")
     */
    private $fee;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Groups({"api", "api_get_deals_by_market_id"})
     * @Type("float")
     */
    private $price;

    /**
     * Default 0 - Unknown. 1 - Executed, 2 - Completed
     *
     * @ORM\Column(type="integer")
     * @Groups({"api"})
     * @Type("integer")
     */
    private $status;

    /**
     * Values maker, taker
     *
     * @ORM\Column(length=6)
     * @Groups({"api"})
     * @Type("string")
     */
    private $type;

    /**
     * Value EXM, BFX
     *
     * @ORM\Column(length=3)
     * @Groups({"api"})
     * @Type("string")
     */
    private $platform;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="executed_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $executedAt;

    /**
     * Updates when status changes to Deal::STATUS_COMPLETED
     *
     * @Gedmo\Timestampable(on="change", field="status", value=2)
     * @ORM\Column(type="datetime", nullable=true, name="completed_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $completedAt;

    /**
     * UNIX_TIMESTAMP
     *
     * @Groups({"api_get_deals_by_market_id"})
     * @Type("DateTime<'U'>")
     */
    private $time;

    /**
     * @var float
     * @Groups({"api"})
     * @Type("float")
     */
    private $total;

    public function __construct()
    {
        $this->status = self::STATUS_UNKNOWN;
        $this->type = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDeal(Deal $deal)
    {
        $this->deal = $deal;
        
        return $this;
    }

    public function getDeal()
    {
        return $this->deal;
    }

    public function setOrder(Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function setMarket(Market $market)
    {
        $this->market = $market;

        return $this;
    }

    public function getMarket()
    {
        return $this->market;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setExecutedAt (\DateTime $executedAt)
    {
        $this->executedAt = $executedAt ;

        return $this;
    }

    public function getExecutedAt ()
    {
        return $this->executedAt ;
    }

    public function setCompletedAt(\DateTime $completedAt = null)
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    public function getValue()
    {
        return abs(bcmul($this->amount, $this->price, 8));
    }

    public function getFee()
    {
        return bcmul($this->order->getFeePercent() / 100, $this->getValue(), 8);
    }

    public function getPriceWithFee()
    {
        return bcadd($this->getPrice(), ($this->order->getSide() === Order::SIDE_BUY ? $this->getFee() : -1 * $this->getFee()), 8);
    }

    public function setFee($fee)
    {
        $this->fee = $fee;
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

    public function getTotal()
    {
        if ($this->getOrder()->getSide() === Order::SIDE_BUY) {
            return bcadd($this->getValue(), $this->getFee(), 8);
        }

        return bcsub($this->getValue(), $this->getFee(), 8);
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }
}
