<?php

namespace App\Form;

use App\Entity\Log;
use App\Entity\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Iteration')
            ->add('Value')
            ->add('Device')
            ->add('Indicator', null, array(
                    'query_builder' => function(EntityRepository $repository) {
                        return $repository->createQueryBuilder('u')->orderBy('u.Name', 'ASC');
                    }
                ))
            ->add('save', SubmitType::class, ['label' => 'Save & Back to list'])
            ->add('saveAndAdd', SubmitType::class, ['label' => 'Save & Add new'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
        ]);
    }
}
