<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DecimalValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[0-9]{1,8}(\.[0-9]{1,8})$/', $value, $matches)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
