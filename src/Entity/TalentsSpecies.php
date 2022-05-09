<?php

namespace App\Entity;

use App\Repository\TalentsSpeciesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TalentsSpecies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSpecies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idTalents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Specs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idTalentsSec;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specsSec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSpecies(): ?int
    {
        return $this->idSpecies;
    }

    public function setIdSpecies(?int $idSpecies): self
    {
        $this->idSpecies = $idSpecies;

        return $this;
    }

    public function getIdTalents(): ?int
    {
        return $this->idTalents;
    }

    public function setIdTalents(?int $idTalents): self
    {
        $this->idTalents = $idTalents;

        return $this;
    }

    public function getSpecs(): ?string
    {
        return $this->Specs;
    }

    public function setSpecs(?string $Specs): self
    {
        $this->Specs = $Specs;

        return $this;
    }

    public function getIdTalentsSec(): ?int
    {
        return $this->idTalentsSec;
    }

    public function setIdTalentsSec(?int $idTalentsSec): self
    {
        $this->idTalentsSec = $idTalentsSec;

        return $this;
    }

    public function getSpecsSec(): ?string
    {
        return $this->specsSec;
    }

    public function setSpecsSec(?string $specsSec): self
    {
        $this->specsSec = $specsSec;

        return $this;
    }
}
