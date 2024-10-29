<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUsers
 *
 * @ORM\Table(name="auth_users")
 * @ORM\Entity(repositoryClass="App\Repository\AuthUsersRepository")
 */
class AuthUsers
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdUser", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AD_login", type="string", length=150, nullable=true, options={"comment"="Example : ESB\admin.roland"})
     */
    private $adLogin;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IdGroupUsr", type="integer", nullable=true)
     */
    private $idgroupusr;

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

    public function getIduser(): ?string
    {
        return $this->iduser;
    }

    public function getAdLogin(): ?string
    {
        return $this->adLogin;
    }

    public function setAdLogin(?string $adLogin): self
    {
        $this->adLogin = $adLogin;

        return $this;
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
