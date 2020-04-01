<?php

namespace App\Manager;

use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param Patient $patient
     * @param array   $comorbiditiesPatients
     * @param array   $symptomsPatient
     * @return Patient
     */
    public function savePatient(Patient $patient, array $comorbiditiesPatients, array $symptomsPatient)
    {
        $this->entityManager->persist($patient);

        if ($comorbiditiesPatients) {
            foreach ($comorbiditiesPatients as $comorbidityPatient) {
                $patient->addComorbidityPatient($comorbidityPatient);
                $this->entityManager->persist($comorbidityPatient);
            }
        }
        if ($symptomsPatient) {
            foreach ($symptomsPatient as $symptomPatient) {
                $patient->addSymptomPatient($symptomPatient);
                $this->entityManager->persist($symptomPatient);
            }
        }

        $this->entityManager->flush();

        return $patient;
    }

}