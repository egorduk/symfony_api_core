<?php

namespace Btc\CoreBundle\Util;

/**
 * Username/Password generator
 */
class Generator implements GeneratorInterface
{
    private $passwordChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * {@inheritDoc}
     */
    public function generateUsername()
    {
        // @TODO this could be a better generator
        return 'V' . mt_rand(100000, 999999);
    }

    /**
     * {@inheritDoc}
     */
    public function generatePassword()
    {
        return substr(str_shuffle($this->passwordChars), 0, 12);
    }
}
