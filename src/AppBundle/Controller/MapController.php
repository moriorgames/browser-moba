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
 * Map controller.
 *
 * @Route("/map")
 */
class MapController extends Controller
{

    /**
     * Lists all Map entities.
     *
     * @Route("/", name="map")
     * @Template()
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
     * Creates a new Map entity.
     *
     * @Route("/", name="map_create")
     * @Method("POST")
     * @Template("AppBundle:Map:new.html.twig")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $entity = new Map();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('map_show', ['id' => $entity->getId()]));
        }

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Map entity.
     *
     * @param Map $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Map $entity)
    {
        $form = $this->createForm(new MapType(), $entity, [
            'action' => $this->generateUrl('map_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        return $form;
    }

    /**
     * Displays a form to create a new Map entity.
     *
     * @Route("/new", name="map_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Map();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Map entity.
     *
     * @Route("/{id}", name="map_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Map')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Map entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Map entity.
     *
     * @Route("/{id}/edit", name="map_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Map')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Map entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Map entity.
     *
     * @param Map $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Map $entity)
    {
        $form = $this->createForm(new MapType(), $entity, [
            'action' => $this->generateUrl('map_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', ['label' => 'Update']);

        return $form;
    }

    /**
     * Edits an existing Map entity.
     *
     * @Route("/{id}", name="map_update")
     * @Method("PUT")
     * @Template("AppBundle:Map:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Map')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Map entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('map_edit', ['id' => $id]));
        }

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Map entity.
     *
     * @Route("/{id}", name="map_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Map')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Map entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('map'));
    }

    /**
     * Creates a form to delete a Map entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('map_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Delete'])
            ->getForm();
    }

    /**
     * Construct the map tile by tile
     *
     * @Route("/construct/{id}", name="map_construct")
     * @Template()
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
