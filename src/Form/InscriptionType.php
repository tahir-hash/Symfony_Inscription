<?php

namespace App\Form;

use App\Entity\Classe;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe',EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'libelle',
                'attr'=>[
                    'class'=>'select form-control-lg'
                ],
                'label'=>" ", 
                'required'=>false,
                
            ])
            ->add('etudiant',EtudiantType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
