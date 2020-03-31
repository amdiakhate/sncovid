<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SymptomRepository")
 */
class Symptom
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
    private $name;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SymptomPatient", mappedBy="symptom", orphanRemoval=true)
     */
    private $symptomPatients;

    public function __construct()
    {
        $this->symptomPatients = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void
    {
        $this->question = $question;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $symptomPatient->setSymptom($this);
        }

        return $this;
    }

    public function removeSymptomPatient(SymptomPatient $symptomPatient): self
    {
        if ($this->symptomPatients->contains($symptomPatient)) {
            $this->symptomPatients->removeElement($symptomPatient);
            // set the owning side to null (unless already changed)
            if ($symptomPatient->getSymptom() === $this) {
                $symptomPatient->setSymptom(null);
            }
        }

        return $this;
    }

}
