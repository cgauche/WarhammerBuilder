<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spells
 *
 * @ORM\Table(name="spells", indexes={@ORM\Index(name="FK_SPELL_SOURCE", columns={"ID_Source"}), @ORM\Index(name="FK_SPELL_TYPE", columns={"ID_Spell_type"})})
 * @ORM\Entity
 */
class Spells
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
     * @ORM\Column(name="Type", type="string", length=20, nullable=true, options={"comment"="Bénédiction, Miracle, Sortilège"})
     */
    private $type;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NI", type="integer", nullable=true)
     */
    private $ni = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Range", type="string", length=10, nullable=true)
     */
    private $range;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Target", type="string", length=10, nullable=true)
     */
    private $target;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Length", type="string", length=10, nullable=true)
     */
    private $length;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Damage", type="string", length=10, nullable=true)
     */
    private $damage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=10, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Spell_type", type="integer", nullable=true)
     */
    private $idSpellType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_Source", type="integer", nullable=true)
     */
    private $idSource;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNi(): ?int
    {
        return $this->ni;
    }

    public function setNi(?int $ni): self
    {
        $this->ni = $ni;

        return $this;
    }

    public function getRange(): ?string
    {
        return $this->range;
    }

    public function setRange(?string $range): self
    {
        $this->range = $range;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(?string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(?string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDamage(): ?string
    {
        return $this->damage;
    }

    public function setDamage(?string $damage): self
    {
        $this->damage = $damage;

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

    public function getIdSpellType(): ?int
    {
        return $this->idSpellType;
    }

    public function setIdSpellType(?int $idSpellType): self
    {
        $this->idSpellType = $idSpellType;

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


}
