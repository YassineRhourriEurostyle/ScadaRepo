<?php

namespace App\Form;

use App\Entity\Log;
use App\Entity\Unit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class UnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Symbol')
            ->add('save', SubmitType::class, ['label' => 'Save & Back to list'])
            ->add('saveAndAdd', SubmitType::class, ['label' => 'Save & Add new'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Unit::class,
        ]);
    }
}
