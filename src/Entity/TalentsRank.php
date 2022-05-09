<?php

namespace App\Entity;

use App\Repository\TalentsRankRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TalentsRank
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
    private $idTalents;

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

    public function getIdTalents(): ?int
    {
        return $this->idTalents;
    }

    public function setIdTalents(?int $idTalents): self
    {
        $this->idTalents = $idTalents;

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
