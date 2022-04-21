<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trapping
 *
 * @ORM\Table(name="trapping", indexes={@ORM\Index(name="FK_TRAP_SOURCE", columns={"ID_Source"})})
 * @ORM\Entity
 */
class Trapping
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
     * @ORM\Column(name="Type", type="string", length=20, nullable=true, options={"comment"="Catégorie"})
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Price", type="string", length=10, nullable=true)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="Clutter", type="integer", nullable=false, options={"comment"="Encombrement"})
     */
    private $clutter = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Availability", type="string", length=10, nullable=true)
     */
    private $availability;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getClutter(): ?int
    {
        return $this->clutter;
    }

    public function setClutter(int $clutter): self
    {
        $this->clutter = $clutter;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(?string $availability): self
    {
        $this->availability = $availability;

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
