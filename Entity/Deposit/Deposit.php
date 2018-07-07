<?php

namespace Btc\CoreBundle\Entity\Deposit;

use Btc\CoreBundle\Entity\RestEntityInterface;
use Btc\CoreBundle\Entity\Transfer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="deposit")
 */
class Deposit extends Transfer implements RestEntityInterface
{
    const DEPOSIT_TYPE = 'deposit';

    public function __construct()
    {
        parent::__construct();
    }
}
