-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 09:39 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsnl`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountid` int(11) NOT NULL,
  `acctypeid` int(11) NOT NULL,
  `accdetailsid` int(11) NOT NULL,
  `accountname` varchar(250) NOT NULL,
  `currency` varchar(250) NOT NULL,
  `accbalance` varchar(250) NOT NULL,
  `balancedate` date NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountid`, `acctypeid`, `accdetailsid`, `accountname`, `currency`, `accbalance`, `balancedate`, `datecreated`, `dateupdated`) VALUES
(4, 2, 18, 'BDO', 'PHP', '49712.5', '2020-03-28', '2020-03-29 20:00:53', '2020-03-29 12:00:53'),
(5, 2, 16, 'BPI', 'PHP', '10000', '2020-03-28', '2020-03-29 20:07:19', '2020-03-29 12:07:19'),
(6, 2, 15, 'Cash and Equivalents', 'PHP', '13807', '2020-04-18', '2020-04-19 09:34:19', '2020-04-19 01:34:19'),
(7, 2, 14, 'CIB BPI Revived Sales', 'PHP', '59747.45', '2020-04-18', '2020-04-19 09:35:43', '2020-04-19 01:35:43'),
(8, 2, 18, 'Money Market', 'PHP', '14682.6', '2020-04-18', '2020-04-19 09:36:13', '2020-04-19 01:36:13'),
(9, 2, 15, 'Petty Cash Fund', 'PHP', '15500', '2020-04-18', '2020-04-19 09:36:47', '2020-04-19 01:36:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
