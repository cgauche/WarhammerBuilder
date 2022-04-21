<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Talents
 *
 * @ORM\Table(name="talents", indexes={@ORM\Index(name="FK_TALENT_SKILL", columns={"ID_Skill"}), @ORM\Index(name="FK_TALENT_SOURCE", columns={"ID_Source"}), @ORM\Index(name="FK_TALENT_CARAC", columns={"ID_Caracteristics"})})
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
     * @ORM\Column(name="Name", type="string", length=20, nullable=true)
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
     * @ORM\Column(name="ID_Skill", type="integer", nullable=true)
     */
    private $idSkill;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Caracteristics", type="integer", nullable=true)
     */
    private $idCaracteristics;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdSkill(): ?int
    {
        return $this->idSkill;
    }

    public function setIdSkill(?int $idSkill): self
    {
        $this->idSkill = $idSkill;

        return $this;
    }

    public function getIdCaracteristics(): ?int
    {
        return $this->idCaracteristics;
    }

    public function setIdCaracteristics(?int $idCaracteristics): self
    {
        $this->idCaracteristics = $idCaracteristics;

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
