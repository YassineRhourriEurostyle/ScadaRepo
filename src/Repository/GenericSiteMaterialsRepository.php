<?php

namespace App\Repository;

use App\Entity\GenericSiteMaterials;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GenericSiteMaterials>
 *
 * @method GenericSiteMaterials|null find($id, $lockMode = null, $lockVersion = null)
 * @method GenericSiteMaterials|null findOneBy(array $criteria, array $orderBy = null)
 * @method GenericSiteMaterials[]    findAll()
 * @method GenericSiteMaterials[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenericSiteMaterialsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GenericSiteMaterials::class);
    }

    public function add(GenericSiteMaterials $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GenericSiteMaterials $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GenericSiteMaterials[] Returns an array of GenericSiteMaterials objects
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

//    public function findOneBySomeField($value): ?GenericSiteMaterials
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
