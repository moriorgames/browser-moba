<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Map;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\MapRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MapManager.
 */
class MapManager implements ManagerInterface
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
     * Get Map by id or throw exception.
     *
     * @param int $id
     *
     * @return Map|NotFoundHttpException
     */
    public function getById($id)
    {
        /** @var Map $map */
        $map = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$map instanceof Map) {
            throw new NotFoundHttpException('Map not found!');
        }

        return $map;
    }

    /**
     * @return MapRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Map');
    }

    /**
     * @param Map $map
     */
    public function persistMap(Map $map)
    {
        try {
            $this->em->persist($map);
            $this->em->flush();
        } catch (ORMException $e) {
            echo 'Fail when persist: '.$e->getMessage()."\n";
        }
    }

    /**
     * @todo this function has to be implemented
     *
     * @param Map $map
     *
     * @return array
     */
    public function createView(Map $map)
    {
        $tiles = [];

        return $tiles;
    }
}
