<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\Column(type="date")
     */
    private $bithdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $otherNumber;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $referentDoctor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pregnant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $background;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComorbidityPatient", mappedBy="patient", orphanRemoval=true)
     */
    private $comorbidityPatients;

    /**
     * @ORM\Column(type="boolean")
     */
    private $selfDeclare;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $initialInfection;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $daySymptoms;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dayDiagnostic;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $infiltrates;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $treatmentDetails;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTreatment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $otherPeople;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $otherPeopleDetails;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $homeFollowUp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SymptomPatient", mappedBy="patient", orphanRemoval=true)
     */
    private $symptomPatients;

    /**
     * @ORM\Column(type="boolean")
     */
    private $haveSymptoms;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visitedCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $whichCountry;

    /**
     * @ORM\Column(type="boolean")
     */
    private $caseContact;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $caseContactWho;

    public function __construct()
    {
        $this->comorbidityPatients = new ArrayCollection();
        $this->symptomPatients = new ArrayCollection();
        $this->setHaveSymptoms(false);
        $this->setVisitedCountry(false);
        $this->setCaseContact(false);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBithdate(): ?\DateTimeInterface
    {
        return $this->bithdate;
    }

    public function setBithdate(\DateTimeInterface $bithdate): self
    {
        $this->bithdate = $bithdate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getOtherNumber(): ?string
    {
        return $this->otherNumber;
    }

    public function setOtherNumber(?string $otherNumber): self
    {
        $this->otherNumber = $otherNumber;

        return $this;
    }

    public function getReferentDoctor(): ?string
    {
        return $this->referentDoctor;
    }

    public function setReferentDoctor(?string $referentDoctor): self
    {
        $this->referentDoctor = $referentDoctor;

        return $this;
    }

    public function getPregnant(): ?bool
    {
        return $this->pregnant;
    }

    public function setPregnant(bool $pregnant): self
    {
        $this->pregnant = $pregnant;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    /**
     * @return Collection|ComorbidityPatient[]
     */
    public function getComorbidityPatients(): Collection
    {
        return $this->comorbidityPatients;
    }

    public function addComorbidityPatient(ComorbidityPatient $comorbidityPatient): self
    {
        if (!$this->comorbidityPatients->contains($comorbidityPatient)) {
            $this->comorbidityPatients[] = $comorbidityPatient;
            $comorbidityPatient->setPatient($this);
        }

        return $this;
    }

    public function removeComorbidityPatient(ComorbidityPatient $comorbidityPatient): self
    {
        if ($this->comorbidityPatients->contains($comorbidityPatient)) {
            $this->comorbidityPatients->removeElement($comorbidityPatient);
            // set the owning side to null (unless already changed)
            if ($comorbidityPatient->getPatient() === $this) {
                $comorbidityPatient->setPatient(null);
            }
        }

        return $this;
    }

    public function getSelfDeclare(): ?bool
    {
        return $this->selfDeclare;
    }

    public function setSelfDeclare(bool $selfDeclare): self
    {
        $this->selfDeclare = $selfDeclare;

        return $this;
    }

    public function getInitialInfection(): ?string
    {
        return $this->initialInfection;
    }

    public function setInitialInfection(?string $initialInfection): self
    {
        $this->initialInfection = $initialInfection;

        return $this;
    }

    public function getDaySymptoms(): ?\DateTimeInterface
    {
        return $this->daySymptoms;
    }

    public function setDaySymptoms(?\DateTimeInterface $daySymptoms): self
    {
        $this->daySymptoms = $daySymptoms;

        return $this;
    }

    public function getDayDiagnostic(): ?\DateTimeInterface
    {
        return $this->dayDiagnostic;
    }

    public function setDayDiagnostic(?\DateTimeInterface $dayDiagnostic): self
    {
        $this->dayDiagnostic = $dayDiagnostic;

        return $this;
    }

    public function getInfiltrates(): ?bool
    {
        return $this->infiltrates;
    }

    public function setInfiltrates(?bool $infiltrates): self
    {
        $this->infiltrates = $infiltrates;

        return $this;
    }

    public function getTreatment(): ?bool
    {
        return $this->treatment;
    }

    public function setTreatment(?bool $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getTreatmentDetails(): ?string
    {
        return $this->treatmentDetails;
    }

    public function setTreatmentDetails(?string $treatmentDetails): self
    {
        $this->treatmentDetails = $treatmentDetails;

        return $this;
    }

    public function getDateTreatment(): ?\DateTimeInterface
    {
        return $this->dateTreatment;
    }

    public function setDateTreatment(?\DateTimeInterface $dateTreatment): self
    {
        $this->dateTreatment = $dateTreatment;

        return $this;
    }

    public function getOtherPeople(): ?bool
    {
        return $this->otherPeople;
    }

    public function setOtherPeople(?bool $otherPeople): self
    {
        $this->otherPeople = $otherPeople;

        return $this;
    }

    public function getOtherPeopleDetails(): ?string
    {
        return $this->otherPeopleDetails;
    }

    public function setOtherPeopleDetails(?string $otherPeopleDetails): self
    {
        $this->otherPeopleDetails = $otherPeopleDetails;

        return $this;
    }

    public function getHomeFollowUp(): ?bool
    {
        return $this->homeFollowUp;
    }

    public function setHomeFollowUp(?bool $homeFollowUp): self
    {
        $this->homeFollowUp = $homeFollowUp;

        return $this;
    }

    /**
     * @return Collection|SymptomPatient[]
     */
    public function getSymptomPatients(): Collection
    {
        return $this->symptomPatients;
    }

    public function addSymptomPatient(SymptomPatient $symptomPatient): self
    {
        if (!$this->symptomPatients->contains($symptomPatient)) {
            $this->symptomPatients[] = $symptomPatient;
            $symptomPatient->setPatient($this);
        }

        return $this;
    }

    public function removeSymptomPatient(SymptomPatient $symptomPatient): self
    {
        if ($this->symptomPatients->contains($symptomPatient)) {
            $this->symptomPatients->removeElement($symptomPatient);
            // set the owning side to null (unless already changed)
            if ($symptomPatient->getPatient() === $this) {
                $symptomPatient->setPatient(null);
            }
        }

        return $this;
    }

    public function getHaveSymptoms(): ?bool
    {
        return $this->haveSymptoms;
    }

    public function setHaveSymptoms(bool $haveSymptoms): self
    {
        $this->haveSymptoms = $haveSymptoms;

        return $this;
    }

    public function getVisitedCountry(): ?bool
    {
        return $this->visitedCountry;
    }

    public function setVisitedCountry(bool $visitedCountry): self
    {
        $this->visitedCountry = $visitedCountry;

        return $this;
    }

    public function getWhichCountry(): ?string
    {
        return $this->whichCountry;
    }

    public function setWhichCountry(?string $whichCountry): self
    {
        $this->whichCountry = $whichCountry;

        return $this;
    }

    public function getCaseContact(): ?bool
    {
        return $this->caseContact;
    }

    public function setCaseContact(bool $caseContact): self
    {
        $this->caseContact = $caseContact;

        return $this;
    }

    public function getCaseContactWho(): ?string
    {
        return $this->caseContactWho;
    }

    public function setCaseContactWho(?string $caseContactWho): self
    {
        $this->caseContactWho = $caseContactWho;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getScore(): int
    {
        $symptomPatients = $this->getSymptomPatients();
        $score = 0;

        if (empty($symptomPatients)) {
            return $score;
        }
        foreach ($symptomPatients as $symptomPatient) {
            if($symptomPatient->getValue() == 'yes'){
                $score += $symptomPatient->getSymptom()->getQuotation();
            }
        }

        if ($this->getVisitedCountry()) {
            $score += 1;
        }

        return $score;
    }

    /**
     * @return string
     */
    public function getLikelyHood()
    {
        $score = $this->getScore();
        if ($this->getCaseContact() && $score <= 3) {
            return 'case_contact';
        }

        switch (true) {
            case in_array($score, range(0, 3)):
                return 'unlikely';
            case in_array($score, range(3, 5)):
                return 'likely';
            case $score > 5:
                return 'very_likely';
        }

        return 'unlikely';
    }

}
