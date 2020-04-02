<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComorbidityRepository")
 */
class Comorbidity
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComorbidityPatient", mappedBy="comorbidity", orphanRemoval=true)
     */
    private $comorbidityPatients;

    public function __construct()
    {
        $this->comorbidityPatients = new ArrayCollection();
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
            $comorbidityPatient->setComorbidity($this);
        }

        return $this;
    }

    public function removeComorbidityPatient(ComorbidityPatient $comorbidityPatient): self
    {
        if ($this->comorbidityPatients->contains($comorbidityPatient)) {
            $this->comorbidityPatients->removeElement($comorbidityPatient);
            // set the owning side to null (unless already changed)
            if ($comorbidityPatient->getComorbidity() === $this) {
                $comorbidityPatient->setComorbidity(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
