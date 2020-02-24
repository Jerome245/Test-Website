-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 07:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicantlist`
--

CREATE TABLE `applicantlist` (
  `Passkey` varchar(32) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Club1` varchar(14) NOT NULL,
  `Club2` varchar(14) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clublist`
--

CREATE TABLE `clublist` (
  `Club_ID` int(11) NOT NULL,
  `Adv_ID` smallint(6) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Mission` varchar(10) NOT NULL,
  `Vission` varchar(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clublist`
--

INSERT INTO `clublist` (`Club_ID`, `Adv_ID`, `Name`, `Mission`, `Vission`, `reg_date`) VALUES
(1, 1, 'Bahaghari', '', '', '0000-00-00 00:00:00'),
(2, 0, 'Catalyst', '', '', '0000-00-00 00:00:00'),
(3, 0, 'Central Scholar', '', '', '0000-00-00 00:00:00'),
(4, 0, 'Codebusters', '', '', '0000-00-00 00:00:00'),
(5, 0, 'DSDC', '', '', '0000-00-00 00:00:00'),
(6, 0, 'Kasalaglahi', '', '', '0000-00-00 00:00:00'),
(7, 0, 'Kislap', '', '', '0000-00-00 00:00:00'),
(8, 0, 'Likas', '', '', '0000-00-00 00:00:00'),
(9, 0, 'Math', '', '', '0000-00-00 00:00:00'),
(10, 0, 'Missionary Club', '', '', '0000-00-00 00:00:00'),
(11, 0, 'Sayarani', '', '', '0000-00-00 00:00:00'),
(12, 0, 'Spiker\'s Club', '', '', '0000-00-00 00:00:00'),
(13, 0, 'Theatre Club', '', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicantlist`
--
ALTER TABLE `applicantlist`
  ADD PRIMARY KEY (`Passkey`),
  ADD UNIQUE KEY `Passkey` (`Passkey`);

--
-- Indexes for table `clublist`
--
ALTER TABLE `clublist`
  ADD PRIMARY KEY (`Club_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clublist`
--
ALTER TABLE `clublist`
  MODIFY `Club_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
