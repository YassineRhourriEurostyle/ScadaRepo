<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Records
 *
 * @ORM\Table(name="records")
 * @ORM\Entity(repositoryClass="App\Repository\RecordsRepository")
 */
class Records
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrecords", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecords;

    /**
     * @var int
     *
     * @ORM\Column(name="idSite", type="integer", nullable=false)
     */
    private $idsite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idMac", type="integer", nullable=true)
     */
    private $idmac;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idMould", type="integer", nullable=true)
     */
    private $idmould;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateRecord", type="datetime", nullable=true)
     */
    private $daterecord;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idCyc", type="bigint", nullable=true)
     */
    private $idcyc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CYCLE_ID", type="bigint", nullable=true)
     */
    private $cycleId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParameter", type="integer", nullable=true)
     */
    private $idparameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamValue", type="string", length=50, nullable=true)
     */
    private $paramvalue;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idOpcParameter", type="bigint", nullable=true)
     */
    private $idopcparameter;

    public function getIdrecords(): ?string
    {
        return $this->idrecords;
    }

    public function getIdsite(): ?int
    {
        return $this->idsite;
    }

    public function setIdsite(int $idsite): self
    {
        $this->idsite = $idsite;

        return $this;
    }

    public function getIdmac(): ?int
    {
        return $this->idmac;
    }

    public function setIdmac(?int $idmac): self
    {
        $this->idmac = $idmac;

        return $this;
    }

    public function getIdmould(): ?int
    {
        return $this->idmould;
    }

    public function setIdmould(?int $idmould): self
    {
        $this->idmould = $idmould;

        return $this;
    }

    public function getDaterecord(): ?\DateTimeInterface
    {
        return $this->daterecord;
    }

    public function setDaterecord(?\DateTimeInterface $daterecord): self
    {
        $this->daterecord = $daterecord;

        return $this;
    }

    public function getIdcyc(): ?string
    {
        return $this->idcyc;
    }

    public function setIdcyc(?string $idcyc): self
    {
        $this->idcyc = $idcyc;

        return $this;
    }

    public function getCycleId(): ?string
    {
        return $this->cycleId;
    }

    public function setCycleId(?string $cycleId): self
    {
        $this->cycleId = $cycleId;

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

    public function getParamvalue(): ?string
    {
        return $this->paramvalue;
    }

    public function setParamvalue(?string $paramvalue): self
    {
        $this->paramvalue = $paramvalue;

        return $this;
    }

    public function getIdopcparameter(): ?string
    {
        return $this->idopcparameter;
    }

    public function setIdopcparameter(?string $idopcparameter): self
    {
        $this->idopcparameter = $idopcparameter;

        return $this;
    }


}
