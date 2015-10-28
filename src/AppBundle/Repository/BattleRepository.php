<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Battle;
use Doctrine\ORM\EntityRepository;
use MoriorGames\UserBundle\Entity\User;

/**
 * Class MapRepository.
 */
class BattleRepository extends EntityRepository
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function isUserInBattle(User $user)
    {
        $battle = $this->createQueryBuilder('b')
            ->join('AppBundle:Hero', 'h')
            ->where('h.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();

        if ($battle instanceof Battle) {
            return true;
        }

        return false;
    }
}
