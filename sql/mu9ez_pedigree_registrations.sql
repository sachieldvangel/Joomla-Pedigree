-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2014 at 10:42 AM
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
-- Table structure for table `mu9ez_pedigree_registrations`
--

CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dog` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `is_primary` tinyint(1) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `registration_name` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_country` (`id_country`),
  UNIQUE KEY `idx_dog_country` (`id_dog`,`id_country`),
  KEY `idx_dog` (`id_dog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mu9ez_pedigree_registrations`
--
ALTER TABLE `mu9ez_pedigree_registrations`
  ADD CONSTRAINT `fk_registration_country` FOREIGN KEY (`id_country`) REFERENCES `mu9ez_pedigree_countries` (`id`),
  ADD CONSTRAINT `fk_registration_dog` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reg_dog` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
