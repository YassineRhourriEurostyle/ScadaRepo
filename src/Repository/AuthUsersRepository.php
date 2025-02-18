<?php

namespace App\Repository;

use App\Entity\AuthUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuthUsers>
 *
 * @method AuthUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthUsers[]    findAll()
 * @method AuthUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthUsers::class);
    }

    public function add(AuthUsers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AuthUsers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AuthUsers[] Returns an array of AuthUsers objects
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

//    public function findOneBySomeField($value): ?AuthUsers
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findGroupIdByAdLogin(string $adLogin)
    {
        return $this->createQueryBuilder('u')
            ->select('g.idgroupusr')  // Select the group ID from the joined table
            ->join('u.groups', 'g')   // Join with the groups relation
            ->where('u.adLogin = :adLogin')
            ->setParameter('adLogin', $adLogin)
            ->getQuery()
            ->getResult();
    }
    public function addGroupsToUser(int $userId, int $groupId)
    {
        $connection = $this->getEntityManager()->getConnection();

        // SQL query to insert into the join table
        $sql = "INSERT INTO auth_users_groups (idgroupusr, iduser) VALUES (:idgroupusr, :iduser)";

        // Prepare and execute the SQL query using executeStatement
        $connection->executeStatement($sql, [
            'idgroupusr' => $groupId,
            'iduser' => $userId
        ]);
    }
    public function removeGroupsFromUser(int $userId, int $groupId)
    {
        $connection = $this->getEntityManager()->getConnection();
    
        // SQL query to delete from the join table
        $sql = "DELETE FROM auth_users_groups WHERE idgroupusr = :idgroupusr AND iduser = :iduser";
    
        // Prepare and execute the SQL query using executeStatement
        $connection->executeStatement($sql, [
            'idgroupusr' => $groupId,
            'iduser' => $userId
        ]);
    }
    

}
