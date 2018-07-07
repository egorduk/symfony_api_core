<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_activity")
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"system", "dashboard", "private", "api"})
     * @Type("integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="activities")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Groups({"system", "dashboard", "private"})
     */
    private $user;

    /**
     * Values as: btc_user.security.two_factor_enabled, btc_user.security.two_factor_disabled, btc_user.security.profile_edit_completed,
     * btc_user.security.registration_completed, btc_user.security.login, btc_user.security.limit_buy, btc_user.security.limit_sell,
     * btc_user.security.market_buy,btc_user.security.market_sell, btc_user.security.preferences_updated, btc_user.security.login_custom,
     * btc_user.security.change_password_completed
     *
     * @ORM\Column
     * @Groups({"system", "dashboard", "private", "api"})
     * @Type("string")
     */
    private $action;

    /**
     * @ORM\Column(name="ip_address")
     * @Groups({"system", "dashboard", "private", "api"})
     * @Type("string")
     */
    private $ipAddress;

    /**
     * @ORM\Column(name="additional_info", type="array")
     * @Groups({"system", "dashboard", "private", "api"})
     * @Type("array")
     */
    private $additionalInfo = [];

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     * @Groups({"system", "dashboard", "private", "api"})
     * @Type("DateTime")
     */
    private $createdAt;

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $created
     */
    public function setCreatedAt(\DateTime $created)
    {
        $this->createdAt = $created;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Serializes and stores additional data related to activity
     *
     * @param mixed $params
     */
    public function setAdditionalInfo(array $params = [])
    {
        $this->additionalInfo = $params;
    }

    /**
     * Returns unserialized additional data
     *
     * @return mixed
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }
}
