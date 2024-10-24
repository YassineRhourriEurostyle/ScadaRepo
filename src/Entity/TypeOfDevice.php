<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeOfDeviceRepository")
 */
class TypeOfDevice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Indicator", mappedBy="TypeOfDevice")
     */
    private $Indicators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Device", mappedBy="TypeOfDevice")
     */
    private $Devices;

    public function __construct()
    {
        $this->Indicators = new ArrayCollection();
        $this->Devices = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|Indicator[]
     */
    public function getIndicators(): Collection
    {
        return $this->Indicators;
    }

    public function addIndicator(Indicator $indicator): self
    {
        if (!$this->Indicators->contains($indicator)) {
            $this->Indicators[] = $indicator;
            $indicator->setTypeOfDevice($this);
        }

        return $this;
    }

    public function removeIndicator(Indicator $indicator): self
    {
        if ($this->Indicators->contains($indicator)) {
            $this->Indicators->removeElement($indicator);
            // set the owning side to null (unless already changed)
            if ($indicator->getTypeOfDevice() === $this) {
                $indicator->setTypeOfDevice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Device[]
     */
    public function getDevices(): Collection
    {
        return $this->Devices;
    }

    public function addDevice(Device $device): self
    {
        if (!$this->Devices->contains($device)) {
            $this->Devices[] = $device;
            $device->setTypeOfDevice($this);
        }

        return $this;
    }

    public function removeDevice(Device $device): self
    {
        if ($this->Devices->contains($device)) {
            $this->Devices->removeElement($device);
            // set the owning side to null (unless already changed)
            if ($device->getTypeOfDevice() === $this) {
                $device->setTypeOfDevice(null);
            }
        }

        return $this;
    }
}
