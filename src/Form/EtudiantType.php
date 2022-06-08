<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ], 'required'=>false,
                //'mapped'=>true
            ])
            ->add('sexe', ChoiceType::class, [
                'attr' => [
                    'class' => "form-select form-select-sm",
                ],
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Feminin' => 'Feminin'
                ], 'required'=>false,
                //'mapped'=>true
            ])
            ->add('adresse',TextType::class, [
                'attr' => [
                    'class' => "form-control form-control-lg",
                ], 'required'=>false,
                //'mapped'=>true
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
