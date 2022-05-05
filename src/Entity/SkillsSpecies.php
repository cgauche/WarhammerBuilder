<?php

namespace App\Entity;

use App\Repository\SkillsSpeciesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SkillsSpecies
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
    private $idSkills;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSpecies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSkills(): ?int
    {
        return $this->idSkills;
    }

    public function setIdSkills(?int $idSkills): self
    {
        $this->idSkills = $idSkills;

        return $this;
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

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(?string $specs): self
    {
        $this->specs = $specs;

        return $this;
    }
}
