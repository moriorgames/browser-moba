<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Hero;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\HeroRepository;
use Doctrine\ORM\EntityNotFoundException;
use CoreBundle\Manager\Interfaces\ManagerInterface;

/**
 * Class HeroManager.
 */
class HeroManager implements ManagerInterface
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
     * @return Hero
     *
     * @throws EntityNotFoundException
     */
    public function getById($id)
    {
        /** @var Hero $hero */
        $hero = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$hero instanceof Hero) {
            throw new EntityNotFoundException();
        }

        return $hero;
    }

    /**
     * @return HeroRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Hero');
    }
}
