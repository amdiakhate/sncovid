<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SymptomAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label'=>'admin.symptom.name'
        ]);
        $formMapper->add('question', TextType::class, [
            'label'=>'admin.symptom.question'
        ]);
        $formMapper->add('quotation', null, [
            'label'=>'admin.symptom.quotation'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name', null , [
            'label'=>'admin.symptom.name'
        ]);
        $datagridMapper->add('question', null, [
            'label'=>'admin.symptom.question'
        ]);
        $datagridMapper->add('quotation',null, [
            'label'=>'admin.symptom.quotation'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name',null, [
            'label'=>'admin.symptom.name'
        ]);
        $listMapper->addIdentifier('question',null, [
            'label'=>'admin.symptom.question'
        ]);
        $listMapper->addIdentifier('quotation',null, [
            'label'=>'admin.symptom.quotation'
        ]);
    }
}