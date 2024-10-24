<?php

/*
 * To change this license header, choose License Headers in Vehicle Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Schema\MySqlSchemaManager;

/**
 * Description of DBBackup
 *
 * @author aurelien.stride
 */
class DBBackup {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * 
     */
    public function backup() {

        $dir = __DIR__ . '/../../_dbbackup/';
        @mkdir($dir);
        $dir = realpath($dir);
        $date = date('Y-m-d');
        $dateRoll = date('Y-m-d', strtotime('-30 days'));
        @mkdir($dir . '/');

        $t = scandir($dir);
        foreach ($t as $file):
            if (substr($file, 0, 1) == '.')
                continue;
            if (substr($file, 0, 10) < $dateRoll)
                @unlink($dir . $file);
        endforeach;

        $connection = $this->em->getConnection();
        $conn = $connection->getParams();
        $database = $conn['dbname'];

        @unlink("$dir/$date-dump.sql");
        $cmd = "mysqldump -u root -proot $database --add-drop-database --opt > $dir/$date-dump.sql";
        echo shell_exec($cmd);
        
        $dir = __DIR__ . '/../../src/';
        @unlink("$dir/latest-dump.sql");
        $cmd = "mysqldump -u root -proot $database --add-drop-database --opt > $dir/latest-dump.sql";
        echo shell_exec($cmd);
    }

}
