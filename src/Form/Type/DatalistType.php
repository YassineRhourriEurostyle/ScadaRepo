<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatalistType extends AbstractType
{
//    public function getParent()
//    {
//        return EntityType::class;
//    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        //$resolver->setRequired(['choices']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['choices'] = $options['choices'];
    }

    public function getName()
    {
        return 'datalist';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'choices' => array(),            
        ]);
    }
}