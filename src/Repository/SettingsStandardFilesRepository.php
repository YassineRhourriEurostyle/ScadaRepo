<?php

namespace App\Repository;

use App\Entity\SettingsStandardFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Sites;
use App\Entity\ConfigMachines;
use App\Entity\ConfigTools;
use App\Entity\ConfigToolVersions;

/**
 * @extends ServiceEntityRepository<SettingsStandardFiles>
 *
 * @method SettingsStandardFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method SettingsStandardFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method SettingsStandardFiles[]    findAll()
 * @method SettingsStandardFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsStandardFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SettingsStandardFiles::class);
    }

    public function add(SettingsStandardFiles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SettingsStandardFiles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SettingsStandardFiles[] Returns an array of SettingsStandardFiles objects
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

//    public function findOneBySomeField($value): ?SettingsStandardFiles
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * Creates and saves a new SettingsStandardFile based on provided references.
     *
     * @param int $siteId
     * @param int $machineId
     * @param int $toolId
     * @param int $toolVersionId
     * 
     * @return SettingsStandardFiles
     * 
     * @throws \Exception If any of the references cannot be found
     */
    public function createNewSettingsStandardFile(int $siteId, int $machineId, int $toolId, int $toolVersionId): SettingsStandardFiles
    {
        // Check if a file with the same site, machine, tool, and tool version already exists
        $existingFile = $this->createQueryBuilder('s')
            ->where('s.idsite = :siteId')
            ->andWhere('s.idmachine = :machineId')
            ->andWhere('s.idtool = :toolId')
            ->andWhere('s.idtoolversion = :toolVersionId')
            ->setParameter('siteId', $siteId)
            ->setParameter('machineId', $machineId)
            ->setParameter('toolId', $toolId)
            ->setParameter('toolVersionId', $toolVersionId)
            ->getQuery()
            ->getOneOrNullResult(); // Only returns a single result or null

        // If a file already exists, throw an exception or return the existing file
        if ($existingFile) {
            throw new \Exception("A Settings Standard File already exists for the given site, machine, tool, and tool version.");
            // return $existingFile;
        }

        // Fetch related entities (site, machine, tool, tool version)
        $site = $this->getEntityManager()->getRepository(Sites::class)->find($siteId);
        $machine = $this->getEntityManager()->getRepository(ConfigMachines::class)->find($machineId);
        $tool = $this->getEntityManager()->getRepository(ConfigTools::class)->find($toolId);
        $toolVersion = $this->getEntityManager()->getRepository(ConfigToolVersions::class)->find($toolVersionId);

        // Validate if related entities exist
        if (!$site || !$machine || !$tool || !$toolVersion) {
            throw new \Exception("One or more related entities were not found.");
        }

        // Create the new SettingsStandardFile entity
        $settingsFile = new SettingsStandardFiles();
        $settingsFile->setIdsite($site->getIdsites());
        $settingsFile->setIdmachine($machine->getIdcfgmachine());
        $settingsFile->setIdtool($tool->getIdcfgtool());
        $settingsFile->setIdtoolversion($toolVersion->getIdcfgtoolversion());

        // Set default or metadata-based values for the fields
        $settingsFile->setActivefile(true); // You can modify this based on $otherMetadata or default it as true

        // Set timestamps (use current time if not provided)
        $currentDate = new \DateTime();
        $settingsFile->setDatecreationutc($currentDate);
        $settingsFile->setDatemodificationutc($currentDate);

        // Persist the entity using the repository
        $this->add($settingsFile, true);

        return $settingsFile;
    }

}
