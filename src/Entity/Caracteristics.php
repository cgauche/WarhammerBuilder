<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristics
 *
 * @ORM\Table(name="caracteristics")
 * @ORM\Entity
 */
class Caracteristics
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
     * @ORM\Column(name="Name", type="string", length=10, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Abridged", type="string", length=4, nullable=true)
     */
    private $abridged;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Value", type="integer", nullable=true)
     */
    private $value;

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

    public function getAbridged(): ?string
    {
        return $this->abridged;
    }

    public function setAbridged(?string $abridged): self
    {
        $this->abridged = $abridged;

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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }


}
