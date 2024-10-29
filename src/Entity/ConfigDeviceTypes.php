<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigDeviceTypes
 *
 * @ORM\Table(name="config_device_types")
 * @ORM\Entity(repositoryClass="App\Repository\ConfigDeviceTypesRepository")
 */
class ConfigDeviceTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="iddevice_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddeviceType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DevTypDescription", type="string", length=100, nullable=true)
     */
    private $devtypdescription;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DevTypeSort", type="integer", nullable=true)
     */
    private $devtypesort;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DevTypeDateCreation", type="datetime", nullable=true)
     */
    private $devtypedatecreation;

    public function getIddeviceType(): ?int
    {
        return $this->iddeviceType;
    }

    public function getDevtypdescription(): ?string
    {
        return $this->devtypdescription;
    }

    public function setDevtypdescription(?string $devtypdescription): self
    {
        $this->devtypdescription = $devtypdescription;

        return $this;
    }

    public function getDevtypesort(): ?int
    {
        return $this->devtypesort;
    }

    public function setDevtypesort(?int $devtypesort): self
    {
        $this->devtypesort = $devtypesort;

        return $this;
    }

    public function getDevtypedatecreation(): ?\DateTimeInterface
    {
        return $this->devtypedatecreation;
    }

    public function setDevtypedatecreation(?\DateTimeInterface $devtypedatecreation): self
    {
        $this->devtypedatecreation = $devtypedatecreation;

        return $this;
    }


}
