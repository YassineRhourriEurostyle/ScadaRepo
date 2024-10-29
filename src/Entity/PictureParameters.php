<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PictureParameters
 *
 * @ORM\Table(name="picture_parameters")
 * @ORM\Entity
 */
class PictureParameters
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPictParam", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpictparam;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdSettStdFile", type="bigint", nullable=true)
     */
    private $idsettstdfile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idMachine", type="bigint", nullable=true)
     */
    private $idmachine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idTool", type="bigint", nullable=true)
     */
    private $idtool;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idToolVersion", type="bigint", nullable=true)
     */
    private $idtoolversion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParameter", type="bigint", nullable=true)
     */
    private $idparameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IdRank", type="string", length=50, nullable=true)
     */
    private $idrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PictParamFileName", type="string", length=100, nullable=true)
     */
    private $pictparamfilename;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PictParamDateCreation", type="datetime", nullable=true)
     */
    private $pictparamdatecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PictParamDateModification", type="datetime", nullable=true)
     */
    private $pictparamdatemodification;

    public function getIdpictparam(): ?string
    {
        return $this->idpictparam;
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

    public function getIdsettstdfile(): ?string
    {
        return $this->idsettstdfile;
    }

    public function setIdsettstdfile(?string $idsettstdfile): self
    {
        $this->idsettstdfile = $idsettstdfile;

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

    public function getIdparameter(): ?string
    {
        return $this->idparameter;
    }

    public function setIdparameter(?string $idparameter): self
    {
        $this->idparameter = $idparameter;

        return $this;
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

    public function getPictparamfilename(): ?string
    {
        return $this->pictparamfilename;
    }

    public function setPictparamfilename(?string $pictparamfilename): self
    {
        $this->pictparamfilename = $pictparamfilename;

        return $this;
    }

    public function getPictparamdatecreation(): ?\DateTimeInterface
    {
        return $this->pictparamdatecreation;
    }

    public function setPictparamdatecreation(?\DateTimeInterface $pictparamdatecreation): self
    {
        $this->pictparamdatecreation = $pictparamdatecreation;

        return $this;
    }

    public function getPictparamdatemodification(): ?\DateTimeInterface
    {
        return $this->pictparamdatemodification;
    }

    public function setPictparamdatemodification(?\DateTimeInterface $pictparamdatemodification): self
    {
        $this->pictparamdatemodification = $pictparamdatemodification;

        return $this;
    }


}
