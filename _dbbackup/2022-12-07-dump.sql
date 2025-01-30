-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: scada
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_of_device_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92FB68E2483DDD7` (`type_of_device_id`),
  CONSTRAINT `FK_92FB68E2483DDD7` FOREIGN KEY (`type_of_device_id`) REFERENCES `type_of_device` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_business_unit`
--

DROP TABLE IF EXISTS `generic_business_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_business_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(3) NOT NULL,
  `signatory` varchar(255) NOT NULL,
  `dtype` varchar(255) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_business_unit`
--

LOCK TABLES `generic_business_unit` WRITE;
/*!40000 ALTER TABLE `generic_business_unit` DISABLE KEYS */;
INSERT INTO `generic_business_unit` VALUES (1,'WSE','Auger, Frederic','business_unit','#ff8080'),(2,'CRM','van der Weijden, Willem','business_unit','#80ff80'),(3,'SO','van der Weijden, Willem','business_unit',''),(4,'TC','Valentin, Isabelle','business_unit','#ffc080');
/*!40000 ALTER TABLE `generic_business_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_country`
--

DROP TABLE IF EXISTS `generic_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_country`
--

LOCK TABLES `generic_country` WRITE;
/*!40000 ALTER TABLE `generic_country` DISABLE KEYS */;
INSERT INTO `generic_country` VALUES (88,47,'ABW','Aruba','country'),(89,47,'AFG','Afghanistan','country'),(90,47,'AGO','Angola','country'),(91,47,'AIA','Anguilla','country'),(92,47,'ALA','Åland Islands','country'),(93,47,'ALB','Albania','country'),(94,47,'AND','Andorra','country'),(95,47,'ARE','United Arab Emirates','country'),(96,47,'ARG','Argentina','country'),(97,47,'ARM','Armenia','country'),(98,47,'ASM','American Samoa','country'),(99,47,'ATA','Antarctica','country'),(100,47,'ATF','French Southern Territories','country'),(101,47,'ATG','Antigua and Barbuda','country'),(102,47,'AUS','Australia','country'),(103,47,'AUT','Austria','country'),(104,47,'AZE','Azerbaijan','country'),(105,47,'BDI','Burundi','country'),(106,47,'BEL','Belgium','country'),(107,47,'BEN','Benin','country'),(108,47,'BES','Bonaire, Sint Eustatius and Saba','country'),(109,47,'BFA','Burkina Faso','country'),(110,47,'BGD','Bangladesh','country'),(111,47,'BGR','Bulgaria','country'),(112,47,'BHR','Bahrain','country'),(113,47,'BHS','Bahamas','country'),(114,47,'BIH','Bosnia and Herzegovina','country'),(115,47,'BLM','Saint Barthélemy','country'),(116,47,'BLR','Belarus','country'),(117,47,'BLZ','Belize','country'),(118,47,'BMU','Bermuda','country'),(119,47,'BOL','Bolivia (Plurinational State of)','country'),(120,47,'BRA','Brazil','country'),(121,47,'BRB','Barbados','country'),(122,47,'BRN','Brunei Darussalam','country'),(123,47,'BTN','Bhutan','country'),(124,47,'BVT','Bouvet Island','country'),(125,47,'BWA','Botswana','country'),(126,47,'CAF','Central African Republic','country'),(127,47,'CAN','Canada','country'),(128,47,'CCK','Cocos (Keeling) Islands','country'),(129,47,'CHE','Switzerland','country'),(130,47,'CHL','Chile','country'),(131,33,'CHN','China','country'),(132,47,'CIV','Côte d\'Ivoire','country'),(133,47,'CMR','Cameroon','country'),(134,47,'COD','Congo, Democratic Republic of the','country'),(135,47,'COG','Congo','country'),(136,47,'COK','Cook Islands','country'),(137,47,'COL','Colombia','country'),(138,47,'COM','Comoros','country'),(139,47,'CPV','Cabo Verde','country'),(140,47,'CRI','Costa Rica','country'),(141,47,'CUB','Cuba','country'),(142,47,'CUW','Curaçao','country'),(143,47,'CXR','Christmas Island','country'),(144,47,'CYM','Cayman Islands','country'),(145,47,'CYP','Cyprus','country'),(146,47,'CZE','Czechia','country'),(147,47,'DEU','Germany','country'),(148,47,'DJI','Djibouti','country'),(149,47,'DMA','Dominica','country'),(150,47,'DNK','Denmark','country'),(151,47,'DOM','Dominican Republic','country'),(152,47,'DZA','Algeria','country'),(153,47,'ECU','Ecuador','country'),(154,47,'EGY','Egypt','country'),(155,47,'ERI','Eritrea','country'),(156,47,'ESH','Western Sahara','country'),(157,47,'ESP','Spain','country'),(158,47,'EST','Estonia','country'),(159,47,'ETH','Ethiopia','country'),(160,47,'FIN','Finland','country'),(161,47,'FJI','Fiji','country'),(162,47,'FLK','Falkland Islands (Malvinas)','country'),(163,47,'FRA','France','country'),(164,47,'FRO','Faroe Islands','country'),(165,47,'FSM','Micronesia (Federated States of)','country'),(166,47,'GAB','Gabon','country'),(167,50,'GBR','United Kingdom','country'),(168,47,'GEO','Georgia','country'),(169,47,'GGY','Guernsey','country'),(170,47,'GHA','Ghana','country'),(171,47,'GIB','Gibraltar','country'),(172,47,'GIN','Guinea','country'),(173,47,'GLP','Guadeloupe','country'),(174,47,'GMB','Gambia','country'),(175,47,'GNB','Guinea-Bissau','country'),(176,47,'GNQ','Equatorial Guinea','country'),(177,47,'GRC','Greece','country'),(178,47,'GRD','Grenada','country'),(179,47,'GRL','Greenland','country'),(180,47,'GTM','Guatemala','country'),(181,47,'GUF','French Guiana','country'),(182,47,'GUM','Guam','country'),(183,47,'GUY','Guyana','country'),(184,47,'HKG','Hong Kong','country'),(185,47,'HMD','Heard Island and McDonald Islands','country'),(186,47,'HND','Honduras','country'),(187,47,'HRV','Croatia','country'),(188,47,'HTI','Haiti','country'),(189,63,'HUN','Hungary','country'),(190,47,'IDN','Indonesia','country'),(191,47,'IMN','Isle of Man','country'),(192,47,'IND','India','country'),(193,47,'IOT','British Indian Ocean Territory','country'),(194,47,'IRL','Ireland','country'),(195,47,'IRN','Iran (Islamic Republic of)','country'),(196,47,'IRQ','Iraq','country'),(197,47,'ISL','Iceland','country'),(198,47,'ISR','Israel','country'),(199,47,'ITA','Italy','country'),(200,47,'JAM','Jamaica','country'),(201,47,'JEY','Jersey','country'),(202,47,'JOR','Jordan','country'),(203,47,'JPN','Japan','country'),(204,47,'KAZ','Kazakhstan','country'),(205,47,'KEN','Kenya','country'),(206,47,'KGZ','Kyrgyzstan','country'),(207,47,'KHM','Cambodia','country'),(208,47,'KIR','Kiribati','country'),(209,47,'KNA','Saint Kitts and Nevis','country'),(210,47,'KOR','Korea, Republic of','country'),(211,47,'KWT','Kuwait','country'),(212,47,'LAO','Lao People\'s Democratic Republic','country'),(213,47,'LBN','Lebanon','country'),(214,47,'LBR','Liberia','country'),(215,47,'LBY','Libya','country'),(216,47,'LCA','Saint Lucia','country'),(217,47,'LIE','Liechtenstein','country'),(218,47,'LKA','Sri Lanka','country'),(219,47,'LSO','Lesotho','country'),(220,47,'LTU','Lithuania','country'),(221,47,'LUX','Luxembourg','country'),(222,47,'LVA','Latvia','country'),(223,47,'MAC','Macao','country'),(224,47,'MAF','Saint Martin (French part)','country'),(225,90,'MAR','Morocco','country'),(226,47,'MCO','Monaco','country'),(227,47,'MDA','Moldova, Republic of','country'),(228,47,'MDG','Madagascar','country'),(229,47,'MDV','Maldives','country'),(230,47,'MEX','Mexico','country'),(231,47,'MHL','Marshall Islands','country'),(232,47,'MKD','North Macedonia','country'),(233,47,'MLI','Mali','country'),(234,47,'MLT','Malta','country'),(235,47,'MMR','Myanmar','country'),(236,47,'MNE','Montenegro','country'),(237,47,'MNG','Mongolia','country'),(238,47,'MNP','Northern Mariana Islands','country'),(239,47,'MOZ','Mozambique','country'),(240,47,'MRT','Mauritania','country'),(241,47,'MSR','Montserrat','country'),(242,47,'MTQ','Martinique','country'),(243,47,'MUS','Mauritius','country'),(244,47,'MWI','Malawi','country'),(245,47,'MYS','Malaysia','country'),(246,47,'MYT','Mayotte','country'),(247,47,'NAM','Namibia','country'),(248,47,'NCL','New Caledonia','country'),(249,47,'NER','Niger','country'),(250,47,'NFK','Norfolk Island','country'),(251,47,'NGA','Nigeria','country'),(252,47,'NIC','Nicaragua','country'),(253,47,'NIU','Niue','country'),(254,47,'NLD','Netherlands','country'),(255,47,'NOR','Norway','country'),(256,47,'NPL','Nepal','country'),(257,47,'NRU','Nauru','country'),(258,47,'NZL','New Zealand','country'),(259,47,'OMN','Oman','country'),(260,47,'PAK','Pakistan','country'),(261,47,'PAN','Panama','country'),(262,47,'PCN','Pitcairn','country'),(263,47,'PER','Peru','country'),(264,47,'PHL','Philippines','country'),(265,47,'PLW','Palau','country'),(266,47,'PNG','Papua New Guinea','country'),(267,47,'POL','Poland','country'),(268,47,'PRI','Puerto Rico','country'),(269,47,'PRK','Korea (Democratic People\'s Republic of)','country'),(270,47,'PRT','Portugal','country'),(271,47,'PRY','Paraguay','country'),(272,47,'PSE','Palestine, State of','country'),(273,47,'PYF','French Polynesia','country'),(274,47,'QAT','Qatar','country'),(275,47,'REU','Réunion','country'),(276,120,'ROU','Romania','country'),(277,122,'RUS','Russian Federation','country'),(278,47,'RWA','Rwanda','country'),(279,47,'SAU','Saudi Arabia','country'),(280,47,'SDN','Sudan','country'),(281,47,'SEN','Senegal','country'),(282,47,'SGP','Singapore','country'),(283,47,'SGS','South Georgia and the South Sandwich Islands','country'),(284,47,'SHN','Saint Helena, Ascension and Tristan da Cunha','country'),(285,47,'SJM','Svalbard and Jan Mayen','country'),(286,47,'SLB','Solomon Islands','country'),(287,47,'SLE','Sierra Leone','country'),(288,47,'SLV','El Salvador','country'),(289,47,'SMR','San Marino','country'),(290,47,'SOM','Somalia','country'),(291,47,'SPM','Saint Pierre and Miquelon','country'),(292,47,'SRB','Serbia','country'),(293,47,'SSD','South Sudan','country'),(294,47,'STP','Sao Tome and Principe','country'),(295,47,'SUR','Suriname','country'),(296,47,'SVK','Slovakia','country'),(297,47,'SVN','Slovenia','country'),(298,47,'SWE','Sweden','country'),(299,47,'SWZ','Eswatini','country'),(300,47,'SXM','Sint Maarten (Dutch part)','country'),(301,47,'SYC','Seychelles','country'),(302,47,'SYR','Syrian Arab Republic','country'),(303,47,'TCA','Turks and Caicos Islands','country'),(304,47,'TCD','Chad','country'),(305,47,'TGO','Togo','country'),(306,47,'THA','Thailand','country'),(307,47,'TJK','Tajikistan','country'),(308,47,'TKL','Tokelau','country'),(309,47,'TKM','Turkmenistan','country'),(310,47,'TLS','Timor-Leste','country'),(311,47,'TON','Tonga','country'),(312,47,'TTO','Trinidad and Tobago','country'),(313,47,'TUN','Tunisia','country'),(314,47,'TUR','Turkey','country'),(315,47,'TUV','Tuvalu','country'),(316,47,'TWN','Taiwan Province of China','country'),(317,47,'TZA','Tanzania, United Republic of','country'),(318,47,'UGA','Uganda','country'),(319,47,'UKR','Ukraine','country'),(320,47,'UMI','United States Minor Outlying Islands','country'),(321,47,'URY','Uruguay','country'),(322,47,'USA','United States of America','country'),(323,47,'UZB','Uzbekistan','country'),(324,47,'VAT','Holy See','country'),(325,47,'VCT','Saint Vincent and the Grenadines','country'),(326,47,'VEN','Venezuela (Bolivarian Republic of)','country'),(327,47,'VGB','Virgin Islands (British)','country'),(328,47,'VIR','Virgin Islands (U.S.)','country'),(329,47,'VNM','Viet Nam','country'),(330,47,'VUT','Vanuatu','country'),(331,47,'WLF','Wallis and Futuna','country'),(332,47,'WSM','Samoa','country'),(333,47,'YEM','Yemen','country'),(334,47,'ZAF','South Africa','country'),(335,47,'ZMB','Zambia','country'),(336,47,'ZWE','Zimbabwe','country');
/*!40000 ALTER TABLE `generic_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_currency`
--

DROP TABLE IF EXISTS `generic_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_currency` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_rate` double NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_currency`
--

LOCK TABLES `generic_currency` WRITE;
/*!40000 ALTER TABLE `generic_currency` DISABLE KEYS */;
INSERT INTO `generic_currency` VALUES (1,'United Arab Emirates Dirham','AED',3.9429305062658,'currency'),(2,'Afghan Afghani','AFN',95.534484942559,'currency'),(3,'Albanian Lek','ALL',121.03974060882,'currency'),(4,'Armenian Dram','AMD',489.46308366772,'currency'),(5,'Netherlands Antillean Guilder','ANG',1.9344963212483,'currency'),(6,'Angolan Kwanza','AOA',454.45625967457,'currency'),(7,'Argentine Peso','ARS',129.03605756329,'currency'),(8,'Australian Dollar','AUD',1.4945006580317,'currency'),(9,'Aruban Florin','AWG',1.9322302445559,'currency'),(10,'Azerbaijani Manat','AZN',1.8248841198584,'currency'),(11,'Bosnia-Herzegovina Convertible Mark','BAM',1.9627809516449,'currency'),(12,'Barbadian Dollar','BBD',2.146922493951,'currency'),(13,'Bangladeshi Taka','BDT',95.609599319855,'currency'),(14,'Bulgarian Lev','BGN',1.9578022383814,'currency'),(15,'Bahraini Dinar','BHD',0.4047024043385,'currency'),(16,'Burundian Franc','BIF',2190.4930439711,'currency'),(17,'Bermudan Dollar','BMD',1.0734612469755,'currency'),(18,'Brunei Dollar','BND',1.471770116127,'currency'),(19,'Bolivian Boliviano','BOB',7.4008003727057,'currency'),(20,'Brazilian Real','BRL',5.0799406590623,'currency'),(21,'Bahamian Dollar','BSD',1.0734612469755,'currency'),(22,'Bitcoin','BTC',0.000033735144906534,'currency'),(23,'Bhutanese Ngultrum','BTN',83.3043627612,'currency'),(24,'Botswanan Pula','BWP',12.901023652645,'currency'),(25,'Belarusian Ruble','BYN',3.6254715178527,'currency'),(26,'Belize Dollar','BZD',2.1635504086667,'currency'),(27,'Canadian Dollar','CAD',1.3565007739656,'currency'),(28,'Congolese Franc','CDF',2150.1500033277,'currency'),(29,'Swiss Franc','CHF',1.0301406448926,'currency'),(30,'Chilean Unit of Account (UF)','CLF',0.032064287447159,'currency'),(31,'Chilean Peso','CLP',884.7574943697,'currency'),(32,'Chinese Yuan (Offshore)','CNH',7.1676778671613,'currency'),(33,'Chinese Yuan','CNY',7.1627775165689,'currency'),(34,'Colombian Peso','COP',4064.601284289,'currency'),(35,'Costa Rican Colón','CRC',725.03629909207,'currency'),(36,'Cuban Convertible Peso','CUC',1.0734612469755,'currency'),(37,'Cuban Peso','CUP',27.64162710962,'currency'),(38,'Cape Verdean Escudo','CVE',110.81340452528,'currency'),(39,'Czech Republic Koruna','CZK',24.717572345921,'currency'),(40,'Djiboutian Franc','DJF',191.08668306915,'currency'),(41,'Danish Krone','DKK',7.439558764489,'currency'),(42,'Dominican Peso','DOP',59.194330836462,'currency'),(43,'Algerian Dinar','DZD',156.17449863992,'currency'),(44,'Egyptian Pound','EGP',19.97686046936,'currency'),(45,'Eritrean Nakfa','ERN',16.101919778094,'currency'),(46,'Ethiopian Birr','ETB',55.591305393284,'currency'),(47,'Euro','EUR',1,'currency'),(48,'Fijian Dollar','FJD',2.3026817208872,'currency'),(49,'Falkland Islands Pound','FKP',0.85130629499144,'currency'),(50,'British Pound Sterling','GBP',0.85130629499144,'currency'),(51,'Georgian Lari','GEL',3.2418529658661,'currency'),(52,'Guernsey Pound','GGP',0.85130629499144,'currency'),(53,'Ghanaian Cedi','GHS',8.388744329441,'currency'),(54,'Gibraltar Pound','GIP',0.85130629499144,'currency'),(55,'Gambian Dalasi','GMD',58.127926523725,'currency'),(56,'Guinean Franc','GNF',9495.4016537744,'currency'),(57,'Guatemalan Quetzal','GTQ',8.243461010814,'currency'),(58,'Guyanaese Dollar','GYD',224.55893838977,'currency'),(59,'Hong Kong Dollar','HKD',8.4237692230073,'currency'),(60,'Honduran Lempira','HNL',26.366901539988,'currency'),(61,'Croatian Kuna','HRK',7.5422460673747,'currency'),(62,'Haitian Gourde','HTG',120.21033077635,'currency'),(63,'Hungarian Forint','HUF',396.93215510227,'currency'),(64,'Indonesian Rupiah','IDR',15614.935422718,'currency'),(65,'Israeli New Sheqel','ILS',3.5747494004719,'currency'),(66,'Manx pound','IMP',0.85130629499144,'currency'),(67,'Indian Rupee','INR',83.299795183594,'currency'),(68,'Iraqi Dinar','IQD',1566.8559092968,'currency'),(69,'Iranian Rial','IRR',45407.410747065,'currency'),(70,'Icelandic Króna','ISK',136.27948314988,'currency'),(71,'Jersey Pound','JEP',0.85130629499144,'currency'),(72,'Jamaican Dollar','JMD',165.03982004496,'currency'),(73,'Jordanian Dinar','JOD',0.76108402410565,'currency'),(74,'Japanese Yen','JPY',138.19460993639,'currency'),(75,'Kenyan Shilling','KES',125.43394670909,'currency'),(76,'Kyrgystani Som','KGS',88.065799954056,'currency'),(77,'Cambodian Riel','KHR',4360.7696212614,'currency'),(78,'Comorian Franc','KMF',492.34278193923,'currency'),(79,'North Korean Won','KPW',966.11512227797,'currency'),(80,'South Korean Won','KRW',1334.032451807,'currency'),(81,'Kuwaiti Dinar','KWD',0.32864552806779,'currency'),(82,'Cayman Islands Dollar','KYD',0.89444226173991,'currency'),(83,'Kazakhstani Tenge','KZT',456.56643544311,'currency'),(84,'Laotian Kip','LAK',14422.533013227,'currency'),(85,'Lebanese Pound','LBP',1628.9987290219,'currency'),(86,'Sri Lankan Rupee','LKR',389.09327304775,'currency'),(87,'Liberian Dollar','LRD',163.16608592413,'currency'),(88,'Lesotho Loti','LSL',16.749224424249,'currency'),(89,'Libyan Dinar','LYD',5.1220385887849,'currency'),(90,'Moroccan Dirham','MAD',10.607093861305,'currency'),(91,'Moldovan Leu','MDL',20.435292829494,'currency'),(92,'Malagasy Ariary','MGA',4319.4659723519,'currency'),(93,'Macedonian Denar','MKD',61.621671465038,'currency'),(94,'Myanma Kyat','MMK',1987.3272392938,'currency'),(95,'Mongolian Tugrik','MNT',3333.4786799862,'currency'),(96,'Macanese Pataca','MOP',8.6752972950923,'currency'),(97,'Mauritanian Ouguiya (pre-2018)','MRO',402.78068637472,'currency'),(98,'Mauritanian Ouguiya','MRU',39.15656324941,'currency'),(99,'Mauritian Rupee','MUR',46.268847295844,'currency'),(100,'Maldivian Rufiyaa','MVR',16.568874347067,'currency'),(101,'Malawian Kwacha','MWK',874.62402019825,'currency'),(102,'Mexican Peso','MXN',21.096331338842,'currency'),(103,'Malaysian Ringgit','MYR',4.7001500698823,'currency'),(104,'Mozambican Metical','MZN',68.604900779977,'currency'),(105,'Namibian Dollar','NAD',16.745995452818,'currency'),(106,'Nigerian Naira','NGN',445.70110974424,'currency'),(107,'Nicaraguan Córdoba','NIO',38.481224089329,'currency'),(108,'Norwegian Krone','NOK',10.056921356082,'currency'),(109,'Nepalese Rupee','NPR',133.28727647853,'currency'),(110,'New Zealand Dollar','NZD',1.6467002874729,'currency'),(111,'Omani Rial','OMR',0.41328043316308,'currency'),(112,'Panamanian Balboa','PAB',1.0734612469755,'currency'),(113,'Peruvian Nuevo Sol','PEN',3.9467659833012,'currency'),(114,'Papua New Guinean Kina','PGK',3.8098277524083,'currency'),(115,'Philippine Peso','PHP',56.356715466215,'currency'),(116,'Pakistani Rupee','PKR',213.38406940571,'currency'),(117,'Polish Zloty','PLN',4.5826790587033,'currency'),(118,'Paraguayan Guarani','PYG',7392.0249880309,'currency'),(119,'Qatari Rial','QAR',3.9113707456047,'currency'),(120,'Romanian Leu','RON',4.9418935427012,'currency'),(121,'Serbian Dinar','RSD',117.43118684022,'currency'),(122,'Russian Ruble','RUB',67.359693247714,'currency'),(123,'Rwandan Franc','RWF',1097.9407438657,'currency'),(124,'Saudi Riyal','SAR',4.0258929587383,'currency'),(125,'Solomon Islands Dollar','SBD',8.7132516644017,'currency'),(126,'Seychellois Rupee','SCR',13.793659279106,'currency'),(127,'Sudanese Pound','SDG',488.42486737386,'currency'),(128,'Swedish Krona','SEK',10.483613614065,'currency'),(129,'Singapore Dollar','SGD',1.4705130930068,'currency'),(130,'Saint Helena Pound','SHP',0.85130629499144,'currency'),(131,'Sierra Leonean Leone','SLL',13833.909782023,'currency'),(132,'Somali Shilling','SOS',623.56437869136,'currency'),(133,'Surinamese Dollar','SRD',22.674721919864,'currency'),(134,'South Sudanese Pound','SSP',139.82906203103,'currency'),(135,'São Tomé and Príncipe Dobra (pre-2018)','STD',24683.167912955,'currency'),(136,'São Tomé and Príncipe Dobra','STN',24.796954805135,'currency'),(137,'Salvadoran Colón','SVC',9.3918638078247,'currency'),(138,'Syrian Pound','SYP',2697.1035868634,'currency'),(139,'Swazi Lilangeni','SZL',16.75083461612,'currency'),(140,'Thai Baht','THB',36.823477885625,'currency'),(141,'Tajikistani Somoni','TJS',13.356112180994,'currency'),(142,'Turkmenistani Manat','TMT',3.7678489768841,'currency'),(143,'Tunisian Dinar','TND',3.2525875783358,'currency'),(144,'Tongan Pa\'anga','TOP',2.468136449806,'currency'),(145,'Turkish Lira','TRY',17.605705875912,'currency'),(146,'Trinidad and Tobago Dollar','TTD',7.2749585107228,'currency'),(147,'New Taiwan Dollar','TWD',31.145188854037,'currency'),(148,'Tanzanian Shilling','TZS',2499.017782959,'currency'),(149,'Ukrainian Hryvnia','UAH',31.71219108469,'currency'),(150,'Ugandan Shilling','UGX',4054.7497235837,'currency'),(151,'United States Dollar','USD',1.0734612469755,'currency'),(152,'Uruguayan Peso','UYU',42.833864696651,'currency'),(153,'Uzbekistan Som','UZS',11825.281392837,'currency'),(154,'Venezuelan Bolívar Fuerte (Old)','VEF',300813.19508676,'currency'),(155,'Venezuelan Bolívar Soberano','VES',5.4302099904891,'currency'),(156,'Vietnamese Dong','VND',24894.03686588,'currency'),(157,'Vanuatu Vatu','VUV',123.05068239931,'currency'),(158,'Samoan Tala','WST',2.8049027122072,'currency'),(159,'CFA Franc BEAC','XAF',655.95679640519,'currency'),(160,'Silver Ounce','XAG',0.049816062415331,'currency'),(161,'Gold Ounce','XAU',0.00058453185281558,'currency'),(162,'East Caribbean Dollar','XCD',2.9010826930137,'currency'),(163,'Special Drawing Rights','XDR',0.78091944102726,'currency'),(164,'CFA Franc BCEAO','XOF',655.95679640519,'currency'),(165,'Palladium Ounce','XPD',0.00053475545479333,'currency'),(166,'CFP Franc','XPF',119.33170489262,'currency'),(167,'Platinum Ounce','XPT',0.0011034000811537,'currency'),(168,'Yemeni Rial','YER',268.63360942757,'currency'),(169,'South African Rand','ZAR',16.778312003658,'currency'),(170,'Zambian Kwacha','ZMW',18.515015575923,'currency'),(171,'Zimbabwean Dollar','ZWL',345.65452152612,'currency');
/*!40000 ALTER TABLE `generic_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_language`
--

DROP TABLE IF EXISTS `generic_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_language` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `right_to_left` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_language`
--

LOCK TABLES `generic_language` WRITE;
/*!40000 ALTER TABLE `generic_language` DISABLE KEYS */;
INSERT INTO `generic_language` VALUES (1,'Afar','AAR','language',0),(2,'Abkhazian','ABK','language',0),(3,'Achinese','ACE','language',0),(4,'Acoli','ACH','language',0),(5,'Adangme','ADA','language',0),(6,'Adyghe; Adygei','ADY','language',0),(7,'Afro-Asiatic languages','AFA','language',0),(8,'Afrihili','AFH','language',0),(9,'Afrikaans','AFR','language',0),(10,'Ainu','AIN','language',0),(11,'Akan','AKA','language',0),(12,'Akkadian','AKK','language',0),(13,'Albanian','ALB','language',0),(14,'Aleut','ALE','language',0),(15,'Algonquian languages','ALG','language',0),(16,'Southern Altai','ALT','language',0),(17,'Amharic','AMH','language',0),(18,'English, Old (ca.450-1100)','ANG','language',0),(19,'Angika','ANP','language',0),(20,'Apache languages','APA','language',0),(21,'Arabic','ARA','language',1),(22,'Official Aramaic (700-300 BCE); Imperial Aramaic (700-300 BCE)','ARC','language',0),(23,'Aragonese','ARG','language',0),(24,'Armenian','ARM','language',0),(25,'Mapudungun; Mapuche','ARN','language',0),(26,'Arapaho','ARP','language',0),(27,'Artificial languages','ART','language',0),(28,'Arawak','ARW','language',0),(29,'Assamese','ASM','language',0),(30,'Asturian; Bable; Leonese; Asturleonese','AST','language',0),(31,'Athapascan languages','ATH','language',0),(32,'Australian languages','AUS','language',0),(33,'Avaric','AVA','language',0),(34,'Avestan','AVE','language',0),(35,'Awadhi','AWA','language',0),(36,'Aymara','AYM','language',0),(37,'Azerbaijani','AZE','language',0),(38,'Banda languages','BAD','language',0),(39,'Bamileke languages','BAI','language',0),(40,'Bashkir','BAK','language',0),(41,'Baluchi','BAL','language',0),(42,'Bambara','BAM','language',0),(43,'Balinese','BAN','language',0),(44,'Basque','BAQ','language',0),(45,'Basa','BAS','language',0),(46,'Baltic languages','BAT','language',0),(47,'Beja; Bedawiyet','BEJ','language',0),(48,'Belarusian','BEL','language',0),(49,'Bemba','BEM','language',0),(50,'Bengali','BEN','language',0),(51,'Berber languages','BER','language',0),(52,'Bhojpuri','BHO','language',0),(53,'Bihari languages','BIH','language',0),(54,'Bikol','BIK','language',0),(55,'Bini; Edo','BIN','language',0),(56,'Bislama','BIS','language',0),(57,'Siksika','BLA','language',0),(58,'Bantu languages','BNT','language',0),(59,'Tibetan','TIB','language',0),(60,'Bosnian','BOS','language',0),(61,'Braj','BRA','language',0),(62,'Breton','BRE','language',0),(63,'Batak languages','BTK','language',0),(64,'Buriat','BUA','language',0),(65,'Buginese','BUG','language',0),(66,'Bulgarian','BUL','language',0),(67,'Burmese','BUR','language',0),(68,'Blin; Bilin','BYN','language',0),(69,'Caddo','CAD','language',0),(70,'Central American Indian languages','CAI','language',0),(71,'Galibi Carib','CAR','language',0),(72,'Catalan; Valencian','CAT','language',0),(73,'Caucasian languages','CAU','language',0),(74,'Cebuano','CEB','language',0),(75,'Celtic languages','CEL','language',0),(76,'Czech','CZE','language',0),(77,'Chamorro','CHA','language',0),(78,'Chibcha','CHB','language',0),(79,'Chechen','CHE','language',0),(80,'Chagatai','CHG','language',0),(81,'Chinese','CHI','language',0),(82,'Chuukese','CHK','language',0),(83,'Mari','CHM','language',0),(84,'Chinook jargon','CHN','language',0),(85,'Choctaw','CHO','language',0),(86,'Chipewyan; Dene Suline','CHP','language',0),(87,'Cherokee','CHR','language',0),(88,'Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic','CHU','language',0),(89,'Chuvash','CHV','language',0),(90,'Cheyenne','CHY','language',0),(91,'Chamic languages','CMC','language',0),(92,'Montenegrin','CNR','language',0),(93,'Coptic','COP','language',0),(94,'Cornish','COR','language',0),(95,'Corsican','COS','language',0),(96,'Creoles and pidgins, English based','CPE','language',0),(97,'Creoles and pidgins, French-based','CPF','language',0),(98,'Creoles and pidgins, Portuguese-based','CPP','language',0),(99,'Cree','CRE','language',0),(100,'Crimean Tatar; Crimean Turkish','CRH','language',0),(101,'Creoles and pidgins','CRP','language',0),(102,'Kashubian','CSB','language',0),(103,'Cushitic languages','CUS','language',0),(104,'Welsh','WEL','language',0),(105,'Czech','CZE','language',0),(106,'Dakota','DAK','language',0),(107,'Danish','DAN','language',0),(108,'Dargwa','DAR','language',0),(109,'Land Dayak languages','DAY','language',0),(110,'Delaware','DEL','language',0),(111,'Slave (Athapascan)','DEN','language',0),(112,'German','GER','language',0),(113,'Dogrib','DGR','language',0),(114,'Dinka','DIN','language',0),(115,'Divehi; Dhivehi; Maldivian','DIV','language',0),(116,'Dogri','DOI','language',0),(117,'Dravidian languages','DRA','language',0),(118,'Lower Sorbian','DSB','language',0),(119,'Duala','DUA','language',0),(120,'Dutch, Middle (ca.1050-1350)','DUM','language',0),(121,'Dutch; Flemish','DUT','language',0),(122,'Dyula','DYU','language',0),(123,'Dzongkha','DZO','language',0),(124,'Efik','EFI','language',0),(125,'Egyptian (Ancient)','EGY','language',0),(126,'Ekajuk','EKA','language',0),(127,'Greek, Modern (1453-)','GRE','language',0),(128,'Elamite','ELX','language',0),(129,'English','ENG','language',0),(130,'English, Middle (1100-1500)','ENM','language',0),(131,'Esperanto','EPO','language',0),(132,'Estonian','EST','language',0),(133,'Basque','BAQ','language',0),(134,'Ewe','EWE','language',0),(135,'Ewondo','EWO','language',0),(136,'Fang','FAN','language',0),(137,'Faroese','FAO','language',0),(138,'Persian','PER','language',0),(139,'Fanti','FAT','language',0),(140,'Fijian','FIJ','language',0),(141,'Filipino; Pilipino','FIL','language',0),(142,'Finnish','FIN','language',0),(143,'Finno-Ugrian languages','FIU','language',0),(144,'Fon','FON','language',0),(145,'French','FRE','language',0),(146,'French','FRE','language',0),(147,'French, Middle (ca.1400-1600)','FRM','language',0),(148,'French, Old (842-ca.1400)','FRO','language',0),(149,'Northern Frisian','FRR','language',0),(150,'Eastern Frisian','FRS','language',0),(151,'Western Frisian','FRY','language',0),(152,'Fulah','FUL','language',0),(153,'Friulian','FUR','language',0),(154,'Ga','GAA','language',0),(155,'Gayo','GAY','language',0),(156,'Gbaya','GBA','language',0),(157,'Germanic languages','GEM','language',0),(158,'Georgian','GEO','language',0),(159,'German','GER','language',0),(160,'Geez','GEZ','language',0),(161,'Gilbertese','GIL','language',0),(162,'Gaelic; Scottish Gaelic','GLA','language',0),(163,'Irish','GLE','language',0),(164,'Galician','GLG','language',0),(165,'Manx','GLV','language',0),(166,'German, Middle High (ca.1050-1500)','GMH','language',0),(167,'German, Old High (ca.750-1050)','GOH','language',0),(168,'Gondi','GON','language',0),(169,'Gorontalo','GOR','language',0),(170,'Gothic','GOT','language',0),(171,'Grebo','GRB','language',0),(172,'Greek, Ancient (to 1453)','GRC','language',0),(173,'Greek, Modern (1453-)','GRE','language',0),(174,'Guarani','GRN','language',0),(175,'Swiss German; Alemannic; Alsatian','GSW','language',0),(176,'Gujarati','GUJ','language',0),(177,'Gwich\'in','GWI','language',0),(178,'Haida','HAI','language',0),(179,'Haitian; Haitian Creole','HAT','language',0),(180,'Hausa','HAU','language',0),(181,'Hawaiian','HAW','language',0),(182,'Hebrew','HEB','language',0),(183,'Herero','HER','language',0),(184,'Hiligaynon','HIL','language',0),(185,'Himachali languages; Western Pahari languages','HIM','language',0),(186,'Hindi','HIN','language',0),(187,'Hittite','HIT','language',0),(188,'Hmong; Mong','HMN','language',0),(189,'Hiri Motu','HMO','language',0),(190,'Croatian','HRV','language',0),(191,'Upper Sorbian','HSB','language',0),(192,'Hungarian','HUN','language',0),(193,'Hupa','HUP','language',0),(194,'Armenian','ARM','language',0),(195,'Iban','IBA','language',0),(196,'Igbo','IBO','language',0),(197,'Icelandic','ICE','language',0),(198,'Ido','IDO','language',0),(199,'Sichuan Yi; Nuosu','III','language',0),(200,'Ijo languages','IJO','language',0),(201,'Inuktitut','IKU','language',0),(202,'Interlingue; Occidental','ILE','language',0),(203,'Iloko','ILO','language',0),(204,'Interlingua (International Auxiliary Language Association)','INA','language',0),(205,'Indic languages','INC','language',0),(206,'Indonesian','IND','language',0),(207,'Indo-European languages','INE','language',0),(208,'Ingush','INH','language',0),(209,'Inupiaq','IPK','language',0),(210,'Iranian languages','IRA','language',0),(211,'Iroquoian languages','IRO','language',0),(212,'Icelandic','ICE','language',0),(213,'Italian','ITA','language',0),(214,'Javanese','JAV','language',0),(215,'Lojban','JBO','language',0),(216,'Japanese','JPN','language',0),(217,'Judeo-Persian','JPR','language',0),(218,'Judeo-Arabic','JRB','language',0),(219,'Kara-Kalpak','KAA','language',0),(220,'Kabyle','KAB','language',0),(221,'Kachin; Jingpho','KAC','language',0),(222,'Kalaallisut; Greenlandic','KAL','language',0),(223,'Kamba','KAM','language',0),(224,'Kannada','KAN','language',0),(225,'Karen languages','KAR','language',0),(226,'Kashmiri','KAS','language',0),(227,'Georgian','GEO','language',0),(228,'Kanuri','KAU','language',0),(229,'Kawi','KAW','language',0),(230,'Kazakh','KAZ','language',0),(231,'Kabardian','KBD','language',0),(232,'Khasi','KHA','language',0),(233,'Khoisan languages','KHI','language',0),(234,'Central Khmer','KHM','language',0),(235,'Khotanese; Sakan','KHO','language',0),(236,'Kikuyu; Gikuyu','KIK','language',0),(237,'Kinyarwanda','KIN','language',0),(238,'Kirghiz; Kyrgyz','KIR','language',0),(239,'Kimbundu','KMB','language',0),(240,'Konkani','KOK','language',0),(241,'Komi','KOM','language',0),(242,'Kongo','KON','language',0),(243,'Korean','KOR','language',0),(244,'Kosraean','KOS','language',0),(245,'Kpelle','KPE','language',0),(246,'Karachay-Balkar','KRC','language',0),(247,'Karelian','KRL','language',0),(248,'Kru languages','KRO','language',0),(249,'Kurukh','KRU','language',0),(250,'Kuanyama; Kwanyama','KUA','language',0),(251,'Kumyk','KUM','language',0),(252,'Kurdish','KUR','language',0),(253,'Kutenai','KUT','language',0),(254,'Ladino','LAD','language',0),(255,'Lahnda','LAH','language',0),(256,'Lamba','LAM','language',0),(257,'Lao','LAO','language',0),(258,'Latin','LAT','language',0),(259,'Latvian','LAV','language',0),(260,'Lezghian','LEZ','language',0),(261,'Limburgan; Limburger; Limburgish','LIM','language',0),(262,'Lingala','LIN','language',0),(263,'Lithuanian','LIT','language',0),(264,'Mongo','LOL','language',0),(265,'Lozi','LOZ','language',0),(266,'Luxembourgish; Letzeburgesch','LTZ','language',0),(267,'Luba-Lulua','LUA','language',0),(268,'Luba-Katanga','LUB','language',0),(269,'Ganda','LUG','language',0),(270,'Luiseno','LUI','language',0),(271,'Lunda','LUN','language',0),(272,'Luo (Kenya and Tanzania)','LUO','language',0),(273,'Lushai','LUS','language',0),(274,'Macedonian','MAC','language',0),(275,'Madurese','MAD','language',0),(276,'Magahi','MAG','language',0),(277,'Marshallese','MAH','language',0),(278,'Maithili','MAI','language',0),(279,'Makasar','MAK','language',0),(280,'Malayalam','MAL','language',0),(281,'Mandingo','MAN','language',0),(282,'Maori','MAO','language',0),(283,'Austronesian languages','MAP','language',0),(284,'Marathi','MAR','language',0),(285,'Masai','MAS','language',0),(286,'Malay','MAY','language',0),(287,'Moksha','MDF','language',0),(288,'Mandar','MDR','language',0),(289,'Mende','MEN','language',0),(290,'Irish, Middle (900-1200)','MGA','language',0),(291,'Mi\'kmaq; Micmac','MIC','language',0),(292,'Minangkabau','MIN','language',0),(293,'Uncoded languages','MIS','language',0),(294,'Macedonian','MAC','language',0),(295,'Mon-Khmer languages','MKH','language',0),(296,'Malagasy','MLG','language',0),(297,'Maltese','MLT','language',0),(298,'Manchu','MNC','language',0),(299,'Manipuri','MNI','language',0),(300,'Manobo languages','MNO','language',0),(301,'Mohawk','MOH','language',0),(302,'Mongolian','MON','language',0),(303,'Mossi','MOS','language',0),(304,'Maori','MAO','language',0),(305,'Malay','MAY','language',0),(306,'Multiple languages','MUL','language',0),(307,'Munda languages','MUN','language',0),(308,'Creek','MUS','language',0),(309,'Mirandese','MWL','language',0),(310,'Marwari','MWR','language',0),(311,'Burmese','BUR','language',0),(312,'Mayan languages','MYN','language',0),(313,'Erzya','MYV','language',0),(314,'Nahuatl languages','NAH','language',0),(315,'North American Indian languages','NAI','language',0),(316,'Neapolitan','NAP','language',0),(317,'Nauru','NAU','language',0),(318,'Navajo; Navaho','NAV','language',0),(319,'Ndebele, South; South Ndebele','NBL','language',0),(320,'Ndebele, North; North Ndebele','NDE','language',0),(321,'Ndonga','NDO','language',0),(322,'Low German; Low Saxon; German, Low; Saxon, Low','NDS','language',0),(323,'Nepali','NEP','language',0),(324,'Nepal Bhasa; Newari','NEW','language',0),(325,'Nias','NIA','language',0),(326,'Niger-Kordofanian languages','NIC','language',0),(327,'Niuean','NIU','language',0),(328,'Dutch; Flemish','DUT','language',0),(329,'Norwegian Nynorsk; Nynorsk, Norwegian','NNO','language',0),(330,'Bokm?l, Norwegian; Norwegian Bokm','NOB','language',0),(331,'Nogai','NOG','language',0),(332,'Norse, Old','NON','language',0),(333,'Norwegian','NOR','language',0),(334,'N\'Ko','NQO','language',0),(335,'Pedi; Sepedi; Northern Sotho','NSO','language',0),(336,'Nubian languages','NUB','language',0),(337,'Classical Newari; Old Newari; Classical Nepal Bhasa','NWC','language',0),(338,'Chichewa; Chewa; Nyanja','NYA','language',0),(339,'Nyamwezi','NYM','language',0),(340,'Nyankole','NYN','language',0),(341,'Nyoro','NYO','language',0),(342,'Nzima','NZI','language',0),(343,'Occitan (post 1500)','OCI','language',0),(344,'Ojibwa','OJI','language',0),(345,'Oriya','ORI','language',0),(346,'Oromo','ORM','language',0),(347,'Osage','OSA','language',0),(348,'Ossetian; Ossetic','OSS','language',0),(349,'Turkish, Ottoman (1500-1928)','OTA','language',0),(350,'Otomian languages','OTO','language',0),(351,'Papuan languages','PAA','language',0),(352,'Pangasinan','PAG','language',0),(353,'Pahlavi','PAL','language',0),(354,'Pampanga; Kapampangan','PAM','language',0),(355,'Panjabi; Punjabi','PAN','language',0),(356,'Papiamento','PAP','language',0),(357,'Palauan','PAU','language',0),(358,'Persian, Old (ca.600-400 B.C.)','PEO','language',0),(359,'Persian','PER','language',0),(360,'Philippine languages','PHI','language',0),(361,'Phoenician','PHN','language',0),(362,'Pali','PLI','language',0),(363,'Polish','POL','language',0),(364,'Pohnpeian','PON','language',0),(365,'Portuguese','POR','language',0),(366,'Prakrit languages','PRA','language',0),(367,'Proven?al, Old (to 1500);Occitan, Old (to 1500)','PRO','language',0),(368,'Pushto; Pashto','PUS','language',0),(369,'Reserved for local use','QAA','language',0),(370,'Quechua','QUE','language',0),(371,'Rajasthani','RAJ','language',0),(372,'Rapanui','RAP','language',0),(373,'Rarotongan; Cook Islands Maori','RAR','language',0),(374,'Romance languages','ROA','language',0),(375,'Romansh','ROH','language',0),(376,'Romany','ROM','language',0),(377,'Romanian; Moldavian; Moldovan','RUM','language',0),(378,'Romanian; Moldavian; Moldovan','RUM','language',0),(379,'Rundi','RUN','language',0),(380,'Aromanian; Arumanian; Macedo-Romanian','RUP','language',0),(381,'Russian','RUS','language',0),(382,'Sandawe','SAD','language',0),(383,'Sango','SAG','language',0),(384,'Yakut','SAH','language',0),(385,'South American Indian languages','SAI','language',0),(386,'Salishan languages','SAL','language',0),(387,'Samaritan Aramaic','SAM','language',0),(388,'Sanskrit','SAN','language',0),(389,'Sasak','SAS','language',0),(390,'Santali','SAT','language',0),(391,'Sicilian','SCN','language',0),(392,'Scots','SCO','language',0),(393,'Selkup','SEL','language',0),(394,'Semitic languages','SEM','language',0),(395,'Irish, Old (to 900)','SGA','language',0),(396,'Sign Languages','SGN','language',0),(397,'Shan','SHN','language',0),(398,'Sidamo','SID','language',0),(399,'Sinhala; Sinhalese','SIN','language',0),(400,'Siouan languages','SIO','language',0),(401,'Sino-Tibetan languages','SIT','language',0),(402,'Slavic languages','SLA','language',0),(403,'Slovak','SLO','language',0),(404,'Slovak','SLO','language',0),(405,'Slovenian','SLV','language',0),(406,'Southern Sami','SMA','language',0),(407,'Northern Sami','SME','language',0),(408,'Sami languages','SMI','language',0),(409,'Lule Sami','SMJ','language',0),(410,'Inari Sami','SMN','language',0),(411,'Samoan','SMO','language',0),(412,'Skolt Sami','SMS','language',0),(413,'Shona','SNA','language',0),(414,'Sindhi','SND','language',0),(415,'Soninke','SNK','language',0),(416,'Sogdian','SOG','language',0),(417,'Somali','SOM','language',0),(418,'Songhai languages','SON','language',0),(419,'Sotho, Southern','SOT','language',0),(420,'Spanish; Castilian','SPA','language',0),(421,'Albanian','ALB','language',0),(422,'Sardinian','SRD','language',0),(423,'Sranan Tongo','SRN','language',0),(424,'Serbian','SRP','language',0),(425,'Serer','SRR','language',0),(426,'Nilo-Saharan languages','SSA','language',0),(427,'Swati','SSW','language',0),(428,'Sukuma','SUK','language',0),(429,'Sundanese','SUN','language',0),(430,'Susu','SUS','language',0),(431,'Sumerian','SUX','language',0),(432,'Swahili','SWA','language',0),(433,'Swedish','SWE','language',0),(434,'Classical Syriac','SYC','language',0),(435,'Syriac','SYR','language',0),(436,'Tahitian','TAH','language',0),(437,'Tai languages','TAI','language',0),(438,'Tamil','TAM','language',0),(439,'Tatar','TAT','language',0),(440,'Telugu','TEL','language',0),(441,'Timne','TEM','language',0),(442,'Tereno','TER','language',0),(443,'Tetum','TET','language',0),(444,'Tajik','TGK','language',0),(445,'Tagalog','TGL','language',0),(446,'Thai','THA','language',0),(447,'Tibetan','TIB','language',0),(448,'Tigre','TIG','language',0),(449,'Tigrinya','TIR','language',0),(450,'Tiv','TIV','language',0),(451,'Tokelau','TKL','language',0),(452,'Klingon; tlhIngan-Hol','TLH','language',0),(453,'Tlingit','TLI','language',0),(454,'Tamashek','TMH','language',0),(455,'Tonga (Nyasa)','TOG','language',0),(456,'Tonga (Tonga Islands)','TON','language',0),(457,'Tok Pisin','TPI','language',0),(458,'Tsimshian','TSI','language',0),(459,'Tswana','TSN','language',0),(460,'Tsonga','TSO','language',0),(461,'Turkmen','TUK','language',0),(462,'Tumbuka','TUM','language',0),(463,'Tupi languages','TUP','language',0),(464,'Turkish','TUR','language',0),(465,'Altaic languages','TUT','language',0),(466,'Tuvalu','TVL','language',0),(467,'Twi','TWI','language',0),(468,'Tuvinian','TYV','language',0),(469,'Udmurt','UDM','language',0),(470,'Ugaritic','UGA','language',0),(471,'Uighur; Uyghur','UIG','language',0),(472,'Ukrainian','UKR','language',0),(473,'Umbundu','UMB','language',0),(474,'Undetermined','UND','language',0),(475,'Urdu','URD','language',0),(476,'Uzbek','UZB','language',0),(477,'Vai','VAI','language',0),(478,'Venda','VEN','language',0),(479,'Vietnamese','VIE','language',0),(480,'Volap?k','VOL','language',0),(481,'Votic','VOT','language',0),(482,'Wakashan languages','WAK','language',0),(483,'Wolaitta; Wolaytta','WAL','language',0),(484,'Waray','WAR','language',0),(485,'Washo','WAS','language',0),(486,'Welsh','WEL','language',0),(487,'Sorbian languages','WEN','language',0),(488,'Walloon','WLN','language',0),(489,'Wolof','WOL','language',0),(490,'Kalmyk; Oirat','XAL','language',0),(491,'Xhosa','XHO','language',0),(492,'Yao','YAO','language',0),(493,'Yapese','YAP','language',0),(494,'Yiddish','YID','language',0),(495,'Yoruba','YOR','language',0),(496,'Yupik languages','YPK','language',0),(497,'Zapotec','ZAP','language',0),(498,'Blissymbols; Blissymbolics; Bliss','ZBL','language',0),(499,'Zenaga','ZEN','language',0),(500,'Standard Moroccan Tamazight','ZGH','language',0),(501,'Zhuang; Chuang','ZHA','language',0),(502,'Chinese','CHI','language',0),(503,'Zande languages','ZND','language',0),(504,'Zulu','ZUL','language',0),(505,'Zuni','ZUN','language',0),(506,'No linguistic content; Not applicable','ZXX','language',0),(507,'Zaza; Dimili; Dimli; Kirdki; Kirmanjki; Zazaki','ZZA','language',0);
/*!40000 ALTER TABLE `generic_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_log`
--

DROP TABLE IF EXISTS `generic_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_log` (
  `id` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_log`
--

LOCK TABLES `generic_log` WRITE;
/*!40000 ALTER TABLE `generic_log` DISABLE KEYS */;
INSERT INTO `generic_log` VALUES (0,'2022-11-11 10:40:57','Stride, Aurelien','Unit','Symbol','hand drawing\n >> \nhand-drawing','log',7);
/*!40000 ALTER TABLE `generic_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_site`
--

DROP TABLE IF EXISTS `generic_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_site` (
  `id` int(11) NOT NULL DEFAULT '0',
  `business_unit_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ldap_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldap_ou` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `signatory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `default_language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_site`
--

LOCK TABLES `generic_site` WRITE;
/*!40000 ALTER TABLE `generic_site` DISABLE KEYS */;
INSERT INTO `generic_site` VALUES (1,2,225,'ESA','ES MELLOUSSA','10.51.2.11','dc=gta,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Avelli, Roberto',NULL,NULL,21),(2,2,296,'ESB','ES BANOVCE','10.61.2.32','dc=esb,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Smolka, Vladimir',NULL,NULL,403),(3,1,163,'ESC','ES CHATEAUROUX','10.4.200.83','dc=esc,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Biarneix, Francois',NULL,NULL,145),(4,NULL,147,'ESD','ES DEUTSCHLAND',NULL,'dc=esd,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,159),(5,1,157,'ESE','ES SPAIN','10.95.2.15','dc=ese,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Gonzalez, Victor',NULL,NULL,420),(6,2,146,'ESH','ES CZECHIA','10.4.200.113','dc=esh,dc=src,dc=local','OU=_Management','EUR','site','Schneider, Jiri','2021-03-01',NULL,76),(7,NULL,203,'ESJ','ES JAPON',NULL,'dc=esj,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,129),(8,2,296,'ESK','ES LIPTOVSKY MIKULAS','10.60.0.32','dc=esk,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Odskoc, Jozef',NULL,NULL,403),(9,1,163,'ESL','ES LOGNES','192.168.10.228','dc=plastiqueforme,dc=com','OU=_Management','EUR','site','Robert Carvaillo',NULL,'2020-06-01',145),(10,1,163,'ESM','ES MOLINGES','10.4.200.223','dc=esm,dc=src,dc=local','OU=User','EUR','site','Philippe, Pascal',NULL,NULL,145),(11,2,277,'ESN','ES KLIN','10.4.200.178','dc=esn,dc=src,dc=local','OU=_MANAGEMENT','RUB','site','Melnikov, Ilya',NULL,NULL,129),(12,4,296,'ESO','ES KOSICE','10.4.200.82','dc=esy,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Zarnay, Jan',NULL,NULL,129),(13,1,270,'ESP','ES PORTUGAL','10.90.2.38','dc=esp,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Ferreira, Abilio',NULL,NULL,365),(14,1,163,'ESS','ES SENS','10.13.1.252','dc=ess,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Houari, Karim',NULL,NULL,145),(15,2,225,'EST','ES TANGER','10.51.2.11','dc=gta,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Avelli, Roberto',NULL,NULL,21),(16,1,163,'ESV','ES VALENCIENNES','10.9.4.27','dc=esv,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Fortier, Patrice',NULL,NULL,145),(17,NULL,NULL,'ESW','ES KOREA',NULL,'dc=esw,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,243),(18,4,163,'ESY','ES CHATEAUROUX - Tech Center','10.4.200.82','dc=esy,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Duplessy, Regis',NULL,NULL,145),(19,NULL,297,'ESZ','ES SLOVENIA',NULL,'dc=esz,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,405),(20,2,147,'SOW','SO WURZBURG','192.168.7.31','dc=sco,dc=local','OU=_MANAGEMENT','EUR','site','Persak, Dejan',NULL,NULL,159),(21,2,189,'SOB','SO BONYHAD','192.168.19.245','dc=sco-hu,dc=local','OU=_MANAGEMENT','HUF','site','Zemes Attila',NULL,NULL,129),(22,NULL,NULL,'GPL','GMD PLAST','10.4.200.81','dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Lemasson, Francois-Xavier',NULL,NULL,129),(23,4,147,'ESG','ES GERMANY','192.168.7.31','dc=sco,dc=local','OU=_MANAGEMENT','EUR','site','Herrmann, Volker',NULL,NULL,159),(24,4,276,'ESR','ES ROMANIA','10.4.200.43','dc=esr,dc=src,dc=local','OU=_MANAGEMENT','RON','site','Ionita, Razvan',NULL,NULL,377),(25,4,163,'ELT','ES LOGNES - Tech Center','192.168.10.228','dc=plastiqueforme,dc=com','OU=_MANAGEMENT','EUR','site','Duplessy, Regis',NULL,NULL,145),(26,NULL,NULL,'ITC','Interco',NULL,NULL,NULL,'0','site','Mathorel, Fabrice',NULL,NULL,129),(27,NULL,NULL,'EXT','External','10.4.200.75','dc=esxt,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','External',NULL,NULL,129),(28,2,277,'ESI','ES TOGLIATTI',NULL,NULL,NULL,'RUB','site','.','2021-01-01',NULL,381);
/*!40000 ALTER TABLE `generic_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_user_access`
--

DROP TABLE IF EXISTS `generic_user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_user_access` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deny` tinyint(1) DEFAULT NULL,
  `read_only` tinyint(1) DEFAULT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_user_access`
--

LOCK TABLES `generic_user_access` WRITE;
/*!40000 ALTER TABLE `generic_user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `generic_user_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicator`
--

DROP TABLE IF EXISTS `indicator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `type_of_device_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_iterations` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `tolerance` double DEFAULT NULL,
  `decimals` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D1349DB3727ACA70` (`parent_id`),
  KEY `IDX_D1349DB3F8BD700D` (`unit_id`),
  KEY `IDX_D1349DB32483DDD7` (`type_of_device_id`),
  CONSTRAINT `FK_D1349DB32483DDD7` FOREIGN KEY (`type_of_device_id`) REFERENCES `type_of_device` (`id`),
  CONSTRAINT `FK_D1349DB3727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `indicator` (`id`),
  CONSTRAINT `FK_D1349DB3F8BD700D` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicator`
--

LOCK TABLES `indicator` WRITE;
/*!40000 ALTER TABLE `indicator` DISABLE KEYS */;
INSERT INTO `indicator` VALUES (1,NULL,1,4,'Mold',1,1,NULL,NULL),(2,1,2,4,'Cavity Number',1,1,NULL,NULL),(3,1,4,4,'Clamping Force',1,1,NULL,NULL),(4,1,2,4,'Versions',1,1,NULL,NULL),(5,1,2,4,'Lifting Link',1,1,NULL,NULL),(6,5,2,4,'Diameter M:',1,1,NULL,NULL),(7,1,2,4,'Centring Ring',1,1,NULL,NULL),(8,7,3,4,'Diameter Fixed Side',2,1,NULL,NULL),(9,7,3,4,'Diameter Moving Side',2,1,NULL,NULL),(10,1,7,4,'Sprue Drawing',1,1,NULL,NULL),(11,1,2,4,'Nbr Gates',1,1,NULL,NULL),(12,1,3,4,'Gate Diameter',1,1,NULL,2),(13,1,3,4,'Feed Runner Diameter',1,1,NULL,NULL),(14,1,5,4,'Mold Nozzle',1,1,NULL,NULL),(15,14,2,4,'Radius',1,1,NULL,NULL),(16,14,3,4,'Diameter',1,1,NULL,1),(17,1,6,4,'Weight',1,1,NULL,NULL),(18,1,3,4,'Thickness',1,1,NULL,NULL),(19,1,3,4,'Width',1,1,NULL,NULL),(20,1,3,4,'Height',1,1,NULL,NULL),(21,1,NULL,4,'Ejection',1,1,NULL,NULL),(22,21,5,4,'Mechanical',1,1,NULL,NULL),(23,21,5,4,'Hydraulic',1,1,NULL,NULL),(24,1,2,4,'Ejector Nut Threading M:',1,1,NULL,NULL),(25,1,2,4,'Cores',1,1,NULL,NULL),(26,1,1,4,'Hot Runner',1,1,NULL,NULL),(27,26,2,4,'Zones',1,1,NULL,NULL),(28,1,NULL,4,'Shut Off Nozzles',1,1,NULL,NULL),(29,28,2,4,'Hydraulic',1,1,NULL,NULL),(30,28,2,4,'Pneumatic',1,1,NULL,NULL),(31,28,2,4,'Electric',1,1,NULL,NULL),(32,1,2,4,'Pressure Sensor',1,1,NULL,NULL),(33,1,2,4,'Temperature Sensor',1,1,NULL,NULL),(34,1,1,4,'Cooling',1,1,NULL,NULL),(35,34,8,4,'Fixed Side',1,1,NULL,NULL),(36,35,2,4,'Circuits',1,1,NULL,NULL),(37,35,2,4,'Bridge',1,1,NULL,NULL),(38,35,2,4,'Sequential',1,1,NULL,NULL),(39,35,8,4,'Thermoregulator',1,1,NULL,NULL),(40,34,8,4,'Moving Side',1,1,NULL,NULL),(41,40,2,4,'Circuits',1,1,NULL,NULL),(42,40,2,4,'Bridge',1,1,NULL,NULL),(43,40,2,4,'Sequential',1,1,NULL,NULL),(44,40,8,4,'Thermoregulator',1,1,NULL,NULL),(45,1,NULL,4,'Operating Mode',1,1,NULL,NULL),(46,40,5,4,'Auto',1,1,NULL,NULL),(47,40,5,4,'Semi Auto',1,1,NULL,NULL),(48,1,1,4,'Cinematic',1,1,NULL,NULL),(49,1,1,4,'Mold Cavity Side',1,1,NULL,NULL),(50,1,1,4,'Mold Core Side',1,1,NULL,NULL),(51,NULL,NULL,1,'Imm',1,1,NULL,NULL),(52,51,3,1,'Screw Diameter',3,1,NULL,NULL),(53,51,NULL,1,'Nozzle',3,1,NULL,NULL),(54,53,2,1,'Radius',1,1,NULL,NULL),(55,53,3,1,'Diameter',1,1,NULL,1),(56,51,NULL,1,'Ejector Tail',1,1,NULL,NULL),(57,56,3,1,'Length',1,1,NULL,NULL),(58,56,3,1,'Diameter',1,1,NULL,NULL),(59,56,2,1,'Threading M:',1,1,NULL,NULL),(60,NULL,NULL,3,'Material',1,1,NULL,NULL),(61,60,5,3,'Material Type',3,1,NULL,NULL),(62,61,5,3,'Reference',1,1,NULL,NULL),(63,61,9,3,'Colorant',1,1,NULL,1),(64,61,5,3,'Adjuvant',1,1,NULL,NULL),(65,61,5,3,'Batch',1,1,NULL,NULL),(66,61,9,3,'Recycled Material',1,1,NULL,2),(67,61,8,3,'Drying',1,1,NULL,NULL),(68,67,11,3,'Time',1,1,NULL,1),(69,61,5,3,'Fluidity Index',1,1,NULL,NULL),(70,NULL,14,2,'Robot',1,1,NULL,NULL),(71,70,5,2,'Type',1,1,NULL,NULL),(72,70,5,2,'Programme Number',1,1,NULL,NULL),(73,70,1,2,'Gripper',1,1,NULL,NULL),(74,73,1,2,'Air And Electrical Connection',1,1,NULL,NULL),(75,73,2,2,'Vacuum',1,1,NULL,NULL),(76,73,2,2,'Air Circuits',1,1,NULL,NULL),(77,70,9,2,'Speed',1,1,NULL,NULL),(78,70,5,2,'Camera',1,1,NULL,NULL),(79,NULL,NULL,1,'Settings',1,1,NULL,NULL),(80,79,1,1,'Cycle Grafcet',1,1,NULL,NULL),(81,79,NULL,1,'Mold Closing',1,1,NULL,NULL),(82,81,10,1,'Pressure',6,1,NULL,NULL),(83,81,9,1,'Speed',6,1,NULL,NULL),(84,81,3,1,'Steps',6,1,NULL,NULL),(85,81,3,1,'Protection Stroke',1,1,NULL,NULL),(86,85,10,1,'Pressure',1,1,NULL,NULL),(87,85,9,1,'Speed',1,1,NULL,NULL),(88,85,12,1,'Time',1,1,NULL,NULL),(89,81,3,1,'End Of Mold Protection Toggle',1,1,NULL,NULL),(90,81,4,1,'Clamping Force',1,1,NULL,NULL),(91,81,4,1,'Actual Clamping Force',1,1,NULL,NULL),(92,79,NULL,1,'Mold Opening',1,1,NULL,NULL),(93,92,3,1,'Opening Stroke',1,1,NULL,NULL),(94,92,10,1,'Pressure',6,1,NULL,NULL),(95,92,9,1,'Speed',6,1,NULL,NULL),(96,92,3,1,'Steps',6,1,NULL,NULL),(97,92,NULL,1,'Decompression Stroke',1,1,NULL,NULL),(98,97,10,1,'Pressure',1,1,NULL,NULL),(99,97,9,1,'Speed',1,1,NULL,NULL),(100,97,3,1,'Stroke',1,1,NULL,NULL),(101,92,NULL,1,'Nut Closing',1,1,NULL,NULL),(102,101,10,1,'Pressure',1,1,NULL,NULL),(103,101,9,1,'Speed',1,1,NULL,NULL),(104,92,NULL,1,'Nut Opening',1,1,NULL,NULL),(105,104,10,1,'Pressure',1,1,NULL,NULL),(106,104,9,1,'Speed',1,1,NULL,NULL),(107,92,5,1,'Mold Spring Using',1,1,NULL,NULL),(108,92,12,1,'Real Cycle Time',1,1,NULL,2),(109,92,3,1,'Mini Opening Stroke For Robot',1,1,NULL,NULL),(110,79,14,1,'Ejection',1,1,NULL,NULL),(111,110,NULL,1,'Ejector In',1,1,NULL,NULL),(112,111,10,1,'Pressure',3,1,NULL,NULL),(113,111,9,1,'Speed',3,1,NULL,NULL),(114,111,3,1,'Stroke',3,1,NULL,NULL),(115,111,3,1,'Rear Position',1,1,NULL,NULL),(116,111,3,1,'Ejector Position Start',1,1,NULL,NULL),(117,110,NULL,1,'Ejector Out',1,1,NULL,NULL),(118,117,10,1,'Pressure',3,1,NULL,NULL),(119,117,9,1,'Speed',3,1,NULL,NULL),(120,117,3,1,'Stroke',3,1,NULL,NULL),(121,117,12,1,'Ejector Time Forward',1,1,NULL,NULL),(122,117,2,1,'Ejector Counter',1,1,NULL,NULL),(123,110,12,1,'Ejection Delay',1,1,NULL,2),(124,79,NULL,1,'Cores',10,1,NULL,NULL),(125,124,NULL,1,'Core In',1,1,NULL,NULL),(126,125,10,1,'Pressure',1,1,NULL,NULL),(127,125,9,1,'Speed',1,1,NULL,NULL),(128,125,2,1,'Priority',1,1,NULL,NULL),(129,125,3,1,'Position',1,1,NULL,NULL),(130,125,3,1,'Start Mold Position',1,1,NULL,NULL),(131,125,3,1,'Mold Control Point',1,1,NULL,NULL),(132,125,2,1,'In Priority',1,1,NULL,NULL),(133,125,5,1,'Without Pressure After Entry',1,1,NULL,NULL),(134,125,5,1,'Without Robot Authorisation',1,1,NULL,NULL),(135,125,5,1,'Time Variable',1,1,NULL,NULL),(136,135,12,1,'Entry Time',1,1,NULL,NULL),(137,135,12,1,'Monitoring Time',1,1,NULL,NULL),(138,125,5,1,'Superimposed On Mold Movement',1,1,NULL,NULL),(139,125,5,1,'Demoulding With Core',1,1,NULL,NULL),(140,125,5,1,'Unscrewing Core',1,1,NULL,NULL),(141,124,NULL,1,'Core Out',1,1,NULL,NULL),(142,141,10,1,'Pressure',1,1,NULL,NULL),(143,141,9,1,'Speed',1,1,NULL,NULL),(144,141,2,1,'Priority',1,1,NULL,NULL),(145,141,3,1,'Position',1,1,NULL,NULL),(146,141,3,1,'Start Mold Position',1,1,NULL,NULL),(147,141,3,1,'Mold Control Point',1,1,NULL,NULL),(148,141,2,1,'Out Priority',1,1,NULL,NULL),(149,141,5,1,'Without Pressure After Entry',1,1,NULL,NULL),(150,141,5,1,'Without Robot Authorisation',1,1,NULL,NULL),(151,141,5,1,'Time Variable',1,1,NULL,NULL),(152,151,12,1,'Exit Time',1,1,NULL,NULL),(153,151,12,1,'Monitoring Time',1,1,NULL,NULL),(154,141,5,1,'Superimposed On Mold Movement',1,1,NULL,NULL),(155,141,5,1,'During Cooling Time',1,1,NULL,NULL),(156,153,12,1,'Time',1,1,NULL,NULL),(157,141,5,1,'After Ejection Forward',1,1,NULL,NULL),(158,141,5,1,'Unscrewing Core',1,1,NULL,NULL),(159,79,NULL,1,'Cooling',1,1,NULL,NULL),(160,159,5,1,'Fixed Side Zones',30,1,NULL,NULL),(161,160,13,1,'Flow',1,1,NULL,NULL),(162,160,1,1,'Water Box',1,1,NULL,NULL),(163,159,5,1,'Moving Side Zones',30,1,NULL,NULL),(164,163,13,1,'Flow',1,1,NULL,NULL),(165,163,1,1,'Water Box',1,1,NULL,NULL),(166,79,14,1,'Rotating Plate',1,1,NULL,NULL),(167,166,5,1,'Actuation During Mold Closing',1,1,NULL,NULL),(168,166,3,1,'Mold Position Actuation Stop',1,1,NULL,NULL),(169,166,5,1,'Service Mode',1,1,NULL,NULL),(170,166,NULL,1,'Direction',1,1,NULL,NULL),(171,170,NULL,1,'Rotating Speed',1,1,NULL,NULL),(172,171,9,1,'Left',1,1,NULL,NULL),(173,171,9,1,'Right',1,1,NULL,NULL),(174,170,NULL,1,'Time',1,1,NULL,NULL),(175,174,12,1,'Left',1,1,NULL,NULL),(176,174,12,1,'Right',1,1,NULL,NULL),(177,166,NULL,1,'Station',1,1,NULL,NULL),(178,177,NULL,1,'Final Position Of Stroke Sensor',1,1,NULL,NULL),(179,178,3,1,'Left',1,1,NULL,NULL),(180,178,3,1,'Right',1,1,NULL,NULL),(181,177,NULL,1,'Breaking Stroke',1,1,NULL,NULL),(182,181,3,1,'Left',1,1,NULL,NULL),(183,181,3,1,'Right',1,1,NULL,NULL),(184,79,NULL,1,'Cylinders Temperature',3,1,NULL,NULL),(185,184,8,1,'Zones',9,1,NULL,NULL),(186,185,8,1,'Mini Tolerance',1,1,NULL,NULL),(187,185,8,1,'Maxi Tolerance',1,1,NULL,NULL),(188,184,8,1,'Injection Unit Alimentation',1,1,NULL,NULL),(189,184,8,1,'Mass Temperature',1,1,NULL,NULL),(190,184,8,1,'Standby Temperature',1,1,NULL,NULL),(191,79,NULL,1,'Oil Machine Temperature',1,1,NULL,NULL),(192,191,8,1,'Set Value',1,1,NULL,NULL),(193,191,8,1,'Actual',1,1,NULL,NULL),(194,79,NULL,1,'Hot Runner Temperature',1,1,NULL,NULL),(195,194,5,1,'Imm',80,1,NULL,NULL),(196,195,8,1,'Zones',1,1,NULL,NULL),(197,195,9,1,'Average Consumption Of Nozzles',1,1,NULL,NULL),(198,194,5,1,'External Regulator',80,1,NULL,NULL),(199,198,8,1,'Zones',1,1,NULL,NULL),(200,198,9,1,'Average Consumption Of Nozzles',1,1,NULL,NULL),(201,79,NULL,1,'Injection Unit',1,1,NULL,NULL),(202,201,3,1,'Advance Stroke Unit',2,1,NULL,NULL),(203,202,9,1,'Speed',1,1,NULL,NULL),(204,202,10,1,'Pressure',1,1,NULL,NULL),(205,201,3,1,'Backward Stroke Unit',2,1,NULL,NULL),(206,205,9,1,'Speed',1,1,NULL,NULL),(207,205,10,1,'Pressure',1,1,NULL,NULL),(208,201,10,1,'Application Pressure',1,1,NULL,NULL),(209,201,12,1,'Pressure Rise Time',1,1,NULL,NULL),(210,79,NULL,1,'Injection Parameters',1,1,NULL,NULL),(211,210,NULL,1,'Switchover',3,1,NULL,NULL),(212,211,NULL,1,'Switch Over Mode',1,1,NULL,NULL),(213,212,15,1,'Stroke',1,1,NULL,NULL),(214,212,10,1,'Pressure',1,1,NULL,NULL),(215,212,12,1,'Time',1,1,NULL,1),(216,212,10,1,'Internal Mold Pressure',1,1,NULL,NULL),(217,212,15,1,'Mask',1,1,NULL,NULL),(218,211,10,1,'Switch Over Pressure',1,1,NULL,NULL),(219,211,5,1,'Specific Injection Pressure Increased',1,1,NULL,NULL),(220,211,12,1,'Delay Injection Time',1,1,NULL,2),(221,211,16,1,'Injection Speed',1,1,NULL,NULL),(222,211,NULL,1,'Injection Profile',1,1,NULL,NULL),(223,222,16,1,'Step',10,1,NULL,NULL),(224,222,12,1,'Injection Time',1,1,NULL,2),(225,222,10,1,'Limit Injection Pressure',1,1,NULL,NULL),(226,211,NULL,1,'Holding Pressure',1,1,NULL,NULL),(227,226,10,1,'Step',10,1,NULL,NULL),(228,226,12,1,'Holding Time',1,1,NULL,1),(229,211,15,1,'Cushion',1,1,NULL,NULL),(230,211,12,1,'Cooling Time',1,1,NULL,1),(231,79,14,1,'Intrusion Injection',1,1,NULL,NULL),(232,231,12,1,'Time',1,1,NULL,2),(233,231,9,1,'Speed',1,1,NULL,NULL),(234,79,12,1,'Injection Time',3,1,NULL,2),(235,79,1,1,'Filling Progression',1,1,NULL,NULL),(236,79,3,1,'Valve Gate Screw Etancheity Test',1,1,NULL,NULL),(237,79,NULL,1,'Dosing',3,1,NULL,NULL),(238,237,15,1,'Dosing Volume',1,1,NULL,NULL),(239,237,10,1,'Back Pressure',8,1,NULL,NULL),(240,237,12,1,'Delay Dosing Time',1,1,NULL,1),(241,237,12,1,'Dosing Time',1,1,NULL,2),(242,237,15,1,'Decompression',1,1,NULL,NULL),(243,237,16,1,'Decompression Speed',1,1,NULL,NULL),(244,237,10,1,'Decompression Pressure',1,1,NULL,NULL),(245,237,9,1,'Dosing Speed',6,1,NULL,NULL),(246,237,5,1,'Decompression Before Dosing',1,1,NULL,NULL),(247,246,3,1,'Stroke',1,1,NULL,NULL),(248,246,16,1,'Speed',1,1,NULL,NULL),(249,79,17,1,'Shut Off Nozzles Type',1,1,NULL,NULL),(250,79,NULL,1,'Shut Off Nozzles',24,1,NULL,NULL),(251,250,NULL,1,'Injection',1,1,NULL,NULL),(252,251,NULL,1,'Opening',1,1,NULL,NULL),(253,252,15,1,'Volume',1,1,NULL,NULL),(254,252,3,1,'Stroke',1,1,NULL,NULL),(255,252,12,1,'Time',1,1,NULL,NULL),(256,252,8,1,'Temperature',1,1,NULL,NULL),(257,251,NULL,1,'Closing',1,1,NULL,NULL),(258,257,15,1,'Volume',1,1,NULL,NULL),(259,257,3,1,'Stroke',1,1,NULL,NULL),(260,257,12,1,'Time',1,1,NULL,NULL),(261,257,8,1,'Temperature',1,1,NULL,NULL),(262,250,NULL,1,'Holding',1,1,NULL,NULL),(263,262,12,1,'Time',1,1,NULL,NULL),(264,262,12,1,'Delay',1,1,NULL,NULL),(265,79,14,1,'Monitoring Of Parameters',1,1,NULL,NULL),(266,265,12,1,'Cycle Time',1,1,NULL,2),(267,266,12,1,'Maxi Tolerance',1,1,NULL,1),(268,266,12,1,'Mini Tolerance',1,1,NULL,1),(269,265,NULL,1,'Dosing Time',1,1,NULL,NULL),(270,269,12,1,'Maxi Tolerance',1,1,NULL,1),(271,269,12,1,'Mini Tolerance',1,1,NULL,1),(272,265,NULL,1,'Injection Time',1,1,NULL,NULL),(273,272,12,1,'Maxi Tolerance',1,1,NULL,1),(274,272,12,1,'Mini Tolerance',1,1,NULL,1),(275,265,NULL,1,'Cushion',1,1,NULL,NULL),(276,275,3,1,'Maxi Tolerance',1,1,NULL,1),(277,275,3,1,'Mini Tolerance',1,1,NULL,1),(278,265,NULL,1,'Switchover Point Pressure',1,1,NULL,NULL),(279,278,10,1,'Maxi Tolerance',1,1,NULL,NULL),(280,278,10,1,'Mini Tolerance',1,1,NULL,NULL),(281,265,NULL,1,'Injection Pressure Maximum',1,1,NULL,NULL),(282,281,10,1,'Maxi Tolerance',1,1,NULL,NULL),(283,281,10,1,'Mini Tolerance',1,1,NULL,NULL),(284,79,14,1,'Babyplast',1,1,NULL,NULL),(285,284,8,1,'Temperature',4,1,NULL,NULL),(286,284,3,1,'Dosing',1,1,NULL,1),(287,284,12,1,'Cooling Time',1,1,NULL,1),(288,284,10,1,'1st Injection Pressure',1,1,NULL,NULL),(289,284,12,1,'Timeout Pressure Change',1,1,NULL,1),(290,284,10,1,'2nd Injection Pressure',1,1,NULL,NULL),(291,284,12,1,'2nd Injection Pressure Time',1,1,NULL,NULL),(292,284,3,1,'2nd Pressure Position',1,1,NULL,1),(293,284,3,1,'Decompression',1,1,NULL,1),(294,284,9,1,'Injection Speed',1,1,NULL,1),(295,284,9,1,'2nd Injection Speed',1,1,NULL,NULL),(296,284,3,1,'2nd Injection Speed Position',1,1,NULL,NULL),(297,284,12,1,'End Of Cycle Break Time',1,1,NULL,1),(298,284,12,1,'Mold Shut Off Nozzle Delay',1,1,NULL,1),(299,284,12,1,'Mold Shut Off Nozzle Time',1,1,NULL,1),(300,79,NULL,1,'Pneumatic Valve',4,1,NULL,NULL),(301,300,2,1,'Function',1,1,NULL,NULL),(302,301,5,1,'Mold Closing After Position',1,1,NULL,NULL),(303,301,5,1,'Injection Start',1,1,NULL,NULL),(304,301,5,1,'Cooling Time Start',1,1,NULL,NULL),(305,301,5,1,'Mold Opening After Position',1,1,NULL,NULL),(306,300,3,1,'Air Supply Flow Position',1,1,NULL,NULL),(307,300,12,1,'Blowing Time Delay',1,1,NULL,1),(308,300,12,1,'Blowing Time',1,1,NULL,1),(309,79,14,1,'Gaz Injection',1,1,NULL,NULL),(310,309,NULL,1,'Circuit',4,1,NULL,NULL),(311,310,12,1,'Gaz Delay',1,1,NULL,1),(312,310,10,1,'Pressure',4,1,NULL,NULL),(313,310,12,1,'Holding Time',4,1,NULL,1),(314,310,18,1,'Ramp',4,1,NULL,NULL),(315,NULL,1,5,'Parts',1,1,NULL,NULL),(316,315,NULL,5,'Weight',1,1,NULL,NULL),(317,316,NULL,5,'Part',16,1,NULL,NULL),(318,317,5,5,'Description',1,1,NULL,NULL),(319,317,19,5,'Weight',1,1,NULL,2),(320,317,19,5,'Weight Without Holding',1,1,NULL,2),(321,316,19,5,'Sprues',1,1,NULL,2),(322,316,19,5,'Total',1,1,NULL,2),(323,316,19,5,'Total Without Holding',1,1,NULL,2);
/*!40000 ALTER TABLE `indicator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `iteration` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9F74B89894A4C7D4` (`device_id`),
  KEY `IDX_9F74B8984402854A` (`indicator_id`),
  CONSTRAINT `FK_9F74B8984402854A` FOREIGN KEY (`indicator_id`) REFERENCES `indicator` (`id`),
  CONSTRAINT `FK_9F74B89894A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_of_device`
--

DROP TABLE IF EXISTS `type_of_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_of_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_of_device`
--

LOCK TABLES `type_of_device` WRITE;
/*!40000 ALTER TABLE `type_of_device` DISABLE KEYS */;
INSERT INTO `type_of_device` VALUES (1,'IMM'),(2,'Robot'),(3,'Material'),(4,'Mold'),(5,'Part');
/*!40000 ALTER TABLE `type_of_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'photo','Photo'),(2,'nb','Number'),(3,'mm','Millimeters'),(4,'kN','KiloNewtons'),(5,'txt','Text value'),(6,'kg','Kilograms'),(7,'hand-drawing','Hand-drawing'),(8,'°C','Celsius'),(9,'%','Percent'),(10,'bars','Bars'),(11,'hour','Hours'),(12,'s','Seconds'),(13,'L/mn','Liters per minute'),(14,'bool','Boolean'),(15,'cm3','Centimeters Cube'),(16,'mm/s','Millimeters per second'),(17,'Hydraulic OR Pneumatic','Hydraulic / Pneumatic'),(18,'bars/s','Bars per second'),(19,'g','Grams');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-07  3:28:09
