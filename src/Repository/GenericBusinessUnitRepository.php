<?php

namespace App\Repository;

use App\Entity\GenericBusinessUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GenericBusinessUnit>
 *
 * @method GenericBusinessUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method GenericBusinessUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method GenericBusinessUnit[]    findAll()
 * @method GenericBusinessUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenericBusinessUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GenericBusinessUnit::class);
    }

    public function add(GenericBusinessUnit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GenericBusinessUnit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GenericBusinessUnit[] Returns an array of GenericBusinessUnit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GenericBusinessUnit
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
