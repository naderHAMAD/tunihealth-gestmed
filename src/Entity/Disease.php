<?php

namespace App\Entity;

use App\Repository\DiseaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DiseaseRepository::class)
 */
class Disease
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $diseasename;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $medicamentname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $cinpatient;




    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Medication", inversedBy="diseases")
     */
    private $medications;

    /**
     * @ORM\ManyToMany(targetEntity=Ordonnance::class, mappedBy="Diseases")
     */
    private $ordonnances;

    public function __construct()
    {
        $this->medications = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiseasename(): ?string
    {
        return $this->diseasename;
    }

    public function setDiseasename(string $diseasename): self
    {
        $this->diseasename = $diseasename;

        return $this;
    }

    public function getMedicamentname(): ?string
    {
        return $this->medicamentname;
    }

    public function setMedicamentname(string $medicamentname): self
    {
        $this->medicamentname = $medicamentname;

        return $this;
    }

    public function getCinpatient(): ?string
    {
        return $this->cinpatient;
    }

    public function setCinpatient(string $cinpatient): self
    {
        $this->cinpatient = $cinpatient;

        return $this;
    }

    /**
     * @return Collection|Medication[]
     */
    public function getMedication(): Collection
    {
        return $this->medications;
    }
    public function addMedication(Medication $medications): self
    {
        if (!$this->medications->contains($medications)) {
            $this->medications[] = $medications;
        }
        return $this;
    }
    public function removeMedication(Medication $medications): self
    {
        if ($this->medications->contains($medications)) {
            $this->medications->removeElement($medications);
        }
        return $this;
    }

    /**
     * @return Collection|Ordonnance[]
     */
    public function getOrdonnances(): Collection
    {
        return $this->ordonnances;
    }

    public function addOrdonnance(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnances->contains($ordonnance)) {
            $this->ordonnances[] = $ordonnance;
            $ordonnance->addDisease($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            $ordonnance->removeDisease($this);
        }

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->diseasename;
        // to show the id of the Category in the select
        // return $this->id;
    }


}
