<?php

namespace AppBundle\Repository;

use CoreBundle\Constants;
use AppBundle\Entity\Hero;
use AppBundle\Entity\Archetype;
use Doctrine\ORM\EntityRepository;
use MoriorGames\UserBundle\Entity\User;

/**
 * Class ArchetypeRepository.
 */
class HeroRepository extends EntityRepository
{
    /**
     * @param Archetype $archetype
     * @param User      $user
     *
     * @return Hero
     */
    public function createHeroFromArchetype(Archetype $archetype, User $user)
    {
        $hero = new Hero();
        $hero
            ->setUser($user)
            ->setName($archetype->getName())
            ->setPhysicalDamage($archetype->getPhysicalDamage())
            ->setMagicDamage($archetype->getMagicDamage())
            ->setStructuralDamage($archetype->getStructuralDamage())
            ->setHitPoints($archetype->getHitPoints())
            ->setHitPointsRest($archetype->getHitPoints())
            ->setMagicPoints($archetype->getMagicPoints())
            ->setMagicPointsRest($archetype->getMagicPoints())
            ->setArmor($archetype->getArmor())
            ->setMagicResistance($archetype->getMagicResistance())
            ->setAgility($archetype->getAgility())
            ->setMovement($archetype->getMovement())
            ->setRegeneration($archetype->getRegeneration())
            ->setFighterType(Constants::FIGHTER_PLAYER)
            ->setExperience(0);

        return $hero;
    }

    /**
     * @param Hero $hero
     */
    public function persistHero(Hero $hero)
    {
        $this->_em->persist($hero);
        $this->_em->flush();
    }
}
