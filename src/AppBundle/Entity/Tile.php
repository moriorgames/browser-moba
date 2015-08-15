<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Tile
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="m_tile")
 */
class Tile
{

    const TYPE_BLUE_HOME = 0;
    const TYPE_BLUE_CASTLE = 1;
    const TYPE_BLUE_TOWER = 2;
    const TYPE_RED_HOME = 3;
    const TYPE_RED_CASTLE = 4;
    const TYPE_RED_TOWER = 5;
    const TYPE_NPC = 6;
    const TYPE_GRASS = 7;
    const TYPE_WOODS = 8;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @var integer
     *
     * @ORM\Column(name="tile_type", type="integer")
     */
    private $tileType;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MapTile", mappedBy="tile", cascade={"persist"})
     */
    protected $mapTiles;

    public function __construct()
    {
        $this->mapTiles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set slug
     *
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTileType()
    {
        return $this->tileType;
    }

    /**
     * @param integer $tileType
     * @return $this
     */
    public function setTileType($tileType)
    {
        $this->tileType = $tileType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapTiles()
    {
        return $this->mapTiles;
    }

    /**
     * Add tiles to map
     *
     * @param MapTile $mapTiles
     * @return $this
     */
    public function addMapTiles(MapTile $mapTiles)
    {
        $this->mapTiles->add($mapTiles);

        return $this;
    }

    /**
     * Remove postHasMedias
     *
     * @param MapTile $mapTiles
     */
    public function removeMapTiles(MapTile $mapTiles)
    {
        $this->mapTiles->removeElement($mapTiles);
    }

}
