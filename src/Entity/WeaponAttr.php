<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class WeaponAttr
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
    private $name;

    /**
     * @ORM\Column(type="string", length=1023, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSource;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withRank;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $Name): self
    {
        $this->name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $Description): self
    {
        $this->description = $Description;

        return $this;
    }

    public function getIdSource(): ?int
    {
        return $this->idSource;
    }

    public function setIdSource(?int $IdSource): self
    {
        $this->idSource = $IdSource;

        return $this;
    }

    public function getWithRank(): ?bool
    {
        return $this->withRank;
    }

    public function setWithRank(?bool $withRank): self
    {
        $this->withRank = $withRank;

        return $this;
    }
}
