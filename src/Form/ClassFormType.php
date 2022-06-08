<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg"
                ],
                "label"=>"Libelle Classe", 
                'required'=>false,
               // 'constraints' => [new NotBlank()]
            ])
            ->add('filiere', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm"
                ],
                'choices' => Classe::$filieres, 
                'required'=>false,
               // 'constraints' => [new NotBlank()]
            ])
            ->add('niveau', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm"
                ], 'choices' => Classe::$niveaux, 
                'required'=>false,
              //  'constraints' => [new NotBlank()]
            ])
            ->getForm();
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
