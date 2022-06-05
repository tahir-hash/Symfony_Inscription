<?php

namespace App\Form;


use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfFormType extends AbstractType
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
            ->add('modules', EntityType::class, [
                'attr' => [
                    'class' => "select selectpicker",
                    'data-live-search' => true,
                ], 'class' => Module::class,
                'choice_label' => 'libelle',
                'label' => ' ',
                'multiple' => true,

            ])
            ->add('classes', EntityType::class, [
                'choice_label' => 'libelle',
                'attr' => [
                    'class' => "select selectpicker",
                    'data-live-search' => true,
                ], 'class' => Classe::class,
                'multiple' => true,
                'label'=>' '

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
