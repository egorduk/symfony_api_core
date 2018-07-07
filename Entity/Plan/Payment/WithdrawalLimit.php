<?php

namespace Btc\CoreBundle\Entity\Plan\Payment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="plan_payment_limit_withdrawals")
 */
class WithdrawalLimit extends Limit
{
}
