<?php

namespace App\Controller;

use App\Entity\Comorbidity;
use App\Entity\ComorbidityPatient;
use App\Entity\Patient;
use App\Form\ComorbidityPatientType;
use App\Form\PatientType;
use App\Form\SuspiciousType;
use App\Manager\PatientManager;
use App\Repository\ComorbidityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render(
            'user/index.html.twig',
            [
                'controller_name' => 'UserController',
            ]
        );
    }

    /**
     * @Route("/suspicious", name="suspicious")
     * @param Request               $request
     * @param ComorbidityRepository $comorbidityRepository
     * @param PatientManager        $patientManager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
            $comorbiditiesPatient = [];
            foreach($comorbidities as $comorbidity)
            {
//                Get the comorbidities as well
                $comorbidyPatient = new ComorbidityPatient();
                $comorbidyPatient->setPatient($patient);
                $comorbidyPatient->setComorbidity($comorbidity);
                $comorbidyPatient->setValue($form[$comorbidity->getName()]->getData()['value']);
                $comorbiditiesPatient[] = $comorbidyPatient;
            }
            $patientManager->savePatient($patient, $comorbiditiesPatient);

        }

        return $this->render(
            'user/suspicious.html.twig',
            [
                'form' => $form->createView(),
                'comorbidities' => $comorbidities,
            ]
        );
    }

    private function generateSuspisciousForm($patient, array $comorbidities)
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
                    'label'=>'form.sex',
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
                    'label' => 'form.birthday',
                ]
            )
//            ->add('bithdate', DateType::class, [
//                'html5' => false,
//                'attr' => ['class' => 'js-datepicker'],
//            ])
            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'form.address',
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'form.phone',
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Email',
                ]
            )
            ->add(
                'otherNumber',
                TextType::class,
                [
                    'label' => 'Numéro de téléphone mobile d’un contact tiers',
                ]
            )
            ->add(
                'referentDoctor',
                TextType::class,
                [
                    'label' => 'Médecin généraliste référent du patient (coordonnées)',
                ]
            )
            ->add(
                'pregnant',
                null,
                [
                    'label' => 'Enceinte ?',
                ]
            )
            ->add(
                'background',
                null,
                [
                    'label' => 'Traitements au long cours notables',
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

        return $form
            ->getForm();

    }
}
