<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LastDataImport
 *
 * @ORM\Table(name="last_data_import")
 * @ORM\Entity(repositoryClass="App\Repository\LastDataImportRepository")
 */
class LastDataImport
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLastDataImp", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlastdataimp;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idSite", type="integer", nullable=true)
     */
    private $idsite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LastIdCyc", type="bigint", nullable=true)
     */
    private $lastidcyc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dbName", type="string", length=100, nullable=true)
     */
    private $dbname;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    public function getIdlastdataimp(): ?string
    {
        return $this->idlastdataimp;
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

    public function getLastidcyc(): ?string
    {
        return $this->lastidcyc;
    }

    public function setLastidcyc(?string $lastidcyc): self
    {
        $this->lastidcyc = $lastidcyc;

        return $this;
    }

    public function getDbname(): ?string
    {
        return $this->dbname;
    }

    public function setDbname(?string $dbname): self
    {
        $this->dbname = $dbname;

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
