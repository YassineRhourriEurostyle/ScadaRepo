<?php

namespace App\Repository;

use App\Entity\ZzRecordsPython;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZzRecordsPython>
 *
 * @method ZzRecordsPython|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZzRecordsPython|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZzRecordsPython[]    findAll()
 * @method ZzRecordsPython[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZzRecordsPythonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZzRecordsPython::class);
    }

    public function add(ZzRecordsPython $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ZzRecordsPython $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ZzRecordsPython[] Returns an array of ZzRecordsPython objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('z.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ZzRecordsPython
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
