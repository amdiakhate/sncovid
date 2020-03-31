<?php

namespace App\Controller;

use App\Entity\ComorbidityPatient;
use App\Entity\Patient;
use App\Form\ComorbidityPatientType;
use App\Manager\PatientManager;
use App\Repository\ComorbidityRepository;
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
        PatientManager $patientManager
    ) {
        $patient = new Patient();
        $comorbidities = $comorbidityRepository->findAll();

        $form = $this->generateSuspisciousForm($patient, $comorbidities);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();
            $patient->setSelfDeclare(true);
            $comorbiditiesPatient = [];
            foreach ($comorbidities as $comorbidity) {
//                Get the comorbidities as well
                $comorbidyPatient = new ComorbidityPatient();
                $comorbidyPatient->setPatient($patient);
                $comorbidyPatient->setComorbidity($comorbidity);
                $comorbidyPatient->setValue($form[$comorbidity->getName()]->getData()['value']);
                $comorbiditiesPatient[] = $comorbidyPatient;
            }

            $save = $patientManager->savePatient($patient, $comorbiditiesPatient);
            if ($save) {
                return $this->render('user/suspicious/success.html.twig');
            }

        }

        return $this->render(
            'user/suspicious/suspicious.html.twig',
            [
                'form' => $form->createView(),
                'comorbidities' => $comorbidities,
            ]
        );
    }

    private function generateSuspisciousForm($patient, array $comorbidities, bool $complete = false)
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
                'bithdate',
                DateType::class,
                [
                    'label'=>'form.birthdate',
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

//            Todo  we're creating a real patient

        return $form
            ->getForm();

    }
}
