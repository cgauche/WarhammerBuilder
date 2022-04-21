<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharCaracteristics
 *
 * @ORM\Table(name="char_caracteristics", indexes={@ORM\Index(name="FK_CARAC_CARAC", columns={"ID_Caracteristics"}), @ORM\Index(name="FK_CARAC_CHAR", columns={"ID_Char"})})
 * @ORM\Entity
 */
class CharCaracteristics
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
     * @ORM\Column(name="Init_val", type="integer", nullable=false)
     */
    private $initVal;

    /**
     * @var int
     *
     * @ORM\Column(name="Inc_val", type="integer", nullable=false)
     */
    private $incVal = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Talent", type="integer", nullable=false)
     */
    private $talent = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Char", type="integer", nullable=false)
     */
    private $idChar;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Caracteristics", type="integer", nullable=false)
     */
    private $idCaracteristics;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitVal(): ?int
    {
        return $this->initVal;
    }

    public function setInitVal(int $initVal): self
    {
        $this->initVal = $initVal;

        return $this;
    }

    public function getIncVal(): ?int
    {
        return $this->incVal;
    }

    public function setIncVal(int $incVal): self
    {
        $this->incVal = $incVal;

        return $this;
    }

    public function getTalent(): ?int
    {
        return $this->talent;
    }

    public function setTalent(int $talent): self
    {
        $this->talent = $talent;

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

    public function getIdCaracteristics(): ?int
    {
        return $this->idCaracteristics;
    }

    public function setIdCaracteristics(int $idCaracteristics): self
    {
        $this->idCaracteristics = $idCaracteristics;

        return $this;
    }


}
