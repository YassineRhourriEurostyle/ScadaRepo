<?php

namespace App\Repository;

use App\Entity\Records;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Records>
 *
 * @method Records|null find($id, $lockMode = null, $lockVersion = null)
 * @method Records|null findOneBy(array $criteria, array $orderBy = null)
 * @method Records[]    findAll()
 * @method Records[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Records::class);
    }

    public function add(Records $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Records $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Records[] Returns an array of Records objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Records
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    //retrieve data for display last value
    public function findLastValues($idSite, $idMac, $idMould = null)
    {
        $qb = $this->createQueryBuilder('tabRec')
            ->select('
                tabRec.idrecords,
                tabRec.idsite,
                tabRec.idmac,
                tabRec.idmould,
                tabRec.daterecord,
                tabRec.idparameter,
                tabRec.paramvalue,
                cfgtools.toolreference,
                param.paramname
                ')
            ->leftjoin('App\Entity\Parameters', 'param', 'WITH', 'tabRec.idparameter = param.idparameters')
            ->leftjoin('App\Entity\ConfigTools', 'cfgtools','WITH','cfgtools.idcfgtool = tabRec.idmould')
            ->leftjoin('App\Entity\ConfigMachines','cfgmachines','WITH', 'cfgmachines.idcfgmachine = tabRec.idmac' )
            //->leftjoin('App\Entity\SettingsStandard', 'settingsstd', 'WITH', 'tabRec.idparameter = settingsstd.idparameter')
            ->where('tabRec.idsite = :idSite')
            ->andWhere('tabRec.idmac = :idMac')
            ->setParameter('idSite', $idSite)
            ->setParameter('idMac', $idMac);
        
        if ($idMould) {
            $qb->andWhere('tabRec.idmould = :idMould')
            ->setParameter('idMould', $idMould);
        }
    
        $qb->orderBy('tabRec.idrecords', 'DESC')
            ->setMaxResults(180);

        return $qb->getQuery()->getResult();
    }

    //retrieve data for display one parameter
    public function findRecords($siteId, $macId, $mouldId, $paramId, $startDate, $endDate)
    {
        $qb = $this->createQueryBuilder('r')
        ->where('r.idsite = :siteId')
        ->andWhere('r.idmac = :macId')
        ->andWhere('r.idmould = :mouldId')
        ->andWhere('r.idparameter = :paramId')
        ->andWhere('r.daterecord BETWEEN :startDate AND :endDate')
        ->setParameters([
            'siteId' => $siteId,         
            'mouldId' => $mouldId,
            'paramId' => $paramId,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'macId'=> $macId,
        ])
        ->orderBy('r.daterecord', 'DESC');
        
        return $qb->getQuery()->getResult();

    }
    

}
