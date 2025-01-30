-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esscada`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `idsites` int(11) NOT NULL,
  `SiteRef` varchar(50) NOT NULL,
  `SiteSAPCode` varchar(10) DEFAULT NULL,
  `SiteDescription` varchar(50) DEFAULT NULL,
  `SiteSort` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`idsites`, `SiteRef`, `SiteSAPCode`, `SiteDescription`, `SiteSort`) VALUES
(30, 'ESC', 'CHTX', 'FR - ChÃ¢teauroux', 10),
(110, 'ESA', 'ES19', 'MA - Melloussa', 3),
(120, 'ESB', 'ES17', 'SK - Banovce', 7),
(140, 'ESE', 'ESE', 'ES - Aguilar de Campoo', 15),
(145, 'ESH', 'ES22', 'CZ - Tachov', 17),
(150, 'ESK', 'ESK', 'SK - Liptovsky', 20),
(160, 'ESM', 'ES21', 'FR - Molinges', 30),
(170, 'ESN', 'ESN', 'RU - Klin', 40),
(180, 'ESP', 'ES18', 'PT - Viana Do Castelo', 50),
(190, 'ESS', 'STCL', 'FR - Sens', 60),
(200, 'EST', 'PGTA', 'MA - Tanger', 70),
(205, 'ESU', 'ES23', 'TR - BURSA', 75),
(210, 'ESV', 'VAL', 'FR - Valenciennes', 80),
(300, 'ESY', 'CHDT', 'FR - ChÃ¢teauroux', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`idsites`),
  ADD KEY `SiteRef` (`SiteRef`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
