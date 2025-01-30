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
-- Table structure for table `settings_standard_modification_log`
--

CREATE TABLE `settings_standard_modification_log` (
  `idSettStdModLog` bigint(20) NOT NULL,
  `idSite` int(11) DEFAULT NULL,
  `SettStdModDate` datetime DEFAULT NULL,
  `idParameter` int(11) DEFAULT NULL,
  `SettStdModOldValue` varchar(100) DEFAULT NULL,
  `SetStdModNewValue` varchar(100) DEFAULT NULL,
  `SetStdModWho` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_standard_modification_log`
--
ALTER TABLE `settings_standard_modification_log`
  ADD PRIMARY KEY (`idSettStdModLog`),
  ADD KEY `StdSettModIdx1` (`idSite`,`idParameter`,`SettStdModDate`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_standard_modification_log`
--
ALTER TABLE `settings_standard_modification_log`
  MODIFY `idSettStdModLog` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
