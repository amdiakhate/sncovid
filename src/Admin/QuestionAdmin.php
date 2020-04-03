<?php

namespace App\Admin;

use App\Entity\Question;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class QuestionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class);
        $formMapper->add('question', TextType::class);
        $formMapper->add(
            'type',
            ChoiceFieldMaskType::class,
            [
                'choices' => [
                    'form.admin.number' => Question::TYPE_NUMBER,
                    'form.admin.text' => Question::TYPE_TEXT,
                    'form.admin.choices' =>  Question::TYPE_CHOICES,
                ],
                'map' => [
                    'choices' => ['choices'],
                ],
                'placeholder' => 'form.admin.type_placeholder',
                'label'=>'form.admin.type'
            ]
        );
        $formMapper->add('choices', null,[
            'label'=>'form.admin.choices',
            'help'=>'form.admin.choices.help'
        ]);
        $formMapper->add('help', null,[
            'label'=>'form.admin.help',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('question');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('question');
    }
}