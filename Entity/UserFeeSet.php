<?php
namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_fee_set")
 */
class UserFeeSet implements RestEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="FeeSet")
     * @ORM\JoinColumn(name="fee_set_id", referencedColumnName="id", nullable=false)
     */
    private $feeSet;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="expires_at", nullable=true)
     */
    private $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="FeeSet")
     * @ORM\JoinColumn(name="fallback_fee_set_id", referencedColumnName="id", nullable=false)
     */
    private $fallbackFeeSet;

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

    public function setFeeSet(FeeSet $feeSet)
    {
        $this->feeSet = $feeSet;
        return $this;
    }

    public function getFeeSet()
    {
        return $this->feeSet;
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

    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setFallbackFeeSet(FeeSet $fallbackFeeSet)
    {
        $this->fallbackFeeSet = $fallbackFeeSet;
        return $this;
    }

    public function getFallbackFeeSet()
    {
        return $this->fallbackFeeSet;
    }
}
