<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenericSite
 *
 * @ORM\Table(name="generic_site", indexes={@ORM\Index(name="IDX_5339E5775602A942", columns={"default_language_id"}), @ORM\Index(name="IDX_5339E577A58ECB40", columns={"business_unit_id"}), @ORM\Index(name="IDX_5339E577F92F3E70", columns={"country_id"})})
 * @ORM\Entity
 */
class GenericSite
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
     * @var string|null
     *
     * @ORM\Column(name="ldap_ip", type="string", length=15, nullable=true)
     */
    private $ldapIp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ldap_domain", type="string", length=255, nullable=true)
     */
    private $ldapDomain;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ldap_ou", type="string", length=255, nullable=true)
     */
    private $ldapOu;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=false)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="dtype", type="string", length=255, nullable=false)
     */
    private $dtype;

    /**
     * @var string
     *
     * @ORM\Column(name="signatory", type="string", length=255, nullable=false)
     */
    private $signatory;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var \GenericLanguage
     *
     * @ORM\ManyToOne(targetEntity="GenericLanguage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="default_language_id", referencedColumnName="id")
     * })
     */
    private $defaultLanguage;

    /**
     * @var \GenericCountry
     *
     * @ORM\ManyToOne(targetEntity="GenericCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \GenericBusinessUnit
     *
     * @ORM\ManyToOne(targetEntity="GenericBusinessUnit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="business_unit_id", referencedColumnName="id")
     * })
     */
    private $businessUnit;

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

    public function getLdapIp(): ?string
    {
        return $this->ldapIp;
    }

    public function setLdapIp(?string $ldapIp): self
    {
        $this->ldapIp = $ldapIp;

        return $this;
    }

    public function getLdapDomain(): ?string
    {
        return $this->ldapDomain;
    }

    public function setLdapDomain(?string $ldapDomain): self
    {
        $this->ldapDomain = $ldapDomain;

        return $this;
    }

    public function getLdapOu(): ?string
    {
        return $this->ldapOu;
    }

    public function setLdapOu(?string $ldapOu): self
    {
        $this->ldapOu = $ldapOu;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

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

    public function getSignatory(): ?string
    {
        return $this->signatory;
    }

    public function setSignatory(string $signatory): self
    {
        $this->signatory = $signatory;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDefaultLanguage(): ?GenericLanguage
    {
        return $this->defaultLanguage;
    }

    public function setDefaultLanguage(?GenericLanguage $defaultLanguage): self
    {
        $this->defaultLanguage = $defaultLanguage;

        return $this;
    }

    public function getCountry(): ?GenericCountry
    {
        return $this->country;
    }

    public function setCountry(?GenericCountry $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBusinessUnit(): ?GenericBusinessUnit
    {
        return $this->businessUnit;
    }

    public function setBusinessUnit(?GenericBusinessUnit $businessUnit): self
    {
        $this->businessUnit = $businessUnit;

        return $this;
    }


}
