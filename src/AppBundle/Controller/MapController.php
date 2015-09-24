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
use Symfony\Component\DependencyInjection\ContainerInterface;
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
     * @var MapManager
     */
    private $manager;

    /**
     * Override the set container to add some controller logic.
     * This function is called at the initialize of the controller.
     *
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->manager = $this->get('app.map_manager');
    }

    /**
     * @Route("/", name="map_index")
     * @Template("map/index.html.twig")
     *
     * @return Response
     */
    public function indexAction()
    {
        return ['maps' => $this->manager->getMapRepository()->findAll()];
    }

    /**
     * @Route("/edit/{id}", name="map_edit")
     * @Template("map/edit.html.twig")
     *
     * @param int $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        /** @var Map $map */
        $map = $this->manager->getMapById($id);

        return [
            'map' => $map,
            'mapTiles' => $this->manager->createView($map),
            'tiles' => $this->manager->getTiles(),
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
        $form = $this->createForm(new MapType());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persistMap($form->getData());

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
        $id = $request->get('id');
        $x = $request->get('x');
        $y = $request->get('y');

        /** @var Tile $tile */
        foreach ($this->manager->getTiles() as $tile) {
            if ($tile->getId() == $request->get('tileId')) {
                break;
            }
        }

        /** @var Map $map */
        $map = $this->manager->getMapById($id);

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
