<?php
 
namespace App\Entity;
 
use App\Entity\Generic\Country as GenericCountry;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
*/
class Country extends GenericCountry
{
 
}