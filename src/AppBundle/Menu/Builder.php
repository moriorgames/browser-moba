<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Class Builder.
 */
class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('menu.homepage', ['route' => 'homepage']);
        $menu->addChild('menu.map', ['route' => 'map_index']);
        $menu->addChild('menu.archetype', ['route' => 'archetype_index']);

        return $menu;
    }
}
