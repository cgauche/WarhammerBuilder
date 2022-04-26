<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class WAttrArmoury
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int|null
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idWeaponAttr;

    /**
     * @var int|null
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rank;

    /**
     * @var int|null
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idArmoury;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdWeaponAttr(): ?int
    {
        return $this->idWeaponAttr;
    }

    public function setIdWeaponAttr(?int $idWeaponAttr): self
    {
        $this->idWeaponAttr = $idWeaponAttr;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): self
    {
        $this->rank = $rank;

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
}
