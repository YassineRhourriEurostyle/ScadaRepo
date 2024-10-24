<?php

        namespace App\Entity;

        use App\Entity\Generic\Log as GenericLog;
        use Doctrine\ORM\Mapping as ORM;
        /**
         * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
         */
        class Log extends GenericLog
        {

        }