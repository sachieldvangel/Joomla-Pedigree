-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 01:39 PM
-- Server version: 5.5.30-30.1
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ahiafgha_joomla32`
--

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_patterns`
--

CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_patterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(20) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Color` (`pattern`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mu9ez_pedigree_patterns`
--

INSERT INTO `mu9ez_pedigree_patterns` (`id`, `pattern`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'Black mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Domino', 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Self mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(4, 'Shaded mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(5, 'No mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(6, 'Brindle', 0, 1, 0, '0000-00-00 00:00:00', 0),
(7, 'Mask', 0, 1, 0, '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
