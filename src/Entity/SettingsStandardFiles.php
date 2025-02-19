<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsStandardFiles
 *
 * @ORM\Table(name="settings_standard_files", indexes={@ORM\Index(name="IdSite", columns={"IdSite", "IdMachine", "IdTool", "IdToolVersion"}), @ORM\Index(name="ActiveFile", columns={"ActiveFile"})})
 * @ORM\Entity(repositoryClass="App\Repository\SettingsStandardFilesRepository")
 */
class SettingsStandardFiles
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdSettStdFile", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsettstdfile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdMachine", type="bigint", nullable=true)
     */
    private $idmachine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdTool", type="bigint", nullable=true)
     */
    private $idtool;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdToolVersion", type="bigint", nullable=true)
     */
    private $idtoolversion;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ActiveFile", type="boolean", nullable=true, options={"default"="1"})
     */
    private $activefile = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreationUTC", type="datetime", nullable=true)
     */
    private $datecreationutc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateModificationUTC", type="datetime", nullable=true)
     */
    private $datemodificationutc;

    public function getId(): ?string
    {
        return $this->idsettstdfile;
    }
    public function getIdsettstdfile(): ?string
    {
        return $this->idsettstdfile;
    }

    public function getIdsite(): ?int
    {
        return $this->idsite;
    }

    public function setIdsite(?int $idsite): self
    {
        $this->idsite = $idsite;

        return $this;
    }

    public function getIdmachine(): ?string
    {
        return $this->idmachine;
    }

    public function setIdmachine(?string $idmachine): self
    {
        $this->idmachine = $idmachine;

        return $this;
    }

    public function getIdtool(): ?string
    {
        return $this->idtool;
    }

    public function setIdtool(?string $idtool): self
    {
        $this->idtool = $idtool;

        return $this;
    }

    public function getIdtoolversion(): ?string
    {
        return $this->idtoolversion;
    }

    public function setIdtoolversion(?string $idtoolversion): self
    {
        $this->idtoolversion = $idtoolversion;

        return $this;
    }

    public function getActivefile(): ?bool
    {
        return $this->activefile;
    }

    public function setActivefile(?bool $activefile): self
    {
        $this->activefile = $activefile;

        return $this;
    }

    public function getDatecreationutc(): ?\DateTimeInterface
    {
        return $this->datecreationutc;
    }

    public function setDatecreationutc(?\DateTimeInterface $datecreationutc): self
    {
        $this->datecreationutc = $datecreationutc;

        return $this;
    }

    public function getDatemodificationutc(): ?\DateTimeInterface
    {
        return $this->datemodificationutc;
    }

    public function setDatemodificationutc(?\DateTimeInterface $datemodificationutc): self
    {
        $this->datemodificationutc = $datemodificationutc;

        return $this;
    }


}
