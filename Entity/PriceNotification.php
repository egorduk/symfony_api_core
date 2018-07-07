<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="price_notifications")
 */
class PriceNotification
{
    const STATUS_OPEN = 1; // waiting for price match
    const STATUS_SENT = 2; // price notification was sent
    const STATUS_CANCELED = 3; // price notification was cancelled

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank(message="core_user.email.blank")
     * @Assert\Email(message="core_user.email.invalid")
     */
    private $email;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     * @Assert\NotBlank(message="core_trade.price.blank")
     * @Assert\GreaterThan(message="core_trade.price.zero_or_negative", value=0)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8, name="current_price")
     */
    private $currentPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Market")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=false)
     */
    private $market;

    /**
     * @ORM\Column(length=40)
     */
    private $hash;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = self::STATUS_OPEN;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    public function setCreatedAt(\DateTime $created)
    {
        $this->createdAt = $created;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
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

    public function setMarket(Market $market)
    {
        $this->market = $market;
        return $this;
    }

    public function getMarket()
    {
        return $this->market;
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

    public function getHash()
    {
        return $this->hash;
    }

    public function generateHash()
    {
        $this->hash = sha1($this->email . $this->price . time());
    }

    public function getCurrentPrice()
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice($currentPrice)
    {
        $this->currentPrice = $currentPrice;
    }
}
