-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 01:49 PM
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
-- Table structure for table `mu9ez_pedigree_dogs`
--

CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_dogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_sire` int(11) DEFAULT NULL,
  `id_dam` int(11) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `call_name` varchar(50) NOT NULL DEFAULT '',
  `id_gallery_category` int(11) DEFAULT NULL,
  `coi` double DEFAULT NULL,
  `kc_stud_number` varchar(100) DEFAULT NULL,
  `kc_brs_number` varchar(20) DEFAULT NULL,
  `litter_number` varchar(20) DEFAULT NULL,
  `atc_number` varchar(50) DEFAULT NULL,
  `akc_website` tinyint(1) DEFAULT NULL,
  `birth_date` varchar(10) DEFAULT NULL,
  `id_color` int(11) DEFAULT NULL,
  `color_variations` varchar(100) DEFAULT NULL,
  `id_pattern` int(11) DEFAULT NULL,
  `is_scented` tinyint(1) DEFAULT NULL,
  `is_smooth` tinyint(1) DEFAULT NULL,
  `is_bearded` tinyint(1) DEFAULT NULL,
  `titles_prefix` varchar(255) DEFAULT NULL,
  `titles_suffix` varchar(255) DEFAULT NULL,
  `title_conformation` varchar(100) DEFAULT NULL,
  `title_conformation_year` int(11) DEFAULT NULL,
  `title_additional` varchar(100) DEFAULT NULL,
  `titles_coursing_racing` varchar(100) DEFAULT NULL,
  `titles_agility_rally` varchar(100) DEFAULT NULL,
  `titles_obedience` varchar(100) DEFAULT NULL,
  `titles_other` varchar(100) DEFAULT NULL,
  `uk_ccs` varchar(100) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `microchip` varchar(25) DEFAULT NULL,
  `dna_profile` varchar(100) DEFAULT NULL,
  `ofa_registration_number` varchar(100) DEFAULT NULL,
  `chic_number` varchar(10) DEFAULT NULL,
  `health_test_thyroid` varchar(255) DEFAULT NULL,
  `health_test_elbow` varchar(255) DEFAULT NULL,
  `health_test_hips` varchar(255) DEFAULT NULL,
  `health_test_eyes` varchar(255) DEFAULT NULL,
  `health_test_heart` varchar(255) DEFAULT NULL,
  `health_notes` varchar(255) DEFAULT NULL,
  `death_date` varchar(10) DEFAULT NULL,
  `death_cause` varchar(255) DEFAULT NULL,
  `exports` varchar(255) DEFAULT NULL,
  `is_stud` tinyint(1) DEFAULT NULL,
  `stud_details` varchar(255) DEFAULT NULL,
  `is_semen` tinyint(1) DEFAULT NULL,
  `is_ai` tinyint(1) DEFAULT NULL,
  `litter_announcement` tinyint(1) DEFAULT NULL,
  `litter_details` varchar(255) DEFAULT NULL,
  `notes` text,
  `articles` varchar(255) DEFAULT NULL,
  `videos` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`),
  KEY `idx_dam` (`id_dam`),
  KEY `idx_sire` (`id_sire`),
  KEY `idx_name_sex` (`name`,`sex`),
  KEY `idx_color` (`id_color`),
  KEY `idx_pattern` (`id_pattern`),
  KEY `idx_gallerycategory` (`id_gallery_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=227580 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mu9ez_pedigree_dogs`
--
ALTER TABLE `mu9ez_pedigree_dogs`
  ADD CONSTRAINT `fk_color_dog` FOREIGN KEY (`id_Color`) REFERENCES `mu9ez_pedigree_colors` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dam_dog` FOREIGN KEY (`id_Dam`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dogs_color` FOREIGN KEY (`id_color`) REFERENCES `mu9ez_pedigree_colors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_dam` FOREIGN KEY (`id_dam`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_pattern` FOREIGN KEY (`id_pattern`) REFERENCES `mu9ez_pedigree_patterns` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_sire` FOREIGN KEY (`id_sire`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pattern_dog` FOREIGN KEY (`id_Pattern`) REFERENCES `mu9ez_pedigree_patterns` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sire_dog` FOREIGN KEY (`id_Sire`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
