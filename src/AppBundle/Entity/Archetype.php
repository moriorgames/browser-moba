<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\ArchetypeTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Archetype.
 *
 * @ORM\Entity
 * @ORM\Table(name="char_archetype")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchetypeRepository")
 */
class Archetype
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use ArchetypeTrait;

    /**
     * This number indicates if an Archetype has to be nerfed or not
     * as much stability points, more changes to nerf.
     *
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $stability;

    /**
     * @return int
     */
    public function getStability()
    {
        return $this->stability;
    }

    /**
     * @param int $stability
     *
     * @return $this
     */
    public function setStability($stability)
    {
        $this->stability = $stability;

        return $this;
    }
}
