<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Hotp extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Key %string% is invalid';

    /**
     * @var string
     */
    public $field = '';

    /**
     * @inheritdoc
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
