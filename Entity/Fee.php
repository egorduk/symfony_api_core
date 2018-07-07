<?php

namespace Btc\CoreBundle\Entity;

use Btc\CoreBundle\Validator\Constraints\Decimal;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fee")
 */
class Fee
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FeeSet", inversedBy="fees", cascade={"persist"})
     * @ORM\JoinColumn(name="fee_set_id", referencedColumnName="id", nullable=false)
     */
    private $feeSet;

    /**
     * @ORM\ManyToOne(targetEntity="FeeAction")
     * @ORM\JoinColumn(name="fee_action_id", referencedColumnName="id", nullable=false)
     */
    private $feeAction;

    /**
     * @ORM\ManyToOne(targetEntity="Market")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", nullable=true)
     */
    private $market;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     */
    private $fixed = 0;

    /**
     * @ORM\Column(type="decimal", precision=24, scale=8)
     *
     * @Decimal()
     */
    private $percent = 0;


    public function getId()
    {
        return $this->id;
    }

    public function setFeeSet(FeeSet $feeSet)
    {
        $this->feeSet = $feeSet;
        return $this;
    }

    public function getFeeSet()
    {
        return $this->feeSet;
    }

    public function setFeeAction(FeeAction $feeAction)
    {
        $this->feeAction = $feeAction;
        return $this;
    }

    public function getFeeAction()
    {
        return $this->feeAction;
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

    public function setFixed($fixed)
    {
        $this->fixed = $fixed;
        return $this;
    }

    public function getFixed()
    {
        return $this->fixed;
    }

    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    public function getPercent()
    {
        return $this->percent;
    }
}
