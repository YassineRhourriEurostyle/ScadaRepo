<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogApplication
 *
 * @ORM\Table(name="log_application")
 * @ORM\Entity(repositoryClass="App\Repository\LogApplicationRepository")
 */
class LogApplication
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLog", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlog;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="logDateTime", type="datetime", nullable=true)
     */
    private $logdatetime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="bigint", nullable=true)
     */
    private $idsite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="logType", type="integer", nullable=true, options={"default"="1"})
     */
    private $logtype = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logWriter", type="string", length=100, nullable=true)
     */
    private $logwriter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logText", type="text", length=65535, nullable=true)
     */
    private $logtext;

    public function getIdlog(): ?string
    {
        return $this->idlog;
    }

    public function getLogdatetime(): ?\DateTimeInterface
    {
        return $this->logdatetime;
    }

    public function setLogdatetime(?\DateTimeInterface $logdatetime): self
    {
        $this->logdatetime = $logdatetime;

        return $this;
    }

    public function getIdsite(): ?string
    {
        return $this->idsite;
    }

    public function setIdsite(?string $idsite): self
    {
        $this->idsite = $idsite;

        return $this;
    }

    public function getLogtype(): ?int
    {
        return $this->logtype;
    }

    public function setLogtype(?int $logtype): self
    {
        $this->logtype = $logtype;

        return $this;
    }

    public function getLogwriter(): ?string
    {
        return $this->logwriter;
    }

    public function setLogwriter(?string $logwriter): self
    {
        $this->logwriter = $logwriter;

        return $this;
    }

    public function getLogtext(): ?string
    {
        return $this->logtext;
    }

    public function setLogtext(?string $logtext): self
    {
        $this->logtext = $logtext;

        return $this;
    }


}
