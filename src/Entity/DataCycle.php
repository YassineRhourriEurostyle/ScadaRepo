<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataCycleRepository")
 */
class DataCycle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCfgMachine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCfgTool;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $DataCycleNo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DataCycleDateUTC;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DataCycle_DateCreationUTC;
    
    public function __toString() {
        return 'DataCycle_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCfgMachine(): ?int
    {
        return $this->idCfgMachine;
    }

    public function setIdCfgMachine(?int $idCfgMachine): self
    {
        $this->idCfgMachine = $idCfgMachine;

        return $this;
    }

    public function getIdCfgTool(): ?int
    {
        return $this->idCfgTool;
    }

    public function setIdCfgTool(?int $idCfgTool): self
    {
        $this->idCfgTool = $idCfgTool;

        return $this;
    }

    public function getDataCycleNo(): ?int
    {
        return $this->DataCycleNo;
    }

    public function setDataCycleNo(?int $DataCycleNo): self
    {
        $this->DataCycleNo = $DataCycleNo;

        return $this;
    }

    public function getDataCycleDateUTC(): ?\DateTimeInterface
    {
        return $this->DataCycleDateUTC;
    }

    public function setDataCycleDateUTC(?\DateTimeInterface $DataCycleDateUTC): self
    {
        $this->DataCycleDateUTC = $DataCycleDateUTC;

        return $this;
    }

    public function getDataCycleDateCreationUTC(): ?\DateTimeInterface
    {
        return $this->DataCycle_DateCreationUTC;
    }

    public function setDataCycleDateCreationUTC(?\DateTimeInterface $DataCycle_DateCreationUTC): self
    {
        $this->DataCycle_DateCreationUTC = $DataCycle_DateCreationUTC;

        return $this;
    }
}
