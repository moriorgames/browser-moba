<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Map.
 *
 * @ORM\Entity
 * @ORM\Table(name="map_map")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MapRepository")
 */
class Map
{
    use IdentifiableTrait;
    use NameSlugTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $width;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}
