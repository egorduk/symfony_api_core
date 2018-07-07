<?php

namespace Btc\CoreBundle\Entity\Withdraw;

use Btc\CoreBundle\Entity\RestEntityInterface;
use Btc\CoreBundle\Entity\Transfer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="withdraw")
 */
class Withdraw extends Transfer implements RestEntityInterface
{
    const WITHDRAW_TYPE = 'withdraw';

    public function __construct()
    {
        parent::__construct();
    }
}
