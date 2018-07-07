<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="phone_verification")
 */
class PhoneVerification
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Assert\NotBlank(groups={"api"})
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     */
    private $pin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sent;

    public function __construct()
    {
        $this->confirmed = false;
        $this->sent = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param mixed $pin
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function isConfirmed()
    {
        return $this->confirmed === true;
    }

    public function confirm()
    {
        $this->confirmed = true;
        return $this;
    }

    public function setSent($sent)
    {
        $this->sent = (bool)$sent;
        return $this;
    }

    public function isSent()
    {
        return $this->sent === true;
    }
}
