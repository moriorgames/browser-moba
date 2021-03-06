<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class Archetype.
 */
class Archetype extends Admin
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
            ->add('physicalDamage')
            ->add('magicDamage');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('physicalDamage', 'integer')
            ->add('MagicDamage', 'integer')
            ->add('structuralDamage', 'integer')
            ->add('hitPoints', 'integer')
            ->add('magicPoints', 'integer')
            ->add('armor', 'integer')
            ->add('magicResistance', 'integer')
            ->add('agility', 'integer')
            ->add('movement', 'integer')
            ->add('regeneration', 'integer')
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }
}
