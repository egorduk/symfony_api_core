<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RestrictedCountry extends Constraint
{
    public $message = "%country% is restricted";
}
