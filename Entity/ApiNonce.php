<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="api_nonce")
 * @ORM\Entity
 */
class ApiNonce
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    private $nonce;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="ApiKey")
     * @ORM\JoinColumn(
     *   name="api_key_id",
     *   referencedColumnName="key",
     *   nullable=false,
     *   onDelete="CASCADE"
     * )
     */
    private $apiKey;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function setApiKey(ApiKey $apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    public function getNonce()
    {
        return $this->nonce;
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
}
