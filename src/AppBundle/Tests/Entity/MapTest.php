<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Map;
use Doctrine\ORM\EntityManager;
use CoreBundle\Tests\Traits\EntityManagerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MapTest extends WebTestCase
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
        $this->object = new Map();
        $this->object
            ->setName($name)
            ->setHeight(1)
            ->setWidth(1)
            ->setEnabled(true);
        $this->em->persist($this->object);
        $this->em->flush();

        $entity = $this->em
            ->getRepository('AppBundle:Map')
            ->findOneBy(['name' => $name]);

        $this->assertInstanceOf('AppBundle\Entity\Map', $entity);
        $this->assertEquals($name, $entity->getName());
    }
}
