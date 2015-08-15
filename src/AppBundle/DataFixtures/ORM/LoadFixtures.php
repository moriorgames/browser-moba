<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Entity\MapTile;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:
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
        $this->loadTiles($manager);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadTiles(ObjectManager $manager)
    {
        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_BLUE_HOME);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_BLUE_CASTLE);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_BLUE_TOWER);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_RED_HOME);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_RED_CASTLE);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_NPC);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_GRASS);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('')
            ->setSlug('')
            ->setTileType(Tile::TYPE_WOODS);
        $manager->persist($tile);
        $manager->flush();
    }

}
