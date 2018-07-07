<?php

namespace Btc\CoreBundle\Validator\Constraints;

interface TotpProviderInterface
{
    /**
     * @return string - authorization key, unique to owner
     */
    function getAuthKey();

    /**
     * @return string - OTP code based on authorization key
     */
    function getAuthCode();

    /**
     * @return boolean
     */
    function hasTOTP();
}
