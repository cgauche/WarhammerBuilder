<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ranks
 *
 * @ORM\Table(name="ranks", indexes={@ORM\Index(name="FK_RANK_CAREER", columns={"ID_Career"})})
 * @ORM\Entity
 */
class Ranks
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
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;

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
