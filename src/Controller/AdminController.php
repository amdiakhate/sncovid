<?php

namespace App\Controller;

use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/backend", name="backend")
     * @param PatientRepository $patientRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PatientRepository $patientRepository)
    {
        $patients = $patientRepository->findAll();

        return $this->render(
            'backend/patient/list.html.twig',
            ['patients' => $patients]
        );
    }

}
