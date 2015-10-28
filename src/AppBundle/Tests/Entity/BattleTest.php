<?php

namespace AppBundle\Tests\Entity;

use DateTime;
use CoreBundle\Constants;
use AppBundle\Entity\Battle;
use Doctrine\ORM\EntityManager;
use CoreBundle\Tests\Traits\EntityManagerTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BattleTest extends WebTestCase
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
        $this->object = new Battle();
        $this->object
            ->setName($name)
            ->setUpdatedAt(new DateTime())
            ->setCreatedAt(new DateTime())
            ->setBattleType(Constants::BATTLE_TYPE_5_VS_5);
        $this->em->persist($this->object);
        $this->em->flush();

        $entity = $this->em
            ->getRepository('AppBundle:Battle')
            ->findOneBy(['name' => $name]);

        $this->assertInstanceOf('AppBundle\Entity\Battle', $entity);
        $this->assertTrue($entity->getName() === $name);
    }
}
