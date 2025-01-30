<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZzSiseParametersTemp
 *
 * @ORM\Table(name="zz_sise_parameters_temp")
 * @ORM\Entity(repositoryClass="App\Repository\ZzSiseParametersTempRepository")
 */
class ZzSiseParametersTemp
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSiseParamTmp", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsiseparamtmp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamName", type="string", length=200, nullable=true)
     */
    private $paramname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IntDate", type="bigint", nullable=true)
     */
    private $intdate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idparameters", type="bigint", nullable=true)
     */
    private $idparameters;

    public function getIdsiseparamtmp(): ?string
    {
        return $this->idsiseparamtmp;
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

    public function getIntdate(): ?string
    {
        return $this->intdate;
    }

    public function setIntdate(?string $intdate): self
    {
        $this->intdate = $intdate;

        return $this;
    }

    public function getIdparameters(): ?string
    {
        return $this->idparameters;
    }

    public function setIdparameters(?string $idparameters): self
    {
        $this->idparameters = $idparameters;

        return $this;
    }


}
