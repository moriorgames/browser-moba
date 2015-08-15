<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use AppBundle\Manager\MapManager;
use AppBundle\Repository\MapRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/map")
 */
class MapController extends Controller
{
    /**
     * @Route("/", name="map_index")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('map/index.html.twig');
    }

    /**
     * @Route("/create", name="map_create")
     *
     * @return Response
     */
    public function createAction()
    {
        return $this->render('map/create.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="map_edit")
     *
     * @param integer $id
     * @return Response
     */
    public function editAction($id)
    {
        /** @var MapRepository $repo */
        $repo = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Map');

        $map = $repo->findOneById($id);

        if (!$map instanceof Map) {
            throw $this->createNotFoundException('Map not found!');
        }

        $mapManager = new MapManager();

        return $this->render('map/edit.html.twig',
            array(
                'tiles' => $mapManager->createView($map)
            )
        );
    }

}
