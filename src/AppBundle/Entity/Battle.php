<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\DateTimeTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Battle.
 *
 * @ORM\Entity
 * @ORM\Table(name="battle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BattleRepository")
 */
class Battle
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use DateTimeTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="battle.blank_type")
     */
    private $battleType;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Hero", mappedBy="battle", orphanRemoval=true)
     */
    private $battleHeroes;

    /**
     * Create the array collection instance to save heroes to combat
     */
    public function __construct()
    {
        $this->battleHeroes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getBattleType()
    {

        return $this->battleType;
    }

    /**
     * @param mixed $battleType
     *
     * @return $this
     */
    public function setBattleType($battleType)
    {
        $this->battleType = $battleType;

        return $this;
    }

    /**
     * Add Hero.
     *
     * @param Hero $hero
     *
     * @return $this
     */
    public function addBattleHeroes(Hero $hero)
    {
        $this->battleHeroes->add($hero);

        return $this;
    }

    /**
     * Remove Hero.
     *
     * @param Hero $hero
     */
    public function removeBattleHeroes(Hero $hero)
    {
        $this->battleHeroes->removeElement($hero);
    }

    /**
     * Get BattleHeroes.
     *
     * @return ArrayCollection
     */
    public function getBattleHeroes()
    {
        return $this->battleHeroes;
    }
}
