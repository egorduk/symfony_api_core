<?php
namespace Btc\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fee_action")
 */
class FeeAction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", name="for_market")
     */
    private $forMarket;

    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setForMarket($forMarket)
    {
        $this->forMarket = $forMarket;
        return $this;
    }

    public function isForMarket()
    {
        return (bool)$this->forMarket;
    }
}
