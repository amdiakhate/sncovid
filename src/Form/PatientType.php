<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénoms',
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Nom',
                ]
            )
            ->add(
                'sex',
                ChoiceType::class,
                [
                    'choices' => [
                        'male' => 'Homme',
                        'female' => 'Féminin',
                    ],
                ]
            )
            ->add(
                'bithdate',
                DateType::class,
                [
                    'label' => 'Date de naissance',
                ]
            )
//            ->add('bithdate', DateType::class, [
//                'html5' => false,
//                'attr' => ['class' => 'js-datepicker'],
//            ])
            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'Adresse',
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'Numéro de téléphone',
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Email',
                ]
            )
            ->add(
                'otherNumber',
                TextType::class,
                [
                    'label' => 'Numéro de téléphone mobile d’un contact tiers',
                ]
            )
            ->add(
                'referentDoctor',
                TextType::class,
                [
                    'label' => 'Médecin généraliste référent du patient (coordonnées)',
                ]
            )
            ->add(
                'pregnant',
                null,
                [
                    'label' => 'Enceinte ?',
                ]
            )
            ->add(
                'background',
                null,
                [
                    'label' => 'Traitements au long cours notables',
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'attr' => ['class' => 'save'],
                ]
            );;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Patient::class,
            ]
        );
    }
}
