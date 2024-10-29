<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpcServers
 *
 * @ORM\Table(name="opc_servers")
 * @ORM\Entity
 */
class OpcServers
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdOpcServer", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idopcserver;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdOpcType", type="integer", nullable=true)
     */
    private $idopctype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="OpcComputer", type="string", length=200, nullable=true)
     */
    private $opccomputer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="OpcServer", type="string", length=100, nullable=true)
     */
    private $opcserver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NetworkPath", type="string", length=200, nullable=true)
     */
    private $networkpath;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreationUTC", type="datetime", nullable=true)
     */
    private $datecreationutc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateModificationUTC", type="datetime", nullable=true)
     */
    private $datemodificationutc;

    public function getIdopcserver(): ?string
    {
        return $this->idopcserver;
    }

    public function getIdopctype(): ?int
    {
        return $this->idopctype;
    }

    public function setIdopctype(?int $idopctype): self
    {
        $this->idopctype = $idopctype;

        return $this;
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

    public function getOpccomputer(): ?string
    {
        return $this->opccomputer;
    }

    public function setOpccomputer(?string $opccomputer): self
    {
        $this->opccomputer = $opccomputer;

        return $this;
    }

    public function getOpcserver(): ?string
    {
        return $this->opcserver;
    }

    public function setOpcserver(?string $opcserver): self
    {
        $this->opcserver = $opcserver;

        return $this;
    }

    public function getNetworkpath(): ?string
    {
        return $this->networkpath;
    }

    public function setNetworkpath(?string $networkpath): self
    {
        $this->networkpath = $networkpath;

        return $this;
    }

    public function getDatecreationutc(): ?\DateTimeInterface
    {
        return $this->datecreationutc;
    }

    public function setDatecreationutc(?\DateTimeInterface $datecreationutc): self
    {
        $this->datecreationutc = $datecreationutc;

        return $this;
    }

    public function getDatemodificationutc(): ?\DateTimeInterface
    {
        return $this->datemodificationutc;
    }

    public function setDatemodificationutc(?\DateTimeInterface $datemodificationutc): self
    {
        $this->datemodificationutc = $datemodificationutc;

        return $this;
    }


}
