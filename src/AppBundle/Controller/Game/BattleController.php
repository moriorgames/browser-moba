<?php

namespace AppBundle\Controller\Game;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class BattleController.
 */
class BattleController extends Controller
{
    /**
     * @Route("/", name="game_battle")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function battleAction()
    {
        return [];
    }
}
