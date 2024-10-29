<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigValueType
 *
 * @ORM\Table(name="config_value_type")
 * @ORM\Entity(repositoryClass="App\Repository\ConfigValueTypeRepository")
 */
class ConfigValueType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idconfig_value_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconfigValueType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CfgValTpDescription", type="string", length=100, nullable=true)
     */
    private $cfgvaltpdescription;

    public function getIdconfigValueType(): ?int
    {
        return $this->idconfigValueType;
    }

    public function getCfgvaltpdescription(): ?string
    {
        return $this->cfgvaltpdescription;
    }

    public function setCfgvaltpdescription(?string $cfgvaltpdescription): self
    {
        $this->cfgvaltpdescription = $cfgvaltpdescription;

        return $this;
    }


}
