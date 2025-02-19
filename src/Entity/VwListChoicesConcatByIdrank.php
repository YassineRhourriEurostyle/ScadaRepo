<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VwListChoicesConcatByIdrankRepository")
 * @ORM\Table(name="vw_listchoices_concat_by_idrank")
 */
class VwListChoicesConcatByIdrank
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $idRank;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ListChoices;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRank(): ?string
    {
        return $this->idRank;
    }

    public function setIdRank(?string $idRank): self
    {
        $this->idRank = $idRank;

        return $this;
    }

    public function getListChoices(): ?string
    {
        return $this->ListChoices;
    }

    public function setListChoices(?string $ListChoices): self
    {
        $this->ListChoices = $ListChoices;

        return $this;
    }
}