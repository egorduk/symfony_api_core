<?php

namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
abstract class TransferLog
{
    const TYPE_IPN_RECEIVED = 'ipn.received';
    const TYPE_API = 'api';
    // Crypto coin received
    const TYPE_TX_IN = 'tx.in';
    const TYPE_TX_OUT = 'tx.out';

    const STATUS_INFO = 'info';
    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Type of the log, or event name why it occurred. Possible:
     *  admin - someone from backend triggered the change.
     *
     * @ORM\Column()
     */
    private $type;

    /**
     * Status type of this log. Possible:
     *  error - ipn error, api error
     *  success - everything went fine
     *  info - informational log
     *
     * @ORM\Column()
     */
    private $status;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="text")
     */
    private $data;

    /**
     * Date of the Transfer entry creation.
     *
     * This date represents when user made request to transfer currency.
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Date of the Transfer entry status change.
     *
     * Initially status is Pending, until callback or proof of the transfer
     * is received or manual intervention has confirmed it.
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * Should return either deposit or withdrawal object to which its referenced
     *
     * @return object
     */
    abstract public function getReferencedTransfer();

    /**
     * @param object $referenced
     * @return self
     */
    abstract public function setReferencedTransfer($referenced);

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = base64_encode(serialize($data));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return unserialize(base64_decode($this->data));
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
