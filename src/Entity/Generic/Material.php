<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 * @ORM\Table(name="generic_material") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_materia": "App\Entity\Generic\Material", "site": "App\Entity\Material"})
 */
class Material
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
     * @ORM\OneToMany(targetEntity="App\Entity\SiteMaterials", mappedBy="Material")
     */
    private $Sites;

    public function __construct()
    {
        $this->Sites = new ArrayCollection();
    }
    
    public function __toString() {
        if (isset($this->Name)) return $this->Name;
        return 'Material_#' . $this->id;
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
     * @return Collection|SiteMaterials[]
     */
    public function getSites(): Collection
    {
        return $this->Sites;
    }

    public function addSite(SiteMaterials $site): self
    {
        if (!$this->Sites->contains($site)) {
            $this->Sites[] = $site;
            $site->setMaterial($this);
        }

        return $this;
    }

    public function removeSite(SiteMaterials $site): self
    {
        if ($this->Sites->contains($site)) {
            $this->Sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getMaterial() === $this) {
                $site->setMaterial(null);
            }
        }

        return $this;
    }
}
