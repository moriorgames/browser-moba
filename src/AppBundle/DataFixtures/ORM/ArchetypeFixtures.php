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
                ->setArmor(1)
                ->setHitPoints(1)
                ->setMagicDamage(1)
                ->setMagicPoints(1)
                ->setMagicResistance(1)
                ->setName($name)
                ->setPhysicalDamage(1)
                ->setSlug('slug');
            $manager->persist($archetype);

        }

        $manager->flush();
    }
}
