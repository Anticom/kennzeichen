<?php
/**
 * Created by PhpStorm.
 * User: muehlbti
 * Date: 02.04.14
 * Time: 10:04
 */

namespace Anticom\KennzeichenBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchQuickType extends AbstractType
{
    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                //'data_class' => 'Anticom\KennzeichenBundle\Entity\Kennzeichen',
                'method' => 'get'
            )
        );
    }

    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting form the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', 'text',
                array(
                    'label' => 'Suchbegriff',
                    'map' => false,
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Suchbegriff'
                    )
                )
            )
            ->add('submit', 'submit',
                array(
                    'label' => 'speichern',
                    'attr' => array(
                        'class' => 'btn btn-primary'
                    )
                )
            );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'anticom_kennzeichen_quicksearch';
    }
} 