<?php
 
namespace App\Entity;

use App\Entity\Generic\Material as GenericMaterial;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
*/
class Material extends GenericMaterial
{
 
}