<?php
 
namespace App\Entity;

use App\Entity\Generic\SiteMaterials as GenericSiteMaterials;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\SiteMaterialsRepository")
*/
class SiteMaterials extends GenericSiteMaterials
{
 
}