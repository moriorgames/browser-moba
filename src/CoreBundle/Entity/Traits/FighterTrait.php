<?php

namespace CoreBundle\Entity\Traits;

use CoreBundle\Constants;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class FighterTrait.
 */
trait FighterTrait
{
    /**
     * @var int
     *
     * @ORM\Column(name="physical_damage", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $physicalDamage;

    /**
     * @var int
     *
     * @ORM\Column(name="magic_damage", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicDamage;

    /**
     * Amount of Damage per second to structures.
     *
     * @var int
     *
     * @ORM\Column(name="structural_damage", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $structuralDamage;

    /**
     * @var int
     *
     * @ORM\Column(name="hit_points", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $hitPoints;

    /**
     * @var int
     *
     * @ORM\Column(name="magic_points", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicPoints;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $armor;

    /**
     * @var int
     *
     * @ORM\Column(name="magic_resistance", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicResistance;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $agility;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $movement;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $regeneration;

    /**
     * @var string
     *
     * @ORM\Column(name="fighter_Type", type="string", length=255)
     * @Assert\NotBlank(message="general.blank")
     */
    private $fighterType;

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
    public function getStructuralDamage()
    {
        return $this->structuralDamage;
    }

    /**
     * @param int $structuralDamage
     *
     * @return $this
     */
    public function setStructuralDamage($structuralDamage)
    {
        $this->structuralDamage = $structuralDamage;

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

    /**
     * @return int
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param int $agility
     *
     * @return $this
     */
    public function setAgility($agility)
    {
        $this->agility = $agility;

        return $this;
    }

    /**
     * @return int
     */
    public function getMovement()
    {
        return $this->movement;
    }

    /**
     * @param int $movement
     *
     * @return $this
     */
    public function setMovement($movement)
    {
        $this->movement = $movement;

        return $this;
    }

    /**
     * @return int
     */
    public function getRegeneration()
    {
        return $this->regeneration;
    }

    /**
     * @param int $regeneration
     *
     * @return $this
     */
    public function setRegeneration($regeneration)
    {
        $this->regeneration = $regeneration;

        return $this;
    }

    /**
     * @return string
     */
    public function getFighterType()
    {
        return $this->fighterType;
    }

    /**
     * @param string $fighterType
     *
     * @return $this
     */
    public function setFighterType($fighterType)
    {
        if (!in_array($fighterType, Constants::fighters())) {
            throw new UnexpectedValueException('This fighter type is not allowed');
        }
        $this->fighterType = $fighterType;

        return $this;
    }
}
