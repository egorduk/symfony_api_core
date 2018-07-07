<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="market")
 */
class Market implements RestEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * Market slug (usd-btc, btc-eur, eth-eur, ltc-eur and etc.)
     *
     * @ORM\Column(length=16, unique=true)
     * @Groups({"api", "api_get_deals_markets"})
     * @Type("string")
     */
    private $slug;

    /**
     * TODO: rename to $baseCurrency
     *
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Currency")
     */
    private $currency;

    /**
     * TODO: rename to $quoteCurrency
     *
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Currency")
     * @ORM\JoinColumn(name="with_currency_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Currency")
     */
    private $withCurrency;

    /**
     * The market name
     *
     * @ORM\Column(length=32)
     * @Groups({"api"})
     * @Type("string")
     */
    private $name;

    /**
     * Whether or not the market type is internal. Etc
     * USD - EUR is a money exchange trade and an instant one
     * used internally for money exchange
     *
     * @ORM\Column(type="boolean")
     */
    private $internal;

    /**
     * @ORM\Column(type="smallint", name="base_precision")
     */
    private $basePrecision;

    /**
     * @ORM\Column(type="smallint", name="quote_precision")
     */
    private $quotePrecision;

    /**
     * Precision for market ratio - $baseCurrency / $quoteCurrency
     *
     * @ORM\Column(type="smallint", name="price_precision")
     */
    private $pricePrecision;

    /**
     * @ORM\OneToMany(targetEntity="Settings", mappedBy="market", cascade={"persist", "remove"})
     * @Since("2")
     */
    private $settings;

    /**
     * @Groups({"api"})
     * @Type("float")
     */
    private $lastPrice;

    /**
     * @Groups({"api"})
     * @Type("float")
     */
    private $todayOpenPrice;

    /**
     * @Groups({"api"})
     * @Type("float")
     */
    private $volume24;

    /**
     * @Groups({"api"})
     * @Type("float")
     */
    private $minAmount;

    public function __construct()
    {
        $this->settings = new ArrayCollection();
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setWithCurrency(Currency $withCurrency)
    {
        $this->withCurrency = $withCurrency;
        return $this;
    }

    public function getWithCurrency()
    {
        return $this->withCurrency;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setInternal($internal)
    {
        $this->internal = (bool)$internal;
        return $this;
    }

    public function isInternal()
    {
        return $this->internal;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function addSettings(Settings $settings)
    {
        if (!$this->settings->contains($settings)) {
            $settings->setMarket($this);
            $this->settings->add($settings);
        }
    }

    public function removeSettings(Settings $settings)
    {
        $this->settings->remove($settings);
    }

    public function isCrypto()
    {
        return $this->withCurrency->isCrypto() && $this->currency->isCrypto();
    }

    public function setBasePrecision($basePrecision)
    {
        $this->basePrecision = $basePrecision;
        return $this;
    }

    public function getBasePrecision()
    {
        return $this->basePrecision;
    }

    public function setQuotePrecision($quotePrecision)
    {
        $this->quotePrecision = $quotePrecision;
        return $this;
    }

    public function getQuotePrecision()
    {
        return $this->quotePrecision;
    }

    public function setPricePrecision($pricePrecision)
    {
        $this->pricePrecision = $pricePrecision;
        return $this;
    }

    public function getPricePrecision()
    {
        return $this->pricePrecision;
    }

    public function getLastPrice()
    {
        return $this->lastPrice;
    }

    public function setLastPrice($lastPrice)
    {
        $this->lastPrice = $lastPrice;
    }

    public function getTodayOpenPrice()
    {
        return $this->todayOpenPrice;
    }

    public function setTodayOpenPrice($todayOpenPrice)
    {
        $this->todayOpenPrice = $todayOpenPrice;
    }

    public function getVolume24()
    {
        return $this->volume24;
    }

    public function setVolume24($volume24)
    {
        $this->volume24 = $volume24;
    }

    public function getMinAmount()
    {
        return $this->minAmount;
    }

    public function setMinAmount($minAmount)
    {
        $this->minAmount = $minAmount;
    }

    public function getFirstCurrencyCodeFromPair()
    {
        if ($slug = $this->getSlug()) {
            return explode('-', $slug)[0];
        }

        return '';
    }
}
