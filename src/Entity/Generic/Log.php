<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
 * @ORM\Table(name="generic_log") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_log": "App\Entity\Generic\Log", "log": "App\Entity\Log"})
 */
class Log
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Entity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Field;

    /**
     * @ORM\Column(type="text")
     */
    private $Value;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $FieldID;
    
    public function __toString() {
        return 'Log_#' . $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getFieldID(): ?int
    {
        return $this->FieldID;
    }

    public function setFieldID(int $FieldID): self
    {
        $this->FieldID = $FieldID;

        return $this;
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

    public function getEntity(): ?string
    {
        return $this->Entity;
    }

    public function setEntity(string $Entity): self
    {
        $this->Entity = $Entity;

        return $this;
    }

    public function getField(): ?string
    {
        return $this->Field;
    }

    public function setField(string $Field): self
    {
        $this->Field = $Field;

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
