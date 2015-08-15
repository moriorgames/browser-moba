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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Map", inversedBy="mapTiles")
     * @ORM\JoinColumn(name="map_id", referencedColumnName="id")
     */
    private $map;

    /**
     * @var Tile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tile", inversedBy="mapTiles")
     * @ORM\JoinColumn(name="tile_id", referencedColumnName="id")
     */
    private $tile;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $top;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $left;

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

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @param int $top
     * @return $this
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param int $left
     * @return $this
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

}
