<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint; // Into the header comment: @ORM\Table(name="",uniqueConstraints={@UniqueConstraint(name="table_field", columns={"field"})})

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametersServerRepository")
 */
class ParametersServer
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
    private $idParamStd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idServerType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ParamRegistry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ParamNode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idParamConvert;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ParamServer_DateCreationUTC;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ParamServer_DateModificationUTC;
    
    public function __toString() {
        return 'ParametersServer_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParamStd(): ?int
    {
        return $this->idParamStd;
    }

    public function setIdParamStd(?int $idParamStd): self
    {
        $this->idParamStd = $idParamStd;

        return $this;
    }

    public function getIdServerType(): ?int
    {
        return $this->idServerType;
    }

    public function setIdServerType(?int $idServerType): self
    {
        $this->idServerType = $idServerType;

        return $this;
    }

    public function getParamRegistry(): ?string
    {
        return $this->ParamRegistry;
    }

    public function setParamRegistry(?string $ParamRegistry): self
    {
        $this->ParamRegistry = $ParamRegistry;

        return $this;
    }

    public function getParamNode(): ?string
    {
        return $this->ParamNode;
    }

    public function setParamNode(?string $ParamNode): self
    {
        $this->ParamNode = $ParamNode;

        return $this;
    }

    public function getIdParamConvert(): ?int
    {
        return $this->idParamConvert;
    }

    public function setIdParamConvert(?int $idParamConvert): self
    {
        $this->idParamConvert = $idParamConvert;

        return $this;
    }

    public function getParamServerDateCreationUTC(): ?\DateTimeInterface
    {
        return $this->ParamServer_DateCreationUTC;
    }

    public function setParamServerDateCreationUTC(?\DateTimeInterface $ParamServer_DateCreationUTC): self
    {
        $this->ParamServer_DateCreationUTC = $ParamServer_DateCreationUTC;

        return $this;
    }

    public function getParamServerDateModificationUTC(): ?string
    {
        return $this->ParamServer_DateModificationUTC;
    }

    public function setParamServerDateModificationUTC(?string $ParamServer_DateModificationUTC): self
    {
        $this->ParamServer_DateModificationUTC = $ParamServer_DateModificationUTC;

        return $this;
    }
}
