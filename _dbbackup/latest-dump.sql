-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: time
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
-- Table structure for table `activity`
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
INSERT INTO `generic_business_unit` VALUES (1,'WSE','Auger, Frederic','business_unit','#ff8080'),(2,'CRM','van der Weijden, Willem','business_unit','#80ff80'),(3,'SO','van der Weijden, Willem','business_unit',''),(4,'TC','Lemasson, Francois-Xavier','business_unit','#ffc080');
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
  PRIMARY KEY (`id`),
  KEY `IDX_EE3DEB3738248176` (`currency_id`),
  CONSTRAINT `FK_EE3DEB3738248176` FOREIGN KEY (`currency_id`) REFERENCES `generic_currency` (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `current_rate` double NOT NULL,
  `dtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_currency`
--

LOCK TABLES `generic_currency` WRITE;
/*!40000 ALTER TABLE `generic_currency` DISABLE KEYS */;
INSERT INTO `generic_currency` VALUES (1,'United Arab Emirates Dirham','AED',4.1024575653093,'currency'),(2,'Afghan Afghani','AFN',76.074543429869,'currency'),(3,'Albanian Lek','ALL',98.760646787674,'currency'),(4,'Armenian Dram','AMD',432.34565745987,'currency'),(5,'Netherlands Antillean Guilder','ANG',2.0126893603048,'currency'),(6,'Angolan Kwanza','AOA',1052.5508473535,'currency'),(7,'Argentine Peso','ARS',1078.5443591488,'currency'),(8,'Australian Dollar','AUD',1.6143064411823,'currency'),(9,'Aruban Florin','AWG',2.0132534063354,'currency'),(10,'Azerbaijani Manat','AZN',1.8987688159613,'currency'),(11,'Bosnia-Herzegovina Convertible Mark','BAM',1.9564534125902,'currency'),(12,'Barbadian Dollar','BBD',2.2338456658368,'currency'),(13,'Bangladeshi Taka','BDT',133.44453752135,'currency'),(14,'Bulgarian Lev','BGN',1.9559072373249,'currency'),(15,'Bahraini Dinar','BHD',0.42062085272591,'currency'),(16,'Burundian Franc','BIF',3232.9942880566,'currency'),(17,'Bermudan Dollar','BMD',1.1169228329184,'currency'),(18,'Brunei Dollar','BND',1.4325618747326,'currency'),(19,'Bolivian Boliviano','BOB',7.7170599910423,'currency'),(20,'Brazilian Real','BRL',6.0701405200616,'currency'),(21,'Bahamian Dollar','BSD',1.1169228329184,'currency'),(22,'Bitcoin','BTC',0.000017022042472108,'currency'),(23,'Bhutanese Ngultrum','BTN',93.452306836573,'currency'),(24,'Botswanan Pula','BWP',14.59898449376,'currency'),(25,'Belarusian Ruble','BYN',3.6545201308587,'currency'),(26,'Belize Dollar','BZD',2.2510920712999,'currency'),(27,'Canadian Dollar','CAD',1.5089605134271,'currency'),(28,'Congolese Franc','CDF',3187.4853197247,'currency'),(29,'Swiss Franc','CHF',0.93983136699069,'currency'),(30,'Chilean Unit of Account (UF)','CLF',0.036440724346796,'currency'),(31,'Chilean Peso','CLP',1005.5097803348,'currency'),(32,'Chinese Yuan (Offshore)','CNH',7.7934742666564,'currency'),(33,'Chinese Yuan','CNY',7.8310810584408,'currency'),(34,'Colombian Peso','COP',4641.139603068,'currency'),(35,'Costa Rican Colón','CRC',579.63742339306,'currency'),(36,'Cuban Convertible Peso','CUC',1.1169228329184,'currency'),(37,'Cuban Peso','CUP',28.760762947649,'currency'),(38,'Cape Verdean Escudo','CVE',110.52292763345,'currency'),(39,'Czech Republic Koruna','CZK',25.137954489862,'currency'),(40,'Djiboutian Franc','DJF',198.54685770515,'currency'),(41,'Danish Krone','DKK',7.4568002171298,'currency'),(42,'Dominican Peso','DOP',67.300985014246,'currency'),(43,'Algerian Dinar','DZD',147.5528477623,'currency'),(44,'Egyptian Pound','EGP',53.966695594968,'currency'),(45,'Eritrean Nakfa','ERN',16.753842493776,'currency'),(46,'Ethiopian Birr','ETB',132.15766929479,'currency'),(47,'Euro','EUR',1,'currency'),(48,'Fijian Dollar','FJD',2.4444973121252,'currency'),(49,'Falkland Islands Pound','FKP',0.83460271613295,'currency'),(50,'British Pound Sterling','GBP',0.83460271613295,'currency'),(51,'Georgian Lari','GEL',3.038030105538,'currency'),(52,'Guernsey Pound','GGP',0.83460271613295,'currency'),(53,'Ghanaian Cedi','GHS',17.605536363098,'currency'),(54,'Gibraltar Pound','GIP',0.83460271613295,'currency'),(55,'Gambian Dalasi','GMD',76.50921405491,'currency'),(56,'Guinean Franc','GNF',9642.6609692433,'currency'),(57,'Guatemalan Quetzal','GTQ',8.6383861805372,'currency'),(58,'Guyanaese Dollar','GYD',233.61257186002,'currency'),(59,'Hong Kong Dollar','HKD',8.6823102878645,'currency'),(60,'Honduran Lempira','HNL',27.783552641132,'currency'),(61,'Croatian Kuna','HRK',7.534878707765,'currency'),(62,'Haitian Gourde','HTG',147.17704008748,'currency'),(63,'Hungarian Forint','HUF',396.9090188168,'currency'),(64,'Indonesian Rupiah','IDR',16892.910584743,'currency'),(65,'Israeli New Sheqel','ILS',4.1342027460665,'currency'),(66,'Manx pound','IMP',0.83460271613295,'currency'),(67,'Indian Rupee','INR',93.505037880438,'currency'),(68,'Iraqi Dinar','IQD',1463.0533721576,'currency'),(69,'Iranian Rial','IRR',47028.035880029,'currency'),(70,'Icelandic Króna','ISK',150.9074439556,'currency'),(71,'Jersey Pound','JEP',0.83460271613295,'currency'),(72,'Jamaican Dollar','JMD',175.44854950816,'currency'),(73,'Jordanian Dinar','JOD',0.79156321168927,'currency'),(74,'Japanese Yen','JPY',159.49779053676,'currency'),(75,'Kenyan Shilling','KES',144.08304544647,'currency'),(76,'Kyrgystani Som','KGS',94.044902531729,'currency'),(77,'Cambodian Riel','KHR',4537.0467890144,'currency'),(78,'Comorian Franc','KMF',493.26117676756,'currency'),(79,'North Korean Won','KPW',1005.2305496266,'currency'),(80,'South Korean Won','KRW',1463.5034630192,'currency'),(81,'Kuwaiti Dinar','KWD',0.34052073176316,'currency'),(82,'Cayman Islands Dollar','KYD',0.93068600283475,'currency'),(83,'Kazakhstani Tenge','KZT',535.66756132186,'currency'),(84,'Laotian Kip','LAK',24661.2052167,'currency'),(85,'Lebanese Pound','LBP',100000.25042639,'currency'),(86,'Sri Lankan Rupee','LKR',333.45117539374,'currency'),(87,'Liberian Dollar','LRD',216.36451446806,'currency'),(88,'Lesotho Loti','LSL',19.184778128864,'currency'),(89,'Libyan Dinar','LYD',5.29574664616,'currency'),(90,'Moroccan Dirham','MAD',10.830034501746,'currency'),(91,'Moldovan Leu','MDL',19.418407111671,'currency'),(92,'Malagasy Ariary','MGA',5067.4775425911,'currency'),(93,'Macedonian Denar','MKD',61.581470026817,'currency'),(94,'Myanma Kyat','MMK',2343.3041034628,'currency'),(95,'Mongolian Tugrik','MNT',3795.3037862567,'currency'),(96,'Macanese Pataca','MOP',8.9428459417167,'currency'),(97,'Mauritanian Ouguiya (pre-2018)','MRO',402.78068637472,'currency'),(98,'Mauritanian Ouguiya','MRU',44.278969348287,'currency'),(99,'Mauritian Rupee','MUR',51.3226041726,'currency'),(100,'Maldivian Rufiyaa','MVR',17.155934713627,'currency'),(101,'Malawian Kwacha','MWK',1937.4733061028,'currency'),(102,'Mexican Peso','MXN',21.939181317902,'currency'),(103,'Malaysian Ringgit','MYR',4.6033974558732,'currency'),(104,'Mozambican Metical','MZN',71.34343701728,'currency'),(105,'Namibian Dollar','NAD',19.184778128864,'currency'),(106,'Nigerian Naira','NGN',1862.591685403,'currency'),(107,'Nicaraguan Córdoba','NIO',41.097334240275,'currency'),(108,'Norwegian Krone','NOK',11.715108726853,'currency'),(109,'Nepalese Rupee','NPR',149.52058432935,'currency'),(110,'New Zealand Dollar','NZD',1.759002677264,'currency'),(111,'Omani Rial','OMR',0.42960649691673,'currency'),(112,'Panamanian Balboa','PAB',1.1169228329184,'currency'),(113,'Peruvian Nuevo Sol','PEN',4.1723557131161,'currency'),(114,'Papua New Guinean Kina','PGK',4.4395270055187,'currency'),(115,'Philippine Peso','PHP',62.653790780249,'currency'),(116,'Pakistani Rupee','PKR',310.0671292961,'currency'),(117,'Polish Zloty','PLN',4.275538161344,'currency'),(118,'Paraguayan Guarani','PYG',8716.9558067143,'currency'),(119,'Qatari Rial','QAR',4.0674811267964,'currency'),(120,'Romanian Leu','RON',4.9763379897846,'currency'),(121,'Serbian Dinar','RSD',117.09812167087,'currency'),(122,'Russian Ruble','RUB',105.26625876645,'currency'),(123,'Rwandan Franc','RWF',1501.0506960105,'currency'),(124,'Saudi Riyal','SAR',4.1879245004842,'currency'),(125,'Solomon Islands Dollar','SBD',9.2620200442972,'currency'),(126,'Seychellois Rupee','SCR',14.801738378697,'currency'),(127,'Sudanese Pound','SDG',671.82908400042,'currency'),(128,'Swedish Krona','SEK',11.265278108201,'currency'),(129,'Singapore Dollar','SGD',1.4302018167867,'currency'),(130,'Saint Helena Pound','SHP',0.83460271613295,'currency'),(131,'Sierra Leonean Leone','SLL',23421.313344882,'currency'),(132,'Somali Shilling','SOS',638.05565403092,'currency'),(133,'Surinamese Dollar','SRD',34.290089432011,'currency'),(134,'South Sudanese Pound','SSP',145.49036821595,'currency'),(135,'São Tomé and Príncipe Dobra (pre-2018)','STD',24887.051178521,'currency'),(136,'São Tomé and Príncipe Dobra','STN',24.756319828619,'currency'),(137,'Salvadoran Colón','SVC',9.7712620222781,'currency'),(138,'Syrian Pound','SYP',2806.3021253925,'currency'),(139,'Swazi Lilangeni','SZL',19.181237483484,'currency'),(140,'Thai Baht','THB',36.165961329898,'currency'),(141,'Tajikistani Somoni','TJS',11.882510887205,'currency'),(142,'Turkmenistani Manat','TMT',3.9092299152144,'currency'),(143,'Tunisian Dinar','TND',3.3911352068597,'currency'),(144,'Tongan Pa\'anga','TOP',2.6091764146107,'currency'),(145,'Turkish Lira','TRY',38.176139847674,'currency'),(146,'Trinidad and Tobago Dollar','TTD',7.5861097242653,'currency'),(147,'New Taiwan Dollar','TWD',35.283592291892,'currency'),(148,'Tanzanian Shilling','TZS',3049.1993338672,'currency'),(149,'Ukrainian Hryvnia','UAH',45.972445513712,'currency'),(150,'Ugandan Shilling','UGX',4125.6992294349,'currency'),(151,'United States Dollar','USD',1.1169228329184,'currency'),(152,'Uruguayan Peso','UYU',46.729009948432,'currency'),(153,'Uzbekistan Som','UZS',14224.457003497,'currency'),(154,'Venezuelan Bolívar Fuerte (Old)','VEF',300813.19508676,'currency'),(155,'Venezuelan Bolívar Soberano','VES',41.171935750131,'currency'),(156,'Vietnamese Dong','VND',27486.739548115,'currency'),(157,'Vanuatu Vatu','VUV',132.60331256974,'currency'),(158,'Samoan Tala','WST',3.1273839321715,'currency'),(159,'CFA Franc BEAC','XAF',655.95720286781,'currency'),(160,'Silver Ounce','XAG',0.03517845634563,'currency'),(161,'Gold Ounce','XAU',0.00041931516993422,'currency'),(162,'East Caribbean Dollar','XCD',3.0185398021036,'currency'),(163,'Special Drawing Rights','XDR',0.82612415490826,'currency'),(164,'CFA Franc BCEAO','XOF',655.95720286781,'currency'),(165,'Palladium Ounce','XPD',0.0010997110520631,'currency'),(166,'CFP Franc','XPF',119.33177857675,'currency'),(167,'Platinum Ounce','XPT',0.0011105675419991,'currency'),(168,'Yemeni Rial','YER',279.59374835952,'currency'),(169,'South African Rand','ZAR',19.102664196033,'currency'),(170,'Zambian Kwacha','ZMW',29.533709289559,'currency'),(171,'Zimbabwean Dollar','ZWL',359.64915219972,'currency');
/*!40000 ALTER TABLE `generic_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_language`
--

DROP TABLE IF EXISTS `generic_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `dtype` varchar(255) NOT NULL,
  `right_to_left` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=latin1;
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `user` varchar(255) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `dtype` varchar(255) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14301 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_log`
--


--
-- Table structure for table `generic_material`
--

DROP TABLE IF EXISTS `generic_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_material`
--

LOCK TABLES `generic_material` WRITE;
/*!40000 ALTER TABLE `generic_material` DISABLE KEYS */;
INSERT INTO `generic_material` VALUES (1,'Plastic','site'),(2,'Leather','site');
/*!40000 ALTER TABLE `generic_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_site`
--

DROP TABLE IF EXISTS `generic_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_unit_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ldap_ip` varchar(15) DEFAULT NULL,
  `ldap_domain` varchar(255) DEFAULT NULL,
  `ldap_ou` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `dtype` varchar(255) NOT NULL,
  `signatory` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `default_language_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5339E577A58ECB40` (`business_unit_id`),
  KEY `IDX_5339E577F92F3E70` (`country_id`),
  KEY `IDX_5339E5775602A942` (`default_language_id`),
  CONSTRAINT `FK_5339E5775602A942` FOREIGN KEY (`default_language_id`) REFERENCES `generic_language` (`id`),
  CONSTRAINT `FK_5339E577A58ECB40` FOREIGN KEY (`business_unit_id`) REFERENCES `generic_business_unit` (`id`),
  CONSTRAINT `FK_5339E577F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `generic_country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_site`
--

LOCK TABLES `generic_site` WRITE;
/*!40000 ALTER TABLE `generic_site` DISABLE KEYS */;
INSERT INTO `generic_site` VALUES (1,2,225,'ESA','ES MELLOUSSA','10.51.2.11','dc=gta,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Avelli, Roberto',NULL,NULL,21),(2,2,296,'ESB','ES BANOVCE','10.61.2.33','dc=esb,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Smolka, Vladimir',NULL,NULL,403),(3,1,163,'ESC','ES CHATEAUROUX','10.4.3.18','dc=esc,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Auger, Frederic',NULL,NULL,145),(4,NULL,147,'ESD','ES DEUTSCHLAND',NULL,'dc=esd,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,'2022-12-31',159),(5,1,157,'ESE','ES SPAIN','10.95.2.15','dc=ese,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Gonzalez, Victor',NULL,NULL,420),(6,2,146,'ESH','ES CZECHIA','10.4.200.59','dc=esh,dc=src,dc=local','OU=_Management','EUR','site','Jocham, Wolfgang','2021-03-01',NULL,76),(7,NULL,203,'ESJ','ES JAPON',NULL,'dc=esj,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,129),(8,2,296,'ESK','ES LIPTOVSKY MIKULAS','10.60.0.32','dc=esk,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Odskoc, Jozef',NULL,NULL,403),(9,1,163,'ESL','ES LOGNES','192.168.10.228','dc=plastiqueforme,dc=com','OU=_Management','EUR','site','Robert Carvaillo',NULL,'2020-06-01',145),(10,1,163,'ESM','ES MOLINGES','10.4.200.223','dc=esm,dc=src,dc=local','OU=User','EUR','site','Viry, Joel',NULL,NULL,145),(11,2,277,'ESN','ES KLIN','10.4.200.178','dc=esn,dc=src,dc=local','OU=_MANAGEMENT','RUB','site','Melnikov, Ilya',NULL,NULL,129),(12,4,296,'ESO','ES KOSICE','10.4.1.21','dc=esy,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Zarnay, Jan',NULL,NULL,129),(13,1,270,'ESP','ES PORTUGAL','10.90.2.29','dc=esp,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Ferreira, Abilio',NULL,NULL,365),(14,1,163,'ESS','ES SENS','10.13.1.252','dc=ess,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Badyine, Tarik',NULL,NULL,145),(15,2,225,'EST','ES TANGER','10.51.2.11','dc=gta,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Avelli, Roberto',NULL,NULL,21),(16,1,163,'ESV','ES VALENCIENNES','10.9.1.21','dc=esv,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Braem, Vincent',NULL,NULL,145),(17,NULL,NULL,'ESW','ES KOREA',NULL,'dc=esw,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,243),(18,4,163,'ESY','ES CHATEAUROUX - Tech Center','10.4.1.21','dc=esy,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Marcault, Yves',NULL,NULL,145),(19,NULL,297,'ESZ','ES SLOVENIA',NULL,'dc=esz,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','.',NULL,NULL,405),(20,2,147,'SOW','SO WURZBURG','192.168.7.31','dc=sco,dc=local','OU=_MANAGEMENT','EUR','site','Persak, Dejan',NULL,NULL,159),(21,2,189,'SOB','SO BONYHAD','192.168.19.245','dc=sco-hu,dc=local','OU=_MANAGEMENT','HUF','site','Attila Zemes',NULL,NULL,129),(22,NULL,NULL,'GPL','GMD PLAST','10.4.200.86','dc=src,dc=local','OU=_MANAGEMENT','EUR','site','Lemasson, Francois-Xavier',NULL,NULL,129),(23,4,147,'ESG','ES GERMANY','192.168.7.31','dc=sco,dc=local','OU=_MANAGEMENT','EUR','site','Foertsch, Torsten',NULL,NULL,159),(24,4,276,'ESR','ES ROMANIA','10.4.200.43','dc=esr,dc=src,dc=local','OU=_MANAGEMENT','RON','site','Ionita, Razvan',NULL,NULL,377),(25,4,163,'ELT','ES LOGNES - Tech Center','192.168.10.228','dc=plastiqueforme,dc=com','OU=_MANAGEMENT','EUR','site','Marcault, Yves',NULL,'2022-12-31',145),(26,NULL,NULL,'ITC','Interco',NULL,NULL,NULL,'0','site','Mathorel, Fabrice',NULL,NULL,129),(27,NULL,NULL,'EXT','External','10.4.200.66','dc=esxt,dc=src,dc=local','OU=_MANAGEMENT','EUR','site','External',NULL,NULL,129),(29,2,314,'ESU','ES BURSA','10.4.200.31','dc=esu,dc=src,dc=local','OU=_MANAGEMENT','TRY','site','Ozden, Ozge','2023-11-01',NULL,464);
/*!40000 ALTER TABLE `generic_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_site_materials`
--

DROP TABLE IF EXISTS `generic_site_materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_site_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `dtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3A005691F6BD1646` (`site_id`),
  KEY `IDX_3A005691E308AC6F` (`material_id`),
  CONSTRAINT `FK_3A005691E308AC6F` FOREIGN KEY (`material_id`) REFERENCES `generic_material` (`id`),
  CONSTRAINT `FK_3A005691F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `generic_site` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_site_materials`
--

LOCK TABLES `generic_site_materials` WRITE;
/*!40000 ALTER TABLE `generic_site_materials` DISABLE KEYS */;
INSERT INTO `generic_site_materials` VALUES (1,1,1,'site'),(2,2,1,'site'),(3,3,1,'site'),(4,5,1,'site'),(5,6,1,'site'),(6,8,1,'site'),(7,9,1,'site'),(8,10,1,'site'),(9,11,1,'site'),(10,12,1,'site'),(11,13,1,'site'),(12,14,1,'site'),(13,15,1,'site'),(14,16,1,'site'),(15,18,1,'site'),(16,20,2,'site'),(17,21,2,'site');
/*!40000 ALTER TABLE `generic_site_materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_user_access`
--

DROP TABLE IF EXISTS `generic_user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `entity_field` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `deny` tinyint(1) DEFAULT NULL,
  `read_only` tinyint(1) DEFAULT NULL,
  `dtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `job`
--

/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-30  3:04:00
