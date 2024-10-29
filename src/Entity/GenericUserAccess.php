<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericUserAccess
 *
 * @ORM\Table(name="generic_user_access")
 * @ORM\Entity
 */
class GenericUserAccess
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
     * @ORM\Column(name="user", type="string", length=255, nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_field", type="string", length=255, nullable=false)
     */
    private $entityField;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deny", type="boolean", nullable=true)
     */
    private $deny;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="read_only", type="boolean", nullable=true)
     */
    private $readOnly;

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

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEntityField(): ?string
    {
        return $this->entityField;
    }

    public function setEntityField(string $entityField): self
    {
        $this->entityField = $entityField;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDeny(): ?bool
    {
        return $this->deny;
    }

    public function setDeny(?bool $deny): self
    {
        $this->deny = $deny;

        return $this;
    }

    public function getReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setReadOnly(?bool $readOnly): self
    {
        $this->readOnly = $readOnly;

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
