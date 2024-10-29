<?php

namespace App\Entity;

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
     * @ORM\Column(name="GroupShow", type="boolean", nullable=true, options={"comment"="Display :
1 -> Yes
0 -> No"})
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


}
