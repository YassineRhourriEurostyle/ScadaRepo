<?php

namespace App\Entity\Generic;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JJG\Ping;
use App\Entity\Country;
use App\Entity\BusinessUnit;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 * @ORM\Table(name="generic_site") 
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({"generic_site": "App\Entity\Generic\Site", "site": "App\Entity\Site"})
 */
class Site {

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
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $LDAP_IP;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $LDAP_Domain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $LDAP_OU;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $Currency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessUnit", inversedBy="sites")
     */
    protected $BusinessUnit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="sites")
     */
    protected $Country;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Language", inversedBy="sites")
     */
    protected $DefaultLanguage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Signatory;

    public function __construct() {
        $this->budgetAllowances = new ArrayCollection();
        $this->budgets = new ArrayCollection();
    }

    public function __toString() {
        return $this->Code;
    }

    public function getSignatory(): ?string {
        return $this->Signatory;
    }

    public function setSignatory(string $Signatory): self {
        $this->Signatory = $Signatory;

        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCode(): ?string {
        return $this->Code;
    }

    public function setCode(string $Code): self {
        $this->Code = $Code;

        return $this;
    }

    public function getCountry(): ?Country {
        return $this->Country;
    }

    public function setCountry(Country $Country): self {
        $this->Country = $Country;

        return $this;
    }

    public function getName(): ?string {
        return $this->Name;
    }

    public function setName(string $Name): self {
        $this->Name = $Name;

        return $this;
    }

    public function getLDAPIP(): ?string {
        return $this->LDAP_IP;
    }

    public function setLDAPIP(?string $LDAP_IP): self {
        $this->LDAP_IP = $LDAP_IP;

        return $this;
    }

    public function getLDAPDomain(): ?string {
        return $this->LDAP_Domain;
    }

    public function setLDAPDomain(?string $LDAP_Domain): self {
        $this->LDAP_Domain = $LDAP_Domain;

        return $this;
    }

    public function getLDAPOU(): ?string {
        return $this->LDAP_OU;
    }

    public function setLDAPOU(?string $LDAP_OU): self {
        $this->LDAP_OU = $LDAP_OU;

        return $this;
    }

    public function getCurrency(): ?string {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): self {
        $this->Currency = $Currency;

        return $this;
    }

    public function getDefaultLanguage(): ?\App\Entity\Language {
        return $this->DefaultLanguage;
    }

    public function setDefaultLanguage(\App\Entity\Language $DefaultLanguage): self {
        $this->DefaultLanguage = $DefaultLanguage;

        return $this;
    }

    public function getBusinessUnit(): ?BusinessUnit {
        return $this->BusinessUnit;
    }

    public function setBusinessUnit(?BusinessUnit $BusinessUnit): self {
        $this->BusinessUnit = $BusinessUnit;

        return $this;
    }

    /*
     * Ping
     */

    public function ping() {

        return true;

        $ping = new Ping($this->LDAP_IP);

        return $ping->ping() !== false;
    }

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $StartDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $EndDate;

    public function getStartDate(): ?\DateTimeInterface {
        return $this->StartDate;
    }

    public function setStartDate(?\DateTimeInterface $StartDate): self {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface {
        return $this->EndDate;
    }

    public function setEndDate(?\DateTimeInterface $EndDate): self {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function isActive($year = null): bool {
        if (!$year)
            $year = date('Y');

        if (empty($this->StartDate) && empty($this->EndDate)):
            return true;
        else:
            if (is_object($this->StartDate) && $this->StartDate->format('Y-m-d') > $year . '-12-31')
                return false;
            /**
             * @TODO : Revoir cette ligne ci-dessous
             */
            if (is_object($this->EndDate) && $this->EndDate->format('Y-m-d') < $year . '-01-01' && $this->EndDate->format('Y-m-d') != '-0001-11-30')
                return false;
        endif;

        return true;
    }

    public function isActiveThisMonth($year, $month): bool {
        if (!$year)
            $year = date('Y');

        $ok = true;
        if (empty($this->StartDate) && empty($this->EndDate)):
            return true;
        else:
            if (is_object($this->StartDate) && $this->StartDate->format('Y-m-d') > $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-31')
                return false;
            if (is_object($this->EndDate) && $this->EndDate->format('Y-m-d') <= $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01' && $this->EndDate->format('Y-m-d') != '-0001-11-30')
                return false;
        endif;

        return true;
    }

}
