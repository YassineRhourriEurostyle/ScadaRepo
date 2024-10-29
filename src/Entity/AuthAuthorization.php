<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthAuthorization
 *
 * @ORM\Table(name="auth_authorization")
 * @ORM\Entity
 */
class AuthAuthorization
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdAuthAuthor", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idauthauthor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdGroupUsr", type="integer", nullable=true)
     */
    private $idgroupusr;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdAuthFeature", type="integer", nullable=true)
     */
    private $idauthfeature;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="Authorization", type="boolean", nullable=true, options={"comment"="1 -> Yes
0 -> No
"})
     */
    private $authorization;

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

    public function getIdauthauthor(): ?string
    {
        return $this->idauthauthor;
    }

    public function getIdgroupusr(): ?int
    {
        return $this->idgroupusr;
    }

    public function setIdgroupusr(?int $idgroupusr): self
    {
        $this->idgroupusr = $idgroupusr;

        return $this;
    }

    public function getIdauthfeature(): ?int
    {
        return $this->idauthfeature;
    }

    public function setIdauthfeature(?int $idauthfeature): self
    {
        $this->idauthfeature = $idauthfeature;

        return $this;
    }

    public function getAuthorization(): ?bool
    {
        return $this->authorization;
    }

    public function setAuthorization(?bool $authorization): self
    {
        $this->authorization = $authorization;

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
