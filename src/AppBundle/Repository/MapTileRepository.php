<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Map;
use AppBundle\Entity\MapTile;
use Doctrine\ORM\EntityRepository;

/**
 * Class MapRepository
 * @package AppBundle\Repository
 */
class MapTileRepository extends EntityRepository
{

    public function insertPosition($x, $y, Map $map)
    {
        $mapTile = new MapTile();
        $mapTile
            ->setMap($map)
            ->setX($x)
            ->setY($y);

        $this->_em->persist($mapTile);
        $this->_em->flush();

        return true;
    }
}