<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsStandardTemplate
 *
 * @ORM\Table(name="settings_standard_template", indexes={@ORM\Index(name="IdRank", columns={"IdRank"})})
 * @ORM\Entity(repositoryClass="App\Repository\SettingsStandardTemplateRepository")
 */
class SettingsStandardTemplate
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSettStdTemp", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsettstdtemp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IdRank", type="string", length=45, nullable=true)
     */
    private $idrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Fieldname", type="string", length=100, nullable=true)
     */
    private $fieldname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FieldUnit", type="string", length=10, nullable=true)
     */
    private $fieldunit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MasterUnit", type="string", length=45, nullable=true)
     */
    private $masterunit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idCfgValueType", type="integer", nullable=true)
     */
    private $idcfgvaluetype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbDecimals", type="smallint", nullable=true)
     */
    private $nbdecimals;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="IsTitle", type="boolean", nullable=true, options={"comment"="0 = No / 1 = Yes"})
     */
    private $istitle;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="MandatoryTitle", type="boolean", nullable=true)
     */
    private $mandatorytitle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="IsPicture", type="boolean", nullable=true, options={"comment"="0 = No / 1 = Yes"})
     */
    private $ispicture;

    public function getIspicture(): ?bool
    {
        return $this->ispicture;
    }

    public function setIspicture(?bool $ispicture): self
    {
        $this->ispicture = $ispicture;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->idsettstdtemp;
    }
    public function getIdsettstdtemp(): ?string
    {
        return $this->idsettstdtemp;
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

    public function getFieldname(): ?string
    {
        return $this->fieldname;
    }

    public function setFieldname(?string $fieldname): self
    {
        $this->fieldname = $fieldname;

        return $this;
    }

    public function getFieldunit(): ?string
    {
        return $this->fieldunit;
    }

    public function setFieldunit(?string $fieldunit): self
    {
        $this->fieldunit = $fieldunit;

        return $this;
    }

    public function getMasterunit(): ?string
    {
        return $this->masterunit;
    }

    public function setMasterunit(?string $masterunit): self
    {
        $this->masterunit = $masterunit;

        return $this;
    }

    public function getIdcfgvaluetype(): ?int
    {
        return $this->idcfgvaluetype;
    }

    public function setIdcfgvaluetype(?int $idcfgvaluetype): self
    {
        $this->idcfgvaluetype = $idcfgvaluetype;

        return $this;
    }

    public function getNbdecimals(): ?int
    {
        return $this->nbdecimals;
    }

    public function setNbdecimals(?int $nbdecimals): self
    {
        $this->nbdecimals = $nbdecimals;

        return $this;
    }

    public function getIstitle(): ?bool
    {
        return $this->istitle;
    }

    public function setIstitle(?bool $istitle): self
    {
        $this->istitle = $istitle;

        return $this;
    }

    public function getMandatorytitle(): ?bool
    {
        return $this->mandatorytitle;
    }

    public function setMandatorytitle(?bool $mandatorytitle): self
    {
        $this->mandatorytitle = $mandatorytitle;

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

    public function getDatemodification(): ?\DateTimeInterface
    {
        return $this->datemodification;
    }

    public function setDatemodification(?\DateTimeInterface $datemodification): self
    {
        $this->datemodification = $datemodification;

        return $this;
    }


}
