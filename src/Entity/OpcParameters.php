<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpcParameters
 *
 * @ORM\Table(name="opc_parameters")
 * @ORM\Entity
 */
class OpcParameters
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdOpcParameter", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idopcparameter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdOpcServer", type="bigint", nullable=true)
     */
    private $idopcserver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamNode", type="string", length=100, nullable=true)
     */
    private $paramnode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamDataType", type="string", length=45, nullable=true)
     */
    private $paramdatatype;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Coeff_A", type="float", precision=10, scale=0, nullable=true)
     */
    private $coeffA = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="Coeff_Multi", type="float", precision=10, scale=0, nullable=true, options={"default"="1"})
     */
    private $coeffMulti = 1;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Coeff_Div", type="float", precision=10, scale=0, nullable=true, options={"default"="1"})
     */
    private $coeffDiv = 1;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Coeff_B", type="float", precision=10, scale=0, nullable=true)
     */
    private $coeffB = '0';

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

    public function getIdopcparameter(): ?string
    {
        return $this->idopcparameter;
    }

    public function getIdopcserver(): ?string
    {
        return $this->idopcserver;
    }

    public function setIdopcserver(?string $idopcserver): self
    {
        $this->idopcserver = $idopcserver;

        return $this;
    }

    public function getParamnode(): ?string
    {
        return $this->paramnode;
    }

    public function setParamnode(?string $paramnode): self
    {
        $this->paramnode = $paramnode;

        return $this;
    }

    public function getParamdatatype(): ?string
    {
        return $this->paramdatatype;
    }

    public function setParamdatatype(?string $paramdatatype): self
    {
        $this->paramdatatype = $paramdatatype;

        return $this;
    }

    public function getCoeffA(): ?float
    {
        return $this->coeffA;
    }

    public function setCoeffA(?float $coeffA): self
    {
        $this->coeffA = $coeffA;

        return $this;
    }

    public function getCoeffMulti(): ?float
    {
        return $this->coeffMulti;
    }

    public function setCoeffMulti(?float $coeffMulti): self
    {
        $this->coeffMulti = $coeffMulti;

        return $this;
    }

    public function getCoeffDiv(): ?float
    {
        return $this->coeffDiv;
    }

    public function setCoeffDiv(?float $coeffDiv): self
    {
        $this->coeffDiv = $coeffDiv;

        return $this;
    }

    public function getCoeffB(): ?float
    {
        return $this->coeffB;
    }

    public function setCoeffB(?float $coeffB): self
    {
        $this->coeffB = $coeffB;

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
