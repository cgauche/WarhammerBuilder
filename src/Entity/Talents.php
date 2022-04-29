<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Talents
 *
 * @ORM\Table(name="talents", indexes={@ORM\Index(name="FK_TALENT_SOURCE", columns={"ID_Source"})})
 * @ORM\Entity
 */
class Talents
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
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Source", type="integer", nullable=true)
     */
    private $idSource;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minRoll;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxRoll;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Max;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Test;

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

    public function getIdSource(): ?int
    {
        return $this->idSource;
    }

    public function setIdSource(?int $idSource): self
    {
        $this->idSource = $idSource;

        return $this;
    }

    public function getMinRoll(): ?int
    {
        return $this->minRoll;
    }

    public function setMinRoll(?int $minRoll): self
    {
        $this->minRoll = $minRoll;

        return $this;
    }

    public function getMaxRoll(): ?int
    {
        return $this->maxRoll;
    }

    public function setMaxRoll(?int $maxRoll): self
    {
        $this->maxRoll = $maxRoll;

        return $this;
    }

    public function getMax(): ?string
    {
        return $this->Max;
    }

    public function setMax(?string $Max): self
    {
        $this->Max = $Max;

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->Test;
    }

    public function setTest(?string $Test): self
    {
        $this->Test = $Test;

        return $this;
    }


}
