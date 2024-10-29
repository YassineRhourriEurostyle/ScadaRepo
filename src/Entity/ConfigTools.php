<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigTools
 *
 * @ORM\Table(name="config_tools")
 * @ORM\Entity
 */
class ConfigTools
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCfgTool", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfgtool;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToolReference", type="string", length=50, nullable=true)
     */
    private $toolreference;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ToolDateCreation", type="bigint", nullable=true)
     */
    private $tooldatecreation;

    public function getIdcfgtool(): ?string
    {
        return $this->idcfgtool;
    }

    public function getIdsite(): ?int
    {
        return $this->idsite;
    }

    public function setIdsite(?int $idsite): self
    {
        $this->idsite = $idsite;

        return $this;
    }

    public function getToolreference(): ?string
    {
        return $this->toolreference;
    }

    public function setToolreference(?string $toolreference): self
    {
        $this->toolreference = $toolreference;

        return $this;
    }

    public function getTooldatecreation(): ?string
    {
        return $this->tooldatecreation;
    }

    public function setTooldatecreation(?string $tooldatecreation): self
    {
        $this->tooldatecreation = $tooldatecreation;

        return $this;
    }


}
