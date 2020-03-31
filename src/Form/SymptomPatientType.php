<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SymptomPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add(
                'value',
                ChoiceType::class,
                [
                    'choices' => [
                        'yes' => 'yes',
                        'no' => 'no',
                    ],
                    'expanded' => true,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // this defines the available options and their default values when
        // they are not configured explicitly when using the form type
        $resolver->setDefaults(
            [
                'question' => null,
            ]
        );
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // pass the form type option directly to the template
        $view->vars['question'] = $options['question'];

    }
}