<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Form\MapType;
use AppBundle\Manager\MapManager;
use AppBundle\Repository\MapTileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller used to manage maps in the public part of the site.
 *
 * @Route("/map")
 */
class MapControllerSample extends Controller
{
    /**
     * @Route("/", name="map_index")
     * @Template("map/index.html.twig")
     *
     * @return Response
     */
    public function indexAction()
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        return ['maps' => $manager->getRepository()->findAll()];
    }

    /**
     * @Route("/sample-edit/{id}", name="map_edit")
     * @Template("map/create.html.twig")
     *
     * @param int $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');
        /** @var Map $map */
        $map = $manager->getById($id);

        return [
            'form' => $this->createForm(new MapType(), $map)->createView(),
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
        return [
            'form' => $this->createForm(new MapType())->createView(),
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
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        $form = $this->createForm(new MapType());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persistMap($form->getData());

            return $this->redirectToRoute('map_index');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/construct/{id}", name="map_construct")
     * @Template("map/construct.html.twig")
     *
     * @param int $id
     *
     * @return Response
     */
    public function constructAction($id)
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');
        /** @var Map $map */
        $map = $manager->getById($id);

        return [
            'map' => $map,
            'mapTiles' => $manager->createView($map),
            'tiles' => $manager->getTiles(),
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
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        $id = $request->get('id');
        $x = $request->get('x');
        $y = $request->get('y');

        /** @var Tile $tile */
        foreach ($manager->getTiles() as $tile) {
            if ($tile->getId() == $request->get('tileId')) {
                break;
            }
        }

        /** @var Map $map */
        $map = $manager->getById($id);

        /** @var MapTileRepository $mapTileRepo */
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
}
