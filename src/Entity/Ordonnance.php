<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;

/**
 * @ORM\Entity(repositoryClass=OrdonnanceRepository::class)
 */
class Ordonnance
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
    private $nompatient;

    /**
     * @ORM\Column(type="text")
     */
    private $autre;

    /**
     * @ORM\ManyToMany(targetEntity=Medication::class, inversedBy="ordonnances")
     */
    private $Medications;

    /**
     * @ORM\ManyToMany(targetEntity=Disease::class, inversedBy="ordonnances")
     */
    private $Diseases;

    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }



    public function __construct()
    {
        $this->Medications = new ArrayCollection();
        $this->Diseases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNompatient(): ?string
    {
        return $this->nompatient;
    }

    public function setNompatient(string $nompatient): self
    {
        $this->nompatient = $nompatient;

        return $this;
    }

    public function getAutre(): ?string
    {
        return $this->autre;
    }

    public function setAutre(string $autre): self
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * @return Collection|Medication[]
     */
    public function getMedications(): Collection
    {
        return $this->Medications;
    }

    public function addMedication(Medication $medication): self
    {
        if (!$this->Medications->contains($medication)) {
            $this->Medications[] = $medication;
        }

        return $this;
    }

    public function removeMedication(Medication $medication): self
    {
        $this->Medications->removeElement($medication);

        return $this;
    }

    /**
     * @return Collection|Disease[]
     */
    public function getDiseases(): Collection
    {
        return $this->Diseases;
    }

    public function addDisease(Disease $disease): self
    {
        if (!$this->Diseases->contains($disease)) {
            $this->Diseases[] = $disease;
        }

        return $this;
    }

    public function removeDisease(Disease $disease): self
    {
        $this->Diseases->removeElement($disease);

        return $this;
    }

}
