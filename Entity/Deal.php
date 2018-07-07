<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="deals")
 */
class Deal implements RestEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="deal", cascade={"persist"})
     */
    private $transactions;
    
    
    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
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

    public function getAmount()
    {
        $amount = 0;

        foreach ($this->transactions as $transaction) {
            if ($transaction->getAmount() > 0) {
                $amount += $transaction->getAmount();
            }
        }

        return $amount;
    }

    public function getValue()
    {
        $value = 0;

        foreach ($this->transactions as $transaction) {
            $value += $transaction->getValue();
        }

        return $value / 2;
    }

    public function getFeesCollected()
    {
        $feesCollected = 0;

        foreach ($this->transactions as $transaction) {
            if ($transaction->getOrder()) {
                $feesCollected += $transaction->getFee();
            }
        }

        return $feesCollected;
    }

    public function getMarket()
    {
        return $this->transactions->first()->getMarket();
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

    public function removeTransactions($key)
    {
        $this->transactions->remove($key);
    }

}
