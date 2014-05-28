<?php

namespace Anticom\KennzeichenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BundeslandType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label' => 'Name',
                    'attr'  => array(
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
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Anticom\KennzeichenBundle\Entity\Bundesland'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anticom_kennzeichenbundle_bundesland';
    }
}
