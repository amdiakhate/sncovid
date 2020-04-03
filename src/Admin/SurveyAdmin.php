<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;

final class SurveyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('patient');
        $formMapper->add('creationDate', DatePickerType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('patient');
        $datagridMapper->add('creationDate');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('patient');
        $listMapper->addIdentifier('creationDate');
    }
}