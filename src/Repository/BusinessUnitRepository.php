<?php

namespace App\Repository;

use App\Entity\BusinessUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusinessUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessUnit[]    findAll()
 * @method BusinessUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessUnit::class);
    }
}