<?php

        namespace App\Entity;

        use App\Entity\Generic\Currency as GenericCurrency;
        use Doctrine\ORM\Mapping as ORM;
        /**
         * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
         */
        class Currency extends GenericCurrency
        {

        }