<?php
namespace App\Entity;
class PropertySearch
{
  private $speciality;
public function getspeciality(): ?string
{
return $this->speciality;
}
public function setspeciality(string $speciality): self
{
$this->speciality = $speciality;
return $this;
}
}
