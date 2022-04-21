<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharTrapping
 *
 * @ORM\Table(name="char_trapping", indexes={@ORM\Index(name="FK_TRAP_ARM", columns={"ID_Armoury"}), @ORM\Index(name="FK_TRAP_AV", columns={"ID_Animals_vehicles"}), @ORM\Index(name="FK_TRAP_CHAR", columns={"ID_Char"}), @ORM\Index(name="FK_TRAP_BAGS", columns={"ID_Bags_containers"}), @ORM\Index(name="FK_TRAP_TRAP", columns={"ID_Trapping"})})
 * @ORM\Entity
 */
class CharTrapping
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
     * @var int
     *
     * @ORM\Column(name="ID_Char", type="integer", nullable=false)
     */
    private $idChar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Armoury", type="integer", nullable=true)
     */
    private $idArmoury;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Bags_containers", type="integer", nullable=true)
     */
    private $idBagsContainers;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Animals_vehicles", type="integer", nullable=true)
     */
    private $idAnimalsVehicles;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Trapping", type="integer", nullable=true)
     */
    private $idTrapping;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=true)
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdChar(): ?int
    {
        return $this->idChar;
    }

    public function setIdChar(int $idChar): self
    {
        $this->idChar = $idChar;

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

    public function getIdArmoury(): ?int
    {
        return $this->idArmoury;
    }

    public function setIdArmoury(?int $idArmoury): self
    {
        $this->idArmoury = $idArmoury;

        return $this;
    }

    public function getIdBagsContainers(): ?int
    {
        return $this->idBagsContainers;
    }

    public function setIdBagsContainers(?int $idBagsContainers): self
    {
        $this->idBagsContainers = $idBagsContainers;

        return $this;
    }

    public function getIdAnimalsVehicles(): ?int
    {
        return $this->idAnimalsVehicles;
    }

    public function setIdAnimalsVehicles(?int $idAnimalsVehicles): self
    {
        $this->idAnimalsVehicles = $idAnimalsVehicles;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }


}
