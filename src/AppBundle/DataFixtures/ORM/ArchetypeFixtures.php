<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Archetype;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ArchetypeFixtures.
 */
class ArchetypeFixtures
{
    /**
     * Load the basic archetypes from the file to the database.
     *
     * @param ObjectManager $manager
     */
    public function loadArchetypes(ObjectManager $manager)
    {
        $names = ['dps', 'tank', 'healer'];
        foreach ($names as $name) {
            $archetype = new Archetype();
            $archetype
                ->setName($name)
                ->setSlug($name)
                ->setHitPoints(1)
                ->setMagicPoints(1)
                ->setMagicDamage(1)
                ->setPhysicalDamage(1)
                ->setArmor(1)
                ->setMagicResistance(1)
                ->setStability(1);
            $manager->persist($archetype);
        }

        $manager->flush();
    }
}
