<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parameters
 *
 * @ORM\Table(name="parameters")
 * @ORM\Entity(repositoryClass="App\Repository\ParametersRepository")
 */
class Parameters
{
    /**
     * @var int
     *
     * @ORM\Column(name="idparameters", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparameters;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamName", type="string", length=100, nullable=true)
     */
    private $paramname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamDateCreation", type="bigint", nullable=true)
     */
    private $paramdatecreation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamLevel", type="integer", nullable=true, options={"comment"="L1 / L2 / L3..."})
     */
    private $paramlevel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamRank", type="integer", nullable=true)
     */
    private $paramrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamUnit", type="string", length=50, nullable=true)
     */
    private $paramunit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamNbDecimals", type="smallint", nullable=true)
     */
    private $paramnbdecimals = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ParamMandatory", type="boolean", nullable=true)
     */
    private $parammandatory;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamDeviceType", type="smallint", nullable=true)
     */
    private $paramdevicetype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamCM", type="integer", nullable=true, options={"default"="1","comment"="Multiplicator coefficient : Real value = Record value * Multiplicator coefficient / Divisor coefficient"})
     */
    private $paramcm = 1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ParamDM", type="integer", nullable=true, options={"default"="1","comment"="Divisor coefficient : Real value = Record value * Multiplicator coefficient / Divisor coefficient"})
     */
    private $paramdm = 1;

    public function getIdparameters(): ?string
    {
        return $this->idparameters;
    }

    public function getParamname(): ?string
    {
        return $this->paramname;
    }

    public function setParamname(?string $paramname): self
    {
        $this->paramname = $paramname;

        return $this;
    }

    public function getParamdatecreation(): ?string
    {
        return $this->paramdatecreation;
    }

    public function setParamdatecreation(?string $paramdatecreation): self
    {
        $this->paramdatecreation = $paramdatecreation;

        return $this;
    }

    public function getParamlevel(): ?int
    {
        return $this->paramlevel;
    }

    public function setParamlevel(?int $paramlevel): self
    {
        $this->paramlevel = $paramlevel;

        return $this;
    }

    public function getParamrank(): ?int
    {
        return $this->paramrank;
    }

    public function setParamrank(?int $paramrank): self
    {
        $this->paramrank = $paramrank;

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

    public function getParamnbdecimals(): ?int
    {
        return $this->paramnbdecimals;
    }

    public function setParamnbdecimals(?int $paramnbdecimals): self
    {
        $this->paramnbdecimals = $paramnbdecimals;

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

    public function getParamdevicetype(): ?int
    {
        return $this->paramdevicetype;
    }

    public function setParamdevicetype(?int $paramdevicetype): self
    {
        $this->paramdevicetype = $paramdevicetype;

        return $this;
    }

    public function getParamcm(): ?int
    {
        return $this->paramcm;
    }

    public function setParamcm(?int $paramcm): self
    {
        $this->paramcm = $paramcm;

        return $this;
    }

    public function getParamdm(): ?int
    {
        return $this->paramdm;
    }

    public function setParamdm(?int $paramdm): self
    {
        $this->paramdm = $paramdm;

        return $this;
    }


}
