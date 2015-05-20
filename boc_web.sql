-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2015 at 12:38 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boc_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_activity`
--

CREATE TABLE IF NOT EXISTS `assign_activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `call_executive` varchar(255) NOT NULL,
  `customer_mobile` varchar(255) NOT NULL,
  `vendor_mobile` varchar(255) NOT NULL,
  `workers_mobile` varchar(255) NOT NULL,
  `service_date` varchar(255) NOT NULL,
  `service_duration` varchar(255) NOT NULL,
  `service_price` varchar(255) NOT NULL,
  `job_status` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assign_activity`
--

INSERT INTO `assign_activity` (`id`, `call_executive`, `customer_mobile`, `vendor_mobile`, `workers_mobile`, `service_date`, `service_duration`, `service_price`, `job_status`, `modified`) VALUES
(2, '8595247365', '7042262749', '9540496952', '', '2015-05-21T13:00', '5 hr', '4000', 'assigned', '2015-05-20 09:41:40'),
(3, '8595247365', '7042262749', '9540496952', '', '2015-05-21T13:00', '5 hr', '4000', 'assigned', '2015-05-20 09:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `co_workers`
--

CREATE TABLE IF NOT EXISTS `co_workers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `y_exp` varchar(255) NOT NULL,
  `dateofbirth` varchar(255) NOT NULL,
  `exp_details` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `co_workers`
--

