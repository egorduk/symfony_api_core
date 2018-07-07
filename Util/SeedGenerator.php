<?php

namespace Btc\CoreBundle\Util;

use Rych\OTP\Seed;

/**
 * Class SeedGenerator
 */
class SeedGenerator implements SeedGeneratorInterface
{
    /**
     * @inheritdoc
     */
    public function getSeed()
    {
        $seed = Seed::generate();
        return $seed->getValue(Seed::FORMAT_BASE32);
    }
}
