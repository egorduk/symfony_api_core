<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
class Currency implements RestEntityInterface
{
    const ANY = 0;
    const VIRTUAL = 1;
    const FIAT = 2;
    
    const ETH_CURRENCY_SERVICE_CODE = 'eth';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * @Groups({"api"})
     * @Type("integer")
     */
    private $id;

    /**
     * Values USD, BTC, EUR, LTC, ETH, BNK
     *
     * @ORM\Column(type="string", length=3)
     * @Groups({"api"})
     * @Type("string")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=3)
     * @Groups({"api"})
     * @Type("string")
     */
    private $sign;

    /**
     * @ORM\Column(type="smallint", name="format_precision")
     * @Groups({"api"})
     * @SerializedName("format")
     * @Type("integer")
     */
    private $precision;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"api"})
     * @Type("boolean")
     */
    private $crypto;

    /**
     * @ORM\Column(type="boolean", name="eth")
     * @Since("2")
     * @Groups({"api_vouchers"})
     * @Type("boolean")
     */
    private $eth;

    /**
     * @ORM\Column(type="boolean", name="is_erc_token")
     * @Since("2")
     * @Groups({"api_vouchers"})
     * @Type("boolean")
     */
    private $isErcToken;

    /**
     * @ORM\Column(type="string", length=255, name="contract_address")
     * @Since("2")
     * @Groups({"api_vouchers"})
     * @Type("string")
     */
    private $contractAddress;

    /**
     * @ORM\Column(type="text", name="contract_abi")
     * @Since("2")
     * @Groups({"api_vouchers"})
     * @Type("string")
     */
    private $contractAbi;


    public function setCrypto($crypto)
    {
        $this->crypto = $crypto;
        return $this;
    }

    public function isCrypto()
    {
        return $this->crypto;
    }

    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    public function getPrecision()
    {
        return $this->precision;
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

    public function getId()
    {
        return $this->id;
    }

    public function setSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }

    public function getSign()
    {
        return $this->sign;
    }

    public function isEth()
    {
        return $this->eth;
    }

    public function setEth($eth)
    {
        $this->eth = $eth;
        return $this;
    }

    public function isToken()
    {
        return $this->isErcToken;
    }

    public function setIsErcToken($isErcToken)
    {
        $this->isErcToken = $isErcToken;
        return $this;
    }

    public function getContractAddress()
    {
        return $this->contractAddress;
    }

    public function setContractAddress($contractAddress)
    {
        $this->contractAddress = $contractAddress;
        return $this;
    }

    public function getContractAbi()
    {
        return $this->contractAbi;
    }

    public function setContractAbi($contractAbi)
    {
        $this->contractAbi = $contractAbi;
        return $this;
    }

    //crafts model which is expeceted by eth-facade
    public function getModelForEthAPI()
    {
        $ret = [
            'isToken' => false
        ];

        if ($this->isToken()) {
            $ret = [
                'isToken' => true,
                'abi' => $this->getContractAbi(),
                'contractAddr' => $this->getContractAddress()
            ];
        }

        return $ret;
    }
}
