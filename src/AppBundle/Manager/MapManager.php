<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Entity\MapTile;

/**
 * Class MapManager
 * @package AppBundle\Manager
 */
class MapManager
{
    const TILE = 112;
    const INCREMENTAL_TOP = 28;
    const INCREMENTAL_LEFT = 83;

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
                    'class' => 'grass',
                    'top' => self::INCREMENTAL_TOP * $top,
                    'left' => self::INCREMENTAL_LEFT * $left + 20,
                    'title' => "$top x $left",
                ];

            }

        }

        return $tiles;
    }
}
