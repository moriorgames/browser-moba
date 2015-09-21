<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArchetypeTrait
 * @package AppBundle\Entity\Traits
 */
trait ArchetypeTrait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="physical_damage", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $physicalDamage;

    /**
     * @var integer
     *
     * @ORM\Column(name="magic_damage", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicDamage;

    /**
     * @var integer
     *
     * @ORM\Column(name="hit_points", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $hitPoints;

    /**
     * @var integer
     *
     * @ORM\Column(name="magic_points", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicPoints;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $armor;

    /**
     * @var integer
     *
     * @ORM\Column(name="magic_resistance", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicResistance;

    /**
     * @return int
     */
    public function getPhysicalDamage()
    {
        return $this->physicalDamage;
    }

    /**
     * @param int $physicalDamage
     *
     * @return $this
     */
    public function setPhysicalDamage($physicalDamage)
    {
        $this->physicalDamage = $physicalDamage;

        return $this;
    }

    /**
     * @return int
     */
    public function getMagicDamage()
    {
        return $this->magicDamage;
    }

    /**
     * @param int $magicDamage
     *
     * @return $this
     */
    public function setMagicDamage($magicDamage)
    {
        $this->magicDamage = $magicDamage;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitPoints()
    {
        return $this->hitPoints;
    }

    /**
     * @param int $hitPoints
     *
     * @return $this
     */
    public function setHitPoints($hitPoints)
    {
        $this->hitPoints = $hitPoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getMagicPoints()
    {
        return $this->magicPoints;
    }

    /**
     * @param int $magicPoints
     *
     * @return $this
     */
    public function setMagicPoints($magicPoints)
    {
        $this->magicPoints = $magicPoints;

        return $this;
    }

    /**
     * @return int
     */
    public function getArmor()
    {
        return $this->armor;
    }

    /**
     * @param int $armor
     *
     * @return $this
     */
    public function setArmor($armor)
    {
        $this->armor = $armor;

        return $this;
    }

    /**
     * @return int
     */
    public function getMagicResistance()
    {
        return $this->magicResistance;
    }

    /**
     * @param int $magicResistance
     *
     * @return $this
     */
    public function setMagicResistance($magicResistance)
    {
        $this->magicResistance = $magicResistance;

        return $this;
    }

}
