<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(name="AD_login", type="string", length=150, nullable=true, options={"comment"="Example: ESB\admin.roland"})
     */
    private $adLogin;

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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AuthGroupes", mappedBy="users", cascade={"persist"})
     */
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
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

    // Getter and setter for groups
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(AuthGroupes $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    public function removeGroup(AuthGroupes $group): self
    {
        $this->groups->removeElement($group);
        return $this;
    }
}