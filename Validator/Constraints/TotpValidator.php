<?php

namespace Btc\CoreBundle\Validator\Constraints;

use Rych\OTP\TOTP as OTP;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TotpValidator extends ConstraintValidator
{
    private $time;

    public function __construct(\DateTime $time = null)
    {
        $this->time = $time ?: new \DateTime();
    }

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
        if (!$protocol instanceof TotpProviderInterface) {
            throw new UnexpectedTypeException(
                $protocol,
                'Btc\CoreBundle\Validator\Constraint\TotpProviderInterface'
            );
        }

        if (!$protocol->hasTOTP()) {
            return;
        }

        $totp = new OTP($protocol->getAuthKey());

        if (!$totp->validate($protocol->getAuthCode(), $this->time->getTimestamp())) {
            if (!$constraint->field) {
                $this->context->addViolation($constraint->message, ['%string%' => $protocol->getAuthCode()]);
            } else {
                $this->context->addViolationAt($constraint->field, $constraint->message, ['%string%' => $protocol->getAuthCode()]);
            }
        }
    }
}
