<?php

namespace App\Repository;

use App\Entity\DataCycle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DataCycle>
 *
 * @method DataCycle|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataCycle|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataCycle[]    findAll()
 * @method DataCycle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataCycleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataCycle::class);
    }

    public function add(DataCycle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DataCycle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DataCycle[] Returns an array of DataCycle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DataCycle
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    //retrieve data for display last value
    public function findLastValues($idMac, $idMould = null)
    {
        $qb = $this->createQueryBuilder('datacyc')
            ->select('
                datacyc.id,
                datacyc.idCfgMachine,
                datacyc.idCfgTool,
                datacyc.DataCycleNo,
                datacyc.DataCycleDateUTC,
                datacyc.DataCycle_DateCreationUTC,
                datarec.DataValue,
                cfgtools.toolreference,
                param.paramname
                ')
            ->join('App\Entity\ConfigMachines','cfgmachines','WITH', 'cfgmachines.idcfgmachine = datacyc.idCfgMachine' )
            ->join('App\Entity\DataRecord','datarec','WITH', 'datarec.idDataCycle = datacyc.id' )
            ->join('App\Entity\ParametersServer','paramserv','WITH', 'paramserv.id = datarec.idParamMac' )
            ->join('App\Entity\Parameters', 'param', 'WITH', 'param.idparameters = paramserv.idParamStd')
            ->leftjoin('App\Entity\ConfigTools', 'cfgtools','WITH','cfgtools.idcfgtool = datacyc.idCfgTool')
            //->leftjoin('App\Entity\SettingsStandard', 'settingsstd', 'WITH', 'tabRec.idparameter = settingsstd.idparameter')
            //->where('tabRec.idsite = :idSite')
            ->where('datacyc.idCfgMachine = :idMac')
            ->setParameter('idMac', $idMac);
        
        if ($idMould) {
            $qb->andWhere('datacyc.idCfgTool = :idMould')
            ->setParameter('idMould', $idMould);
        }

        $qb->orderBy('datacyc.id', 'DESC')
            ->setMaxResults(250);

        return $qb->getQuery()->getResult();
    }
    //retrieve data for display one parameter
    public function findRecords($macId, $mouldId, $paramId, $startDate, $endDate)
    {
        $qb = $this->createQueryBuilder('datacyc')
            ->select('
            datacyc.id,
            datacyc.idCfgMachine,
            datacyc.idCfgTool,
            datacyc.DataCycleNo,
            datacyc.DataCycleDateUTC,
            datacyc.DataCycle_DateCreationUTC,
            datarec.DataValue,
            datarec.idParamMac
            ')
        ->join('App\Entity\DataRecord','datarec','WITH', 'datarec.idDataCycle = datacyc.id' )
        ->where('datacyc.idCfgMachine = :macId')
        ->andWhere('datacyc.idCfgTool = :mouldId')
        ->andWhere('datarec.idParamMac = :paramId')
        ->andWhere('datacyc.DataCycleDateUTC BETWEEN :startDate AND :endDate')
        ->setParameters([
            'mouldId' => $mouldId,
            'paramId' => $paramId,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'macId'=> $macId,
        ])
        ->orderBy('datacyc.DataCycleDateUTC', 'DESC');
        
        return $qb->getQuery()->getResult();

    }
    //retrieve data for display multiple parameters
    public function findRecordsMultipleParameters ($macId, $mouldId, $paramIds, $startDate, $endDate)
    {
        $qb = $this->createQueryBuilder('datacyc')
            ->select('
            datacyc.id,
            datacyc.idCfgMachine,
            datacyc.idCfgTool,
            datacyc.DataCycleNo,
            datacyc.DataCycleDateUTC,
            datacyc.DataCycle_DateCreationUTC,
            datarec.DataValue,
            datarec.idParamMac
            ')
        ->join('App\Entity\DataRecord','datarec','WITH', 'datarec.idDataCycle = datacyc.id' )
        ->where('datacyc.idCfgMachine = :macId')
        ->andWhere('datacyc.idCfgTool = :mouldId')
        ->andWhere('datacyc.DataCycleDateUTC BETWEEN :startDate AND :endDate')
        ->andWhere('datarec.idParamMac IN (:paramIds)')
        ->setParameters([
            'macId'=>$macId,
            'mouldId'=>$mouldId,
            'paramIds'=>$paramIds,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
        ])
        ->orderBy('datacyc.DataCycleDateUTC')
        ->setMaxResults(500);
        return $qb->getQuery()->getresult();
    }
}
