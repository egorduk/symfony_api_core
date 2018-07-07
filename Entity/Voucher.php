<?php
namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="vouchers", indexes={@ORM\Index(name="code_idx", columns={"code"})})
 */
class Voucher
{
    const STATUS_OPEN = 1;
    const STATUS_REDEEMED = 2;

    const STATUS_ANY_STR = 'any';
    const STATUS_OPEN_STR = 'open';
    const STATUS_REDEEMED_STR = 'redeemed';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"api"})
     * @Type("string")
     */
    private $code;

    /**
     * @ORM\Column(name="amount", type="decimal", precision=24, scale=8, nullable=false)
     * @Groups({"api"})
     * @Type("string")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", cascade={"persist"})
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\Currency")
     */
    private $currency;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"api"})
     * @Type("integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="created_by_user_id", referencedColumnName="id", nullable=false)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\User")
     */
    private $createdByUser;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="redeemed_by_user_id", referencedColumnName="id", nullable=true)
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\User")
     */
    private $redeemedByUser;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="redeemed_at", nullable=true)
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $redeemedAt;


    public function __construct()
    {
        $this->status = self::STATUS_OPEN;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return (double)$this->amount;
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

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCreatedByUser(User $user)
    {
        $this->createdByUser = $user;
        return $this;
    }

    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }

    public function setRedeemedByUser(User $user)
    {
        $this->redeemedByUser = $user;
        return $this;
    }

    public function getRedeemedByUser()
    {
        return $this->redeemedByUser;
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

    public function setRedeemedAt(\DateTime $redeemedAt)
    {
        $this->redeemedAt = $redeemedAt;
        return $this;
    }

    public function getRedeemedAt()
    {
        return $this->redeemedAt;
    }
}
