<?php

namespace App\Form;

use App\Controller\ApiController;
use App\Entity\UserAccess;
use App\Form\Type\DatalistType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class UserAccessType extends AbstractType {

    private $em;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('User', DatalistType::class, ['constraints' => [
                        new NotBlank(['groups' => ['form_validation_only']]),
                    ], 'choices' => $this->getUsers()])
                ->add('EntityField', ChoiceType::class, [
                    'choices' => $this->listEntityFields(),
                    'placeholder' => '-- Choose --',
                ])
                ->add('Value', ChoiceType::class, [
                    'placeholder' => '-- Choose --',
                ])
                ->add('Deny', null, [
                    'label' => 'Precise if you deny access to this value'
                ])
                ->add('ReadOnly', null, [
                    'label' => 'Read-only access to the datas'
                ])
//                ->add('ExportExcel', null, [
//                    'label' => 'Allow Excel export'
//                ])
                ->add('save', SubmitType::class, ['label' => 'Save & Back to list'])
                ->add('saveAndAdd', SubmitType::class, ['label' => 'Save & Add new'])
        ;
        
        $builder->get('User')->resetViewTransformers();

        $builder->addEventListener(
                FormEvents::PRE_SUBMIT,
                function (FormEvent $event) {
                    $form = $event->getForm();

                    if ($form->has('User')) {
                        $form->remove('User');
                        $form->add(
                                'User',
                                TextType::class,
                                ['required' => true]
                        );
                    }
                }
            );
    }
    
    private function getUsers() {
        $users=[];
        $api = ApiController::call('spaccess', 'User');
        foreach($api as $u):
            $users[]=$u['Name'];
        endforeach;
        sort($users);
        return $users;
    }

    private function listEntityFields() {
        $tEF = [];
        $dir = __DIR__ . '/../Entity/';
        $t = scandir($dir);
        foreach ($t as $file):
            if (!is_file($dir . $file))
                continue;
            $entity = substr($file, 0, strlen($file) - 4);
            $php = file_get_contents($dir . $file);

            $extend = null;
            preg_match('/extends [A-za-z]*/', $php, $extend);
            if (count($extend)):
                $extend = $dir . substr($extend[0], 8) . '.php';
                if (is_file($extend)):
                    $php = file_get_contents($extend) . $php;
                endif;
            endif;

            $fields = null;
            preg_match_all('/private\ \$[a-zA-Z0-9]*/', $php, $fields);
            foreach ($fields[0] as $field):
                $field = substr($field, 9);
                if ($field == 'id')
                    continue;
                $tEF[$entity . '.' . $field] = $entity . '.' . $field;
            endforeach;
        endforeach;

        ksort($tEF);
        return $tEF;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserAccess::class,
            'em' => null,
            'validation_groups' => ['form_validation_only'],
            'allow_extra_fields' => true,
        ]);
    }

}
