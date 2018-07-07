<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PaymentLimit extends Constraint
{
    /**
     * @var string
     */
    public $message = 'All periodical limits need to be either unlimited or set.';

    /**
     * @inheritdoc
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
