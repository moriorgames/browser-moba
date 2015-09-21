<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NameSlugTrait;
use AppBundle\Entity\Traits\ArchetypeTrait;

/**
 * Class Archetype
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="c_archetype")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchetypeRepository")
 */
class Archetype
{
    use NameSlugTrait;
    use ArchetypeTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}











