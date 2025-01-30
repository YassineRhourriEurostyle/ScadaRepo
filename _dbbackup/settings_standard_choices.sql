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
-- Table structure for table `settings_standard_choices`
--

CREATE TABLE `settings_standard_choices` (
  `idSettStdChoice` bigint(20) NOT NULL,
  `IdRank` varchar(45) DEFAULT NULL,
  `ChoiceText` varchar(70) DEFAULT NULL,
  `DateCreation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_standard_choices`
--

INSERT INTO `settings_standard_choices` (`idSettStdChoice`, `IdRank`, `ChoiceText`, `DateCreation`) VALUES
(1, 'A01I10', 'Yes', '2024-09-17 08:22:36'),
(2, 'A01I10', 'No', '2024-09-17 08:22:36'),
(3, 'A01Q01', 'Yes', '2024-09-17 08:22:40'),
(4, 'A01Q01', 'No', '2024-09-17 08:22:40'),
(5, 'A01Q03', 'mm/s', '2024-09-17 08:22:41'),
(6, 'A01Q03', '%', '2024-09-17 08:22:41'),
(7, 'A01Q04', 'bars', '2024-09-17 08:22:42'),
(8, 'A01Q04', '%', '2024-09-17 08:22:42'),
(9, 'A01T01A01', 'Hydraulic', '2024-09-17 08:23:38'),
(10, 'A01T01A01', 'Pneumatic', '2024-09-17 08:23:38'),
(11, 'A01T01A01', 'Electric', '2024-09-17 08:23:38'),
(12, 'B01D01', 'Yes', '2024-09-17 08:24:01'),
(13, 'B01D01', 'No', '2024-09-17 08:24:01'),
(14, 'B01G01', 'Yes', '2024-09-17 08:24:02'),
(15, 'B01G01', 'No', '2024-09-17 08:24:02'),
(16, 'D01A51B01', 'm/mn', '2024-09-17 08:24:30'),
(17, 'D01A51B01', 'mm/s', '2024-09-17 08:24:30'),
(18, 'D01A51B01', 'cm3/s', '2024-09-17 08:24:30'),
(19, 'D01A51B01', '%', '2024-09-17 08:24:30'),
(20, 'D01A51G01', 'm/mn', '2024-09-17 08:24:45'),
(21, 'D01A51G01', 'mm/s', '2024-09-17 08:24:45'),
(22, 'D01A51G01', 'cm3/s', '2024-09-17 08:24:45'),
(23, 'D01A51G01', '%', '2024-09-17 08:24:45'),
(24, 'D01A51L01', 'm/mn', '2024-09-17 08:24:59'),
(25, 'D01A51L01', 'mm/s', '2024-09-17 08:24:59'),
(26, 'D01A51L01', 'cm3/s', '2024-09-17 08:24:59'),
(27, 'D01A51L01', '%', '2024-09-17 08:24:59'),
(28, 'D01A61D01', 'm/mn', '2024-09-17 08:25:19'),
(29, 'D01A61D01', 'mm/s', '2024-09-17 08:25:19'),
(30, 'D01A61D01', 'cm3/s', '2024-09-17 08:25:19'),
(31, 'D01A61D01', '%', '2024-09-17 08:25:19'),
(32, 'D01A61G50', 'm/mn', '2024-09-17 08:25:23'),
(33, 'D01A61G50', 'mm/s', '2024-09-17 08:25:23'),
(34, 'D01A61G50', 'cm3/s', '2024-09-17 08:25:23'),
(35, 'D01A61G50', '%', '2024-09-17 08:25:23'),
(36, 'D01A71D01', 'm/mn', '2024-09-17 08:25:29'),
(37, 'D01A71D01', 'mm/s', '2024-09-17 08:25:29'),
(38, 'D01A71D01', 'cm3/s', '2024-09-17 08:25:29'),
(39, 'D01A71D01', '%', '2024-09-17 08:25:29'),
(40, 'D01A71G50', 'm/mn', '2024-09-17 08:25:33'),
(41, 'D01A71G50', 'mm/s', '2024-09-17 08:25:33'),
(42, 'D01A71G50', 'cm3/s', '2024-09-17 08:25:33'),
(43, 'D01A71G50', '%', '2024-09-17 08:25:33'),
(44, 'D01A81D01', 'm/mn', '2024-09-17 08:25:39'),
(45, 'D01A81D01', 'mm/s', '2024-09-17 08:25:39'),
(46, 'D01A81D01', 'cm3/s', '2024-09-17 08:25:39'),
(47, 'D01A81D01', '%', '2024-09-17 08:25:39'),
(48, 'D01A81G50', 'm/mn', '2024-09-17 08:25:43'),
(49, 'D01A81G50', 'mm/s', '2024-09-17 08:25:43'),
(50, 'D01A81G50', 'cm3/s', '2024-09-17 08:25:43'),
(51, 'D01A81G50', '%', '2024-09-17 08:25:43'),
(52, 'D01B61', 'cm3', '2024-09-17 08:26:21'),
(53, 'D01B61', 'mm', '2024-09-17 08:26:21'),
(54, 'E01B01A01', 'Grofilley', '2024-09-17 08:27:04'),
(55, 'E01B01A01', 'IMM', '2024-09-17 08:27:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_standard_choices`
--
ALTER TABLE `settings_standard_choices`
  ADD PRIMARY KEY (`idSettStdChoice`),
  ADD KEY `IdRank` (`IdRank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_standard_choices`
--
ALTER TABLE `settings_standard_choices`
  MODIFY `idSettStdChoice` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
