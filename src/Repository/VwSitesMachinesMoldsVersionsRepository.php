<?php

namespace App\Repository;

use App\Entity\VwSitesMachinesMoldsVersions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VwSitesMachinesMoldsVersions>
 *
 * @method VwSitesMachinesMoldsVersions|null find($id, $lockMode = null, $lockVersion = null)
 * @method VwSitesMachinesMoldsVersions|null findOneBy(array $criteria, array $orderBy = null)
 * @method VwSitesMachinesMoldsVersions[]    findAll()
 * @method VwSitesMachinesMoldsVersions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VwSitesMachinesMoldsVersionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VwSitesMachinesMoldsVersions::class);
    }

    public function add(VwSitesMachinesMoldsVersions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VwSitesMachinesMoldsVersions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VwSitesMachinesMoldsVersions[] Returns an array of VwSitesMachinesMoldsVersions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VwSitesMachinesMoldsVersions
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
