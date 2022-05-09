<?php

namespace App\Entity;

use App\Repository\TrappingRankRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TrappingRank
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idRanks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idTrapping;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRanks(): ?int
    {
        return $this->idRanks;
    }

    public function setIdRanks(?int $idRanks): self
    {
        $this->idRanks = $idRanks;

        return $this;
    }

    public function getIdTrapping(): ?int
    {
        return $this->idTrapping;
    }

    public function setIdTrapping(?int $idTrapping): self
    {
        $this->idTrapping = $idTrapping;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(?string $specs): self
    {
        $this->specs = $specs;

        return $this;
    }
}
