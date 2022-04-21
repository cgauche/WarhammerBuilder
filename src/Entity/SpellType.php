<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpellType
 *
 * @ORM\Table(name="spell_type")
 * @ORM\Entity
 */
class SpellType
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
     * @var string|null
     *
     * @ORM\Column(name="Type", type="string", length=20, nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Real_name", type="string", length=20, nullable=true)
     */
    private $realName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Color", type="string", length=20, nullable=true)
     */
    private $color;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="string", length=1000, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(?string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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


}
