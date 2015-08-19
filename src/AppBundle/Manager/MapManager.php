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

                $mapTile = $this->getMapTile($left, $top, $map);

                $tiles[] = [
                    'id' => MapManager::generateIdTile($mapTile),
                    'class' => $mapTile->getTile()->getClass(),
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

    /**
     * @param $x
     * @param $y
     * @param Map $map
     * @return MapTile
     */
    public function getMapTile($x, $y, Map $map)
    {
        $mapTile = $this->em
            ->getRepository('AppBundle:MapTile')
            ->findOneBy(
                [
                    'x' => $x,
                    'y' => $y,
                    'map' => $map,
                ]
            );

        if (!$mapTile instanceof MapTile) {
            $tile = $this->em
                ->getRepository('AppBundle:Tile')
                ->findOneByTileType(Tile::TYPE_GRASS);
            $mapTile = new MapTile();
            $mapTile
                ->setMap($map)
                ->setX($x)
                ->setY($y)
                ->setTile($tile);
        }

        return $mapTile;
    }

    /**
     * Standard method to generate id for tiles
     *
     * @param MapTile $mapTile
     * @return string
     */
    public static function generateIdTile(MapTile $mapTile)
    {
        return 'x_' . $mapTile->getX() . '_y_' . $mapTile->getY();
    }
}
