<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Careers
 *
 * @ORM\Table(name="careers", indexes={@ORM\Index(name="FK_CAREER_SOURCE", columns={"ID_Source"})})
 * @ORM\Entity
 */
class Careers
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
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=2047, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Class", type="integer", nullable=true)
     */
    private $idClass;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Source", type="integer", nullable=true)
     */
    private $idSource;

    /**
     * @var string|null
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resume;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
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

    public function getIdClass(): ?int
    {
        return $this->idClass;
    }

    public function setIdClass(?int $idClass): self
    {
        $this->idClass = $idClass;

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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }


}
