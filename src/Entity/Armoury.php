<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Armoury
 *
 * @ORM\Table(name="armoury")
 * @ORM\Entity
 */
class Armoury
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
     * @ORM\Column(name="TypeGear", type="string", length=10, nullable=true, options={"comment"="Arme, Armure"})
     */
    private $typeGear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="GroupGear", type="string", length=20, nullable=true, options={"comment"="à distance, cuir..."})
     */
    private $group;

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
     * @var string|null
     *
     * @ORM\Column(name="RangeGear", type="string", length=10, nullable=true)
     */
    private $rangeGear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Damage", type="string", length=10, nullable=true)
     */
    private $damage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Advantage_flaw", type="string", length=10, nullable=true)
     */
    private $advantageFlaw;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Penalty", type="string", length=10, nullable=true)
     */
    private $penalty;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LocationGear", type="string", length=10, nullable=true)
     */
    private $locationGear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PA", type="string", length=10, nullable=true)
     */
    private $pa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=10, nullable=true)
     */
    private $description;

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
        return $this->typeGear;
    }

    public function setType(?string $type): self
    {
        $this->typeGear = $type;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(?string $group): self
    {
        $this->group = $group;

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

    public function getRange(): ?string
    {
        return $this->rangeGear;
    }

    public function setRange(?string $rangeGear): self
    {
        $this->rangeGear = $rangeGear;

        return $this;
    }

    public function getDamage(): ?string
    {
        return $this->damage;
    }

    public function setDamage(?string $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getAdvantageFlaw(): ?string
    {
        return $this->advantageFlaw;
    }

    public function setAdvantageFlaw(?string $advantageFlaw): self
    {
        $this->advantageFlaw = $advantageFlaw;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(?string $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->locationGear;
    }

    public function setLocation(?string $location): self
    {
        $this->locationGear = $location;

        return $this;
    }

    public function getPa(): ?string
    {
        return $this->pa;
    }

    public function setPa(?string $pa): self
    {
        $this->pa = $pa;

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

    public function setIdSource(int $idSource): self
    {
        $this->idSource = $idSource;

        return $this;
    }

    public function getTypeGear(): ?string
    {
        return $this->typeGear;
    }

    public function setTypeGear(?string $typeGear): self
    {
        $this->typeGear = $typeGear;

        return $this;
    }

    public function getLocationGear(): ?string
    {
        return $this->locationGear;
    }

    public function setLocationGear(?string $locationGear): self
    {
        $this->locationGear = $locationGear;

        return $this;
    }

    public function getRangeGear(): ?string
    {
        return $this->rangeGear;
    }

    public function setRangeGear(?string $rangeGear): self
    {
        $this->rangeGear = $rangeGear;

        return $this;
    }


}
