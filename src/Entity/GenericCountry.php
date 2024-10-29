<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericCountry
 *
 * @ORM\Table(name="generic_country", indexes={@ORM\Index(name="IDX_EE3DEB3738248176", columns={"currency_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\GenericCountryRepository")
 */
class GenericCountry
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
     * @ORM\Column(name="code", type="string", length=3, nullable=false)
     */
    private $code;

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

    /**
     * @var \GenericCurrency
     *
     * @ORM\ManyToOne(targetEntity="GenericCurrency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCurrency(): ?GenericCurrency
    {
        return $this->currency;
    }

    public function setCurrency(?GenericCurrency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }


}
