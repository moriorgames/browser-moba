<?php

namespace CoreBundle\Tests\Traits;

use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class LoginTrait.
 */
trait LoginTrait
{
    /**
     * @return Client
     */
    public function loginAsAdmin()
    {
        return static::createClient([], [
            'PHP_AUTH_USER' => PHPUNIT_ADMIN_USER,
            'PHP_AUTH_PW' => PHPUNIT_ADMIN_PASS,
        ]);
    }
}
