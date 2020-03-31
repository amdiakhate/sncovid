<?php

namespace App\Manager;

use App\Entity\ComorbidityPatient;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class PatientManager
{
    private $entityManager;

    /**
     * PatientManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Patient              $patient
     * @param ComorbidityPatient[] $comorbiditiesPatients
     * @return Patient
     */
    public function savePatient(Patient $patient, array $comorbiditiesPatients)
    {
        $this->entityManager->persist($patient);
        foreach ($comorbiditiesPatients as $comorbidityPatient) {
            $this->entityManager->persist($comorbidityPatient);
        }
        $this->entityManager->flush();

        return $patient;
    }

}