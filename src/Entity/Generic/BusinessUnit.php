<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BusinessUnitRepository")
 * @ORM\Table(name="generic_business_unit") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_business_unit": "App\Entity\Generic\BusinessUnit", "business_unit": "App\Entity\BusinessUnit"})
 */
class BusinessUnit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="BusinessUnit")
     */
    protected $sites;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Signatory;
    
     /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $Color;


    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->getName();
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
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setBusinessUnit($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getBusinessUnit() === $this) {
                $site->setBusinessUnit(null);
            }
        }

        return $this;
    }

    public function getSignatory(): ?string
    {
        return $this->Signatory;
    }

    public function setSignatory(string $Signatory): self
    {
        $this->Signatory = $Signatory;

        return $this;
    }
    
    
    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(?string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }
}
