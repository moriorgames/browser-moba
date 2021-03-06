<?php

namespace AppBundle\Controller\Game;

use AppBundle\Entity\Archetype;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $manager = $this->get('app.battle_manager');

        return [
            'user' => $this->getUser(),
            'isUserInBattle' => $manager->isUserInBattle($this->getUser()),
        ];
    }

    /**
     * @Route("/choose-hero", name="game_main_choose_hero")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function chooseHeroAction()
    {
        $manager = $this->get('app.archetype_manager');

        return ['archetypes' => $manager->getRepository()->findAll()];
    }

    /**
     * @Route("/update-choose-hero", name="game_main_update_choose_hero")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function updateChooseHeroAction(Request $request)
    {
        $archetypeManager = $this->get('app.archetype_manager');
        $archetype = $archetypeManager->getRepository()->find(
            $request->request->get('heroId')
        );

        if ($archetype instanceof Archetype) {
            $repo = $this->get('app.hero_manager')->getRepository();
            $hero = $repo->createHeroFromArchetype(
                $archetype, $this->getUser()
            );
            $repo->persistHero($hero);

            return $this->redirectToRoute('game_main_homepage');
        }

        return $this->redirectToRoute('game_main_choose_hero');
    }
}
