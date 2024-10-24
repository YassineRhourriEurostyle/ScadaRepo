<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 * @ORM\Table(name="generic_currency") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_currency": "App\Entity\Generic\Currency", "currency": "App\Entity\Currency"})
 */
class Currency {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $Code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Country", mappedBy="Currency")
     */
    protected $countries;

    /**
     * @ORM\Column(type="float")
     */
    protected $CurrentRate;

    public function __construct() {
        $this->countries = new ArrayCollection();
        $this->budgetRevisions = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function __toString() {
        return $this->Code . ' - ' . $this->Name;
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

    /**
     * @return Collection|Country[]
     */
    public function getCountries(): Collection {
        return $this->countries;
    }

    public function addCountry(Country $country): self {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
            $country->setCurrency($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): self {
        if ($this->countries->contains($country)) {
            $this->countries->removeElement($country);
            // set the owning side to null (unless already changed)
            if ($country->getCurrency() === $this) {
                $country->setCurrency(null);
            }
        }

        return $this;
    }

    public function getCurrentRate(): ?float {
        return $this->CurrentRate;
    }

    public function setCurrentRate(float $CurrentRate): self {
        $this->CurrentRate = $CurrentRate;

        return $this;
    }

}
