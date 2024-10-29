<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthFeatures
 *
 * @ORM\Table(name="auth_features")
 * @ORM\Entity(repositoryClass="App\Repository\AuthFeaturesRepository")
 */
class AuthFeatures
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdAuthFeature", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idauthfeature;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FeatDescription", type="string", length=100, nullable=true)
     */
    private $featdescription;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="FeatShow", type="boolean", nullable=true, options={"comment"="Display :
1 -> Yes
2 -> No"})
     */
    private $featshow;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateUtcCreation", type="datetime", nullable=true)
     */
    private $dateutccreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateUtcModification", type="datetime", nullable=true)
     */
    private $dateutcmodification;

    public function getIdauthfeature(): ?int
    {
        return $this->idauthfeature;
    }

    public function getFeatdescription(): ?string
    {
        return $this->featdescription;
    }

    public function setFeatdescription(?string $featdescription): self
    {
        $this->featdescription = $featdescription;

        return $this;
    }

    public function getFeatshow(): ?bool
    {
        return $this->featshow;
    }

    public function setFeatshow(?bool $featshow): self
    {
        $this->featshow = $featshow;

        return $this;
    }

    public function getDateutccreation(): ?\DateTimeInterface
    {
        return $this->dateutccreation;
    }

    public function setDateutccreation(?\DateTimeInterface $dateutccreation): self
    {
        $this->dateutccreation = $dateutccreation;

        return $this;
    }

    public function getDateutcmodification(): ?\DateTimeInterface
    {
        return $this->dateutcmodification;
    }

    public function setDateutcmodification(?\DateTimeInterface $dateutcmodification): self
    {
        $this->dateutcmodification = $dateutcmodification;

        return $this;
    }


}
