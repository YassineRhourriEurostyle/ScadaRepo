<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsStandardModificationLog
 *
 * @ORM\Table(name="settings_standard_modification_log", indexes={@ORM\Index(name="StdSettModIdx1", columns={"idSite", "idParameter", "SettStdModDate"})})
 * @ORM\Entity(repositoryClass="App\Repository\SettingsStandardModificationLogRepository")
 */
class SettingsStandardModificationLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSettStdModLog", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsettstdmodlog;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="SettStdModDate", type="datetime", nullable=true)
     */
    private $settstdmoddate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParameter", type="integer", nullable=true)
     */
    private $idparameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SettStdModOldValue", type="string", length=100, nullable=true)
     */
    private $settstdmodoldvalue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SetStdModNewValue", type="string", length=100, nullable=true)
     */
    private $setstdmodnewvalue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SetStdModWho", type="string", length=100, nullable=true)
     */
    private $setstdmodwho;

    public function getIdsettstdmodlog(): ?string
    {
        return $this->idsettstdmodlog;
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

    public function getSettstdmoddate(): ?\DateTimeInterface
    {
        return $this->settstdmoddate;
    }

    public function setSettstdmoddate(?\DateTimeInterface $settstdmoddate): self
    {
        $this->settstdmoddate = $settstdmoddate;

        return $this;
    }

    public function getIdparameter(): ?int
    {
        return $this->idparameter;
    }

    public function setIdparameter(?int $idparameter): self
    {
        $this->idparameter = $idparameter;

        return $this;
    }

    public function getSettstdmodoldvalue(): ?string
    {
        return $this->settstdmodoldvalue;
    }

    public function setSettstdmodoldvalue(?string $settstdmodoldvalue): self
    {
        $this->settstdmodoldvalue = $settstdmodoldvalue;

        return $this;
    }

    public function getSetstdmodnewvalue(): ?string
    {
        return $this->setstdmodnewvalue;
    }

    public function setSetstdmodnewvalue(?string $setstdmodnewvalue): self
    {
        $this->setstdmodnewvalue = $setstdmodnewvalue;

        return $this;
    }

    public function getSetstdmodwho(): ?string
    {
        return $this->setstdmodwho;
    }

    public function setSetstdmodwho(?string $setstdmodwho): self
    {
        $this->setstdmodwho = $setstdmodwho;

        return $this;
    }


}
