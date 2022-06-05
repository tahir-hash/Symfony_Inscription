<?php

namespace App\Form;

use App\Entity\Professeur;
use App\Repository\ClasseRepository;
use App\Repository\ModuleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfesseurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm",
                ],
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Feminin' => 'Feminin'
                ]

            ])
            ->add('grade', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ]
            ])
            ->add('grade', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ]
            ])
            ->add('modules',ChoiceType::class, [
                'attr' => [
                    'class' => "select selectpicker",
                    'multiple' => 'multiple',
                    'data-live-search'=>true,
                    'name'=>"modules[]"
                ], 'choices' => ['test' => 'test'],
                'label'=>' '
            ])
            ->add('classes', ChoiceType::class, [
                'attr' => [
                    'class' => "select selectpicker",
                    'multiple' => 'multiple',
                    'data-live-search'=>true,
                    'name'=>"classes[]"
                ], 'choices' =>['test' => 'test'],
                'label'=>' '
            ])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
            'module'=>ModuleRepository::class,
            'classe'=>ClasseRepository::class
        ]);
    }
}
