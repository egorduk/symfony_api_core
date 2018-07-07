<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_verification")
 * @ORM\Entity
 */
class Verification
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="verification")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="UserBusinessInfo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="business_info_id", referencedColumnName="id")
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\UserBusinessInfo")
     */
    private $businessInfo;

    /**
     * @ORM\OneToOne(targetEntity="UserPersonalInfo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personal_info_id", referencedColumnName="id")
     * @Groups({"api"})
     * @Type("Btc\CoreBundle\Entity\UserPersonalInfo")
     */
    private $personalInfo;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     * @Groups({"api"})
     * @Type("DateTime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     * @Type("DateTime")
     */
    private $updatedAt;

    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setBusinessInfo(UserBusinessInfo $businessInfo = null)
    {
        $this->businessInfo = $businessInfo;
        return $this;
    }

    public function getBusinessInfo()
    {
        return $this->businessInfo;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getPersonalInfo()
    {
        return $this->personalInfo;
    }

    public function setPersonalInfo($personalInfo)
    {
        $this->personalInfo = $personalInfo;
    }
}
