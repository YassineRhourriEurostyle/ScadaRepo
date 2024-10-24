<?php

namespace App\Entity\Generic;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 * @ORM\Table(name="generic_language") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_language": "App\Entity\Generic\Language", "language": "App\Entity\Language"})
 */
class Language {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $Code;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $RightToLeft;

    public function __toString() {
        return $this->Name;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->Name;
    }

    public function setName(string $Name): self {
        $this->Name = $Name;

        return $this;
    }

    public function getCode(): ?string {
        return $this->Code;
    }

    public function setCode(string $Code): self {
        $this->Code = $Code;

        return $this;
    }

    public function getRightToLeft(): ?bool {
        return $this->RightToLeft;
    }

    public function setRightToLeft(?bool $RightToLeft): self {
        $this->RightToLeft = $RightToLeft;

        return $this;
    }

}
