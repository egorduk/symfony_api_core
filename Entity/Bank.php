<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="bank")
 */
class Bank implements RestEntityInterface
{
    const PAYMENT_METHOD_WIRE = 'wire';
    const PAYMENT_METHOD_E_CURRENCY = 'e-currency';
    const PAYMENT_METHOD_VIRTUAL_CURRENCY = 'virtual-currency';
    const PAYMENT_METHOD_DEPOSIT_ONLY = 'deposit-only';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * Name of the Bank
     *
     * @ORM\Column(length=64)
     */
    private $name;

    /**
     * Values egopay, payza, okpay, perfect-money, astropay and etc.
     *
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fiat;

    /**
     * Values wire, e-currency, virtual-currency, deposit-only
     *
     * @ORM\Column(name="payment_method", type="string")
     */
    private $paymentMethod;

    /**
     * @ORM\Column(name="deposit_available", type="boolean", options={"default" = 1})
     */
    private $depositAvailable;

    /**
     * @ORM\Column(name="withdrawal_available", type="boolean", options={"default" = 1})
     */
    private $withdrawalAvailable;

    public function __construct()
    {
        $this->paymentMethod = '';
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $fiat
     */
    public function setFiat($fiat)
    {
        $this->fiat = $fiat;
    }

    /**
     * @return mixed
     */
    public function getFiat()
    {
        return $this->fiat;
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

    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function setDepositAvailable()
    {
        $this->depositAvailable = true;
    }

    public function setWithdrawalAvailable()
    {
        $this->withdrawalAvailable = true;
    }

    /**
     * @return bool
     */
    public function isDepositAvailable()
    {
        return $this->depositAvailable;
    }

    /**
     * @return bool
     */
    public function isWithdrawalAvailable()
    {
        return $this->withdrawalAvailable;
    }
}
