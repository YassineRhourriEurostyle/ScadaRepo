<?php

namespace App\Repository;

use App\Entity\ConfigDeviceTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConfigDeviceTypes>
 *
 * @method ConfigDeviceTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfigDeviceTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfigDeviceTypes[]    findAll()
 * @method ConfigDeviceTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigDeviceTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConfigDeviceTypes::class);
    }

    public function add(ConfigDeviceTypes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConfigDeviceTypes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ConfigDeviceTypes[] Returns an array of ConfigDeviceTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConfigDeviceTypes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
