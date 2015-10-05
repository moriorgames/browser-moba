<?php

// http://symfony.com/doc/current/cookbook/doctrine/file_uploads.html


namespace AppBundle\Controller;

use AppBundle\Entity\Archetype;
use AppBundle\Form\ArchetypeType;
use AppBundle\Manager\ArchetypeManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ArchetypeController.
 *
 * @Route("/archetype")
 */
class ArchetypeController extends Controller
{
    /**
     * @var ArchetypeManager
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
        $this->manager = $this->get('app.archetype_manager');
    }

    /**
     * @Route("/", name="archetype_index")
     * @Template("archetype/index.html.twig")
     *
     * @return Response
     */
    public function indexAction()
    {
        return ['archetypes' => $this->manager->getRepository()->findAll()];
    }

    /**
     * @Route("/edit/{id}", name="archetype_edit")
     * @Template("archetype/edit.html.twig")
     *
     * @param int $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        /** @var Archetype $archetype */
        $archetype = $this->manager->getById($id);

        return [
            'archetype' => $archetype,
        ];
    }

    /**
     * @Route("/create", name="archetype_create")
     * @Template("archetype/create.html.twig")
     * @Method("GET")
     *
     * @return Response
     */
    public function createAction()
    {
        return [
            'form' => $this->createForm(new ArchetypeType())->createView(),
        ];
    }

    /**
     * @Route("/create", name="archetype_update")
     * @Template("archetype/create.html.twig")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction(Request $request)
    {
        $form = $this->createForm(new ArchetypeType());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$this->manager->persistMap($form->getData());

            return $this->redirectToRoute('archetype_index');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
