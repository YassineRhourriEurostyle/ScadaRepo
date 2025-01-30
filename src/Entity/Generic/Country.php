<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Site;
use App\Entity\Currency;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * @ORM\Table(name="generic_country") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_country": "App\Entity\Generic\Country", "country": "App\Entity\Country"})
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency", inversedBy="countries")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $Currency;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="Country")
     */
    protected $sites;
    

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
    public function getCurrency(): ?Currency
    {
        return $this->Currency;
    }

    public function setCurrency(Currency $Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setCountry($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getCountry() === $this) {
                $site->setCountry(null);
            }
        }

        return $this;
    }
}
