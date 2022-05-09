<?php

namespace App\Entity;

use App\Repository\ClassTrappingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ClassTrapping
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
    private $idClasses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Qte;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

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

    public function getIdClasses(): ?int
    {
        return $this->idClasses;
    }

    public function setIdClasses(?int $idClasses): self
    {
        $this->idClasses = $idClasses;

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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
