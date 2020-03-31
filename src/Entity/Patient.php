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

    public function __construct()
    {
        $this->comorbidityPatients = new ArrayCollection();
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
}
