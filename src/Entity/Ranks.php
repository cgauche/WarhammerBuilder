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
     * @var int|null
     *
     * @ORM\Column(name="ID_Career", type="integer", nullable=true)
     */
    private $idCareer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSource;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCharac;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCharac2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCharac3;

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

    public function getIdCareer(): ?int
    {
        return $this->idCareer;
    }

    public function setIdCareer(?int $idCareer): self
    {
        $this->idCareer = $idCareer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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

    public function getIdCharac(): ?int
    {
        return $this->idCharac;
    }

    public function setIdCharac(?int $idCharac): self
    {
        $this->idCharac = $idCharac;

        return $this;
    }

    public function getIdCharac2(): ?int
    {
        return $this->idCharac2;
    }

    public function setIdCharac2(?int $idCharac2): self
    {
        $this->idCharac2 = $idCharac2;

        return $this;
    }

    public function getIdCharac3(): ?int
    {
        return $this->idCharac3;
    }

    public function setIdCharac3(?int $idCharac3): self
    {
        $this->idCharac3 = $idCharac3;

        return $this;
    }


}
