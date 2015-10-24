<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Map;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:.
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author MoriorGames <moriorgames@gmail.com>
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function load(ObjectManager $manager)
    {
        $this->loadMaps($manager);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadMaps(ObjectManager $manager)
    {
        $map = new Map();
        $map
            ->setName('Base Map')
            ->setSlug('base-map')
            ->setEnabled(true)
            ->setHeight(17)
            ->setWidth(10);

        $manager->persist($map);
        $manager->flush();
    }
}
