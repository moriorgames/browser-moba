<?php

namespace AppBundle\DataFixtures\ORM;

use DateTime;
use CoreBundle\Constants;
use AppBundle\Entity\Battle;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ArchetypeFixtures.
 */
class BattleFixtures
{
    /**
     * loadBattles from the file to the database.
     *
     * @param ObjectManager $manager
     */
    public function loadBattles(ObjectManager $manager)
    {
        $battle = new Battle();
        $battle
            ->setName('First battle')
            ->setSlug('First battle')
            ->setUpdatedAt(new DateTime())
            ->setCreatedAt(new DateTime())
            ->setBattleType(Constants::BATTLE_TYPE_5_VS_5);
        $manager->persist($battle);

        $manager->flush();
    }
}
