<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Characters
 *
 * @ORM\Table(name="characters", indexes={@ORM\Index(name="FK_CHAR_SPECIE", columns={"ID_Species"}), @ORM\Index(name="FK_CHAR_CAREER", columns={"ID_Career"})})
 * @ORM\Entity
 */
class Characters
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
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=2500, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Fate", type="integer", nullable=true)
     */
    private $fate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Luck", type="integer", nullable=true)
     */
    private $luck;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Resilience", type="integer", nullable=true)
     */
    private $resilience;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Determination", type="integer", nullable=true)
     */
    private $determination;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Species", type="integer", nullable=false)
     */
    private $idSpecies;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Career", type="integer", nullable=true)
     */
    private $idCareer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFate(): ?int
    {
        return $this->fate;
    }

    public function setFate(?int $fate): self
    {
        $this->fate = $fate;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(?int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getResilience(): ?int
    {
        return $this->resilience;
    }

    public function setResilience(?int $resilience): self
    {
        $this->resilience = $resilience;

        return $this;
    }

    public function getDetermination(): ?int
    {
        return $this->determination;
    }

    public function setDetermination(?int $determination): self
    {
        $this->determination = $determination;

        return $this;
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

    public function setIdCareer(?int $idCareer): self
    {
        $this->idCareer = $idCareer;

        return $this;
    }


}
