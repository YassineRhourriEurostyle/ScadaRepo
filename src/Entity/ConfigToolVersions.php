<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigToolVersions
 *
 * @ORM\Table(name="config_tool_versions")
 * @ORM\Entity
 */
class ConfigToolVersions
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCfgToolVersion", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfgtoolversion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToolVersionText", type="string", length=50, nullable=true)
     */
    private $toolversiontext;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Archived", type="boolean", nullable=true, options={"comment"="Archived :
0 -> No
1 -> Yes
"})
     */
    private $archived = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    public function getIdcfgtoolversion(): ?string
    {
        return $this->idcfgtoolversion;
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

    public function getToolversiontext(): ?string
    {
        return $this->toolversiontext;
    }

    public function setToolversiontext(?string $toolversiontext): self
    {
        $this->toolversiontext = $toolversiontext;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }


}
