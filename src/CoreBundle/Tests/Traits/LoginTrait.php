<?php

namespace CoreBundle\Tests\Traits;

use MoriorGames\UserBundle\Entity\User;
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->em
            ->getRepository('UserBundle:User')
            ->find(1);
    }
}
