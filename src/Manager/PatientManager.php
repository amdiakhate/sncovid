<?php

namespace App\Manager;

use App\Entity\Patient;
use App\Entity\Question;
use App\Entity\Response;
use App\Entity\Survey;
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

    /**
     * @param Patient $patient
     * @return Survey
     * @throws \Exception
     */
    public function sendSurvey(Patient $patient)
    {
        $survey = Survey::withPatient($patient);
//        todo : send mail & sms here
        $survey->setStatus(Survey::STATUS_SENT);
        $this->entityManager->persist($survey);
        $this->entityManager->flush();

        return $survey;

    }

    /**
     * @param            $form
     * @param Question[] $questions
     * @param Survey     $survey
     * @return bool
     */
    public function saveResponses($form, array $questions, Survey $survey)
    {
        if($survey->getStatus() == Survey::STATUS_COMPLETED){
            return false;
        }
        foreach ($questions as $question) {
            $response = new Response();
            $response->setQuestion($question);
            $response->setValue($form[$question->getName()]->getData());
            $response->setSurvey($survey);
            $survey->setStatus(Survey::STATUS_COMPLETED);
            $this->entityManager->persist($survey);
            $this->entityManager->persist($response);
        }
        $this->entityManager->flush();

        return true;
    }

}