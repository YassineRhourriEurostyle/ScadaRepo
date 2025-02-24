<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndicatorRepository")
 */
class Indicator
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Indicator", inversedBy="Children")
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Indicator", mappedBy="Parent")
     */
    private $Children;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit")
     */
    private $Unit;

    /**
     * @ORM\Column(type="integer")
     */
    private $MaxIterations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Required;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeOfDevice", inversedBy="Indicators")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeOfDevice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Tolerance;

    public function __construct()
    {
        $this->Children = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->TypeOfDevice->getName() . ' >> ' . $this->Name;
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

    public function getParent(): ?self
    {
        return $this->Parent;
    }

    public function setParent(?self $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->Children;
    }

    public function addChildre(self $childre): self
    {
        if (!$this->Children->contains($childre)) {
            $this->Children[] = $childre;
            $childre->setParent($this);
        }

        return $this;
    }

    public function removeChildre(self $childre): self
    {
        if ($this->Children->contains($childre)) {
            $this->Children->removeElement($childre);
            // set the owning side to null (unless already changed)
            if ($childre->getParent() === $this) {
                $childre->setParent(null);
            }
        }

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->Unit;
    }

    public function setUnit(?Unit $Unit): self
    {
        $this->Unit = $Unit;

        return $this;
    }

    public function getMaxIterations(): ?int
    {
        return $this->MaxIterations;
    }

    public function setMaxIterations(int $MaxIterations): self
    {
        $this->MaxIterations = $MaxIterations;

        return $this;
    }

    public function getRequired(): ?bool
    {
        return $this->Required;
    }

    public function setRequired(bool $Required): self
    {
        $this->Required = $Required;

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

    public function getTolerance(): ?float
    {
        return $this->Tolerance;
    }

    public function setTolerance(?float $Tolerance): self
    {
        $this->Tolerance = $Tolerance;

        return $this;
    }
}
