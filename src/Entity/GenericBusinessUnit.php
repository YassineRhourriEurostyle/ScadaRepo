<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericBusinessUnit
 *
 * @ORM\Table(name="generic_business_unit")
 * @ORM\Entity
 */
class GenericBusinessUnit
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
     * @ORM\Column(name="name", type="string", length=3, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="signatory", type="string", length=255, nullable=false)
     */
    private $signatory;

    /**
     * @var string
     *
     * @ORM\Column(name="dtype", type="string", length=255, nullable=false)
     */
    private $dtype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=20, nullable=true)
     */
    private $color;

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

    public function getSignatory(): ?string
    {
        return $this->signatory;
    }

    public function setSignatory(string $signatory): self
    {
        $this->signatory = $signatory;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }


}
