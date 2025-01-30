<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericSiteMaterials
 *
 * @ORM\Table(name="generic_site_materials", indexes={@ORM\Index(name="IDX_3A005691F6BD1646", columns={"site_id"}), @ORM\Index(name="IDX_3A005691E308AC6F", columns={"material_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\GenericSiteMaterialsRepository")
 */
class GenericSiteMaterials
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dtype", type="string", length=255, nullable=false)
     */
    private $dtype;

    /**
     * @var \GenericMaterial
     *
     * @ORM\ManyToOne(targetEntity="GenericMaterial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     * })
     */
    private $material;

    /**
     * @var \GenericSite
     *
     * @ORM\ManyToOne(targetEntity="GenericSite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     * })
     */
    private $site;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDtype(): ?string
    {
        return $this->dtype;
    }

    public function setDtype(string $dtype): self
    {
        $this->dtype = $dtype;

        return $this;
    }

    public function getMaterial(): ?GenericMaterial
    {
        return $this->material;
    }

    public function setMaterial(?GenericMaterial $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getSite(): ?GenericSite
    {
        return $this->site;
    }

    public function setSite(?GenericSite $site): self
    {
        $this->site = $site;

        return $this;
    }


}
