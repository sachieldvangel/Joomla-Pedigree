-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 01:21 PM
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
-- Table structure for table `mu9ez_pedigree_colors`
--

CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_color` (`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `mu9ez_pedigree_colors`
--

INSERT INTO `mu9ez_pedigree_colors` (`id`, `color`, `description`, `image`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'Apricot', '', 'apricot.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(10, 'Black', '', 'black.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(11, 'Black and Brindle', '', 'blackbrindle.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(12, 'Black and Cream', '', 'blackcream.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(13, 'Black and Gold', '', 'blackgold.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(14, 'Black and White', '', 'blackwhite.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(15, 'Black and Silver', '', 'blacksilver.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(16, 'Black and Tan', '', 'blacktan.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(18, 'Blue', '', 'blue.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(22, 'Blue Brindle', '', 'bluebrindle.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(25, 'Brindle', '', 'brindle.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(28, 'Cream', '', 'cream.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(30, 'Fawn', '', 'fawn.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(31, 'Gold', '', 'gold.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(33, 'Red', '', 'red.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(35, 'Red Brindle', '', 'redbrindle.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(39, 'Silver', '', 'silver.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(44, 'White', '', 'white.gif', 0, 1, 0, '0000-00-00 00:00:00', 0),
(46, 'Blue and Tan', '', 'bluetan.gif', 0, 1, 0, '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