INSERT INTO `co_workers` (`id`, `Name`, `mobile`, `c_address`, `y_exp`, `dateofbirth`, `exp_details`, `vendor_id`, `modified`) VALUES
(1, 'ABC Ahmed', '9749678273', 'h jgfjka g', '5', '2015-05-14T13:00', 'jjeejhej', '1', '2015-05-19 10:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `prefix`, `name`, `mobile`, `email`, `c_address`, `modified`) VALUES
(1, 'Mr.', 'Sanjeev', '7042262749', 'san@abc.com', 'fkdf ksnfdk', '2015-05-20 09:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `customer_query`
--

CREATE TABLE IF NOT EXISTS `customer_query` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `landmark` varchar(255) NOT NULL,
  `looking_for` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `job_subcategory` varchar(255) NOT NULL,
  `jd` varchar(255) NOT NULL,
  `expected_date` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_query`
--

INSERT INTO `customer_query` (`id`, `landmark`, `looking_for`, `job_category`, `job_subcategory`, `jd`, `expected_date`, `customer_id`, `modified`) VALUES
(1, 'dhkwd', '3', '12', '', 'dfdf  wdff', '2015-05-21T13:00', '1', '2015-05-20 09:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `description`, `order_by`, `modified`) VALUES
(1, 'Electrician', '', 1, '2015-05-16 07:16:36'),
(2, 'Plumbing', '', 2, '2015-05-16 07:16:41'),
(3, 'Appliances', '', 3, '2015-05-16 07:16:45'),
(4, 'Carpenter', '', 4, '2015-05-16 07:16:49'),
(5, 'Computer', '', 5, '2015-05-16 07:17:35'),
(6, 'Painter', '', 6, '2015-05-16 07:17:35'),
(7, 'KeyMaker', '', 7, '2015-05-16 07:18:19'),
(8, 'Dry Cleaner', '', 8, '2015-05-16 07:18:19'),
(9, 'Pest Control', '', 9, '2015-05-16 07:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE IF NOT EXISTS `job_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `job_id` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `name`, `description`, `job_id`, `modified`) VALUES
(1, 'fix lights/switches', '', '1', '2015-05-16 07:20:58'),
(2, 'Check and fix wiring or voltage problem', '', '1', '2015-05-16 07:20:58'),
(3, 'fix and repair MCB', '', '1', '2015-05-16 07:21:42'),
(4, 'fix television', '', '1', '2015-05-16 07:21:42'),
(5, 'install inverter', '', '1', '2015-05-16 07:22:59'),
(6, 'fix drainage', '', '2', '2015-05-16 07:24:08'),
(7, 'fix faucets', '', '2', '2015-05-16 07:24:08'),
(8, 'fix leakage', '', '2', '2015-05-16 07:24:42'),
(9, 'clean tank', '', '2', '2015-05-16 07:24:42'),
(10, 'install A.C.', '', '3', '2015-05-16 07:25:30'),
(11, 'fix Stabilizer', '', '3', '2015-05-16 07:25:30'),
(12, 'fix or repair refrigerator', '', '3', '2015-05-16 07:26:34'),
(13, 'repair microwave or washing machine', '', '3', '2015-05-16 07:26:34'),
(14, 'repair or service R.O.', '', '3', '2015-05-16 07:27:36'),
(15, 'assemble furniture', '', '4', '2015-05-16 07:28:53'),
(16, 'repair sofa set', '', '4', '2015-05-16 07:28:53'),
(17, 'fix hinges', '', '4', '2015-05-16 07:29:41'),
(18, 'fix or repair doors or windows', '', '4', '2015-05-16 07:29:41'),
(19, 'Check Hanging', '', '5', '2015-05-16 07:30:52'),
(20, 'install software', '', '5', '2015-05-16 07:30:52'),
(21, 'format system', '', '5', '2015-05-16 07:31:30'),
(22, 'Check Viruses', '', '5', '2015-05-16 07:31:30'),
(23, 'Walls', 'house/ office/ farm house', '6', '2015-05-16 07:33:41'),
(24, 'Almirah', 'Corporate Office', '6', '2015-05-16 07:35:05'),
(25, 'Furnitures', '', '6', '2015-05-16 07:32:51'),
(26, 'make duplicate key', '', '7', '2015-05-16 07:36:16'),
(27, 'unlock luggage', '', '7', '2015-05-16 07:36:16'),
(28, 'make lock or key for almirah', '', '7', '2015-05-16 07:38:28'),
(29, 'make lock or key for cupboard', '', '7', '2015-05-16 07:38:59'),
(30, 'make lock or key for locker', '', '7', '2015-05-16 07:38:59'),
(31, 'Kurtis', '', '8', '2015-05-16 07:40:08'),
(32, 'designer lehanga', '', '8', '2015-05-16 07:40:08'),
(33, 'Wedding Suits', '', '8', '2015-05-16 07:40:43'),
(34, 'Formal Suits', '', '8', '2015-05-16 07:41:07'),
(35, 'Blanket or Bedsheet', '', '8', '2015-05-16 07:41:41'),
(36, 'House', '', '9', '2015-05-16 07:43:17'),
(37, 'Small Office', '', '9', '2015-05-16 07:43:17'),
(38, 'Corporate Office', '', '9', '2015-05-16 07:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `job_subcategory`
--

CREATE TABLE IF NOT EXISTS `job_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `job_subcategory`
--

INSERT INTO `job_subcategory` (`id`, `name`, `description`, `job_id`, `modified`) VALUES
(1, 'House', '', 6, '2015-05-16 07:48:10'),
(2, 'Office', '', 6, '2015-05-16 07:48:10'),
(3, 'Corporate Office', '', 6, '2015-05-16 07:48:48'),
(4, 'Farm House', '', 6, '2015-05-16 07:48:48'),
(5, 'Cockroaches & Mosquitoes', '', 9, '2015-05-16 07:49:36'),
(6, 'Termites', '', 9, '2015-05-16 07:49:36'),
(7, 'Rats and Lizards', '', 9, '2015-05-16 07:50:13'),
(8, 'All insects', '', 9, '2015-05-16 07:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `area_covered` varchar(255) NOT NULL,
  `exp_details` varchar(255) NOT NULL,
  `service_schedule` varchar(255) NOT NULL,
  `dateofbirth` varchar(255) NOT NULL,
  `y_exp` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `job_subcategory` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `prefix`, `name`, `mobile`, `c_address`, `area_covered`, `exp_details`, `service_schedule`, `dateofbirth`, `y_exp`, `services`, `job_category`, `job_subcategory`, `modified`) VALUES
(1, 'Dr.', 'ABC Kumar', '9540496952', 'ejfhej erherh', 'Civil Lines', 'kjsfh jshh', 'jkksdf hfjdh', '2015-05-29T13:00', '6', '5', '20', '', '2015-05-20 09:38:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
