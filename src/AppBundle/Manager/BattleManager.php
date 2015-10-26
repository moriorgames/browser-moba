<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Battle;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\BattleRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     */
    public function getById($id)
    {
        /** @var Battle $battle */
        $battle = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$battle instanceof Battle) {
            throw new NotFoundHttpException('Map not found!');
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
     * @return bool
     */
    public function isUserInBattle()
    {
    }
}
