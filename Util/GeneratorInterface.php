<?php

namespace Btc\CoreBundle\Util;

interface GeneratorInterface
{
    /**
     * Generates and returns a random username
     *
     * @return string
     */
    public function generateUsername();

    /**
     * Generates and returns a random password
     *
     * @return string
     */
    public function generatePassword();
}
