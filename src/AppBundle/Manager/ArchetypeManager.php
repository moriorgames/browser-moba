<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Archetype;
use AppBundle\Repository\ArchetypeRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @return Archetype|NotFoundHttpException
     */
    public function getById($id)
    {
        /** @var Archetype $archetype */
        $archetype = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$archetype instanceof Archetype) {
            throw new NotFoundHttpException('Archetype not found!');
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
