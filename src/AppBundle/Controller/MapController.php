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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/map")
 */
class MapController extends Controller
{

    /**
     * @Route("/", name="map_index")
     * @Template("map/index.html.twig")
     *
     * @return Response
     */
    public function indexAction()
    {
        $mapManager = $this->get('app.map_manager');

        return ['maps' => $mapManager->mapRepository()->findAll()];
    }

    /**
     * @Route("/edit/{id}", name="map_edit")
     * @Template("map/edit.html.twig")
     *
     * @param integer $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        $mapManager = $this->get('app.map_manager');

        /** @var Map $map */
        $map = $mapManager
            ->mapRepository()
            ->findOneBy(['id' => $id]);

        $this->checkInstanceOfMap($map);

        return [
            'map'      => $map,
            'mapTiles' => $mapManager->createView($map),
            'tiles'    => $mapManager->getTiles(),
        ];
    }

    /**
     * @Route("/create", name="map_create")
     * @Template("map/create.html.twig")
     * @Method("GET")
     *
     * @return Response
     */
    public function createAction()
    {
        $form = $this->createForm(new MapType());

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/create", name="map_update")
     * @Template("map/create.html.twig")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction(Request $request)
    {
        $form = $this->createForm(new MapType());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Map $map */
            $map = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->redirectToRoute('map_index');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/tile-by-tile", name="map_tile_by_tile")
     *
     * @param Request $request
     *
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
            json_encode(['status' => true])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


// --------------------------- PRIVATE METHODS ---------------------------


    /**
     * Check if $map instanceof Map or throw an exception
     *
     * @param object $map
     */
    private function checkInstanceOfMap($map)
    {
        if (!$map instanceof Map) {
            throw $this->createNotFoundException('Map not found!');
        }
    }

}
