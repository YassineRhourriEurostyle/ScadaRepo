<?php

namespace App\Entity\Generic;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteMaterialsRepository")
 * @ORM\Table(name="generic_site_materials") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_site_materials": "App\Entity\Generic\SiteMaterials", "site": "App\Entity\SiteMaterials"})
 */
class SiteMaterials
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="Materials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Site;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="Sites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Material;
    
    public function __toString() {
        if (isset($this->Name)) return $this->Name;
        return 'SiteMaterials_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?Site
    {
        return $this->Site;
    }

    public function setSite(?Site $Site): self
    {
        $this->Site = $Site;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->Material;
    }

    public function setMaterial(?Material $Material): self
    {
        $this->Material = $Material;

        return $this;
    }
}
