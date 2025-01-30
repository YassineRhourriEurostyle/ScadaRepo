<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsStandard
 *
 * @ORM\Table(name="settings_standard", indexes={@ORM\Index(name="IdSettStdFile", columns={"IdSettStdFile", "idRank"})})
 * @ORM\Entity(repositoryClass="App\Repository\SettingsStandardRepository")
 */
class SettingsStandard
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSettingStandard", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsettingstandard;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdSettStdFile", type="bigint", nullable=true)
     */
    private $idsettstdfile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idRank", type="string", length=45, nullable=true)
     */
    private $idrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SettingDescription", type="string", length=100, nullable=true)
     */
    private $settingdescription;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParameter", type="integer", nullable=true)
     */
    private $idparameter = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="idValueType", type="smallint", nullable=true)
     */
    private $idvaluetype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NbDecimals", type="smallint", nullable=true)
     */
    private $nbdecimals;

    /**
     * @var string|null
     *
     * @ORM\Column(name="StdValue", type="string", length=100, nullable=true)
     */
    private $stdvalue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TolerancePct", type="string", length=5, nullable=true)
     */
    private $tolerancepct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMini", type="string", length=100, nullable=true)
     */
    private $tolerancemini;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMaxi", type="string", length=100, nullable=true)
     */
    private $tolerancemaxi;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ExactValue", type="boolean", nullable=true)
     */
    private $exactvalue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamUnit", type="string", length=50, nullable=true)
     */
    private $paramunit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamMasterUnit", type="string", length=45, nullable=true)
     */
    private $parammasterunit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamUniteAbs", type="string", length=50, nullable=true)
     */
    private $paramuniteabs;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ParamMandatory", type="boolean", nullable=true)
     */
    private $parammandatory;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamDeviceId", type="smallint", nullable=true)
     */
    private $paramdeviceid;

    public function getIdsettingstandard(): ?string
    {
        return $this->idsettingstandard;
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

    public function getIdrank(): ?string
    {
        return $this->idrank;
    }

    public function setIdrank(?string $idrank): self
    {
        $this->idrank = $idrank;

        return $this;
    }

    public function getSettingdescription(): ?string
    {
        return $this->settingdescription;
    }

    public function setSettingdescription(?string $settingdescription): self
    {
        $this->settingdescription = $settingdescription;

        return $this;
    }

    public function getIdparameter(): ?int
    {
        return $this->idparameter;
    }

    public function setIdparameter(?int $idparameter): self
    {
        $this->idparameter = $idparameter;

        return $this;
    }

    public function getIdvaluetype(): ?int
    {
        return $this->idvaluetype;
    }

    public function setIdvaluetype(?int $idvaluetype): self
    {
        $this->idvaluetype = $idvaluetype;

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

    public function getStdvalue(): ?string
    {
        return $this->stdvalue;
    }

    public function setStdvalue(?string $stdvalue): self
    {
        $this->stdvalue = $stdvalue;

        return $this;
    }

    public function getTolerancepct(): ?string
    {
        return $this->tolerancepct;
    }

    public function setTolerancepct(?string $tolerancepct): self
    {
        $this->tolerancepct = $tolerancepct;

        return $this;
    }

    public function getTolerancemini(): ?string
    {
        return $this->tolerancemini;
    }

    public function setTolerancemini(?string $tolerancemini): self
    {
        $this->tolerancemini = $tolerancemini;

        return $this;
    }

    public function getTolerancemaxi(): ?string
    {
        return $this->tolerancemaxi;
    }

    public function setTolerancemaxi(?string $tolerancemaxi): self
    {
        $this->tolerancemaxi = $tolerancemaxi;

        return $this;
    }

    public function getExactvalue(): ?bool
    {
        return $this->exactvalue;
    }

    public function setExactvalue(?bool $exactvalue): self
    {
        $this->exactvalue = $exactvalue;

        return $this;
    }

    public function getParamunit(): ?string
    {
        return $this->paramunit;
    }

    public function setParamunit(?string $paramunit): self
    {
        $this->paramunit = $paramunit;

        return $this;
    }

    public function getParammasterunit(): ?string
    {
        return $this->parammasterunit;
    }

    public function setParammasterunit(?string $parammasterunit): self
    {
        $this->parammasterunit = $parammasterunit;

        return $this;
    }

    public function getParamuniteabs(): ?string
    {
        return $this->paramuniteabs;
    }

    public function setParamuniteabs(?string $paramuniteabs): self
    {
        $this->paramuniteabs = $paramuniteabs;

        return $this;
    }

    public function getParammandatory(): ?bool
    {
        return $this->parammandatory;
    }

    public function setParammandatory(?bool $parammandatory): self
    {
        $this->parammandatory = $parammandatory;

        return $this;
    }

    public function getParamdeviceid(): ?int
    {
        return $this->paramdeviceid;
    }

    public function setParamdeviceid(?int $paramdeviceid): self
    {
        $this->paramdeviceid = $paramdeviceid;

        return $this;
    }


}
