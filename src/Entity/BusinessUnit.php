<?php
 
namespace App\Entity;
 
use App\Entity\Generic\BusinessUnit as GenericBusinessUnit;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\BusinessUnitRepository")
*/
class BusinessUnit extends GenericBusinessUnit
{
 
}