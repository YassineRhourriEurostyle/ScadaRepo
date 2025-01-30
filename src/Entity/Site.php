<?php
 
namespace App\Entity;
 
use App\Entity\Generic\Site as GenericSite;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
*/
class Site extends GenericSite
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Generic\SiteMaterials", mappedBy="Site")
     */
    private $Materials;
}