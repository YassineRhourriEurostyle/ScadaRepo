<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OpcTypes
 *
 * @ORM\Table(name="opc_types")
 * @ORM\Entity(repositoryClass="App\Repository\OpcTypesRepository")
 */
class OpcTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdOpcType", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idopctype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ConnectionMode", type="string", length=50, nullable=true)
     */
    private $connectionmode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CnnDescription", type="string", length=100, nullable=true)
     */
    private $cnndescription;

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

    public function getIdopctype(): ?int
    {
        return $this->idopctype;
    }

    public function getConnectionmode(): ?string
    {
        return $this->connectionmode;
    }

    public function setConnectionmode(?string $connectionmode): self
    {
        $this->connectionmode = $connectionmode;

        return $this;
    }

    public function getCnndescription(): ?string
    {
        return $this->cnndescription;
    }

    public function setCnndescription(?string $cnndescription): self
    {
        $this->cnndescription = $cnndescription;

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
