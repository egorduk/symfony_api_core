<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotAllowedEmailsValidator extends ConstraintValidator
{
    private $notAllowed = [
        'newsletter@exmarkets.com'
    ];

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        if (in_array(strtolower($value), $this->notAllowed)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}