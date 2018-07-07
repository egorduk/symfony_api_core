<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Setting extends Constraint
{
    public $message = "%string%";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
