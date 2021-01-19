-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 09:38 PM
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
-- Table structure for table `account_detail`
--

CREATE TABLE `account_detail` (
  `accdetailsid` int(11) NOT NULL,
  `acctypeid` int(11) NOT NULL,
  `accdetails` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_detail`
--

INSERT INTO `account_detail` (`accdetailsid`, `acctypeid`, `accdetails`) VALUES
(1, 1, 'Allowance for bad debts'),
(2, 1, 'Assets available for sale'),
(3, 1, 'Development costs'),
(4, 1, 'Employee cash advances'),
(5, 1, 'Inventory'),
(6, 1, 'Investments - Other'),
(7, 1, 'Loans to officers'),
(8, 1, 'Loans to others'),
(9, 1, 'Loans to shareholders'),
(10, 1, 'Other current assets'),
(11, 1, 'Prepaid expenses'),
(12, 1, 'Retainage'),
(13, 1, 'Undeposited funds'),
(14, 2, 'Bank'),
(15, 2, 'Cash and cash equivalents'),
(16, 2, 'Cash on hand'),
(17, 2, 'Client trust account'),
(18, 2, 'Money market'),
(19, 2, 'Rents held in trust'),
(20, 2, 'Saving'),
(21, 3, 'Credit card');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`accdetailsid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_detail`
--
ALTER TABLE `account_detail`
  MODIFY `accdetailsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
