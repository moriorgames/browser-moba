<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MapType
 * @package AppBundle\Form
 */
class MapType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'label.name'))
            ->add('slug', null, array('label' => 'label.slug'))
            ->add('height', null, array('label' => 'label.height'))
            ->add('width', null, array('label' => 'label.width'))
            ->add('enabled', null, array('label' => 'label.enabled'));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Map',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_bundle_map_type';
    }

}
