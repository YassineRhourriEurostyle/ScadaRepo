<?php

namespace App\Repository;

use App\Entity\SettingsStandard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SettingsStandard>
 *
 * @method SettingsStandard|null find($id, $lockMode = null, $lockVersion = null)
 * @method SettingsStandard|null findOneBy(array $criteria, array $orderBy = null)
 * @method SettingsStandard[]    findAll()
 * @method SettingsStandard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsStandardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingsStandard::class);
    }

    public function add(SettingsStandard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SettingsStandard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SettingsStandard[] Returns an array of SettingsStandard objects
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

//    public function findOneBySomeField($value): ?SettingsStandard
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    //retrive data for display one parameter
    public function findStandardSettings($siteId, $machineId, $toolId, $paramId)
    {
        $qb = $this->createQueryBuilder('std')
            ->innerJoin('App\Entity\SettingsStandardFiles', 'file','WITH','std.idsettstdfile=file.idsettstdfile')
            ->where('file.idsite = :siteId')
            ->andWhere('file.idmachine = :machineId')
            ->andWhere('file.idtool = :toolId')
            //->andWhere('std.idparameter = :paramId')
            ->setParameters([
                'siteId' => $siteId,
                'machineId' => $machineId,
                'toolId' => $toolId,
                //'paramId' => $paramId,
            ]);
        return $qb->getQuery()->getResult();
    }

    //retrive data for display multiple parameters
    public function findStandardSettingsParamaters ($siteId, $machineId, $toolId, $paramIds)
    {
        $qb = $this->createQueryBuilder('std')
            ->innerJoin('App\Entity\SettingsStandardFiles', 'file', 'WITH', 'std.idsettstdfile = file.idsettstdfile')
            ->where('file.idsite = :siteId')
            ->andWhere('file.idmachine = :machineId')
            ->andWhere('file.idtool = :toolId')
            //->andWhere('std.idparameter IN (:paramIds)')
            ->setParameters([
                'siteId' => $siteId,
                'machineId' => $machineId,
                'toolId' => $toolId,
                //'paramIds' => $paramIds,
            ]);
        return $qb->getQuery()->getResult();
    }
}
