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

        // Temporary
        $menu->addChild('menu.login', ['route' => 'fos_user_security_login']);
        $menu->addChild('menu.register', ['route' => 'fos_user_registration_register']);
        $menu->addChild('menu.logout', ['route' => 'fos_user_security_logout']);
        $menu->addChild('menu.admin', ['route' => 'sonata_admin_dashboard']);

        return $menu;
    }
}
