<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ComorbidityAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label'=>'admin.comorbidity.name'
        ]);
        $formMapper->add('question', TextType::class, [
            'label'=>'admin.comorbidity.question'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name',null, [
            'label'=>'admin.comorbidity.name'
        ]);
        $datagridMapper->add('question',null, [
            'label'=>'admin.comorbidity.question'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name',null, [
            'label'=>'admin.comorbidity.name'
        ]);
        $listMapper->addIdentifier('question',null, [
            'label'=>'admin.comorbidity.question'
        ]);
    }
}