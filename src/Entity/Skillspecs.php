<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skillspecs
 *
 * @ORM\Table(name="skillspecs", indexes={@ORM\Index(name="FK_SSpec_SKILL", columns={"ID_Skill"})})
 * @ORM\Entity
 */
class Skillspecs
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


}
