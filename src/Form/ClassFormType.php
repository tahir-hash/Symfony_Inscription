<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $niveau = [
            "" => "", "L1" => 'L1', "L2" => 'L2', "L3" => 'L3',
            "M1" => 'M1', "M2" => 'M2', "DOCTORAT" => 'DOCTORAT'
        ];
        $filiere = [
            ""=>"",
            "INFORMATIQUE DE GESTION" => 'INFORMATIQUE DE GESTION',
            "DEV MOBILE" => 'DEV MOBILE', "DEV WEB" => 'DEV WEB',
            "DEV WEB MOBILE" => 'DEV WEB MOBILE',
            "MANAGEMENT" => 'MANAGEMENT',
            "DROIT DES AFFAIRES" => 'DROIT DES AFFAIRES'
        ];
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg"
                ],
                "label"=>"Libelle Classe"
            ])
            ->add('filiere', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm"
                ],
                'choices' => $filiere
            ])
            ->add('niveau', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm"
                ], 'choices' => $niveau
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
