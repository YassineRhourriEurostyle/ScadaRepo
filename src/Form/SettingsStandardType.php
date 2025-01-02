<?php

namespace App\Form;

use App\Entity\Log;
use App\Entity\SettingsStandard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SettingsStandardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idrank',ChoiceType::class,[
                'choices'=>[
                    'A01I10' => 'A01I10',
                    'A01Q01' => 'A01Q01',
                    'A01Q03' => 'A01Q03',
                    'A01Q04' => 'A01Q04',
                    'A01T01A01' => 'A01T01A01',
                    'B01D01' => 'B01D01',
                    'B01G01' => 'B01G01',
                    'D01A51B01' => 'D01A51B01',
                    'D01A51G01' => 'D01A51G01',
                    'D01A51L01' => 'D01A51L01',
                    'D01A61D01' => 'D01A61D01',
                    'D01A61G50' => 'D01A61G50',
                    'D01A71D01' => 'D01A71D01',
                    'D01A71G50' => 'D01A71G50',
                    'D01A81D01' => 'D01A81D01',
                    'D01A81G50' => 'D01A81G50',
                    'D01B61' => 'D01B61',
                    'E01B01A01' => 'E01B01A01'
                ]
            ])
            ->add('settingdescription')
            ->add('idparameter')
            ->add('idvaluetype')
            ->add('nbdecimals')
            ->add('stdvalue')
            ->add('tolerancepct')
            ->add('tolerancemini')
            ->add('tolerancemaxi')
            ->add('exactvalue')
            ->add('paramunit')
            ->add('parammasterunit')
            ->add('paramuniteabs')
            ->add('parammandatory')
            ->add('paramdeviceid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SettingsStandard::class,
        ]);
    }
}
