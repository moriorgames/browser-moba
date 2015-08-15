<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Map
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="m_map")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MapRepository")
 */
class Map
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
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $height;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $width;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MapTile", mappedBy="map", cascade={"persist"})
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param integer $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

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
