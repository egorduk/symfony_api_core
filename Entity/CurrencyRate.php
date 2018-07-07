<?php namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency_rate",
 *  uniqueConstraints={
 *      @ORM\UniqueConstraint(
 *          name="currency_date_idx",
 *          columns={"rated_at", "currency_id"}
 *      )
 *  })
 */
class CurrencyRate
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     */
    private $currency;

    /**
     * @ORM\Column(type="date", name="rated_at")
     */
    private $ratedAt;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $rate;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
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

    public function setRatedAt(\DateTime $ratedAt)
    {
        $this->ratedAt = $ratedAt;
        return $this;
    }

    public function getRatedAt()
    {
        return $this->ratedAt;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setCreatedAt(\DateTime $created)
    {
        $this->createdAt = $created;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
