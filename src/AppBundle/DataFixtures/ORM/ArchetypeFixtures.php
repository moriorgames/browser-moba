<?php

namespace AppBundle\DataFixtures\ORM;

use CoreBundle\Constants;
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
                ->setPhysicalDamage(1)
                ->setMagicDamage(1)
                ->setStructuralDamage(1)
                ->setHitPoints(1)
                ->setMagicPoints(1)
                ->setArmor(1)
                ->setMagicResistance(1)
                ->setAgility(1)
                ->setMovement(1)
                ->setRegeneration(1)
                ->setFighterType(Constants::FIGHTER_PLAYER)
                ->setStability(1);
            $manager->persist($archetype);
        }

        $manager->flush();
    }
}
