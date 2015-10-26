<?php

namespace AppBundle\Controller\Game;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller in charge to render the main pages of the Game.
 *
 * @Route("/game/main")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="game_main_homepage")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function homepageAction()
    {
        return ['user' => $this->getUser()];
    }

    /**
     * @Route("/", name="game_main_choose_hero")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function chooseHeroAction()
    {
        return [];
    }

    /**
     * @Route("/", name="game_main_update_choose_hero")
     * @Method("POST")
     * @Template()
     *
     * @return array
     */
    public function updateChooseHeroAction()
    {
        return [];
    }
}
