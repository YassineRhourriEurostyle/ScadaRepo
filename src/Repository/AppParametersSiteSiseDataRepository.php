<?php

namespace App\Repository;

use App\Entity\AppParametersSiteSiseData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AppParametersSiteSiseData>
 *
 * @method AppParametersSiteSiseData|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppParametersSiteSiseData|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppParametersSiteSiseData[]    findAll()
 * @method AppParametersSiteSiseData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppParametersSiteSiseDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppParametersSiteSiseData::class);
    }

    public function add(AppParametersSiteSiseData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AppParametersSiteSiseData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AppParametersSiteSiseData[] Returns an array of AppParametersSiteSiseData objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AppParametersSiteSiseData
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
