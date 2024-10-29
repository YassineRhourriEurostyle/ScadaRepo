<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PictureMolds
 *
 * @ORM\Table(name="picture_molds")
 * @ORM\Entity(repositoryClass="App\Repository\PictureMoldsRepository")
 */
class PictureMolds
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPictMold", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpictmold;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idTool", type="bigint", nullable=true)
     */
    private $idtool;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PictMoldFileName", type="string", length=100, nullable=true)
     */
    private $pictmoldfilename;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="PictMoldMain", type="boolean", nullable=true, options={"comment"="0 -> No / 1 -> Yes, main picture"})
     */
    private $pictmoldmain;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PictMoldDateCreation", type="datetime", nullable=true)
     */
    private $pictmolddatecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="PictMoldDateModification", type="datetime", nullable=true)
     */
    private $pictmolddatemodification;

    public function getIdpictmold(): ?string
    {
        return $this->idpictmold;
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

    public function getPictmoldfilename(): ?string
    {
        return $this->pictmoldfilename;
    }

    public function setPictmoldfilename(?string $pictmoldfilename): self
    {
        $this->pictmoldfilename = $pictmoldfilename;

        return $this;
    }

    public function getPictmoldmain(): ?bool
    {
        return $this->pictmoldmain;
    }

    public function setPictmoldmain(?bool $pictmoldmain): self
    {
        $this->pictmoldmain = $pictmoldmain;

        return $this;
    }

    public function getPictmolddatecreation(): ?\DateTimeInterface
    {
        return $this->pictmolddatecreation;
    }

    public function setPictmolddatecreation(?\DateTimeInterface $pictmolddatecreation): self
    {
        $this->pictmolddatecreation = $pictmolddatecreation;

        return $this;
    }

    public function getPictmolddatemodification(): ?\DateTimeInterface
    {
        return $this->pictmolddatemodification;
    }

    public function setPictmolddatemodification(?\DateTimeInterface $pictmolddatemodification): self
    {
        $this->pictmolddatemodification = $pictmolddatemodification;

        return $this;
    }


}
