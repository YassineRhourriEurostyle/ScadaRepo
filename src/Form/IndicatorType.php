<?php

namespace App\Form;

use App\Entity\Log;
use App\Entity\Indicator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class IndicatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('MaxIterations')
            ->add('Required')
            ->add('Tolerance')
            ->add('Parent')
            ->add('Unit', null, array(
                    'query_builder' => function(EntityRepository $repository) {
                        return $repository->createQueryBuilder('u')->orderBy('u.Name', 'ASC');
                    }
                ))
            ->add('TypeOfDevice')
            ->add('save', SubmitType::class, ['label' => 'Save & Back to list'])
            ->add('saveAndAdd', SubmitType::class, ['label' => 'Save & Add new'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Indicator::class,
        ]);
    }
}
