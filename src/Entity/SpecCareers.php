<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpecCareers
 *
 * @ORM\Table(name="spec_careers", indexes={@ORM\Index(name="FK_SCAREER_CAREER", columns={"ID_Career"}), @ORM\Index(name="FK_SCAREER_SPECIE", columns={"ID_Species"})})
 * @ORM\Entity
 */
class SpecCareers
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Species", type="integer", nullable=false)
     */
    private $idSpecies;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Career", type="integer", nullable=false)
     */
    private $idCareer;

    /**
     * @ORM\Column(type="integer")
     */
    private $rollmin;

    /**
     * @ORM\Column(type="integer")
     */
    private $rollmax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSpecies(): ?int
    {
        return $this->idSpecies;
    }

    public function setIdSpecies(int $idSpecies): self
    {
        $this->idSpecies = $idSpecies;

        return $this;
    }

    public function getIdCareer(): ?int
    {
        return $this->idCareer;
    }

    public function setIdCareer(int $idCareer): self
    {
        $this->idCareer = $idCareer;

        return $this;
    }

    public function getRollmin(): ?int
    {
        return $this->rollmin;
    }

    public function setRollmin(int $rollmin): self
    {
        $this->rollmin = $rollmin;

        return $this;
    }

    public function getRollmax(): ?int
    {
        return $this->rollmax;
    }

    public function setRollmax(int $rollmax): self
    {
        $this->rollmax = $rollmax;

        return $this;
    }


}
