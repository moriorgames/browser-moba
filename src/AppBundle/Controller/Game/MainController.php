<?php

namespace AppBundle\Controller\Game;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Controller in charge to render the main pages of the Game
 *
 * @Route("/game/main")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="game_homepage")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render(':Game/Main:homepage.html.twig');
    }
}
