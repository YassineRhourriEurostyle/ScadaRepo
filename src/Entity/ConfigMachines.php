<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigMachines
 *
 * @ORM\Table(name="config_machines")
 * @ORM\Entity(repositoryClass="App\Repository\ConfigMachinesRepository")
 */
class ConfigMachines
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCfgMachine", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfgmachine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MacReference", type="string", length=50, nullable=true)
     */
    private $macreference;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MacDescription", type="string", length=100, nullable=true)
     */
    private $macdescription;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MacDateCreation", type="bigint", nullable=true)
     */
    private $macdatecreation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MacDescription2", type="string", length=100, nullable=true)
     */
    private $macdescription2;

    public function getId(): ?string
    {
        return $this->idcfgmachine;
    }
    public function getIdcfgmachine(): ?string
    {
        return $this->idcfgmachine;
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

    public function getMacreference(): ?string
    {
        return $this->macreference;
    }

    public function setMacreference(?string $macreference): self
    {
        $this->macreference = $macreference;

        return $this;
    }

    public function getMacdescription(): ?string
    {
        return $this->macdescription;
    }

    public function setMacdescription(?string $macdescription): self
    {
        $this->macdescription = $macdescription;

        return $this;
    }

    public function getMacdatecreation(): ?string
    {
        return $this->macdatecreation;
    }

    public function setMacdatecreation(?string $macdatecreation): self
    {
        $this->macdatecreation = $macdatecreation;

        return $this;
    }

    public function getMacdescription2(): ?string
    {
        return $this->macdescription2;
    }

    public function setMacdescription2(?string $macdescription2): self
    {
        $this->macdescription2 = $macdescription2;

        return $this;
    }


}
