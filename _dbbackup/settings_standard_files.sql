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
-- Table structure for table `settings_standard_files`
--

CREATE TABLE `settings_standard_files` (
  `IdSettStdFile` bigint(20) NOT NULL,
  `IdSite` int(11) DEFAULT NULL,
  `IdMachine` bigint(20) DEFAULT NULL,
  `IdTool` bigint(20) DEFAULT NULL,
  `IdToolVersion` bigint(20) DEFAULT NULL,
  `ActiveFile` tinyint(4) DEFAULT 1,
  `DateCreationUTC` datetime DEFAULT NULL,
  `DateModificationUTC` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_standard_files`
--

INSERT INTO `settings_standard_files` (`IdSettStdFile`, `IdSite`, `IdMachine`, `IdTool`, `IdToolVersion`, `ActiveFile`, `DateCreationUTC`, `DateModificationUTC`) VALUES
(10, 30, 8, 26, 9, 1, '2024-07-22 12:57:08', NULL),
(11, 30, 8, 26, 10, 1, '2024-08-06 09:15:57', NULL),
(13, 30, 15, 53, 11, 1, '2024-09-11 07:11:14', NULL),
(14, 160, 16, 54, 12, 1, '2024-09-11 15:07:32', NULL),
(15, 160, 16, 54, 13, 1, '2024-09-11 15:10:37', NULL),
(16, 160, 16, 54, 14, 1, '2024-09-12 07:13:28', NULL),
(17, 160, 16, 54, 15, 1, '2024-09-13 10:10:43', NULL),
(19, 160, 16, 54, 17, 1, '2024-09-13 13:24:51', NULL),
(20, 30, 15, 57, 9, 1, '2024-09-13 13:26:04', NULL),
(21, 160, 16, 54, 18, 1, '2024-09-16 13:23:54', NULL),
(22, 160, 16, 54, 19, 1, '2024-09-16 13:28:59', NULL),
(23, 160, 16, 54, 20, 1, '2024-09-17 07:25:23', NULL),
(24, 160, 16, 54, 21, 1, '2024-09-17 07:42:38', NULL),
(25, 160, 16, 54, 22, 1, '2024-09-17 07:44:55', NULL),
(26, 160, 16, 54, 23, 1, '2024-09-19 12:42:29', NULL),
(27, 160, 16, 54, 24, 1, '2024-09-24 12:28:12', NULL),
(30, 120, 13, 47, 2, 1, '2024-10-04 09:09:39', NULL),
(31, 120, 10, 52, 1, 1, '2024-10-04 09:25:14', NULL),
(33, 120, 20, 46, 1, 1, '2024-10-04 09:51:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_standard_files`
--
ALTER TABLE `settings_standard_files`
  ADD PRIMARY KEY (`IdSettStdFile`),
  ADD KEY `IdSite` (`IdSite`,`IdMachine`,`IdTool`,`IdToolVersion`),
  ADD KEY `ActiveFile` (`ActiveFile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_standard_files`
--
ALTER TABLE `settings_standard_files`
  MODIFY `IdSettStdFile` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
