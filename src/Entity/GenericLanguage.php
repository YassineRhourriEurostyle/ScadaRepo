<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericLanguage
 *
 * @ORM\Table(name="generic_language")
 * @ORM\Entity(repositoryClass="App\Repository\GenericLanguageRepository")
 */
class GenericLanguage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=3, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="dtype", type="string", length=255, nullable=false)
     */
    private $dtype;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="right_to_left", type="boolean", nullable=true)
     */
    private $rightToLeft;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDtype(): ?string
    {
        return $this->dtype;
    }

    public function setDtype(string $dtype): self
    {
        $this->dtype = $dtype;

        return $this;
    }

    public function getRightToLeft(): ?bool
    {
        return $this->rightToLeft;
    }

    public function setRightToLeft(?bool $rightToLeft): self
    {
        $this->rightToLeft = $rightToLeft;

        return $this;
    }


}
