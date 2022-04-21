<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Xp
 *
 * @ORM\Table(name="xp", indexes={@ORM\Index(name="FK_XP_CHAR", columns={"ID_char"})})
 * @ORM\Entity
 */
class Xp
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
     * @ORM\Column(name="Actual", type="integer", nullable=false)
     */
    private $actual = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Spent", type="integer", nullable=false)
     */
    private $spent = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Total", type="integer", nullable=false)
     */
    private $total = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ID_char", type="integer", nullable=false)
     */
    private $idChar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActual(): ?int
    {
        return $this->actual;
    }

    public function setActual(int $actual): self
    {
        $this->actual = $actual;

        return $this;
    }

    public function getSpent(): ?int
    {
        return $this->spent;
    }

    public function setSpent(int $spent): self
    {
        $this->spent = $spent;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
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


}
