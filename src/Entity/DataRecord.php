<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\DataRecordRepository")
 */
class DataRecord
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
    private $idDataCycle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idParamMac;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DataValue;
    
    public function __toString() {
        return 'DataRecord_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDataCycle(): ?int
    {
        return $this->idDataCycle;
    }

    public function setIdDataCycle(?int $idDataCycle): self
    {
        $this->idDataCycle = $idDataCycle;

        return $this;
    }

    public function getIdParamMac(): ?int
    {
        return $this->idParamMac;
    }

    public function setIdParamMac(?int $idParamMac): self
    {
        $this->idParamMac = $idParamMac;

        return $this;
    }

    public function getDataValue(): ?string
    {
        return $this->DataValue;
    }

    public function setDataValue(?string $DataValue): self
    {
        $this->DataValue = $DataValue;

        return $this;
    }
}
