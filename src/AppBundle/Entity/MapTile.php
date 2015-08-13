<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MapTile
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="m_map_tile")
 */
class MapTile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Map
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Map")
     * @ORM\JoinColumn(name="map_id", referencedColumnName="id")
     */
    private $map;

    /**
     * @var Tile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tile")
     * @ORM\JoinColumn(name="tile_id", referencedColumnName="id")
     */
    private $tile;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param Map $map
     * @return $this
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * @return Tile
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * @param Tile $tile
     * @return $this
     */
    public function setTile(Tile $tile)
    {
        $this->tile = $tile;

        return $this;
    }

}
