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
}
