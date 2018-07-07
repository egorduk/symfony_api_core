<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Rych\OTP\HOTP as OTP;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class HotpValidator extends ConstraintValidator
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
        if (!$protocol instanceof HotpProviderInterface) {
            throw new UnexpectedTypeException(
                $protocol,
                'Btc\CoreBundle\Validator\Constraints\HotpProviderInterface'
            );
        }
        if (!$protocol->hasHOTP()) {
            return;
        }
        $hotp = new OTP($protocol->getHotpAuthKey());

        if (!$hotp->validate($protocol->getAuthCode(), $protocol->getHotpAuthCounter())) {
            if (!$constraint->field) {
                $this->context->addViolation($constraint->message, ['%string%' => $protocol->getAuthCode()]);
            } else {
                $this->context->addViolationAt($constraint->field, $constraint->message, ['%string%' => $protocol->getAuthCode()]);
            }
        }
    }
}
