<?php

namespace MoriorGames\DataFixtures\ORM;

use MoriorGames\UserBundle\Entity\User;
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
        $this->loadUsers($manager);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadUsers(ObjectManager $manager)
    {
        $dataProvider = $this->dataProvider();
        foreach ($dataProvider as $data) {
            $user = new User();
            $user
                ->setUsername($data[0])
                ->setEmail($data[1])
                ->setPlainPassword($data[2])
                ->setRoles($data[3])
                ->setEnabled($data[4]);

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function dataProvider()
    {
        return [
            ['Morior', 'moriorgames@gmail.com', 'nomejodas', ['ROLE_SUPER_ADMIN'], true],
            ['Pruebas', 'pruebas@browsermoba.com', 'prueba', ['ROLE_USER'], true],
            ['Sergio', 'sergio.mbravo@gmail.com', '1234', ['ROLE_USER'], true],
        ];
    }
}
