<?php

        namespace App\Entity;

        use App\Entity\Generic\Language as GenericLanguage;
        use Doctrine\ORM\Mapping as ORM;
        /**
         * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
         */
        class Language extends GenericLanguage
        {

        }