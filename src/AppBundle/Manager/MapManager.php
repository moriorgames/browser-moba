<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Entity\MapTile;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\MapRepository;

/**
 * Class MapManager
 * @package AppBundle\Manager
 */
class MapManager
{
    const TILE = 112;
    const INCREMENTAL_TOP = 28;
    const INCREMENTAL_LEFT = 83;

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
     * @param Map $map
     * @return array
     */
    public function createView(Map $map)
    {
        $tiles = [];

        for ($top = 1; $top <= $map->getHeight(); $top++) {

            for ($left = 0; $left <= $map->getWidth(); $left++) {

                if ($top % 2 === 0 && $left % 2 === 0) {
                    continue;
                }
                if ($top % 2 === 1 && $left % 2 === 1) {
                    continue;
                }

                $tiles[] = [
                    'id' => 'x_' . $left . '_y_' . $top,
                    'class' => 'grass',
                    'top' => self::INCREMENTAL_TOP * $top,
                    'left' => self::INCREMENTAL_LEFT * $left + 20,
                    'y' => $top,
                    'x' => $left,
                ];

            }

        }

        return $tiles;
    }

    /**
     * @return MapRepository
     */
    public function getTiles()
    {
        return $this->em
            ->getRepository('AppBundle:Tile')
            ->findAll();
    }

    /**
     * @return MapRepository
     */
    public function mapRepository()
    {
        return $this->em->getRepository('AppBundle:Map');
    }
}
