<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        //if (!preg_match('/((?=.*[\d])(?=.*[a-z])(?=.*[A-Z])|(?=.*[^\w\d\s])(?=.*[a-z]))(?=.*[A-Z]).*$/', $value, $matches)) {
        if (!preg_match('/^.*[a-z]+.*$/', $value, $matches)) {
            $this->context->addViolation($constraint->message, ['%string%' => "Password should have at least one lowercase"]);
        }
        if (!preg_match('/^.*[A-Z]+.*$/', $value, $matches)) {
            $this->context->addViolation($constraint->message, ['%string%' => "Password should have at least one uppercase"]);
        }
        if (!preg_match('/^.*[0-9]+.*$/', $value, $matches)) {
            $this->context->addViolation($constraint->message, ['%string%' => "Password should have at least one digit"]);
        }
    }

}
