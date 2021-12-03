<?php

namespace App\Entity;

use App\Repository\MedicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicationRepository::class)
 */
class Medication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $medicationname;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Disease", mappedBy="medications")
     */
    private $diseases;

    /**
     * @ORM\ManyToMany(targetEntity=Ordonnance::class, mappedBy="Medications")
     */
    private $ordonnances;

    public function __construct()
    {
        $this->diseases = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicationname(): ?string
    {
        return $this->medicationname;
    }

    public function setMedicationname(string $medicationname): self
    {
        $this->medicationname = $medicationname;

        return $this;
    }




    /**
     * @return Collection|Disease[]
     */
    public function getDiseases(): Collection
    {
        return $this->diseases;
    }
    public function addDisease(Disease $disease): self
    {
        if (!$this->diseases->contains($disease)) {
            $this->diseases[] = $disease;
            $disease->addMedication($this);
        }
        return $this;
    }
    public function removeDisease(Disease $disease): self
    {
        if ($this->diseases->contains($disease)) {
            $this->diseases->removeElement($disease);
            $disease->removeMedicaton($this);
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
            $ordonnance->addMedication($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->removeElement($ordonnance)) {
            $ordonnance->removeMedication($this);
        }

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->medicationname;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
