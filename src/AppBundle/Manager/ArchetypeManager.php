<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Archetype;
use Doctrine\ORM\EntityNotFoundException;
use AppBundle\Repository\ArchetypeRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;

/**
 * Class ArchetypeManager.
 */
class ArchetypeManager implements ManagerInterface
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
     * Get Archetype by id or throw exception.
     *
     * @param int $id
     *
     * @return Archetype
     *
     * @throws EntityNotFoundException
     */
    public function getById($id)
    {
        /** @var Archetype $archetype */
        $archetype = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$archetype instanceof Archetype) {
            throw new EntityNotFoundException('Archetype not found!');
        }

        return $archetype;
    }

    /**
     * @return ArchetypeRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Archetype');
    }
}
