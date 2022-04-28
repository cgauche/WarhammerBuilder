<?php

namespace App\Entity;

use App\Repository\CharacSpeciesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CharacSpecies
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
    private $idCharac;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $base;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbRoll;

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

    public function getIdCharac(): ?int
    {
        return $this->idCharac;
    }

    public function setIdCharac(?int $idCharac): self
    {
        $this->idCharac = $idCharac;

        return $this;
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(?int $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getNbRoll(): ?int
    {
        return $this->nbRoll;
    }

    public function setNbRoll(?int $nbRoll): self
    {
        $this->nbRoll = $nbRoll;

        return $this;
    }
}
