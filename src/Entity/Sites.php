<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sites
 *
 * @ORM\Table(name="sites", indexes={@ORM\Index(name="SiteRef", columns={"SiteRef"})})
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 */
class Sites
{
    /**
     * @var int
     *
     * @ORM\Column(name="idsites", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsites;

    /**
     * @var string
     *
     * @ORM\Column(name="SiteRef", type="string", length=50, nullable=false)
     */
    private $siteref;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SiteSAPCode", type="string", length=10, nullable=true)
     */
    private $sitesapcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SiteDescription", type="string", length=50, nullable=true)
     */
    private $sitedescription;

    /**
     * @var int|null
     *
     * @ORM\Column(name="SiteSort", type="smallint", nullable=true)
     */
    private $sitesort;

    public function getIdsites(): ?int
    {
        return $this->idsites;
    }

    public function getSiteref(): ?string
    {
        return $this->siteref;
    }

    public function setSiteref(string $siteref): self
    {
        $this->siteref = $siteref;

        return $this;
    }

    public function getSitesapcode(): ?string
    {
        return $this->sitesapcode;
    }

    public function setSitesapcode(?string $sitesapcode): self
    {
        $this->sitesapcode = $sitesapcode;

        return $this;
    }

    public function getSitedescription(): ?string
    {
        return $this->sitedescription;
    }

    public function setSitedescription(?string $sitedescription): self
    {
        $this->sitedescription = $sitedescription;

        return $this;
    }

    public function getSitesort(): ?int
    {
        return $this->sitesort;
    }

    public function setSitesort(?int $sitesort): self
    {
        $this->sitesort = $sitesort;

        return $this;
    }


}
