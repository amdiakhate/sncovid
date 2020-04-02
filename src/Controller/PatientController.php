<?php

namespace App\Controller;

use App\Entity\ComorbidityPatient;
use App\Entity\Patient;
use App\Entity\SymptomPatient;
use App\Form\ComorbidityPatientType;
use App\Form\SymptomPatientType;
use App\Manager\PatientManager;
use App\Repository\ComorbidityRepository;
use App\Repository\SymptomRepository;
use phpDocumentor\Reflection\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{

    /**
     * @Route("/suspicious", name="suspicious")
     * @param Request               $request
     * @param ComorbidityRepository $comorbidityRepository
     * @param PatientManager        $patientManager
     * @return Response
     */
    public function suspicious(
        Request $request,
        ComorbidityRepository $comorbidityRepository,
        SymptomRepository $symptomRepository,
        PatientManager $patientManager
    ) {
        $patient = new Patient();
        $symptoms = $symptomRepository->findAll();
        $form = $this->generateSuspisciousForm($patient, [], $symptoms);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Patient $patient
             */
            $patient = $form->getData();
            $patient->setSelfDeclare(true);
            $patient->setSelfDeclare(true);
            $symptomsPatient = [];
            if ($patient->getHaveSymptoms()) {
                foreach ($symptoms as $symptom) {
//                Get the symptoms as well
                    $symptomPatient = new SymptomPatient();
                    $symptomPatient->setPatient($patient);
                    $symptomPatient->setSymptom($symptom);
                    $symptomPatient->setValue($form[$symptom->getName()]->getData()['value']);
                    $symptomsPatient[] = $symptomPatient;
                }

            }

            $save = $patientManager->savePatient($patient, [], $symptomsPatient);
            if ($save) {
                return $this->render(
                    'user/suspicious/success.html.twig',
                    [
                        'patient' => $patient,
                    ]
                );
            }

        }

        return $this->render(
            'user/suspicious/suspicious.html.twig',
            [
                'form' => $form->createView(),
                'comorbidities' => null,
                'symptoms' => $symptoms,
            ]
        );
    }

    private function generateSuspisciousForm($patient, array $comorbidities, array $symptoms, bool $complete = false)
    {
        $form = $this->createFormBuilder($patient)
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'form.firstname',
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'form.lastname',
                ]
            )
            ->add(
                'sex',
                ChoiceType::class,
                [
                    'label' => 'form.sex',
                    'choices' => [
                        'form.male' => 'h',
                        'form.female' => 'f',
                    ],
                ]
            )
            ->add(
                'birthdate',
                DateType::class,
                [
                    'label' => 'form.birthdate',
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'form.address',
                ]
            )
            ->add(
                'phone',
                TelType::class,
                [
                    'label' => 'form.phone',
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'form.email',
                ]
            )
            ->add(
                'haveSymptoms',
                ChoiceType::class,
                [
                    'label' => 'form.haveSymptoms',
                    'choices' => [
                        'yes' => 1,
                        'no' => 0,
                    ],
                ]
            )
            ->add(
                'visitedCountry',
                ChoiceType::class,
                [
                    'label' => 'form.visitedCountry',
                    'choices' => [
                        'yes' => 1,
                        'no' => 0,
                    ],
                ]
            )
            ->add(
                'whichCountry',
                TelType::class,
                [
                    'required' => false,
                    'label' => 'form.whichCountry',
                ]
            )
            ->add(
                'caseContact',
                ChoiceType::class,
                [
                    'label' => 'form.caseContact',
                    'choices' => [
                        'yes' => 1,
                        'no' => 0,
                    ],
                ]
            )
            ->add(
                'caseContactWho',
                TelType::class,
                [
                    'required' => false,
                    'label' => 'form.caseContactWho',
                ]
            )
            ->add(
                'otherNumber',
                TelType::class,
                [
                    'required' => false,
                    'label' => 'form.otherPhone',
                ]
            )
            ->add(
                'referentDoctor',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'form.referentDoctor',
                ]
            )
            ->add(
                'pregnant',
                null,
                [
                    'label' => 'form.pregnant',
                ]
            )
            ->add(
                'background',
                null,
                [
                    'label' => 'form.background',
                ]
            );

        if ($complete) {
            foreach ($comorbidities as $comorbidity) {
                $form->add(
                    $comorbidity->getName(),
                    ComorbidityPatientType::class,
                    [
                        'mapped' => false,
                        'question' => $comorbidity->getQuestion(),
                    ]
                );
            }
        }

        foreach ($symptoms as $symptom) {
            $form->add(
                $symptom->getName(),
                SymptomPatientType::class,
                [
                    'mapped' => false,
                    'question' => $symptom->getQuestion(),
                ]
            );
        }

        return $form
            ->getForm();

    }
}
