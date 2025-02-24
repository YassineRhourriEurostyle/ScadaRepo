<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingRepository")
 */
class Setting
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Device", inversedBy="Settings", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Device;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Indicator", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Indicator;

    /**
     * @ORM\Column(type="integer")
     */
    private $Iteration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Value;
    
    public function __toString() {
        return 'Setting_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevice(): ?Device
    {
        return $this->Device;
    }

    public function setDevice(?Device $Device): self
    {
        $this->Device = $Device;

        return $this;
    }

    public function getIndicator(): ?Indicator
    {
        return $this->Indicator;
    }

    public function setIndicator(?Indicator $Indicator): self
    {
        $this->Indicator = $Indicator;

        return $this;
    }

    public function getIteration(): ?int
    {
        return $this->Iteration;
    }

    public function setIteration(int $Iteration): self
    {
        $this->Iteration = $Iteration;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->Value;
    }

    public function setValue(string $Value): self
    {
        $this->Value = $Value;

        return $this;
    }
}
