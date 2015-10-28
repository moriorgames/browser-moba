<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Hero;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\HeroRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @return Hero|NotFoundHttpException
     */
    public function getById($id)
    {
        /** @var Hero $hero */
        $hero = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$hero instanceof Hero) {
            throw new NotFoundHttpException('Hero not found!');
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
