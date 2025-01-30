<?php

namespace App\Repository;

use App\Entity\SettingsStandardChoices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SettingsStandardChoices>
 *
 * @method SettingsStandardChoices|null find($id, $lockMode = null, $lockVersion = null)
 * @method SettingsStandardChoices|null findOneBy(array $criteria, array $orderBy = null)
 * @method SettingsStandardChoices[]    findAll()
 * @method SettingsStandardChoices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsStandardChoicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingsStandardChoices::class);
    }

    public function add(SettingsStandardChoices $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SettingsStandardChoices $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SettingsStandardChoices[] Returns an array of SettingsStandardChoices objects
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

//    public function findOneBySomeField($value): ?SettingsStandardChoices
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
