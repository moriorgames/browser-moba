<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Hero;
use Doctrine\ORM\EntityManager;
use CoreBundle\Tests\Traits\EntityManagerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HeroTest extends WebTestCase
{
    use EntityManagerTrait;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Object
     */
    private $object;

    /**
     * Call this method to insert some fixtures
     * Its called before the execution of each test
     */
    public function setUp()
    {
        $this->em = $this->createEntityManager();
    }

    /**
     * Call this method delete the inserted fixture
     * Its called after the execution of each test
     */
    public function tearDown()
    {
        $this->em->remove($this->object);
        $this->em->flush();
    }

    public function testCreateEntity()
    {
        $name = 'Name-For-The-Test';

        // First create the entity
        $this->object = new Hero();
        $this->object
            ->setArmor(1)
            ->setHitPoints(1)
            ->setMagicDamage(1)
            ->setMagicPoints(1)
            ->setMagicResistance(1)
            ->setName($name)
            ->setPhysicalDamage(1)
            ->setExperience(1)
            ->setSlug('slug');
        $this->em->persist($this->object);
        $this->em->flush();

        $entity = $this->em
            ->getRepository('AppBundle:Hero')
            ->findOneBy(['name' => $name]);

        $this->assertTrue($entity instanceof Hero);
        $this->assertTrue($entity->getName() === $name);
    }
}
