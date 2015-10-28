<?php

namespace AppBundle\Tests\Entity;

use CoreBundle\Constants;
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
     * Its called before the execution of each test.
     */
    public function setUp()
    {
        $this->em = $this->createEntityManager();
    }

    /**
     * Call this method delete the inserted fixture
     * Its called after the execution of each test.
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
            ->setName($name)
            ->setPhysicalDamage(1)
            ->setMagicDamage(1)
            ->setStructuralDamage(1)
            ->setHitPoints(1)
            ->setMagicPoints(1)
            ->setArmor(1)
            ->setMagicResistance(1)
            ->setAgility(1)
            ->setMovement(1)
            ->setRegeneration(1)
            ->setFighterType(Constants::FIGHTER_PLAYER)
            ->setExperience(1);
        $this->em->persist($this->object);
        $this->em->flush();

        $entity = $this->em
            ->getRepository('AppBundle:Hero')
            ->findOneBy(['name' => $name]);

        $this->assertInstanceOf('AppBundle\Entity\Hero', $entity);
        $this->assertTrue($entity->getName() === $name);
    }
}
