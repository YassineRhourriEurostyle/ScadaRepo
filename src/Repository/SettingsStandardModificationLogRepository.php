<?php

namespace App\Repository;

use App\Entity\SettingsStandardModificationLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SettingsStandardModificationLog>
 *
 * @method SettingsStandardModificationLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method SettingsStandardModificationLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method SettingsStandardModificationLog[]    findAll()
 * @method SettingsStandardModificationLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsStandardModificationLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingsStandardModificationLog::class);
    }

    public function add(SettingsStandardModificationLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SettingsStandardModificationLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SettingsStandardModificationLog[] Returns an array of SettingsStandardModificationLog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SettingsStandardModificationLog
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
