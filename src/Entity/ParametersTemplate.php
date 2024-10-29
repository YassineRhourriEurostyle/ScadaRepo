<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParametersTemplate
 *
 * @ORM\Table(name="parameters_template")
 * @ORM\Entity(repositoryClass="App\Repository\ParametersTemplateRepository")
 */
class ParametersTemplate
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdParameter", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IdRank", type="string", length=50, nullable=true)
     */
    private $idrank;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ParamName", type="string", length=100, nullable=true)
     */
    private $paramname;

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

    public function getIdparameter(): ?string
    {
        return $this->idparameter;
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

    public function getParamname(): ?string
    {
        return $this->paramname;
    }

    public function setParamname(?string $paramname): self
    {
        $this->paramname = $paramname;

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
