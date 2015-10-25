<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\DateTimeTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
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
}
