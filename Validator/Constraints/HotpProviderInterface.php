<?php

namespace Btc\CoreBundle\Validator\Constraints;

interface HotpProviderInterface
{
    /**
     * @return string - authorization key, unique to owner
     */
    function getHotpAuthKey();

    /**
     * @return string - OTP code based on authorization key
     */
    function getAuthCode();

    /**
     * @return integer - hotp auth counter
     */
    function getHotpAuthCounter();

    /**
     * @return boolean
     */
    function hasHOTP();
}
