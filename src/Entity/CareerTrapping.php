<?php

namespace App\Entity;

use App\Repository\CareerTrappingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CareerTrapping
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
    private $idTrapping;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCareer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Qte;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdCareer(): ?int
    {
        return $this->idCareer;
    }

    public function setIdCareer(?int $idCareer): self
    {
        $this->idCareer = $idCareer;

        return $this;
    }

    public function getQte(): ?string
    {
        return $this->Qte;
    }

    public function setQte(?string $Qte): self
    {
        $this->Qte = $Qte;

        return $this;
    }
}
