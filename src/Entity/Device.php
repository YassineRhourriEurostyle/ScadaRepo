<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeviceRepository")
 */
class Device
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOfDevice", inversedBy="Devices", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeOfDevice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Setting", mappedBy="Device")
     */
    private $Settings;

    public function __construct()
    {
        $this->Settings = new ArrayCollection();
    }
    
    public function __toString() {
        return 'Device_#' . $this->id;
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

    public function getTypeOfDevice(): ?TypeOfDevice
    {
        return $this->TypeOfDevice;
    }

    public function setTypeOfDevice(?TypeOfDevice $TypeOfDevice): self
    {
        $this->TypeOfDevice = $TypeOfDevice;

        return $this;
    }

    /**
     * @return Collection|Setting[]
     */
    public function getSettings(): Collection
    {
        return $this->Settings;
    }

    public function addSetting(Setting $setting): self
    {
        if (!$this->Settings->contains($setting)) {
            $this->Settings[] = $setting;
            $setting->setDevice($this);
        }

        return $this;
    }

    public function removeSetting(Setting $setting): self
    {
        if ($this->Settings->contains($setting)) {
            $this->Settings->removeElement($setting);
            // set the owning side to null (unless already changed)
            if ($setting->getDevice() === $this) {
                $setting->setDevice(null);
            }
        }

        return $this;
    }
}
