<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogModifications
 *
 * @ORM\Table(name="log_modifications")
 * @ORM\Entity(repositoryClass="App\Repository\LogModificationsRepository")
 */
class LogModifications
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLogModif", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlogmodif;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SiteId", type="integer", nullable=true)
     */
    private $siteid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idMachine", type="integer", nullable=true)
     */
    private $idmachine;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idTool", type="integer", nullable=true)
     */
    private $idtool;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idToolVersion", type="integer", nullable=true)
     */
    private $idtoolversion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSettingStandard", type="bigint", nullable=true)
     */
    private $idsettingstandard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IdRank", type="string", length=30, nullable=true)
     */
    private $idrank;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idParameter", type="bigint", nullable=true)
     */
    private $idparameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="StdValueOld", type="string", length=20, nullable=true)
     */
    private $stdvalueold;

    /**
     * @var string|null
     *
     * @ORM\Column(name="StdValueNew", type="string", length=20, nullable=true)
     */
    private $stdvaluenew;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMiniOld", type="string", length=20, nullable=true)
     */
    private $toleranceminiold;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMiniNew", type="string", length=20, nullable=true)
     */
    private $tolerancemininew;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMaxiOld", type="string", length=20, nullable=true)
     */
    private $tolerancemaxiold;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ToleranceMaxiNew", type="string", length=20, nullable=true)
     */
    private $tolerancemaxinew;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LogModifText", type="string", length=250, nullable=true)
     */
    private $logmodiftext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="UserLogin", type="string", length=100, nullable=true)
     */
    private $userlogin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    public function getIdlogmodif(): ?string
    {
        return $this->idlogmodif;
    }

    public function getSiteid(): ?int
    {
        return $this->siteid;
    }

    public function setSiteid(?int $siteid): self
    {
        $this->siteid = $siteid;

        return $this;
    }

    public function getIdmachine(): ?int
    {
        return $this->idmachine;
    }

    public function setIdmachine(?int $idmachine): self
    {
        $this->idmachine = $idmachine;

        return $this;
    }

    public function getIdtool(): ?int
    {
        return $this->idtool;
    }

    public function setIdtool(?int $idtool): self
    {
        $this->idtool = $idtool;

        return $this;
    }

    public function getIdtoolversion(): ?int
    {
        return $this->idtoolversion;
    }

    public function setIdtoolversion(?int $idtoolversion): self
    {
        $this->idtoolversion = $idtoolversion;

        return $this;
    }

    public function getIdsettingstandard(): ?string
    {
        return $this->idsettingstandard;
    }

    public function setIdsettingstandard(?string $idsettingstandard): self
    {
        $this->idsettingstandard = $idsettingstandard;

        return $this;
    }

    public function getIdrank(): ?string
    {
        return $this->idrank;
    }

    public function setIdrank(?string $idrank): self
    {
        $this->idrank = $idrank;

        return $this;
    }

    public function getIdparameter(): ?string
    {
        return $this->idparameter;
    }

    public function setIdparameter(?string $idparameter): self
    {
        $this->idparameter = $idparameter;

        return $this;
    }

    public function getStdvalueold(): ?string
    {
        return $this->stdvalueold;
    }

    public function setStdvalueold(?string $stdvalueold): self
    {
        $this->stdvalueold = $stdvalueold;

        return $this;
    }

    public function getStdvaluenew(): ?string
    {
        return $this->stdvaluenew;
    }

    public function setStdvaluenew(?string $stdvaluenew): self
    {
        $this->stdvaluenew = $stdvaluenew;

        return $this;
    }

    public function getToleranceminiold(): ?string
    {
        return $this->toleranceminiold;
    }

    public function setToleranceminiold(?string $toleranceminiold): self
    {
        $this->toleranceminiold = $toleranceminiold;

        return $this;
    }

    public function getTolerancemininew(): ?string
    {
        return $this->tolerancemininew;
    }

    public function setTolerancemininew(?string $tolerancemininew): self
    {
        $this->tolerancemininew = $tolerancemininew;

        return $this;
    }

    public function getTolerancemaxiold(): ?string
    {
        return $this->tolerancemaxiold;
    }

    public function setTolerancemaxiold(?string $tolerancemaxiold): self
    {
        $this->tolerancemaxiold = $tolerancemaxiold;

        return $this;
    }

    public function getTolerancemaxinew(): ?string
    {
        return $this->tolerancemaxinew;
    }

    public function setTolerancemaxinew(?string $tolerancemaxinew): self
    {
        $this->tolerancemaxinew = $tolerancemaxinew;

        return $this;
    }

    public function getLogmodiftext(): ?string
    {
        return $this->logmodiftext;
    }

    public function setLogmodiftext(?string $logmodiftext): self
    {
        $this->logmodiftext = $logmodiftext;

        return $this;
    }

    public function getUserlogin(): ?string
    {
        return $this->userlogin;
    }

    public function setUserlogin(?string $userlogin): self
    {
        $this->userlogin = $userlogin;

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
