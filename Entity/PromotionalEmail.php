<?php

namespace Btc\InvitationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="promotional_email", indexes={@ORM\Index(name="hash_idx", columns={"hash"})})
 */
class PromotionalEmail
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(length=255, unique=true)
     * @Assert\NotBlank(message="core_user.email.blank")
     * @Assert\Email(message="core_user.email.invalid")
     */
    private $email;

    /**
     * @ORM\Column()
     */
    private $hash;

    /**
     * @ORM\Column(type="boolean")
     */
    private $registered;

    public function __construct()
    {
        $this->hash = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->registered = false;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
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

    public function getHash()
    {
        return $this->hash;
    }

    public function setRegistered($registered)
    {
        $this->registered = $registered;
        return $this;
    }

    public function isRegistered()
    {
        return (bool)$this->registered;
    }
}
