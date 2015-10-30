<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Map;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\MapRepository;
use Doctrine\ORM\EntityNotFoundException;
use CoreBundle\Manager\Interfaces\ManagerInterface;

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
     * @return Map
     *
     * @throws EntityNotFoundException
     */
    public function getById($id)
    {
        /** @var Map $map */
        $map = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$map instanceof Map) {
            throw new EntityNotFoundException();
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
}
