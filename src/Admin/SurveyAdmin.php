<?php

namespace App\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;

final class SurveyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('admin.survey.label')
            ->add('patient')
            ->
            add('creationDate', DatePickerType::class, ['label'=>'form.admin.creationDate'])
            ->end()
            ->end();
//        $formMapper->tab('responses')
//            ->add('responses')
//            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('patient');
        $datagridMapper->add('creationDate', null, ['label'=>'form.admin.creationDate']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('patient', null, ['label'=>'admin.patient.label']);
        $listMapper->addIdentifier(
            'creationDate',
            'date',
            [
                'label' => 'form.admin.creationDate',
                'pattern' => 'dd MMM y ',
                'locale' => 'fr',

            ]
        );
        $listMapper->add(
            'status',
            'string',
            [
                'label' => 'admin.survey.status',
                'template' => 'backend/survey/list_status.html.twig',
            ]
        );
    }

    protected function configureTabMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ($this->isGranted('LIST')) {
            $menu->addChild(
                'Réponses',
                [
                    'uri' => $admin->generateUrl('admin.response.list', ['id' => $id]),
                ]
            );
        }
    }
}