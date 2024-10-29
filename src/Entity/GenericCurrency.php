<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericCurrency
 *
 * @ORM\Table(name="generic_currency")
 * @ORM\Entity
 */
class GenericCurrency
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
     * @var float
     *
     * @ORM\Column(name="current_rate", type="float", precision=10, scale=0, nullable=false)
     */
    private $currentRate;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCurrentRate(): ?float
    {
        return $this->currentRate;
    }

    public function setCurrentRate(float $currentRate): self
    {
        $this->currentRate = $currentRate;

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
