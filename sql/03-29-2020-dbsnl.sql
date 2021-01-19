-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 02:51 PM
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
(4, 1, 18, 'dasdasd', 'PHP', '23333', '2020-03-28', '2020-03-29 20:00:53', '2020-03-29 12:00:53'),
(5, 2, 16, 'saddasd', 'PHP', '9000', '2020-03-28', '2020-03-29 20:07:19', '2020-03-29 12:07:19');

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

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `acctypeid` int(11) NOT NULL,
  `accounttype` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`acctypeid`, `accounttype`) VALUES
(1, 'Current assets'),
(2, 'Cash and cash equivalent'),
(3, 'Credit card');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `event` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `module` varchar(256) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateupdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`log_id`, `users_id`, `event`, `description`, `module`, `datecreated`, `dateupdated`) VALUES
(1, 2147483647, 'Update', 'Updated Stock: product 1', 'STOCK', '2020-02-23 05:57:09', '2020-02-23 13:57:09'),
(2, 2147483647, 'Add', 'Added new Purchase Order: Order ID - 1234', 'PURCHASE ORDER', '2020-02-23 06:44:17', '2020-02-23 14:44:17'),
(3, 2147483647, 'Update', 'Updated Purchase Order: Order Number - 1234', 'PURCHASE ORDER', '2020-02-23 06:45:58', '2020-02-23 14:45:58'),
(4, 2147483647, 'Add', 'Added new Purchase Order: Order ID - 8585', 'PURCHASE ORDER', '2020-02-23 06:52:40', '2020-02-23 14:52:40'),
(5, 2147483647, 'Add', 'Added new Purchase Order: Order ID - 8585', 'PURCHASE ORDER', '2020-02-23 06:54:04', '2020-02-23 14:54:04'),
(6, 2147483647, 'Add', 'Added New Stock: testlang', 'STOCK', '2020-02-23 07:50:57', '2020-02-23 15:50:57'),
(7, 2147483647, 'Delete', 'Deleted Stock: test', 'STOCK', '2020-02-23 08:00:49', '2020-02-23 16:00:49'),
(8, 2147483647, 'Delete', 'Deleted Stock: test', 'STOCK', '2020-02-23 08:00:52', '2020-02-23 16:00:52'),
(9, 2147483647, 'Add', 'Added New Stock: test3', 'STOCK', '2020-02-23 08:01:45', '2020-02-23 16:01:45'),
(10, 2147483647, 'Add', 'Added New Stock: test4', 'STOCK', '2020-02-23 08:02:23', '2020-02-23 16:02:23'),
(11, 2147483647, 'Add', 'Added New Stock: test5', 'STOCK', '2020-02-23 08:50:27', '2020-02-23 16:50:27'),
(12, 2147483647, 'Update', 'Updated Stock: test5', 'STOCK', '2020-02-23 08:50:52', '2020-02-23 16:50:52'),
(13, 2147483647, 'Add', 'Added New Stock: Alexus Paint', 'STOCK', '2020-02-24 06:22:03', '2020-02-24 14:22:03'),
(14, 2147483647, 'Delete', 'Deleted Stock: Alexus Paint', 'STOCK', '2020-02-24 06:22:08', '2020-02-24 14:22:08'),
(15, 2147483647, 'Add', 'Added New Stock: Angelic Paint', 'STOCK', '2020-02-24 06:23:01', '2020-02-24 14:23:01'),
(16, 2147483647, 'Add', 'Added new Purchase Order: Order ID - 0001', 'PURCHASE ORDER', '2020-02-25 02:27:04', '2020-02-25 10:27:04'),
(17, 2147483647, 'Add', 'Added new Purchase Order: Order ID - 00054', 'PURCHASE ORDER', '2020-02-25 02:27:51', '2020-02-25 10:27:51'),
(18, 2147483647, 'Delete', 'Deleted Customer Order: 0', 'CUSTOMER ORDER', '2020-02-25 02:30:07', '2020-02-25 10:30:07'),
(19, 2147483647, 'Delete', 'Deleted Customer Order: 1', 'CUSTOMER ORDER', '2020-02-25 02:30:12', '2020-02-25 10:30:12'),
(20, 2147483647, 'Add', 'Added New Customer Order: undefined', 'CUSTOMER ORDER', '2020-02-25 02:30:44', '2020-02-25 10:30:44'),
(21, 2147483647, 'Add', 'Added New Customer Order: undefined', 'CUSTOMER ORDER', '2020-02-25 10:16:25', '2020-02-25 18:16:25'),
(22, 2147483647, 'Update', 'UpdateCustomer Order: undefined', 'CUSTOMER ORDER', '2020-02-26 06:28:26', '2020-02-26 14:28:26'),
(23, 2147483647, 'Add', 'Added New Customer Order: undefined', 'CUSTOMER ORDER', '2020-02-27 00:00:04', '2020-02-27 08:00:04'),
(24, 2147483647, 'Add', 'Added New Customer Order: undefined', 'CUSTOMER ORDER', '2020-02-27 00:00:31', '2020-02-27 08:00:31'),
(25, 2147483647, 'Add', 'Added New Customer Order: undefined', 'CUSTOMER ORDER', '2020-02-27 00:01:00', '2020-02-27 08:01:00'),
(26, 2147483647, 'Add', 'Added Account: sample', 'ACCOUNT', '2020-03-29 11:28:20', '2020-03-29 19:28:20'),
(27, 2147483647, 'Add', 'Added Account: sdasd', 'ACCOUNT', '2020-03-29 11:43:59', '2020-03-29 19:43:59'),
(28, 2147483647, 'Delete', 'Deleted Account: undefined', 'Account', '2020-03-29 11:44:54', '2020-03-29 19:44:54'),
(29, 2147483647, 'Delete', 'Deleted Account: undefined', 'Account', '2020-03-29 11:45:01', '2020-03-29 19:45:01'),
(30, 2147483647, 'Add', 'Added Account: Sample test', 'ACCOUNT', '2020-03-29 11:45:24', '2020-03-29 19:45:24'),
(31, 2147483647, 'Delete', 'Deleted Account: undefined', 'Account', '2020-03-29 12:00:40', '2020-03-29 20:00:40'),
(32, 2147483647, 'Add', 'Added Account: dasdasd', 'ACCOUNT', '2020-03-29 12:00:53', '2020-03-29 20:00:53'),
(33, 2147483647, 'Add', 'Added Account: saddasd', 'ACCOUNT', '2020-03-29 12:07:19', '2020-03-29 20:07:19'),
(34, 2147483647, 'Update', 'Updated Account: saddasd', 'ACCOUNT', '2020-03-29 12:22:40', '2020-03-29 20:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(290) DEFAULT NULL,
  `branddesc` varchar(290) DEFAULT NULL,
  `brandadd` varchar(256) DEFAULT NULL,
  `brandcontactperson` varchar(290) DEFAULT NULL,
  `brandphonenum` varchar(250) DEFAULT NULL,
  `brandemail` varchar(290) DEFAULT NULL,
  `brandwebsite` varchar(290) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandid`, `brandname`, `branddesc`, `brandadd`, `brandcontactperson`, `brandphonenum`, `brandemail`, `brandwebsite`, `datecreated`, `dateupdated`) VALUES
(92, 'Rit Dyee', 'Rit Dye Brand', 'Urdaneta City, Pangasinan', 'Rit Dye', '094564534634', 'ritdye.brand@gmail.com', 'www.rit-dye.com', '2019-11-15 19:37:49', '2019-11-16 07:49:33'),
(103, 'xcxcsdsdfffff', 'fafaf', 'afafaf', 'afafaf', 'afaf', 'afafaf', 'faafaf', '2019-12-14 21:09:36', '2019-12-14 13:12:30'),
(105, 'sdsdeeeeee', 'dsd', 'adfdf', 'fsdff', '3435345', 'fdfdf', 'fddfd', '2019-12-14 21:13:52', '2019-12-14 13:13:52'),
(106, 'dfdf', 'dfdf', 'dfdfdf', 'dfdfd', 'fdfdf', 'dfdf', 'dfdf', '2019-12-14 21:14:13', '2019-12-14 13:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categorydesc` varchar(290) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateupdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categorydesc`, `datecreated`, `dateupdated`) VALUES
(57, 'Shoes', '2019-11-16 07:24:13', '2019-11-15 19:34:52'),
(58, 'Shoe Lace', '2019-11-15 11:34:59', '2019-11-15 19:34:59'),
(59, 'Paints', '2019-11-15 11:35:02', '2019-11-15 19:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `category_exp`
--

CREATE TABLE `category_exp` (
  `categexpid` int(11) NOT NULL,
  `categexptype` varchar(250) NOT NULL,
  `detailtype` varchar(250) NOT NULL,
  `categexpname` varchar(250) NOT NULL,
  `categexdesc` varchar(500) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_exp`
--

INSERT INTO `category_exp` (`categexpid`, `categexptype`, `detailtype`, `categexpname`, `categexdesc`, `datecreated`, `dateupdated`) VALUES
(4, 'Variable expenses', 'Annual licence fees', 'Annual licence fees', 'Sample', '2020-02-13 02:51:33', '2020-02-12 18:51:33'),
(5, 'Fixed expenses', 'Business taxes', 'Business taxes', 'Business taxes', '2020-02-13 02:51:43', '2020-02-12 18:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `courierid` int(11) NOT NULL,
  `couriername` varchar(290) NOT NULL,
  `courierbranch` varchar(290) NOT NULL,
  `courierphonenum` varchar(290) NOT NULL,
  `courieremail` varchar(290) NOT NULL,
  `courierwebsite` varchar(290) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`courierid`, `couriername`, `courierbranch`, `courierphonenum`, `courieremail`, `courierwebsite`, `datecreated`, `dateupdated`) VALUES
(15, 'LBC', 'NCR', '02-8585-999', 'support@lbcexpress.com', 'lbcexpress.com', '0000-00-00 00:00:00', '2019-11-16 08:28:06'),
(16, 'GrabExpress', 'NCR', '02-8585-999', 'support@grab.com', 'www.grab.com/ph', '0000-00-00 00:00:00', '2019-11-15 11:47:58'),
(17, '2GO Express', 'NCR to Luzon', '02-779-9222', 'support@2goexpress.com', 'xpress.2go.com.ph', '0000-00-00 00:00:00', '2019-11-15 11:49:15'),
(18, 'JRS Express', 'NCR', '02-631-7351', 'support@jrs-express.com', 'www,jrs-express.com', '0000-00-00 00:00:00', '2019-11-15 11:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE `creditcard` (
  `creditcardid` int(11) NOT NULL,
  `creditcard` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creditcard`
--

INSERT INTO `creditcard` (`creditcardid`, `creditcard`, `datecreated`, `dateupdated`) VALUES
(1, 'VISA', '2020-02-09 21:29:07', '2020-02-09 13:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customerguid` varchar(110) DEFAULT NULL,
  `customerfirstname` varchar(290) NOT NULL,
  `customerlastname` varchar(290) NOT NULL,
  `customerbname` varchar(200) NOT NULL,
  `cbillingaddress` varchar(250) NOT NULL,
  `cshippingaddress` varchar(290) NOT NULL,
  `cphonenumber` varchar(290) NOT NULL,
  `cemailaddress` varchar(290) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customerguid`, `customerfirstname`, `customerlastname`, `customerbname`, `cbillingaddress`, `cshippingaddress`, `cphonenumber`, `cemailaddress`, `datecreated`, `dateupdated`) VALUES
(5, 'DFSGSDG56JOIJ', 'Khenard', 'Figuracion', 'ken', 'Villasis, Pangasinan', 'Villasis, Pangasinan', '09473877134', 'khenard.figuracion@gmail.com', '0000-00-00 00:00:00', '2019-11-15 11:52:20'),
(6, 'HJBJHGGKJ8646245', 'Ricbon', 'Ibe', 'bon', 'Urdaneta City, Pangasinan', 'Santa Barbara, Pangasinan', '09456224', 'ibericbon@gmail.com', '0000-00-00 00:00:00', '2019-11-15 11:52:50'),
(7, 'GEEG5655956565', 'John Jayther', 'Dacusin', 'jet', 'Urdaneta City, Pangasinan', 'San Manuel, Pangasinan', '093432323', 'johnjayther@gmail.com', '0000-00-00 00:00:00', '2019-11-15 11:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `customerorderid` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `ordernumber` varchar(120) DEFAULT NULL,
  `platformid` varchar(20) DEFAULT NULL,
  `mopid` varchar(50) DEFAULT NULL,
  `courierid` varchar(11) DEFAULT NULL,
  `productid` varchar(50) DEFAULT NULL,
  `supplierid` varchar(11) DEFAULT NULL,
  `quantity` varchar(11) DEFAULT NULL,
  `shippingfee` varchar(20) DEFAULT NULL,
  `shippingdate` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `totalamountdollar` varchar(250) DEFAULT NULL,
  `totalamountpesos` varchar(250) NOT NULL,
  `exchangerate` varchar(50) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `filter` varchar(110) NOT NULL,
  `classification` varchar(110) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`customerorderid`, `customerid`, `ordernumber`, `platformid`, `mopid`, `courierid`, `productid`, `supplierid`, `quantity`, `shippingfee`, `shippingdate`, `purchasedate`, `totalamountdollar`, `totalamountpesos`, `exchangerate`, `remarks`, `filter`, `classification`, `datecreated`, `dateupdated`) VALUES
(1, 5, '00021', '16', '16', '16', '26', '24', '5', '12', '2020-02-26', '2020-02-26', '140', '7163.76346', '51.169739', 'sample', 'Local', 'Wholesale', '2020-02-27 08:00:04', '2020-02-27 00:00:04'),
(2, 6, '0003', '15', '16', '17', '28', '26', '9', '65', '2020-02-26', '2020-02-26', '499.5', '25559.2846305', '51.169739', 'sample', 'Local', 'Retail', '2020-02-27 08:00:31', '2020-02-27 00:00:31'),
(3, 7, '6687', '16', '21', '17', '26', '24', '9', '30', '2020-02-26', '2020-02-26', '252', '12894.728868', '51.169559', 'sample', 'Local', 'Retail', '2020-02-27 08:01:00', '2020-02-27 00:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL,
  `dashboardid` varchar(220) DEFAULT NULL,
  `myincomedatefrom` date DEFAULT NULL,
  `myincomedateto` date DEFAULT NULL,
  `myexpensefrom` date DEFAULT NULL,
  `myexpenseto` date DEFAULT NULL,
  `incomecomparison` varchar(220) NOT NULL DEFAULT 'Monthly',
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `dashboardid`, `myincomedatefrom`, `myincomedateto`, `myexpensefrom`, `myexpenseto`, `incomecomparison`, `datecreated`, `dateupdated`) VALUES
(1, 'HDF3P5PDJBD2A51', '2020-02-01', '2020-02-27', '2020-02-01', '2020-02-28', 'Monthly', '2020-03-02 19:52:35', '2020-03-02 11:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expenseid` varchar(110) NOT NULL,
  `payeeid` varchar(110) DEFAULT NULL,
  `paymentaccount` varchar(110) DEFAULT NULL,
  `paymentdate` date DEFAULT NULL,
  `paymentmethod` varchar(110) DEFAULT NULL,
  `referenceno` varchar(110) DEFAULT NULL,
  `remarks` varchar(220) DEFAULT NULL,
  `session` int(10) DEFAULT 0,
  `status` int(10) DEFAULT 0,
  `dlt` int(11) DEFAULT 0,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expenseid`, `payeeid`, `paymentaccount`, `paymentdate`, `paymentmethod`, `referenceno`, `remarks`, `session`, `status`, `dlt`, `datecreated`, `dateupdated`) VALUES
('0O32A3D7KJ4F5H1', '65464654KJLHUG', '1', '2020-02-24', '16', '005', 'sample', 1, 1, 0, '2020-02-24 14:19:26', '2020-02-24 06:19:26'),
('2CNK1MBOGBP4B39', '5646565456JKJ', '1', '2020-03-07', '15', '0008956', 'sample', 1, 1, 0, '2020-03-07 08:43:28', '2020-03-07 00:43:28'),
('FH30H413M22KH13', 'GEEG5655956565', '1', '2020-03-07', '15', '0045', '', 1, 1, 0, '2020-03-08 02:10:23', '2020-03-07 18:10:23'),
('JA9KGGGFB52KM73', '65464654KJLHUG', '4', '0000-00-00', '16', '00154', '', 0, 0, 0, '2020-03-08 09:22:17', '2020-03-08 01:22:17'),
('JHAL978D94L7K9C', '65464654KJLHUG', '1', '2020-02-26', '15', '00033', 'sample', 1, 1, 0, '2020-02-25 10:32:00', '2020-02-25 02:32:00'),
('N3HID9FMPFJ29DF', 'HJBJHGGKJ8646245', '1', '2020-03-06', '16', '904545', 'sa', 1, 1, 0, '2020-02-27 08:03:09', '2020-02-27 00:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `expenseid` varchar(110) NOT NULL,
  `categoryid` varchar(110) DEFAULT NULL,
  `description` varchar(220) NOT NULL,
  `amount` varchar(110) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `expenseid`, `categoryid`, `description`, `amount`, `datecreated`, `dateupdated`) VALUES
(26, '0O32A3D7KJ4F5H1', '5', 'sample', '05.00', '2020-02-24 14:19:26', '2020-02-24 06:19:26'),
(27, 'JHAL978D94L7K9C', '4', 'sample', '23.00', '2020-02-25 10:32:00', '2020-02-25 02:32:00'),
(28, 'JHAL978D94L7K9C', '5', 'sample', '65', '2020-02-27 08:02:02', '2020-02-27 00:02:02'),
(29, 'N3HID9FMPFJ29DF', '5', 'sample', '2', '2020-02-27 08:03:09', '2020-02-27 00:03:09'),
(30, '2CNK1MBOGBP4B39', '5', 'sample', '23', '2020-03-07 08:43:28', '2020-03-07 00:43:28'),
(31, 'FH30H413M22KH13', '4', 'sample', '45', '2020-03-08 02:10:24', '2020-03-07 18:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `expense_item`
--

CREATE TABLE `expense_item` (
  `id` int(11) NOT NULL,
  `expenseid` varchar(110) NOT NULL,
  `stocksid` varchar(110) DEFAULT NULL,
  `oldstocksid` varchar(110) DEFAULT NULL,
  `description` varchar(220) DEFAULT NULL,
  `quantity` varchar(110) DEFAULT NULL,
  `oldquantity` varchar(110) DEFAULT NULL,
  `unitpricephp` varchar(110) NOT NULL,
  `rate` varchar(110) DEFAULT NULL,
  `amount` varchar(110) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_item`
--

INSERT INTO `expense_item` (`id`, `expenseid`, `stocksid`, `oldstocksid`, `description`, `quantity`, `oldquantity`, `unitpricephp`, `rate`, `amount`, `datecreated`, `dateupdated`) VALUES
(27, '0O32A3D7KJ4F5H1', '26', '26', 'sample', '5', '', '28', '50.50', '7070', '2020-02-24 14:19:26', '2020-02-24 06:19:26'),
(28, 'JHAL978D94L7K9C', '26', '26', 'sample', '6', '6', '28', '50.2', '8433.6', '2020-02-25 10:32:01', '2020-02-25 02:32:01'),
(29, 'JHAL978D94L7K9C', '28', '28', 'sample', '8', '', '55.50', '51.170302', '22719.614088', '2020-02-27 08:02:26', '2020-02-27 00:02:26'),
(30, 'N3HID9FMPFJ29DF', '26', '26', 'sample', '32', '', '28', '2', '1792', '2020-02-27 08:03:09', '2020-02-27 00:03:09'),
(31, '2CNK1MBOGBP4B39', '26', '26', 'sample', '3', '3', '28', '32', '2688', '2020-03-07 08:43:28', '2020-03-07 00:43:28'),
(32, 'FH30H413M22KH13', '26', '26', 'fsdfsfd', '45', '', '28', '45', '56700', '2020-03-08 02:10:24', '2020-03-07 18:10:24'),
(33, 'JA9KGGGFB52KM73', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2020-03-08 09:22:18', '2020-03-08 01:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `role` varchar(110) NOT NULL,
  `icon` varchar(110) NOT NULL,
  `url` varchar(110) NOT NULL,
  `description` varchar(110) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `sort`, `role`, `icon`, `url`, `description`, `datecreated`, `dateupdated`) VALUES
(1, 3, 'customerorder', 'user-check', 'customerorder.php', 'Customer Order', '2019-10-15 21:22:26', '2020-02-20 01:13:54'),
(2, 2, 'supplierorder', 'truck', 'purchase-order.php', 'Purchase Order', '2019-10-15 21:22:26', '2020-02-20 01:13:49'),
(3, 5, 'stockmanagement', 'box', 'stock_management.php', 'Product Management', '2019-10-15 21:24:19', '2020-03-16 02:45:22'),
(4, 6, 'productmanagement', 'package', '', 'Sales Component', '2019-10-15 21:24:19', '2020-02-20 01:23:38'),
(5, 8, 'systemusers', 'user', 'system-users.php', 'System Users', '2019-10-21 12:09:14', '2020-02-20 01:24:41'),
(6, 1, 'dashboard', 'trending-up', 'index.php', 'Dashboard', '2019-10-21 18:20:07', '2019-10-21 10:57:01'),
(7, 9, 'report', 'pie-chart', 'reports.php', 'Reports', '2019-10-21 18:20:07', '2020-02-20 01:24:57'),
(8, 10, 'auditlogs', 'clock', 'auditlogs.php', 'Audit Logs', '2019-10-21 18:53:37', '2020-02-20 01:25:01'),
(15, 7, 'settings', 'settings', '', 'Settings', '2019-10-15 21:24:19', '2020-02-20 01:24:34'),
(16, 4, 'expenses', 'dollar-sign', 'expenses.php', 'Expenses ', '2020-02-09 18:12:14', '2020-02-20 01:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `modeofpayment`
--

CREATE TABLE `modeofpayment` (
  `mopid` int(11) NOT NULL,
  `modeofpayment` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modeofpayment`
--

INSERT INTO `modeofpayment` (`mopid`, `modeofpayment`, `datecreated`, `dateupdated`) VALUES
(15, 'Cash on Delivery', '2020-02-09 17:52:37', '2020-02-09 09:52:37'),
(16, 'Bank Transfer - BPI', '2020-02-09 17:52:46', '2020-02-09 09:52:46'),
(17, 'Bank Transfer - BDO', '2020-02-09 17:53:10', '2020-02-09 09:53:10'),
(18, 'Cash', '2020-02-09 17:53:14', '2020-02-09 09:53:14'),
(19, 'Cebuana Lhuillier', '2020-02-09 17:53:40', '2020-02-09 09:53:40'),
(20, 'Cheque', '2020-02-09 17:53:47', '2020-02-09 09:53:47'),
(21, 'Credit Card', '2020-02-09 17:53:52', '2020-02-09 09:53:52'),
(22, 'Direct Debit', '2020-02-09 17:53:58', '2020-02-09 09:53:58'),
(23, 'Palawan Express', '2020-02-09 17:54:03', '2020-02-09 09:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `platformid` int(11) NOT NULL,
  `platform` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`platformid`, `platform`, `datecreated`, `dateupdated`) VALUES
(15, 'Lazada Shop', '2020-02-09 17:25:14', '2020-02-09 09:25:14'),
(16, 'Official Website', '2020-02-09 17:25:21', '2020-02-09 09:25:21'),
(17, 'Shopee', '2020-02-09 17:26:00', '2020-02-09 09:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `po_main`
--

CREATE TABLE `po_main` (
  `id` int(11) NOT NULL,
  `pom_id` varchar(50) NOT NULL,
  `batchnumber` varchar(50) NOT NULL,
  `ordernumber` varchar(50) NOT NULL,
  `exchangerate` varchar(50) NOT NULL,
  `freightinperunit` varchar(50) NOT NULL,
  `trackingnumber` varchar(50) NOT NULL,
  `courierid` varchar(50) NOT NULL,
  `creditcard` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `purchasedate` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `session_status` varchar(110) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `sys_vat` varchar(110) NOT NULL DEFAULT '0',
  `dlt` varchar(5) NOT NULL DEFAULT '0',
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_main`
--

INSERT INTO `po_main` (`id`, `pom_id`, `batchnumber`, `ordernumber`, `exchangerate`, `freightinperunit`, `trackingnumber`, `courierid`, `creditcard`, `remarks`, `purchasedate`, `status`, `session_status`, `session_id`, `sys_vat`, `dlt`, `datecreated`, `dateupdated`) VALUES
(9, 'MCPO4017B91HMD0', '0001', '0001', '50.912724', '20.5', '0001', '15', '1', 'Lorem ipsum', '2020-02-24', 'placed', '0', '5983806462', '130.00', '0', '2020-02-25 10:27:04', '2020-02-25 02:27:04'),
(10, '0489LM3I3OH9K87', '0003', '00054', '50.912998', '0002', '55404', '16', '1', 'Lorem ipsum', '2020-02-24', 'placed', '0', '5983806462', '130.00', '0', '2020-02-25 10:27:51', '2020-02-25 02:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `po_stock`
--

CREATE TABLE `po_stock` (
  `id` int(11) NOT NULL,
  `pos_id` varchar(50) NOT NULL,
  `pom_id` varchar(50) NOT NULL,
  `stocksid` varchar(50) DEFAULT NULL,
  `stockguid` varchar(220) DEFAULT NULL,
  `oldstocksid` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT '0',
  `oldquantity` varchar(50) DEFAULT NULL,
  `rate` varchar(50) DEFAULT '0',
  `unitpricedollars` varchar(50) DEFAULT NULL,
  `unitpricephp` varchar(50) DEFAULT NULL,
  `totalpricephp` varchar(50) DEFAULT NULL,
  `taxtotalperproduct` varchar(50) DEFAULT NULL,
  `taxperunit` varchar(50) DEFAULT NULL,
  `costperunit` varchar(50) DEFAULT NULL,
  `totalcostofgoods` varchar(50) DEFAULT NULL,
  `srp` varchar(50) DEFAULT NULL,
  `stockname` varchar(110) DEFAULT NULL,
  `stockcolor` varchar(50) DEFAULT NULL,
  `unitpricedollar` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_stock`
--

INSERT INTO `po_stock` (`id`, `pos_id`, `pom_id`, `stocksid`, `stockguid`, `oldstocksid`, `quantity`, `oldquantity`, `rate`, `unitpricedollars`, `unitpricephp`, `totalpricephp`, `taxtotalperproduct`, `taxperunit`, `costperunit`, `totalcostofgoods`, `srp`, `stockname`, `stockcolor`, `unitpricedollar`, `status`, `datecreated`, `dateupdated`) VALUES
(23, '8B34P4AKEEO6PF4', 'MCPO4017B91HMD0', '26', '0357e09c-f1f9-4411-9950-62f16a0d6cb9', '26', '4', '4', '50.912724', NULL, '28.00', '5702.225088', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 10:27:04', '2020-02-25 02:27:04'),
(24, '03F20E83NP4035P', 'MCPO4017B91HMD0', '28', '92836d1a-03f0-450a-bf69-4bf67fa6106e', '28', '6', '', '50.912724', NULL, '55.50', '16953.937092', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 10:27:17', '2020-02-25 02:27:17'),
(25, '0O0GC4H3LEN78HD', '0489LM3I3OH9K87', '28', '92836d1a-03f0-450a-bf69-4bf67fa6106e', '28', '6', '', '50.912998', NULL, '55.50', '16954.028334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 10:27:51', '2020-02-25 02:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `purchaseorderid` int(11) NOT NULL,
  `batchnumber` varchar(100) DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `ordernumber` varchar(100) DEFAULT NULL,
  `productid` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `unitpricedollars` varchar(100) DEFAULT NULL,
  `exchangerate` varchar(100) DEFAULT NULL,
  `unitpricephp` varchar(100) DEFAULT NULL,
  `totalpricedollars` varchar(100) DEFAULT NULL,
  `totalpricephp` varchar(100) DEFAULT NULL,
  `freightintotal` varchar(100) DEFAULT NULL,
  `freightinperunit` varchar(100) DEFAULT NULL,
  `taxtotalperproduct` varchar(100) DEFAULT NULL,
  `taxperunit` varchar(100) DEFAULT NULL,
  `costperunit` varchar(100) DEFAULT NULL,
  `totalcostofgoods` varchar(100) DEFAULT NULL,
  `srp` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `creditcard` varchar(100) DEFAULT NULL,
  `courierid` varchar(100) DEFAULT NULL,
  `trackingnumber` varchar(100) DEFAULT NULL,
  `stockname` varchar(100) DEFAULT NULL,
  `stockcolor` varchar(100) DEFAULT NULL,
  `stocksize` varchar(100) DEFAULT NULL,
  `unitpricedollar` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`purchaseorderid`, `batchnumber`, `purchasedate`, `ordernumber`, `productid`, `quantity`, `unitpricedollars`, `exchangerate`, `unitpricephp`, `totalpricedollars`, `totalpricephp`, `freightintotal`, `freightinperunit`, `taxtotalperproduct`, `taxperunit`, `costperunit`, `totalcostofgoods`, `srp`, `remarks`, `creditcard`, `courierid`, `trackingnumber`, `stockname`, `stockcolor`, `stocksize`, `unitpricedollar`, `status`, `datecreated`, `dateupdated`) VALUES
(7, '1111', '2019-11-05', '1111', '1', '10', '100', '100', '100', NULL, '100', '100', '100', '100', '100', '100', '100', '100', '', '1', '1', '4345645635', 'fgdgd', 'blue', 'xsmall', NULL, 'placed', '2019-11-24 16:46:07', '2019-11-24 08:46:07'),
(8, '1111', '2019-12-04', '1111', '1', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '', '2', '1', '145466456', 'fgdgd', 'blue', 'xsmall', NULL, 'placed', '2019-11-24 16:48:04', '2019-11-24 08:48:04'),
(9, '1122', '2019-11-05', '1122', '1', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '100', '', '1', '1', 'dfhfdghfgh', 'fgdgd', 'blue', 'xsmall', NULL, 'placed', '2019-11-24 17:51:16', '2019-11-24 09:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `user_id` varchar(220) NOT NULL,
  `customerorder` varchar(10) DEFAULT 'false',
  `supplierorder` varchar(10) DEFAULT 'false',
  `stockmanagement` varchar(10) DEFAULT 'false',
  `addstock` varchar(10) DEFAULT 'false',
  `deletestock` varchar(10) DEFAULT 'false',
  `productmanagement` varchar(10) DEFAULT 'false',
  `addcategories` varchar(10) DEFAULT 'false',
  `deletecategories` varchar(10) DEFAULT 'false',
  `addbrands` varchar(10) DEFAULT 'false',
  `addsuppliers` varchar(10) DEFAULT 'false',
  `deletebrands` varchar(10) DEFAULT 'false',
  `deletesuppliers` varchar(10) DEFAULT 'false',
  `addcouriers` varchar(10) DEFAULT 'false',
  `deletecouriers` varchar(10) DEFAULT 'false',
  `systemusers` varchar(250) DEFAULT 'false',
  `report` varchar(10) DEFAULT 'false',
  `dashboard` varchar(10) DEFAULT 'false',
  `categoriesmanagement` varchar(10) DEFAULT 'false',
  `brandsmanagement` varchar(10) DEFAULT 'false',
  `suppliersmanagement` varchar(10) DEFAULT 'false',
  `couriersmanagement` varchar(10) DEFAULT 'false',
  `auditlogs` varchar(10) DEFAULT 'false',
  `customermanagement` varchar(10) DEFAULT 'false',
  `settings` varchar(20) DEFAULT 'false',
  `addcustomer` varchar(10) DEFAULT 'false',
  `deletecustomer` varchar(10) DEFAULT 'false',
  `accessdrafts` varchar(24) DEFAULT 'false',
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `platform` varchar(20) DEFAULT 'false',
  `modeofpayment` varchar(20) DEFAULT 'false',
  `editvatvalue` varchar(20) DEFAULT 'false',
  `creditcard` varchar(20) DEFAULT 'false',
  `expenses` varchar(250) DEFAULT 'false',
  `account` varchar(250) DEFAULT 'false',
  `expensecategory` varchar(20) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `user_id`, `customerorder`, `supplierorder`, `stockmanagement`, `addstock`, `deletestock`, `productmanagement`, `addcategories`, `deletecategories`, `addbrands`, `addsuppliers`, `deletebrands`, `deletesuppliers`, `addcouriers`, `deletecouriers`, `systemusers`, `report`, `dashboard`, `categoriesmanagement`, `brandsmanagement`, `suppliersmanagement`, `couriersmanagement`, `auditlogs`, `customermanagement`, `settings`, `addcustomer`, `deletecustomer`, `accessdrafts`, `datecreated`, `dateupdated`, `platform`, `modeofpayment`, `editvatvalue`, `creditcard`, `expenses`, `account`, `expensecategory`) VALUES
(20, '5983806462', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'false', '2019-10-26 16:38:20', '2020-02-20 01:12:44', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(21, '1857040984', 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', '2019-10-28 19:44:29', '2020-02-20 01:06:20', 'true', 'false', 'false', 'false', 'false', 'true', 'false'),
(22, '5094589641', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', '2019-11-16 18:57:16', '2020-02-20 00:58:17', 'false', 'false', 'false', 'false', 'false', 'true', 'false'),
(23, '3J9BHA3A8LI20HL', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', '2019-12-14 22:51:05', '2020-02-20 00:58:20', 'false', 'false', 'false', 'false', 'false', 'true', 'false'),
(24, '3DDJDNNCKM4NDCA', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true', 'true', 'false', 'false', 'false', '2020-02-20 09:06:02', '2020-02-20 01:06:12', 'true', 'true', 'false', 'true', 'true', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `snldata`
--

CREATE TABLE `snldata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `itemid` varchar(110) DEFAULT NULL,
  `module` varchar(110) DEFAULT NULL,
  `folder` varchar(110) DEFAULT NULL,
  `path` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snldata`
--

INSERT INTO `snldata` (`id`, `name`, `filename`, `itemid`, `module`, `folder`, `path`) VALUES
(71, 'torasshuu_Colorkuler_Palette.png', '59G2AHA9G28AKC51582525262.png', '0357e09c-f1f9-4411-9950-62f16a0d6cb9', 'stocks', 'stocks', 'data/stocks/59G2AHA9G28AKC51582525262.png'),
(72, 'New Project.png', 'M7IMN5843EF91AO1582525379.png', '92836d1a-03f0-450a-bf69-4bf67fa6106e', 'stocks', 'stocks', 'data/stocks/M7IMN5843EF91AO1582525379.png'),
(73, '02-24-2020-dbsnl.sql', '7FLP6P2644OIKE31582761785.sql', 'JHAL978D94L7K9C', 'expense', 'expense', 'data/expense/7FLP6P2644OIKE31582761785.sql');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocksid` int(11) NOT NULL,
  `guid` varchar(220) DEFAULT NULL,
  `stockname` varchar(290) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `stockcolor` varchar(290) NOT NULL,
  `stocksize` varchar(290) NOT NULL,
  `availablestocks` int(11) NOT NULL,
  `costperunit` varchar(280) NOT NULL,
  `unitprice` varchar(290) NOT NULL,
  `rate` varchar(290) NOT NULL,
  `sku` varchar(200) NOT NULL,
  `reorderpoint` date DEFAULT NULL,
  `threshold` varchar(250) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateupdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocksid`, `guid`, `stockname`, `categoryid`, `brandid`, `supplierid`, `stockcolor`, `stocksize`, `availablestocks`, `costperunit`, `unitprice`, `rate`, `sku`, `reorderpoint`, `threshold`, `datecreated`, `dateupdated`) VALUES
(26, '0357e09c-f1f9-4411-9950-62f16a0d6cb9', 'Alexus Paint', 59, 92, 24, 'Red', 'Extra Small', 885, '25', '28', '', '25', NULL, NULL, '2020-02-24 06:21:42', '2020-02-24 14:21:42'),
(28, '92836d1a-03f0-450a-bf69-4bf67fa6106e', 'Angelic Paint', 59, 92, 26, 'Blue', 'Extra Small', 367, '45', '55.50', '', '49.50', '2020-02-23', '50', '2020-02-24 06:23:01', '2020-02-24 14:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `sub_menu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `role` varchar(110) NOT NULL,
  `url` varchar(110) NOT NULL,
  `description` varchar(110) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`sub_menu_id`, `menu_id`, `sort`, `role`, `url`, `description`, `datecreated`, `dateupdated`) VALUES
(3, 4, 2, 'categoriesmanagement', 'categories_management.php', 'Categories', '2019-10-21 18:39:39', '2019-10-21 10:46:07'),
(4, 4, 3, 'brandsmanagement', 'brands_management.php\r\n', 'Brands', '2019-10-21 18:42:32', '2019-10-21 10:46:10'),
(5, 4, 4, 'suppliersmanagement', 'suppliers_management.php', 'Suppliers', '2019-10-21 18:42:32', '2019-10-21 10:46:15'),
(6, 4, 5, 'couriersmanagement', 'couriers_management.php', 'Couriers', '2019-10-21 18:47:45', '2020-02-20 01:19:09'),
(8, 15, 1, 'platform', 'setting_platform.php', 'Platform', '2019-10-21 18:47:45', '2020-02-09 04:09:03'),
(9, 15, 2, 'modeofpayment', 'setting_modeofpayment.php', 'Mode of payment', '2019-10-21 18:47:45', '2020-02-09 04:12:14'),
(10, 15, 3, 'editvatvalue', 'setting_editvatvalue.php', 'Edit Vat Value', '2019-10-21 18:47:45', '2020-02-09 04:13:52'),
(11, 15, 4, 'creditcard', 'setting_creditcard.php', 'Credit Card', '2019-10-21 18:47:45', '2020-02-09 04:12:14'),
(12, 15, 5, 'expensecategory', 'setting_expense_category.php', 'Expense Category', '2020-02-17 14:46:25', '2020-02-17 06:47:59'),
(14, 4, 6, 'customermanagement', 'customer_management.php', 'Customers', '2020-02-20 09:20:05', '2020-02-20 01:20:54'),
(15, 15, 5, 'account', 'setting_account.php', 'Accounts', '2020-03-29 16:47:06', '2020-03-29 08:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `supplierorder`
--

CREATE TABLE `supplierorder` (
  `supplierorderid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `stockid` int(11) NOT NULL,
  `freightbill` varchar(256) NOT NULL,
  `sostatus` varchar(290) NOT NULL,
  `sortedby` varchar(290) NOT NULL,
  `sopurchasedate` varchar(290) NOT NULL,
  `sopurchasetime` varchar(290) NOT NULL,
  `soremarks` varchar(290) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateupdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierid` int(11) NOT NULL,
  `supplierguid` varchar(110) DEFAULT NULL,
  `suppliername` varchar(250) NOT NULL,
  `supplieraddress` varchar(250) NOT NULL,
  `scontactperson` varchar(250) NOT NULL,
  `sphonenumber` varchar(250) NOT NULL,
  `semail` varchar(250) NOT NULL,
  `swebsite` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierid`, `supplierguid`, `suppliername`, `supplieraddress`, `scontactperson`, `sphonenumber`, `semail`, `swebsite`, `datecreated`, `dateupdated`) VALUES
(24, '5646565456JKJ', 'Supplier Rock', 'Baguio City', 'Adam Smith', '094523442', 'supplierrock@gmail.com', 'www.supplier-rock.com', '2019-11-15 19:43:33', '2019-11-15 11:43:33'),
(25, '65464654KJLHUG', 'Logistics on Go', 'Villasis, Pangasinan', 'Adam Williams', '09235235235', 'adamwilliams@logisticsongo.com', 'www.logisticsongo.com', '2019-11-15 19:44:22', '2019-11-15 11:44:22'),
(26, 'GJFGUYFUKLKL5454', 'GreenStreet Supplier Co.', 'Santa Barbara, Pangasinan', 'Anna Beth', '0934553', 'gstreet@gmail.com', 'www.g-street.com', '2019-11-15 19:45:23', '2019-11-15 11:45:23'),
(31, 'F9H9888LFHOCBJA', 'TEST', 'California Street', 'khen', '2035265854', 'snl@mailinator.com', 'ffffffff', '2020-02-11 21:40:00', '2020-02-11 13:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_setting`
--

CREATE TABLE `system_setting` (
  `sys_id` int(11) NOT NULL,
  `sys_name` varchar(110) NOT NULL,
  `sys_value` varchar(10) NOT NULL DEFAULT '0',
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_setting`
--

INSERT INTO `system_setting` (`sys_id`, `sys_name`, `sys_value`, `datecreated`, `dateupdated`) VALUES
(2, 'VAT', '130', '2020-01-30 18:48:36', '2020-01-30 10:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(220) NOT NULL,
  `username` varchar(220) NOT NULL,
  `firstname` varchar(220) NOT NULL,
  `lastname` varchar(220) NOT NULL,
  `address` varchar(220) NOT NULL,
  `contactnumber` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `password` varchar(220) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `username`, `firstname`, `lastname`, `address`, `contactnumber`, `email`, `password`, `datecreated`, `dateupdated`) VALUES
(26, '5983806462', 'superagent', 'Super', 'Agent', 'Pangasinan', '0934343445', 'superagent@mailinator.com', '21232f297a57a5a743894a0e4a801fc3', '2019-10-26 16:38:20', '2019-10-26 08:38:20'),
(27, '1857040984', 'admin', 'd', 'dsd', 'sds', 'sd', 'dsdsd', 'fcea920f7412b5da7be0cf42b8c93759', '2019-10-28 19:44:28', '2020-02-23 04:43:29'),
(28, '5094589641', 'kkkd', 'adad', 'dadad', 'dada', 'dadad', 'adadad', 'fcea920f7412b5da7be0cf42b8c93759', '2019-11-16 18:57:15', '2020-02-23 04:44:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountid`);

--
-- Indexes for table `account_detail`
--
ALTER TABLE `account_detail`
  ADD PRIMARY KEY (`accdetailsid`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`acctypeid`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `category_exp`
--
ALTER TABLE `category_exp`
  ADD PRIMARY KEY (`categexpid`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`courierid`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`creditcardid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`customerorderid`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expenseid`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_item`
--
ALTER TABLE `expense_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `modeofpayment`
--
ALTER TABLE `modeofpayment`
  ADD PRIMARY KEY (`mopid`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`platformid`);

--
-- Indexes for table `po_main`
--
ALTER TABLE `po_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_stock`
--
ALTER TABLE `po_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`purchaseorderid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `snldata`
--
ALTER TABLE `snldata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocksid`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`sub_menu_id`);

--
-- Indexes for table `supplierorder`
--
ALTER TABLE `supplierorder`
  ADD PRIMARY KEY (`supplierorderid`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierid`);

--
-- Indexes for table `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_detail`
--
ALTER TABLE `account_detail`
  MODIFY `accdetailsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `acctypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `category_exp`
--
ALTER TABLE `category_exp`
  MODIFY `categexpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `courierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `creditcardid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `customerorderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `expense_item`
--
ALTER TABLE `expense_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modeofpayment`
--
ALTER TABLE `modeofpayment`
  MODIFY `mopid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `platformid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `po_main`
--
ALTER TABLE `po_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `po_stock`
--
ALTER TABLE `po_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `purchaseorderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `snldata`
--
ALTER TABLE `snldata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocksid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `sub_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `sys_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
