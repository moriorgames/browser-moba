<?php

namespace AppBundle\Admin;

use DateTime;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\Image as ImageUpload;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class Image.
 */
class Image extends Admin
{
    /**
     * @var string
     */
    protected $translationDomain = 'AppBundle';

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('path', 'string', ['template' => ':Admin:templates/image-list.html.twig']);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('path', 'text')
            ->add('file', 'file', ['required' => false])
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * @param ImageUpload $image
     *
     * @return mixed|void
     */
    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * @param ImageUpload $image
     *
     * @return mixed|void
     */
    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    /**
     * @param ImageUpload $image
     */
    private function manageFileUpload(ImageUpload $image)
    {
        if ($image->getFile()) {
            $image->setUpdatedAt(new DateTime());
        }
    }
}
