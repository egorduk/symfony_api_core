<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Btc\CoreBundle\Entity\Plan\Payment\Limit;

class PaymentLimitValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $protocol The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($protocol, Constraint $constraint)
    {
        if (!$protocol instanceof Limit) {
            throw new UnexpectedTypeException($protocol, "Btc\CoreBundle\Entity\Plan\Payment\Limit");
        }

        $zero = function($v) {
            return bccomp($v, 0, 8) === 0;
        };

        $unlimited = $zero($protocol->getDaily());
        if ($unlimited && (!$zero($protocol->getWeekly()) || !$zero($protocol->getMonthly()))) {
            $this->context->addViolationAt('daily', $constraint->message);
        } elseif (!$unlimited && ($zero($protocol->getWeekly()) || $zero($protocol->getMonthly()))) {
            $this->context->addViolationAt('daily', $constraint->message);
        }
    }
}
