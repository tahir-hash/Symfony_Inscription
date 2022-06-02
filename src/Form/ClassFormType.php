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
        $niveau = ["L1" => 'L1', "L2" => 'L2', "L3" => 'L3', 
        "M1" => 'M1', "M2" => 'M2', "DOCTORAT" => 'DOCTORAT'];
        $filiere = [
            "INFORMATIQUE DE GESTION" => 'INFORMATIQUE DE GESTION',
             "GENIE LOGICIEL" => 'GENIE LOGICIEL', "MARKETING" => 'MARKETING', 
             "GESTION DE PROJET" => 'GESTION DE PROJET',
            "MANAGEMENT" => 'MANAGEMENT', 
            "DROIT DES AFFAIRES" => 'DROIT DES AFFAIRES'
        ];
        $builder
            ->add('libelle', TextType::class)
            ->add('filiere', ChoiceType::class, ['choices' => $filiere])
            ->add('niveau', ChoiceType::class, ['choices' => $niveau])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
