<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MoriorGames\UserBundle\Entity\User;
use CoreBundle\Entity\Traits\FighterTrait;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Character.
 *
 * @ORM\Entity
 * @ORM\Table(name="battle_hero")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HeroRepository")
 */
class Hero
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use FighterTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="hit_points_rest", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $hitPointsRest;

    /**
     * @var int
     *
     * @ORM\Column(name="magic_points_rest", type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $magicPointsRest;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $experience;

    /**
     * @var Battle
     *
     * @ORM\ManyToOne(targetEntity="Battle", inversedBy="battleHeroes")
     */
    private $battle;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="MoriorGames\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getHitPointsRest()
    {
        return $this->hitPointsRest;
    }

    /**
     * @param int $hitPointsRest
     *
     * @return $this
     */
    public function setHitPointsRest($hitPointsRest)
    {
        $this->hitPointsRest = $hitPointsRest;

        return $this;
    }

    /**
     * @return int
     */
    public function getMagicPointsRest()
    {
        return $this->magicPointsRest;
    }

    /**
     * @param int $magicPointsRest
     *
     * @return $this
     */
    public function setMagicPointsRest($magicPointsRest)
    {
        $this->magicPointsRest = $magicPointsRest;

        return $this;
    }

    /**
     * @return int
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     *
     * @return $this
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return Battle
     */
    public function getBattle()
    {
        return $this->battle;
    }

    /**
     * @param Battle $battle
     *
     * @return $this
     */
    public function setBattle(Battle $battle)
    {
        $this->battle = $battle;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
