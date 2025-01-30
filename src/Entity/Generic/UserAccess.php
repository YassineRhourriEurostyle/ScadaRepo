<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Site;
use App\Entity\Currency;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAccessRepository")
 * @ORM\Table(name="generic_user_access") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_user_access": "App\Entity\Generic\UserAccess", "user_access": "App\Entity\UserAccess"})
 */
class UserAccess
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $EntityField;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Value;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Deny;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ReadOnly;

    public function getDeny(): ?bool
    {
        return $this->Deny;
    }

    public function setDeny(?bool $Deny): self
    {
        $this->Deny = $Deny;

        return $this;
    }

    public function getReadOnly(): ?bool
    {
        return $this->ReadOnly;
    }

    public function setReadOnly(?bool $ReadOnly): self
    {
        $this->ReadOnly = $ReadOnly;

        return $this;
    }

    

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->EntityField;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->User;
    }

    public function setUser(string $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getEntityField(): ?string
    {
        return $this->EntityField;
    }

    public function setEntityField(string $EntityField): self
    {
        $this->EntityField = $EntityField;

        return $this;
    }
    
    public function getValue(): ?string
    {
        return $this->Value;
    }

    public function setValue(string $Value): self
    {
        $this->Value = $Value;

        return $this;
    }
    
}
