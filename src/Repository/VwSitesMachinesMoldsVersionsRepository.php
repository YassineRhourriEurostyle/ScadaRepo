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
    // retrun all site names of table
    public function allSitesRef(){
        $qb = $this->createQueryBuilder('v')
            ->select('v.IdSite,v.SiteRef')
            ->distinct();
        return $qb->getQuery()->getResult();

    }
    //return all machines names of table
    public function allMachinesRef(){
        $qb=$this->createQueryBuilder('v')
            ->select('v.IdMachine,v.MacReference')
            ->distinct();
        return $qb->getQuery()->getResult();
    }
    //return all tools names of table
    public function allToolsRef(){
        $qb=$this->createQueryBuilder('v')
            ->select ('v.IdTool,v.ToolReference')
            ->distinct();
        return $qb->getQuery()->getResult();
    }
    //retrieve data for filtration on top of page setting list
    public function filterSettingList($IdSite=null, $IdMachine=null, $IdTool = null)
    {
        $qb = $this->createQueryBuilder('data')
            ->select('
                data.IdSettStdFile,
                data.IdSite,
                data.IdMachine,
                data.IdTool,
                data.IdToolVersion,
                data.activeFile,
                data.SiteRef,
                data.SiteSAPCode,
                data.SiteDescription,
                data.MacReference,
                data.ToolReference,
                data.ToolVersionText,
                data.Archived,
                data.PictMoldMain
                ');
        
        if ($IdSite) {
            $qb->andWhere('data.IdSite = :IdSite')
            ->setParameter('IdSite', $IdSite);
        }
        if ($IdMachine) {
            $qb->andWhere('data.IdMachine = :IdMachine')
            ->setParameter('IdMachine', $IdMachine);
        }
        if ($IdTool) {
            $qb->andWhere('data.IdTool = :IdTool')
            ->setParameter('IdTool', $IdTool);
        }

        return $qb->getQuery()->getResult();
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
