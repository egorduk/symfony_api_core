<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Btc\CoreBundle\Entity\Settings;

class SettingValidator extends ConstraintValidator
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
        if (!$value instanceof Settings) {
            return;
        }

        // price margin
        if (preg_match('/-price-margin$/', $value->getSlug())) {
            $percent = (double)$value->getValue();
            if ($percent <= 0) {
                $this->context->addViolationAt('value', $constraint->message, [
                    '%string%' => "Percentage must be higher than 0",
                ]);
            } elseif ($percent > 3) {
                $this->context->addViolationAt('value', $constraint->message, [
                    '%string%' => "Percentage cannot be higher than 3",
                ]);
            }
        }

        // min order amount
        if (preg_match('/-min-order-amount$/', $value->getSlug())) {
            $min = (double)$value->getValue();
            if ($min <= 0) {
                $this->context->addViolationAt('value', $constraint->message, [
                    '%string%' => "Min order amount, cannot be less or 0",
                ]);
            }
        }
    }
}
