<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Species
 *
 * @ORM\Table(name="species", indexes={@ORM\Index(name="FK_Specie_SOURCE", columns={"ID_Source"})})
 * @ORM\Entity
 */
class Species
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
     * @ORM\Column(name="Name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="Rollmin", type="integer", nullable=false, options={"default"="101"})
     */
    private $rollmin = 101;

    /**
     * @var int
     *
     * @ORM\Column(name="Rollmax", type="integer", nullable=false, options={"default"="101"})
     */
    private $rollmax = 101;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=2500, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Randomtalents", type="integer", nullable=true)
     */
    private $randomtalents;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Rollage", type="integer", nullable=true)
     */
    private $rollage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Rollheight", type="integer", nullable=true)
     */
    private $rollheight;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Fate", type="integer", nullable=true)
     */
    private $fate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Resilience", type="integer", nullable=true)
     */
    private $resilience;

    /**
     * @var int|null
     *
     * @ORM\Column(name="FR_spend", type="integer", nullable=true)
     */
    private $frSpend = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Source", type="integer", nullable=true)
     */
    private $idSource;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRandomtalents(): ?int
    {
        return $this->randomtalents;
    }

    public function setRandomtalents(?int $randomtalents): self
    {
        $this->randomtalents = $randomtalents;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getRollage(): ?int
    {
        return $this->rollage;
    }

    public function setRollage(?int $rollage): self
    {
        $this->rollage = $rollage;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getRollheight(): ?int
    {
        return $this->rollheight;
    }

    public function setRollheight(?int $rollheight): self
    {
        $this->rollheight = $rollheight;

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

    public function getResilience(): ?int
    {
        return $this->resilience;
    }

    public function setResilience(?int $resilience): self
    {
        $this->resilience = $resilience;

        return $this;
    }

    public function getFrSpend(): ?int
    {
        return $this->frSpend;
    }

    public function setFrSpend(?int $frSpend): self
    {
        $this->frSpend = $frSpend;

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


}
