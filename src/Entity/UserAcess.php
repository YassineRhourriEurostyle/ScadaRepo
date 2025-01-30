<?php
 
namespace App\Entity;

use App\Entity\Generic\UserAccess as GenericUserAccess;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\UserAcessRepository")
*/
class UserAccess extends GenericUserAccess
{
 
}