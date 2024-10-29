<?php

namespace App\Repository;

use App\Entity\ZzSiseParametersTemp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ZzSiseParametersTemp>
 *
 * @method ZzSiseParametersTemp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZzSiseParametersTemp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZzSiseParametersTemp[]    findAll()
 * @method ZzSiseParametersTemp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZzSiseParametersTempRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZzSiseParametersTemp::class);
    }

    public function add(ZzSiseParametersTemp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ZzSiseParametersTemp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ZzSiseParametersTemp[] Returns an array of ZzSiseParametersTemp objects
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

//    public function findOneBySomeField($value): ?ZzSiseParametersTemp
//    {
//        return $this->createQueryBuilder('z')
//            ->andWhere('z.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
