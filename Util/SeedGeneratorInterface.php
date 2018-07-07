<?php

namespace Btc\CoreBundle\Util;

/**
 * Interface SeedGeneratorInterface
 *
 * Used for seed generation in Two factor authentication secret
 *
 * @package Btc\UserBundle\Util
 */
interface SeedGeneratorInterface
{
    /**
     * Returns base32 encoded secret key
     *
     * @return string A base32 encoded secret key
     */
    public function getSeed();
}
