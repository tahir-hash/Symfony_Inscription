<?php

namespace App\Form;


use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                   
                ], 'required'=>false,
                
            ])
            ->add('sexe', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm",
                ],
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Feminin' => 'Feminin'
                ], 'required'=>false,
            ])
            ->add('grade', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ], 'required'=>false,
                
            ])
            ->add('modules', EntityType::class, [
                'attr' => [
                    'class' => "select selectpicker",
                    'data-live-search' => true,
                    'placeholder'=>"Choisir un Module"
                ],
                 'class' => Module::class,
                'choice_label' => 'libelle',
                'label' => ' ',
                'multiple' => true, 
                'required'=>false,               
            ])
            ->add('classes', EntityType::class, [
                'choice_label' => 'libelle',
                'attr' => [
                    'class' => "select selectpicker",
                    'data-live-search' => true,
                    'placeholder'=>"Choisir une classe"

                ], 'class' => Classe::class,
                'multiple' => true,
                'label'=>' ', 
                'required'=>false,  
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
