<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericMaterial
 *
 * @ORM\Table(name="generic_material")
 * @ORM\Entity(repositoryClass="App\Repository\GenericMaterialRepository")
 */
class GenericMaterial
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
     * @ORM\Column(name="dtype", type="string", length=255, nullable=false)
     */
    private $dtype;

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

    public function getDtype(): ?string
    {
        return $this->dtype;
    }

    public function setDtype(string $dtype): self
    {
        $this->dtype = $dtype;

        return $this;
    }


}
