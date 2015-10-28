<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Hero;
use AppBundle\Entity\Archetype;
use Doctrine\ORM\EntityRepository;
use MoriorGames\UserBundle\Entity\User;

/**
 * Class ArchetypeRepository.
 */
class HeroRepository extends EntityRepository
{
    public function createHeroFromArchetype(Archetype $archetype, User $user)
    {
        $hero = new Hero();
        $hero
            ->setUser($user)
            ->setName($archetype->getName())
            ->setSlug($archetype->getSlug())
            ->setHitPoints($archetype->getHitPoints())
            ->setMagicPoints($archetype->getMagicPoints())
            ->setMagicDamage($archetype->getMagicDamage())
            ->setPhysicalDamage($archetype->getPhysicalDamage())
            ->setStructuralDamage($archetype->getStructuralDamage())
            ->setArmor($archetype->getArmor())
            ->setMagicResistance($archetype->getMagicResistance())
            ->setExperience(0);
        $this->_em->persist($hero);
        $this->_em->flush();
    }
}
