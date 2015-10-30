<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Battle;
use CoreBundle\Constants;
use Doctrine\ORM\EntityManager;
use MoriorGames\UserBundle\Entity\User;
use Doctrine\ORM\EntityNotFoundException;
use AppBundle\Repository\BattleRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;

/**
 * Class BattleManager.
 */
class BattleManager implements ManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $id
     *
     * @return Battle
     *
     * @throws EntityNotFoundException
     */
    public function getById($id)
    {
        /** @var Battle $battle */
        $battle = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$battle instanceof Battle) {
            throw new EntityNotFoundException();
        }

        return $battle;
    }

    /**
     * @return BattleRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Battle');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isUserInBattle(User $user)
    {
        return $this->getRepository()->isUserInBattle($user);
    }

    /**
     *
     */
    public function createBattle()
    {
        $battle = new Battle();
        $battle
            ->setName('new battle')
            ->setSlug('new battle')
            ->setBattleType(Constants::BATTLE_TYPE_5_VS_5);
        $this->em->persist($battle);
        $this->em->flush();
    }
}
