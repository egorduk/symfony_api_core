<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="api_key")
 * @ORM\Entity
 */
class ApiKey
{
    const PERM_TRADES = "ROLE_TRADES";
    const PERM_ACCOUNT = "ROLE_ACCOUNT";
    const PERM_VOUCHERS = "ROLE_VOUCHERS";

    /**
     * @ORM\Column(length=25, unique=true, name="`key`")
     * @ORM\Id
     */
    private $key;

    /**
     * @ORM\Column(length=50)
     */
    private $secret;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Permissions for this api key
     *
     * @ORM\Column(type="array")
     */
    private $permissions = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;


    public function __construct(User $user, $active = false)
    {
        $this->user = $user;
        $this->active = $active;
        // generate unique keys
        $this->secret = strtoupper(base_convert(hash_hmac('sha256', uniqid(mt_rand(), true), 'btc-x-api-key'), 16, 36));
        $this->key = strtoupper(base_convert(hash_hmac('ripemd128', uniqid(mt_rand(), true), 'btc-x-api-secret'), 16, 36));
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function hasPermission($permission)
    {
        return in_array(strtoupper($permission), $this->getPermissions(), true);
    }

    public function setPermissions(array $permissions)
    {
        $this->permissions = [];

        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }

        return $this;
    }

    public function addPermission($permission)
    {
        $permission = strtoupper($permission);

        if (!in_array($permission, $this->permissions, true)) {
            $this->permissions[] = $permission;
        }

        return $this;
    }

    public function removePermission($permission)
    {
        $permission = strtoupper($permission);
        if (in_array($permission, $this->permissions, true)) {
            unset($this->permissions[$permission]);
        }
        return $this;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = (bool)$active;

        return $this;
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

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
