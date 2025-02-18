<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthGroupes
 *
 * @ORM\Table(name="auth_groupes")
 * @ORM\Entity(repositoryClass="App\Repository\AuthGroupesRepository")
 */
class AuthGroupes
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdGroupUsr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgroupusr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="GroupDescription", type="string", length=100, nullable=true)
     */
    private $groupdescription;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="GroupShow", type="boolean", nullable=true, options={"comment"="Display: 1 -> Yes, 0 -> No"})
     */
    private $groupshow;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\AuthUsers", inversedBy="groups")
     * @ORM\JoinTable(
     *     name="auth_users_groups", 
     *     joinColumns={
     *         @ORM\JoinColumn(name="idgroupusr", referencedColumnName="IdGroupUsr")
     *     }, 
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="iduser", referencedColumnName="IdUser")
     *     }
     * )
     */
    private $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    //changed getIdgroupusr to getId because error inentitychangedsubsciber
    public function getId(): ?int
    {
        return $this->idgroupusr;
    }
    public function getIdgroupusr(): ?int
    {
        return $this->idgroupusr;
    }

    public function getGroupdescription(): ?string
    {
        return $this->groupdescription;
    }

    public function setGroupdescription(?string $groupdescription): self
    {
        $this->groupdescription = $groupdescription;
        return $this;
    }

    public function getGroupshow(): ?bool
    {
        return $this->groupshow;
    }

    public function setGroupshow(?bool $groupshow): self
    {
        $this->groupshow = $groupshow;
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

    // Getter and setter for users
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(AuthUsers $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(AuthUsers $user): self
    {
        $this->users->removeElement($user);
        return $this;
    }
}