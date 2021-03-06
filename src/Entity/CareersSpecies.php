<?php

namespace App\Entity;

use App\Repository\CareersSpeciesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CareersSpecies
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
    private $idCareers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSpecies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCareers(): ?int
    {
        return $this->idCareers;
    }

    public function setIdCareers(?int $idCareers): self
    {
        $this->idCareers = $idCareers;

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

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(?int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(?int $max): self
    {
        $this->max = $max;

        return $this;
    }
}
