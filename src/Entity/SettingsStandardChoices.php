<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsStandardChoices
 *
 * @ORM\Table(name="settings_standard_choices", indexes={@ORM\Index(name="IdRank", columns={"IdRank"})})
 * @ORM\Entity(repositoryClass="App\Repository\SettingsStandardChoicesRepository")
 */
class SettingsStandardChoices
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSettStdChoice", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsettstdchoice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IdRank", type="string", length=45, nullable=true)
     */
    private $idrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ChoiceText", type="string", length=70, nullable=true)
     */
    private $choicetext;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    public function getIdsettstdchoice(): ?string
    {
        return $this->idsettstdchoice;
    }

    public function getIdrank(): ?string
    {
        return $this->idrank;
    }

    public function setIdrank(?string $idrank): self
    {
        $this->idrank = $idrank;

        return $this;
    }

    public function getChoicetext(): ?string
    {
        return $this->choicetext;
    }

    public function setChoicetext(?string $choicetext): self
    {
        $this->choicetext = $choicetext;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }


}
