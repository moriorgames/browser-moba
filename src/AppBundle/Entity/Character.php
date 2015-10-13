<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\ArchetypeTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Character.
 *
 * @ORM\Entity
 * @ORM\Table(name="char_character")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterRepository")
 */
class Character
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use ArchetypeTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $experience;

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
}
