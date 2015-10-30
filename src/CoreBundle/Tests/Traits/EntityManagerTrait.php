<?php

namespace CoreBundle\Tests\Traits;

use Doctrine\ORM\EntityManager;

trait EntityManagerTrait
{
    /**
     * Creates an entity manager in the test classes.
     *
     * @return EntityManager
     */
    public function createEntityManager()
    {
        self::bootKernel();

        return static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}
