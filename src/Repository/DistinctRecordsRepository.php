<?php

namespace App\Repository;

use App\Entity\DistinctRecords;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DistinctRecords>
 *
 * @method DistinctRecords|null find($id, $lockMode = null, $lockVersion = null)
 * @method DistinctRecords|null findOneBy(array $criteria, array $orderBy = null)
 * @method DistinctRecords[]    findAll()
 * @method DistinctRecords[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistinctRecordsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DistinctRecords::class);
    }

    public function add(DistinctRecords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DistinctRecords $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DistinctRecords[] Returns an array of DistinctRecords objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DistinctRecords
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    //find mould that has worked on machine and site for dynamic filter
    public function findDistinctMouldsBySiteAndMachine(int $idSite, int $idMac): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.idMould')
            ->where('r.idSite = :idSite')
            ->andWhere('r.idMachine = :idMac')
            ->setParameter('idSite', $idSite)
            ->setParameter('idMac', $idMac)
            ->getQuery()
            ->getResult();
    }
}
