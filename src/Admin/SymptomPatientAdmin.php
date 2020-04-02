<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SymptomPatientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('question', null,  [
            'label' => 'form.admin.symptom',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper->add('name');
//        $datagridMapper->add('question');
//        $datagridMapper->add('quotation');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
//        $listMapper->addIdentifier('name');
//        $listMapper->addIdentifier('question');
//        $listMapper->addIdentifier('quotation');
    }
}