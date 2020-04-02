<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PatientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper->tab('Personal informations')
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'form.admin.firstname',
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'form.admin.lastname',
                ]
            )
            ->add(
                'sex',
                ChoiceType::class,
                [
                    'label' => 'form.admin.sex',
                    'choices' => [
                        'male' => 'Homme',
                        'female' => 'Féminin',
                    ],
                ]
            )
            ->add(
                'birthdate',
                DatePickerType::class,
                [
                    'label' => 'form.admin.birthdate',
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'form.admin.email',
                ]
            )
            ->add(
                'address',
                null,
                [
                    'label' => 'form.admin.address',
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'form.admin.ville',
                ]
            )
            ->add(
                'phone',
                TelType::class,
                [
                    'label' => 'form.admin.phone',
                ]
            )
            ->add(
                'referentDoctor',
                TextType::class,
                [
                    'label' => 'form.admin.referentDoctor',
                    'required' => false,
                ]
            )
            ->add(
                'pregnant',
                null,
                [
                    'label' => 'form.admin.pregnant',
                ]
            )
            ->add(
                'otherNumber',
                TelType::class,
                [
                    'label' => 'form.admin.otherPhone',
                    'required' => false,
                ]
            )
            ->end()
            ->end();

        $formMapper->tab('Etat actuel')
            ->with('form.admin.symptom')
            ->add(
                'symptomPatients',
                CollectionType::class,
                [
                    'label' => 'form.admin.symptom',
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                    ],
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ]
            )
            ->add(
                'visitedCountry',
                ChoiceType::class,
                [
                    'label' => 'form.admin.visitedCountry',
                    'choices' => [
                        'yes' => 1,
                        'no' => 0,
                    ],
                ]
            )
            ->add(
                'whichCountry',
                null,
                ['label' => 'form.admin.whichCountry']
            )
            ->add(
                'caseContact',
                ChoiceType::class,
                [
                    'label' => 'form.admin.caseContact',
                    'choices' => [
                        'yes' => 1,
                        'no' => 0,
                    ],
                ]
            )
            ->add(
                'caseContactWho',
                null,
                ['label' => 'form.admin.caseContactWho']
            )
            ->end()
            ->end();
        $formMapper->tab('form.admin.comorbidities')
            ->with('Comorbidities', ['label' => 'form.admin.comorbidities'])
            ->add(
                'comorbidityPatients',
                CollectionType::class,
                [
                    'label' => 'form.admin.comorbidity',
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                    ],
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ]
            )
            ->end()
            ->end();

        $formMapper->tab('form.admin.covidTab')
            ->with('form.admin.covid')
            ->add(
                'initialInfection',
                ChoiceType::class,
                [
                    'label' => 'form.admin.initialInfection',
                    'required' => false,

                    'choices' => [
                        'mild' => 'mild',
                        'severe' => 'severe',
                        'critical' => 'critical',
                    ],
                ]
            )
            ->add(
                'daySymptoms',
                DatePickerType::class,
                [
                    'label' => 'form.admin.daySymptoms',
                    'required' => false,

                ]
            )
            ->add(
                'dayDiagnostic',
                DatePickerType::class,
                [
                    'label' => 'form.admin.dayDiagnostic',
                    'required' => false,

                ]
            )
            ->add(
                'infiltrates',
                ChoiceType::class,
                [
                    'label' => 'form.admin.caseContact',
                    'required' => false,

                    'choices' => [
                        'form.admin.yes' => 1,
                        'form.admin.no' => 0,
                    ],
                ]
            )
            ->add(
                'treatment',
                ChoiceType::class,
                [
                    'label' => 'form.admin.treatment',
                    'required' => false,
                    'choices' => [
                        'form.admin.yes' => 1,
                        'form.admin.no' => 0,
                    ],
                ]
            )
            ->add(
                'treatmentDetails',
                null,
                [
                    'label' => 'form.admin.treatmentDetails',
                    'required' => false,
                ]
            )
            ->add(
                'dateTreatment',
                DatePickerType::class,
                [
                    'label' => 'form.admin.dateTreatment',
                    'required' => false,
                ]
            )
            ->add(
                'otherPeople',
                ChoiceType::class,
                [
                    'label' => 'form.admin.otherPeople',
                    'required' => false ,
                    'choices' => [
                        'form.admin.yes' => 1,
                        'form.admin.no' => 0,
                    ],
                ]
            )
            ->add(
                'otherPeopleDetails',
                null,
                [
                    'label' => 'form.admin.otherPeopleDetails',
                    'required' => false,

                ]
            )
            ->add(
                'homeFollowUp',
                ChoiceType::class,
                [
                    'label' => 'form.admin.homeFollowUp',
                    'help' => 'form.admin.homeFollowUpHelp',
                    'required' => false,
                    'choices' => [
                        'form.admin.yes' => 1,
                        'form.admin.no' => 0,
                    ],
                ]
            )
            ->end()
            ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('firstname');
        $datagridMapper->add('lastname');
        $datagridMapper->add('sex');
        $datagridMapper->add('address');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('firstname');
        $listMapper->addIdentifier('lastname');
        $listMapper->addIdentifier('sex');
        $listMapper->addIdentifier('address');
        $listMapper->add('score', IntegerType::class);
    }

    public function prePersist($object)
    {
        $symptomPatients = $object->getSymptomPatients();
        foreach ($symptomPatients as $symptomPatient) {
            $symptomPatient->setValue(true);
            $symptomPatient->setPatient($object);

        }
        $comorbidityPatients = $object->getComorbidityPatients();
        foreach ($comorbidityPatients as $comorbidityPatient) {
            $comorbidityPatient->setValue(true);
            $comorbidityPatient->setPatient($object);
        }
    }

    public function preUpdate($object)
    {
        $symptomPatients = $object->getSymptomPatients();
        foreach ($symptomPatients as $symptomPatient) {
            $symptomPatient->setValue(true);
            $symptomPatient->setPatient($object);
        }

        $comorbidityPatients = $object->getComorbidityPatients();
        foreach ($comorbidityPatients as $comorbidityPatient) {
            $comorbidityPatient->setValue(true);
            $comorbidityPatient->setPatient($object);
        }
    }
}