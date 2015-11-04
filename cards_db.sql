-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2015 at 09:46 AM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cards_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `number` bigint(20) NOT NULL AUTO_INCREMENT,
  `series` int(11) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`number`),
  KEY `series` (`series`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`number`, `series`, `issue_date`, `expiration_date`, `status`) VALUES
(4, 1, '2015-11-03 14:45:06', '2016-05-01 16:45:06', 2),
(6, 2, '2015-11-03 14:45:48', '2015-12-03 16:45:48', 1),
(7, 2, '2015-11-03 14:45:48', '2015-12-03 16:45:48', 2),
(9, 2, '2015-11-03 14:45:48', '2015-12-03 16:45:48', 2),
(10, 2, '2015-11-03 14:45:48', '2015-12-03 16:45:48', 1),
(14, 3, '2015-11-03 20:52:45', '2015-12-03 22:52:45', 2),
(15, 3, '2015-11-03 20:52:45', '2015-12-03 22:52:45', 1),
(16, 4, '2015-11-03 20:53:31', '2015-12-03 22:53:31', 1),
(18, 4, '2015-11-03 20:53:31', '2015-12-03 22:53:31', 1),
(19, 4, '2015-11-03 20:53:31', '2015-12-03 22:53:31', 1),
(20, 4, '2015-11-03 20:53:31', '2015-12-03 22:53:31', 1),
(21, 5, '2015-11-03 20:53:47', '2015-12-03 22:53:47', 1),
(22, 5, '2015-11-03 20:53:47', '2015-12-03 22:53:47', 1),
(23, 5, '2015-11-03 20:53:47', '2015-12-03 22:53:47', 1),
(24, 5, '2015-11-03 20:53:47', '2015-12-03 22:53:47', 1),
(25, 5, '2015-11-03 20:53:47', '2015-12-03 22:53:47', 1),
(26, 6, '2015-11-03 20:55:05', '2015-12-03 22:55:05', 1),
(27, 6, '2015-11-03 20:55:05', '2015-12-03 22:55:05', 1),
(28, 6, '2015-11-03 20:55:05', '2015-12-03 22:55:05', 1),
(29, 6, '2015-11-03 20:55:05', '2015-12-03 22:55:05', 1),
(30, 6, '2015-11-03 20:55:05', '2015-12-03 22:55:05', 1),
(31, 7, '2015-11-03 20:56:19', '2015-12-03 22:56:19', 1),
(32, 7, '2015-11-03 20:56:19', '2015-12-03 22:56:19', 1),
(33, 7, '2015-11-03 20:56:19', '2015-12-03 22:56:19', 1),
(34, 7, '2015-11-03 20:56:19', '2015-12-03 22:56:19', 1),
(35, 7, '2015-11-03 20:56:19', '2015-12-03 22:56:19', 1),
(36, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(37, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(38, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(39, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(40, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(41, 8, '2015-11-03 21:02:53', '2016-05-01 23:02:53', 1),
(43, 9, '2015-11-04 08:09:07', '2016-05-02 10:09:07', 1),
(44, 10, '2015-11-04 08:45:39', '2015-12-04 10:45:39', 2),
(45, 10, '2015-11-04 08:45:39', '2015-12-04 10:45:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `card_deals`
--

CREATE TABLE IF NOT EXISTS `card_deals` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `card_number` bigint(20) NOT NULL,
  `info` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `card_number` (`card_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `card_expiration_types`
--

CREATE TABLE IF NOT EXISTS `card_expiration_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `exp_interval` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `card_expiration_types`
--

INSERT INTO `card_expiration_types` (`id`, `name`, `exp_interval`) VALUES
(1, '1 month', 30),
(2, '6 months', 180),
(4, '1 year', 365);

-- --------------------------------------------------------

--
-- Table structure for table `card_status_type`
--

CREATE TABLE IF NOT EXISTS `card_status_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `card_status_type`
--

INSERT INTO `card_status_type` (`id`, `name`) VALUES
(1, 'active'),
(2, 'inactive'),
(3, 'expired');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
