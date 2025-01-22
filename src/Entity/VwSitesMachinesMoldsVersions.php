<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})
/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Entity(repositoryClass="VwSitesMachinesMoldsVersionsRepository")
 * @ORM\Table(name="vw_sites_machines_molds_versions")
 */
class VwSitesMachinesMoldsVersions
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    private $IdSettStdFile;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $IdSite;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $IdMachine;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $IdTool;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $IdToolVersion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activeFile;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $SiteRef;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $SiteSAPCode;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $SiteDescription;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $MacReference;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ToolReference;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ToolVersionText;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Archived;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $PictMoldMain;

    public function getIdSettStdFile(): ?int
    {
        return $this->IdSettStdFile;
    }

    public function setIdSettStdFile(int $IdSettStdFile): self
    {
        $this->IdSettStdFile = $IdSettStdFile;

        return $this;
    }

    public function getIdSite(): ?int
    {
        return $this->IdSite;
    }

    public function setIdSite(?int $IdSite): self
    {
        $this->IdSite = $IdSite;

        return $this;
    }

    public function getIdMachine(): ?int
    {
        return $this->IdMachine;
    }

    public function setIdMachine(?int $IdMachine): self
    {
        $this->IdMachine = $IdMachine;

        return $this;
    }

    public function getIdTool(): ?int
    {
        return $this->IdTool;
    }

    public function setIdTool(?int $IdTool): self
    {
        $this->IdTool = $IdTool;

        return $this;
    }

    public function getIdToolVersion(): ?int
    {
        return $this->IdToolVersion;
    }

    public function setIdToolVersion(?int $IdToolVersion): self
    {
        $this->IdToolVersion = $IdToolVersion;

        return $this;
    }

    public function getActiveFile(): ?int
    {
        return $this->activeFile;
    }

    public function setActiveFile(?int $activeFile): self
    {
        $this->activeFile = $activeFile;

        return $this;
    }

    public function getSiteRef(): ?string
    {
        return $this->SiteRef;
    }

    public function setSiteRef(string $SiteRef): self
    {
        $this->SiteRef = $SiteRef;

        return $this;
    }

    public function getSiteSAPCode(): ?string
    {
        return $this->SiteSAPCode;
    }

    public function setSiteSAPCode(?string $SiteSAPCode): self
    {
        $this->SiteSAPCode = $SiteSAPCode;

        return $this;
    }

    public function getSiteDescription(): ?string
    {
        return $this->SiteDescription;
    }

    public function setSiteDescription(?string $SiteDescription): self
    {
        $this->SiteDescription = $SiteDescription;

        return $this;
    }

    public function getMacReference(): ?string
    {
        return $this->MacReference;
    }

    public function setMacReference(?string $MacReference): self
    {
        $this->MacReference = $MacReference;

        return $this;
    }

    public function getToolReference(): ?string
    {
        return $this->ToolReference;
    }

    public function setToolReference(?string $ToolReference): self
    {
        $this->ToolReference = $ToolReference;

        return $this;
    }

    public function getToolVersionText(): ?string
    {
        return $this->ToolVersionText;
    }

    public function setToolVersionText(?string $ToolVersionText): self
    {
        $this->ToolVersionText = $ToolVersionText;

        return $this;
    }

    public function getArchived(): ?int
    {
        return $this->Archived;
    }

    public function setArchived(?int $Archived): self
    {
        $this->Archived = $Archived;

        return $this;
    }

    public function getPictMoldMain(): ?string
    {
        return $this->PictMoldMain;
    }

    public function setPictMoldMain(string $PictMoldMain): self
    {
        $this->PictMoldMain = $PictMoldMain;

        return $this;
    }
}
