<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistinctRecordsRepository")
 */
class DistinctRecords
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
    private $idSite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idMachine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idMould;
    
    public function __toString() {
        return 'DistinctRecords_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSite(): ?int
    {
        return $this->idSite;
    }

    public function setIdSite(?int $idSite): self
    {
        $this->idSite = $idSite;

        return $this;
    }

    public function getIdMachine(): ?int
    {
        return $this->idMachine;
    }

    public function setIdMachine(?int $idMachine): self
    {
        $this->idMachine = $idMachine;

        return $this;
    }

    public function getIdMould(): ?int
    {
        return $this->idMould;
    }

    public function setIdMould(?int $idMould): self
    {
        $this->idMould = $idMould;

        return $this;
    }
}
