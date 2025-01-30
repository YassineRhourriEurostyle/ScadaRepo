-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 03:23 PM
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
-- Table structure for table `zz_sise_parameters_temp`
--

CREATE TABLE `zz_sise_parameters_temp` (
  `idSiseParamTmp` bigint(20) NOT NULL,
  `ParamName` varchar(200) DEFAULT NULL,
  `IntDate` bigint(20) DEFAULT NULL,
  `idparameters` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zz_sise_parameters_temp`
--

INSERT INTO `zz_sise_parameters_temp` (`idSiseParamTmp`, `ParamName`, `IntDate`, `idparameters`) VALUES
(1, 'Actual barrel temperature in the feed zone', 20241015095400, 306),
(11, 'Actual closing time', 20241015095400, 751),
(12, 'Actual cooling time', 20241015095400, 380),
(13, 'Actual cycle time', 20241015095400, 294),
(14, 'Actual dosing delay time', 20241015095400, 485),
(15, 'Actual dosing time', 20241015095400, 746),
(16, 'Actual injection time', 20241015095400, 355),
(17, 'Actual injection unit application time', 20241015095400, 469),
(19, 'Actual machine oil temperature', 20241015095400, 337),
(21, 'Actual opening stroke', 20241015095400, 295),
(22, 'Actual opening time', 20241015095400, 750),
(23, 'Actual Switchover point in pressure', 20241015095400, 341),
(24, 'Actual Switchover point in stroke', 20241015095400, 340),
(25, 'Actual Switchover point in time', 20241015095400, 342),
(26, 'Actual switchover pressure', 20241015095400, 749),
(29, 'Barrel temperature zone 1', 20241015095400, 298),
(30, 'Barrel temperature zone 2', 20241015095400, 299),
(31, 'Barrel temperature zone 3', 20241015095400, 300),
(32, 'Barrel temperature zone 4', 20241015095400, 301),
(33, 'Barrel temperature zone 5', 20241015095400, 302),
(34, 'Barrel temperature zone 6', 20241015095400, 303),
(35, 'Barrel temperature zone 7', 20241015095400, 304),
(36, 'Barrel temperature zone 8', 20241015095400, 305),
(38, 'Clamping force', 20241015095400, 3),
(49, 'Core pressure in 1', 20241015095400, 547),
(50, 'Core pressure in 2', 20241015095400, 566),
(51, 'Core pressure in 3', 20241015095400, 585),
(52, 'Core pressure in 4', 20241015095400, 604),
(53, 'Core pressure in 5', 20241015095400, 623),
(54, 'Core pressure in 6', 20241015095400, 642),
(55, 'Core pressure out 1', 20241015095400, 556),
(56, 'Core pressure out 2', 20241015095400, 575),
(57, 'Core pressure out 3', 20241015095400, 594),
(58, 'Core pressure out 4', 20241015095400, 613),
(59, 'Core pressure out 5', 20241015095400, 632),
(60, 'Core pressure out 6', 20241015095400, 651),
(61, 'Counter pressure stage 1', 20241015095400, 477),
(62, 'Counter pressure stage 2', 20241015095400, 478),
(63, 'Counter pressure stage 3', 20241015095400, 479),
(64, 'Counter pressure stage 4', 20241015095400, 480),
(65, 'Counter pressure stage 5', 20241015095400, 481),
(66, 'Decompression Stroke', 20241015095400, 494),
(69, 'Ejector output pressure 1', 20241015095400, 42),
(71, 'Ejector output speed 1', 20241015095400, 40),
(73, 'Final cushion', 20241015095400, 379),
(74, 'Holding pressure stage 1', 20241015095400, 368),
(75, 'Holding pressure stage 10', 20241015095400, 377),
(76, 'Holding pressure stage 2', 20241015095400, 369),
(77, 'Holding pressure stage 3', 20241015095400, 370),
(78, 'Holding pressure stage 4', 20241015095400, 371),
(79, 'Holding pressure stage 5', 20241015095400, 372),
(80, 'Holding pressure stage 6', 20241015095400, 373),
(81, 'Holding pressure stage 7', 20241015095400, 374),
(82, 'Holding pressure stage 8', 20241015095400, 375),
(83, 'Holding pressure stage 9', 20241015095400, 376),
(84, 'Holding time stage 1', 20241015095400, 378),
(94, 'In ejection time', 20241015095400, 752),
(95, 'Injection pressure stage 1', 20241015095400, 357),
(96, 'Injection pressure stage 10', 20241015095400, 366),
(97, 'Injection pressure stage 2', 20241015095400, 358),
(98, 'Injection pressure stage 3', 20241015095400, 359),
(99, 'Injection pressure stage 4', 20241015095400, 360),
(100, 'Injection pressure stage 5', 20241015095400, 361),
(101, 'Injection pressure stage 6', 20241015095400, 362),
(102, 'Injection pressure stage 7', 20241015095400, 363),
(103, 'Injection pressure stage 8', 20241015095400, 364),
(104, 'Injection pressure stage 9', 20241015095400, 365),
(105, 'Injection speed stage 1', 20241015095400, 345),
(106, 'Injection speed stage 10', 20241015095400, 354),
(107, 'Injection speed stage 2', 20241015095400, 346),
(108, 'Injection speed stage 3', 20241015095400, 347),
(109, 'Injection speed stage 4', 20241015095400, 348),
(110, 'Injection speed stage 5', 20241015095400, 349),
(111, 'Injection speed stage 6', 20241015095400, 350),
(112, 'Injection speed stage 7', 20241015095400, 351),
(113, 'Injection speed stage 8', 20241015095400, 352),
(114, 'Injection speed stage 9', 20241015095400, 353),
(115, 'Injection unit application  pressure', 20241015095400, 468),
(116, 'Injection unit application time', 20241015095400, 469),
(126, 'Out ejection time', 20241015095400, 753),
(127, 'Pressure holding time for shut off nozzle nÂ°1', 20241015095400, 664),
(128, 'Pressure holding time for shut off nozzle nÂ°10', 20241015095400, 700),
(129, 'Pressure holding time for shut off nozzle nÂ°11', 20241015095400, 704),
(130, 'Pressure holding time for shut off nozzle nÂ°12', 20241015095400, 708),
(131, 'Pressure holding time for shut off nozzle nÂ°13', 20241015095400, 712),
(132, 'Pressure holding time for shut off nozzle nÂ°14', 20241015095400, 716),
(133, 'Pressure holding time for shut off nozzle nÂ°15', 20241015095400, 720),
(134, 'Pressure holding time for shut off nozzle nÂ°16', 20241015095400, 724),
(135, 'Pressure holding time for shut off nozzle nÂ°2', 20241015095400, 668),
(136, 'Pressure holding time for shut off nozzle nÂ°3', 20241015095400, 672),
(137, 'Pressure holding time for shut off nozzle nÂ°4', 20241015095400, 676),
(138, 'Pressure holding time for shut off nozzle nÂ°5', 20241015095400, 680),
(139, 'Pressure holding time for shut off nozzle nÂ°6', 20241015095400, 684),
(140, 'Pressure holding time for shut off nozzle nÂ°7', 20241015095400, 688),
(141, 'Pressure holding time for shut off nozzle nÂ°8', 20241015095400, 692),
(142, 'Pressure holding time for shut off nozzle nÂ°9', 20241015095400, 696),
(148, 'Shut off nozzle closing position nÂ°1', 20241015095400, 663),
(149, 'Shut off nozzle closing position nÂ°10', 20241015095400, 699),
(150, 'Shut off nozzle closing position nÂ°11', 20241015095400, 703),
(151, 'Shut off nozzle closing position nÂ°12', 20241015095400, 707),
(152, 'Shut off nozzle closing position nÂ°13', 20241015095400, 711),
(153, 'Shut off nozzle closing position nÂ°14', 20241015095400, 715),
(154, 'Shut off nozzle closing position nÂ°15', 20241015095400, 719),
(155, 'Shut off nozzle closing position nÂ°16', 20241015095400, 723),
(156, 'Shut off nozzle closing position nÂ°2', 20241015095400, 667),
(157, 'Shut off nozzle closing position nÂ°3', 20241015095400, 671),
(158, 'Shut off nozzle closing position nÂ°4', 20241015095400, 675),
(159, 'Shut off nozzle closing position nÂ°5', 20241015095400, 679),
(160, 'Shut off nozzle closing position nÂ°6', 20241015095400, 683),
(161, 'Shut off nozzle closing position nÂ°7', 20241015095400, 687),
(162, 'Shut off nozzle closing position nÂ°8', 20241015095400, 691),
(163, 'Shut off nozzle closing position nÂ°9', 20241015095400, 695),
(164, 'Shut off nozzle opening position nÂ°1', 20241015095400, 662),
(165, 'Shut off nozzle opening position nÂ°10', 20241015095400, 698),
(166, 'Shut off nozzle opening position nÂ°11', 20241015095400, 702),
(167, 'Shut off nozzle opening position nÂ°12', 20241015095400, 706),
(168, 'Shut off nozzle opening position nÂ°13', 20241015095400, 710),
(169, 'Shut off nozzle opening position nÂ°14', 20241015095400, 714),
(170, 'Shut off nozzle opening position nÂ°15', 20241015095400, 718),
(171, 'Shut off nozzle opening position nÂ°16', 20241015095400, 722),
(172, 'Shut off nozzle opening position nÂ°2', 20241015095400, 666),
(173, 'Shut off nozzle opening position nÂ°3', 20241015095400, 670),
(174, 'Shut off nozzle opening position nÂ°4', 20241015095400, 674),
(175, 'Shut off nozzle opening position nÂ°5', 20241015095400, 678),
(176, 'Shut off nozzle opening position nÂ°6', 20241015095400, 682),
(177, 'Shut off nozzle opening position nÂ°7', 20241015095400, 686),
(178, 'Shut off nozzle opening position nÂ°8', 20241015095400, 690),
(179, 'Shut off nozzle opening position nÂ°9', 20241015095400, 694),
(180, 'Switchover point in pressure', 20241015095400, 341),
(181, 'Switchover point in stroke', 20241015095400, 340),
(182, 'Switchover point in time', 20241015095400, 342),
(192, 'Actual holding time', 20241015095400, 378),
(953, 'Actual claming force', 20240404160247, 537);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `zz_sise_parameters_temp`
--
ALTER TABLE `zz_sise_parameters_temp`
  ADD PRIMARY KEY (`idSiseParamTmp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zz_sise_parameters_temp`
--
ALTER TABLE `zz_sise_parameters_temp`
  MODIFY `idSiseParamTmp` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
