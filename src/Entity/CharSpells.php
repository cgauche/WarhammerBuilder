<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharSpells
 *
 * @ORM\Table(name="char_spells", indexes={@ORM\Index(name="FK_CHAR_CHAR", columns={"ID_Char"}), @ORM\Index(name="FK_CHAR_SPELL", columns={"ID_Spell"})})
 * @ORM\Entity
 */
class CharSpells
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
     * @var int
     *
     * @ORM\Column(name="ID_Spell", type="integer", nullable=false)
     */
    private $idSpell;

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

    public function getIdSpell(): ?int
    {
        return $this->idSpell;
    }

    public function setIdSpell(int $idSpell): self
    {
        $this->idSpell = $idSpell;

        return $this;
    }


}
