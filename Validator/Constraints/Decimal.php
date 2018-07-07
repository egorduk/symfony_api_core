<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Decimal extends Constraint
{
    public $message = 'Decimal value is invalid';
}
