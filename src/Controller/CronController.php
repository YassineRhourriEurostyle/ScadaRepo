<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CurrencyRates;
use App\Service\DBBackup;
use Symfony\Component\Routing\Annotation\Route;

class CronController extends AbstractController {

    /**
     * @Route("/cron/updateRates", name="cron_update_rates")
     * 
     */
    public function updateRates() {
        $service = new CurrencyRates($this->getDoctrine()->getManager());
        $service->updateRates();
    }

    /**
     * @Route("/cron/DBBackup", name="cron_dbbackup")
     * 
     */
    public function DBBackup() {
        $em = $this->getDoctrine()->getManager();
        $d = new DBBackup($em);
        $d->backup();
    }

}
