<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Form\MapType;
use AppBundle\Repository\MapRepository;
use AppBundle\Repository\MapTileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        $mapManager = $this->get('app.map_manager');

        return $this->render('map/index.html.twig', array(
                'maps' => $mapManager->mapRepository()->findAll()
            )
        );
    }

    /**
     * @Route("/create", name="map_create")
     *
     * @return Response
     */
    public function createAction()
    {
        $form = $this->createForm(new MapType());

        return $this->render('map/create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/edit/{id}", name="map_edit")
     *
     * @param integer $id
     * @return Response
     */
    public function editAction($id)
    {
        $mapManager = $this->get('app.map_manager');

        /** @var MapRepository $repo */
        $repo = $mapManager->mapRepository();

        $map = $repo->findOneById($id);

        if (!$map instanceof Map) {
            throw $this->createNotFoundException('Map not found!');
        }

        return $this->render('map/edit.html.twig',
            array(
                'map' => $map,
                'mapTiles' => $mapManager->createView($map),
                'tiles' => $mapManager->getTiles(),
            )
        );
    }

    /**
     * @Route("/tile-by-tile", name="map_tile_by_tile")
     *
     * @param Request $request
     * @return Response
     */
    public function tileByTileAction(Request $request)
    {
        $mapManager = $this->get('app.map_manager');

        $id = $request->get('id');
        $x = $request->get('x');
        $y = $request->get('y');

        /** @var Tile $tile */
        foreach ($mapManager->getTiles() as $tile) {
            if ($tile->getId() == $request->get('tileId')) {
                break;
            }
        }

        /** @var MapRepository $repo */
        $mapRepo = $mapManager->mapRepository();

        $map = $mapRepo->findOneById($id);

        if (!$map instanceof Map) {
            throw $this->createNotFoundException('Map not found!');
        }

        /** @var MapTileRepository $repo */
        $mapTileRepo = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:MapTile');
        $mapTileRepo->insertPosition($x, $y, $map, $tile);

        // Create a JSON-response with a 200 status code
        $response = new Response(
            json_encode(array('status' => true))
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
