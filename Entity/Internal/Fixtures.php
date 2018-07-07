<?php

namespace Btc\CoreBundle\Entity\Internal;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="fixtures")
 * @ORM\Entity
 */
class Fixtures
{
    /**
     * @ORM\Column(length=255)
     * @ORM\Id
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
