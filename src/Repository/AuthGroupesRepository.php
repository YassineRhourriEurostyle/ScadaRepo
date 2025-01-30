<?php

namespace App\Repository;

use App\Entity\AuthGroupes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuthGroupes>
 *
 * @method AuthGroupes|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthGroupes|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthGroupes[]    findAll()
 * @method AuthGroupes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthGroupesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthGroupes::class);
    }

    public function add(AuthGroupes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AuthGroupes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AuthGroupes[] Returns an array of AuthGroupes objects
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

//    public function findOneBySomeField($value): ?AuthGroupes
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findGroupDescriptionById(int $idGroupUsr): ?string
    {
        $group = $this->find($idGroupUsr);
        return $group ? $group->getGroupdescription() : null;
    }
}
