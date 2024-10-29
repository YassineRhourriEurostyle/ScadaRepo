<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppParametersSiteSiseData
 *
 * @ORM\Table(name="app_parameters_site_sise_data")
 * @ORM\Entity(repositoryClass="App\Repository\AppParametersSiteSiseDataRepository")
 */
class AppParametersSiteSiseData
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAppParamSiteData", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idappparamsitedata;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CurrentSynapsName", type="string", length=100, nullable=true)
     */
    private $currentsynapsname;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    public function getIdappparamsitedata(): ?int
    {
        return $this->idappparamsitedata;
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

    public function getCurrentsynapsname(): ?string
    {
        return $this->currentsynapsname;
    }

    public function setCurrentsynapsname(?string $currentsynapsname): self
    {
        $this->currentsynapsname = $currentsynapsname;

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

    public function getDatemodification(): ?\DateTimeInterface
    {
        return $this->datemodification;
    }

    public function setDatemodification(?\DateTimeInterface $datemodification): self
    {
        $this->datemodification = $datemodification;

        return $this;
    }


}
