-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2014 at 07:27 PM
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
-- Table structure for table `mu9ez_pedigree_audits`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_audits`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(15) DEFAULT NULL,
  `operation_type` enum('Insert','Update','Deleted','Unknown') NOT NULL DEFAULT 'Update',
  `operation_table` varchar(64) NOT NULL,
  `operation_field` varchar(64) NOT NULL,
  `operation_id` int(11) NOT NULL COMMENT 'ID row',
  `operation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `operation_olddata` varchar(1024) DEFAULT NULL,
  `operation_newdata` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=276101 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_breeders`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_breeders`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_breeders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  `id_dog` int(11) NOT NULL,
  `is_primary` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_person_dog` (`id_person`,`id_dog`),
  KEY `idx_person` (`id_person`),
  KEY `idx_dog` (`id_dog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_colors`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_colors`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_color` (`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_countries`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_countries`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `short_name` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `long_name` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `iso3` char(3) CHARACTER SET latin1 DEFAULT NULL,
  `numcode` varchar(6) CHARACTER SET latin1 DEFAULT NULL,
  `un_member` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `calling_code` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  `cctld` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `id_oldval` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_dogs`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_dogs`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_dogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `id_sire` int(11) DEFAULT NULL,
  `id_dam` int(11) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `call_name` varchar(50) DEFAULT NULL,
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
  `death_date` varchar(25) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`),
  KEY `idx_dam` (`id_dam`),
  KEY `idx_sire` (`id_sire`),
  KEY `idx_name_sex` (`name`,`sex`),
  KEY `idx_color` (`id_color`),
  KEY `idx_pattern` (`id_pattern`),
  KEY `idx_gallerycategory` (`id_gallery_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=227580 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_dogs_delegation`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_dogs_delegation`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_dogs_delegation` (
  `id` int(11) NOT NULL,
  `id_dog` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Dog_User` (`id_dog`,`id_user`),
  KEY `idx_Dog` (`id_dog`),
  KEY `idx_User` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_judging`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_judging`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_judging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_person` (`id_person`,`id_country`,`date`),
  KEY `idx_person` (`id_person`),
  KEY `idx_country` (`id_country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_owners`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_owners`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  `id_dog` int(11) NOT NULL,
  `is_primary` tinyint(1) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Person_Dog` (`id_person`,`id_dog`),
  KEY `idx_Person` (`id_person`),
  KEY `idx_Dog` (`id_dog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_patterns`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_patterns`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_patterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(20) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Color` (`pattern`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_people`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_people`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `id_country` int(11) NOT NULL,
  `home_phone` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `fb_profile` varchar(255) DEFAULT NULL,
  `kennel_name` varchar(100) DEFAULT NULL,
  `notes` text,
  `is_judge` tinyint(1) DEFAULT NULL,
  `judge_info` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_last_first_country` (`last_name`,`first_name`,`id_country`),
  KEY `idx_country` (`id_country`),
  KEY `idx_kennel` (`kennel_name`),
  KEY `idx_lastname` (`last_name`(5))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Owners and Breeders' AUTO_INCREMENT=104251 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_people_delegation`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_people_delegation`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_people_delegation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Person_User` (`id_person`,`id_user`),
  KEY `idx_User` (`id_user`),
  KEY `idx_Person` (`id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_registrations`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_registrations`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dog` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `is_primary` tinyint(1) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `registration_name` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_country` (`id_country`),
  UNIQUE KEY `idx_dog_country` (`id_dog`,`id_country`),
  KEY `idx_dog` (`id_dog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mu9ez_pedigree_breeders`
--
ALTER TABLE `mu9ez_pedigree_breeders`
  ADD CONSTRAINT `fk_breeders_dog` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_breeders_dogs` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_breeders_people` FOREIGN KEY (`id_Person`) REFERENCES `mu9ez_pedigree_people` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_breeders_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu9ez_pedigree_dogs`
--
ALTER TABLE `mu9ez_pedigree_dogs`
  ADD CONSTRAINT `fk_dogs_pattern` FOREIGN KEY (`id_pattern`) REFERENCES `mu9ez_pedigree_patterns` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_color_dog` FOREIGN KEY (`id_Color`) REFERENCES `mu9ez_pedigree_colors` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dam_dog` FOREIGN KEY (`id_Dam`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dogs_color` FOREIGN KEY (`id_color`) REFERENCES `mu9ez_pedigree_colors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_dam` FOREIGN KEY (`id_dam`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_sire` FOREIGN KEY (`id_sire`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pattern_dog` FOREIGN KEY (`id_Pattern`) REFERENCES `mu9ez_pedigree_patterns` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sire_dog` FOREIGN KEY (`id_Sire`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `mu9ez_pedigree_dogs_delegation`
--
ALTER TABLE `mu9ez_pedigree_dogs_delegation`
  ADD CONSTRAINT `mu9ez_pedigree_dogs_delegation_ibfk_1` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delecation_user` FOREIGN KEY (`id_User`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delegation_dog` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delegation_user` FOREIGN KEY (`id_user`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu9ez_pedigree_judging`
--
ALTER TABLE `mu9ez_pedigree_judging`
  ADD CONSTRAINT `fk_judging_country` FOREIGN KEY (`id_country`) REFERENCES `mu9ez_pedigree_countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_judging_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu9ez_pedigree_owners`
--
ALTER TABLE `mu9ez_pedigree_owners`
  ADD CONSTRAINT `fk_owner_dog` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owners_dog` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owners_people` FOREIGN KEY (`id_Person`) REFERENCES `mu9ez_pedigree_people` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owners_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu9ez_pedigree_people_delegation`
--
ALTER TABLE `mu9ez_pedigree_people_delegation`
  ADD CONSTRAINT `mu9ez_pedigree_people_delegation_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delegation_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idx_Delegation_Person` FOREIGN KEY (`id_Person`) REFERENCES `mu9ez_pedigree_people` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idx_Delegation_User` FOREIGN KEY (`id_User`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
