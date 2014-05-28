<?php

namespace Anticom\KennzeichenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KennzeichenType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'kuerzel',
                'text',
                array(
                    'label' => 'Kürzel',
                    'attr'  => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'kreis',
                'text',
                array(
                    'label' => 'Kreis',
                    'attr'  => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'bundesland',
                'entity',
                array(
                    'class'    => 'AnticomKennzeichenBundle:Bundesland',
                    'property' => 'name',
                    'label'    => 'Bundesland',
                    'attr'     => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'speichern',
                    'attr'  => array(
                        'class' => 'btn btn-primary'
                    )
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anticom\KennzeichenBundle\Entity\Kennzeichen'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anticom_kennzeichenbundle_kennzeichen';
    }
}
