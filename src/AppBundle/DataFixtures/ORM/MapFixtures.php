<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Map;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class MapFixtures.
 */
class MapFixtures
{
    /**
     * @param ObjectManager $manager
     */
    public function loadMaps(ObjectManager $manager)
    {
        $map = new Map();
        $map
            ->setName('Base Map')
            ->setEnabled(true)
            ->setHeight(17)
            ->setWidth(10);

        $manager->persist($map);
        $manager->flush();
    }
}
