<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="operations")
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Btc\CoreBundle\Entity\Wallet")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id", nullable=false)
     */
    private $wallet;

    /**
     * Wallet operation type to record
     *
     * @ORM\Column(length=64)
     */
    private $type;

    /**
     * Reference name based on what operation has happened
     *
     * @ORM\Column(length=32, name="reference_name")
     */
    private $referenceName;

    /**
     * @ORM\Column(type="integer", name="reference_id")
     */
    private $reference;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $available = 0;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $reserved = 0;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $total = 0;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
        return $this;
    }

    public function getWallet()
    {
        return $this->wallet;
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

    public function setReferenceName($referenceName)
    {
        $this->referenceName = $referenceName;
        return $this;
    }

    public function getReferenceName()
    {
        return $this->referenceName;
    }

    public function setReserved($reserved)
    {
        $this->reserved = $reserved;
        return $this;
    }

    public function getReserved()
    {
        return $this->reserved;
    }

    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }
}

