-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2014 at 03:20 PM
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
CREATE DATABASE IF NOT EXISTS `ahiafgha_joomla32` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ahiafgha_joomla32`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_g2Albums`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_g2Albums`()
    NO SQL
BEGIN

SELECT a.*, c.g_parentId, d.g_pathComponent
FROM g2_Item a
INNER JOIN g2_AlbumItem b ON a.g_id = b.g_id
LEFT JOIN g2_ChildEntity c on a.g_id = c.g_id
LEFT JOIN g2_FileSystemEntity d ON a.g_id = d.g_id
ORDER BY a.g_id, c.g_parentId;

END$$

DROP PROCEDURE IF EXISTS `sp_g2Photos`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_g2Photos`()
    NO SQL
BEGIN

SELECT a.*, b.*, d.*, c.g_parentId FROM g2_Item a
INNER JOIN g2_PhotoItem b ON a.g_id = b.g_id
LEFT JOIN g2_FileSystemEntity d ON a.g_id = d.g_id
LEFT JOIN g2_ChildEntity c on a.g_id = c.g_id
ORDER BY a.g_id, c.g_parentId;

END$$

DROP PROCEDURE IF EXISTS `sp_ImportDogs`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_ImportDogs`()
    NO SQL
BEGIN

SELECT * FROM draaf_stamboom;

END$$

DROP PROCEDURE IF EXISTS `sp_ImportOwners`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_ImportOwners`()
    NO SQL
BEGIN

/*
OWNERS 
*/
INSERT INTO mu9ez_pedigree_owners (id, id_person, id_dog, is_primary, date_start, date_end, ordering, state)
SELECT null, id_eigenaar, ID, 1, null, null, null, 1
FROM draaf_stamboom;

END$$

DROP PROCEDURE IF EXISTS `sp_ImportPeople`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_ImportPeople`()
    NO SQL
BEGIN

/* TAKE OUT */
DELETE FROM mu9ez_pedigree_people;

/*
PEOPLE
*/
/* Country Fixes */
UPDATE draaf_eigenaar SET woonplaats = 'Jersey' WHERE woonplaats = 'Channel Islands';
UPDATE draaf_eigenaar SET woonplaats = 'Colombia' WHERE woonplaats = 'Columbia';
UPDATE draaf_eigenaar SET woonplaats = 'Germany' WHERE woonplaats = 'Germany (East)';
UPDATE draaf_eigenaar SET woonplaats = 'Ghana' WHERE woonplaats = 'hana';
UPDATE draaf_eigenaar SET woonplaats = 'Hong Kong' WHERE woonplaats = 'Hongkong';
UPDATE draaf_eigenaar SET woonplaats = 'Colombia' WHERE woonplaats = 'ingapore';
UPDATE draaf_eigenaar SET woonplaats = 'Moldava' WHERE woonplaats = 'Moldova';
UPDATE draaf_eigenaar SET woonplaats = 'Netherlands' WHERE woonplaats = 'Netherland';
UPDATE draaf_eigenaar SET woonplaats = 'Iran' WHERE woonplaats = 'Persia';
UPDATE draaf_eigenaar SET woonplaats = 'Phillipines' WHERE woonplaats = 'Phiilipines';
UPDATE draaf_eigenaar SET woonplaats = 'Serbia' WHERE woonplaats IN ('Serbia and Montenegro', 'Serbia/Montenegro');
UPDATE draaf_eigenaar SET woonplaats = 'Brazil' WHERE woonplaats = 'South America';
UPDATE draaf_eigenaar SET woonplaats = 'Trinidad and Tobago' WHERE woonplaats = 'Trinidad';
UPDATE draaf_eigenaar SET woonplaats = 'United Kingdom' WHERE woonplaats = 'Unknown';
UPDATE draaf_eigenaar SET woonplaats = 'Virgin Islands, US' WHERE woonplaats = 'Virgin Islands';
UPDATE draaf_eigenaar SET woonplaats = 'Virgin Islands, British' WHERE woonplaats = 'West Indies';
UPDATE draaf_eigenaar SET woonplaats = 'South Korea' WHERE woonplaats IN ('Korea', 'Korea (South)');

INSERT INTO mu9ez_pedigree_people
(id, first_name, last_name, address1, address2, city, province, postal_code, id_country, home_phone, email, website, fb_profile, kennel_name, notes, is_judge, judge_info, ordering, state)
SELECT a.id, a.firstname, a.lastname, CONCAT(a.housenumber, ' ', a.streetname), null, null, a.area, a.postcode, b.id AS id_country, a.phonenumber, a.emailadres, a.website, a.fb_profile, a.title, a.notes, a.isajudge, a.judge, null, 1
FROM draaf_eigenaar a
LEFT JOIN mu9ez_pedigree_countries b ON a.woonplaats = b.short_name;

UPDATE `mu9ez_pedigree_people` SET `first_name`= NULL WHERE `first_name` = '';
UPDATE `mu9ez_pedigree_people` SET `kennel_name`= NULL WHERE `kennel_name` = '';
UPDATE `mu9ez_pedigree_people` SET `address1`= NULL WHERE `address1` = '';
UPDATE `mu9ez_pedigree_people` SET `address2`= NULL WHERE `address2` = '';
UPDATE `mu9ez_pedigree_people` SET `city`= NULL WHERE `city` = '';
UPDATE `mu9ez_pedigree_people` SET `province`= NULL WHERE `province` = '';
UPDATE `mu9ez_pedigree_people` SET `postal_code`= NULL WHERE `postal_code` = '';
UPDATE `mu9ez_pedigree_people` SET `home_phone`= NULL WHERE `home_phone` = '';
UPDATE `mu9ez_pedigree_people` SET `email`= NULL WHERE `email` = '';
UPDATE `mu9ez_pedigree_people` SET `website`= NULL WHERE `website` = '';
UPDATE `mu9ez_pedigree_people` SET `fb_profile`= NULL WHERE `fb_profile` = '';
UPDATE `mu9ez_pedigree_people` SET `is_judge`= NULL WHERE `is_judge` = '';
UPDATE `mu9ez_pedigree_people` SET `judge_info`= NULL WHERE `judge_info` = '';
UPDATE `mu9ez_pedigree_people` SET `judge_info`= NULL WHERE `judge_info` = 'http://';
UPDATE `mu9ez_pedigree_people` SET `notes`= NULL WHERE `notes` = '';

END$$

DROP PROCEDURE IF EXISTS `sp_ImportUsers`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_ImportUsers`()
    MODIFIES SQL DATA
BEGIN

DELETE FROM `mu9ez_user_usergroup_map` WHERE group_id != 8;

DELETE a
FROM `mu9ez_users` a
LEFT JOIN `mu9ez_user_usergroup_map` b ON a.id = b.user_id 
WHERE b.group_id != '8' OR b.group_id IS NULL;

INSERT INTO `mu9ez_users` (`id`, `name`, `username`, `email`, `password`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`, `otpKey`, `otep`)
SELECT `uid`, COALESCE(NULLIF(`name`, ''), `uname`), `uname`, `email`, `pass`, 0, 0, FROM_UNIXTIME(`user_regdate`), FROM_UNIXTIME(`last_login`), NULL, '{}', 0, 0, null, null
FROM `draaf_users` a
WHERE a.email NOT IN (SELECT email FROM `mu9ez_users`)
	AND a.uname not in (SELECT username FROM `mu9ez_users`);

INSERT INTO `mu9ez_user_usergroup_map` (`user_id`, `group_id`)
SELECT a.id, 2
FROM `mu9ez_users` a
LEFT JOIN `mu9ez_user_usergroup_map` b ON a.id = b.user_id 
WHERE b.group_id != '8' OR b.group_id IS NULL;

END$$

DROP PROCEDURE IF EXISTS `sp_InsertCoats`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_InsertCoats`()
    NO SQL
BEGIN

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

INSERT INTO `mu9ez_pedigree_patterns` (`id`, `pattern`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'Black mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Domino', 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Self mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(4, 'Shaded mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(5, 'No mask', 0, 1, 0, '0000-00-00 00:00:00', 0),
(6, 'Brindle', 0, 1, 0, '0000-00-00 00:00:00', 0),
(7, 'Mask', 0, 1, 0, '0000-00-00 00:00:00', 0);

END$$

DROP PROCEDURE IF EXISTS `sp_InsertCountries`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_InsertCountries`()
    NO SQL
INSERT INTO `mu9ez_pedigree_countries` (`id`, `iso2`, `short_name`, `long_name`, `iso3`, `numcode`, `un_member`, `calling_code`, `cctld`, `id_oldval`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af', 65, 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(4, 'DZ', 'Algeria', 'People''s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag', 68, 0, 1, 0, '0000-00-00 00:00:00', 0),
(11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh', 82, 0, 1, 0, '0000-00-00 00:00:00', 0),
(19, 'BD', 'Bangladesh', 'People''s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb', 74, 0, 1, 0, '0000-00-00 00:00:00', 0),
(21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm', 76, 0, 1, 0, '0000-00-00 00:00:00', 0),
(26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba', 62, 0, 1, 0, '0000-00-00 00:00:00', 0),
(30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl', 59, 0, 1, 0, '0000-00-00 00:00:00', 0),
(46, 'CN', 'China', 'People''s Republic of China', 'CHN', '156', 'yes', '86', '.cn', 80, 0, 1, 0, '0000-00-00 00:00:00', 0),
(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co', 67, 0, 1, 0, '0000-00-00 00:00:00', 0),
(50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr', 85, 0, 1, 0, '0000-00-00 00:00:00', 0),
(54, 'CI', 'Cote d''ivoire (Ivory Coast)', 'Republic of C&ocirc;te D''Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw', 69, 0, 1, 0, '0000-00-00 00:00:00', 0),
(58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do', 97, 0, 1, 0, '0000-00-00 00:00:00', 0),
(65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec', 98, 0, 1, 0, '0000-00-00 00:00:00', 0),
(66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee', 14, 0, 1, 0, '0000-00-00 00:00:00', 0),
(71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi', 15, 0, 1, 0, '0000-00-00 00:00:00', 0),
(76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', '', '.tf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh', 84, 0, 1, 0, '0000-00-00 00:00:00', 0),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr', 20, 0, 1, 0, '0000-00-00 00:00:00', 0),
(87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk', 64, 0, 1, 0, '0000-00-00 00:00:00', 0),
(100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id', 86, 0, 1, 0, '0000-00-00 00:00:00', 0),
(104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir', 77, 0, 1, 0, '0000-00-00 00:00:00', 0),
(105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie', 25, 0, 1, 0, '0000-00-00 00:00:00', 0),
(107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm', 27, 0, 1, 0, '0000-00-00 00:00:00', 0),
(110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp', 28, 0, 1, 0, '0000-00-00 00:00:00', 0),
(112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo', 87, 0, 1, 0, '0000-00-00 00:00:00', 0),
(114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke', 75, 0, 1, 0, '0000-00-00 00:00:00', 0),
(116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', '', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(120, 'LA', 'Laos', 'Lao People''s Democratic Republic', 'LAO', '418', 'yes', '856', '.la', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv', 30, 0, 1, 0, '0000-00-00 00:00:00', 0),
(122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb', 78, 0, 1, 0, '0000-00-00 00:00:00', 0),
(123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly', 91, 0, 1, 0, '0000-00-00 00:00:00', 0),
(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt', 31, 0, 1, 0, '0000-00-00 00:00:00', 0),
(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu', 32, 0, 1, 0, '0000-00-00 00:00:00', 0),
(129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(130, 'MK', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', 'MKD', '807', 'yes', '389', '.mk', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my', 66, 0, 1, 0, '0000-00-00 00:00:00', 0),
(134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt', 61, 0, 1, 0, '0000-00-00 00:00:00', 0),
(137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma', 72, 0, 1, 0, '0000-00-00 00:00:00', 0),
(150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl', 36, 0, 1, 0, '0000-00-00 00:00:00', 0),
(156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz', 39, 0, 1, 0, '0000-00-00 00:00:00', 0),
(158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng', 88, 0, 1, 0, '0000-00-00 00:00:00', 0),
(161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(163, 'KP', 'North Korea', 'Democratic People''s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no', 38, 0, 1, 0, '0000-00-00 00:00:00', 0),
(166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om', 93, 0, 1, 0, '0000-00-00 00:00:00', 0),
(167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa', 73, 0, 1, 0, '0000-00-00 00:00:00', 0),
(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe', 40, 0, 1, 0, '0000-00-00 00:00:00', 0),
(174, 'PH', 'Phillipines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph', 95, 0, 1, 0, '0000-00-00 00:00:00', 0),
(175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl', 41, 0, 1, 0, '0000-00-00 00:00:00', 0),
(177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt', 42, 0, 1, 0, '0000-00-00 00:00:00', 0),
(178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr', 43, 0, 1, 0, '0000-00-00 00:00:00', 0),
(179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro', 44, 0, 1, 0, '0000-00-00 00:00:00', 0),
(182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru', 45, 0, 1, 0, '0000-00-00 00:00:00', 0),
(183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs', 47, 0, 1, 0, '0000-00-00 00:00:00', 0),
(197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg', 71, 0, 1, 0, '0000-00-00 00:00:00', 0),
(200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk', 48, 0, 1, 0, '0000-00-00 00:00:00', 0),
(202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si', 49, 0, 1, 0, '0000-00-00 00:00:00', 0),
(203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za', 46, 0, 1, 0, '0000-00-00 00:00:00', 0),
(206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr', 60, 0, 1, 0, '0000-00-00 00:00:00', 0),
(208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es', 50, 0, 1, 0, '0000-00-00 00:00:00', 0),
(210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk', 89, 0, 1, 0, '0000-00-00 00:00:00', 0),
(211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se', 51, 0, 1, 0, '0000-00-00 00:00:00', 0),
(216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch', 52, 0, 1, 0, '0000-00-00 00:00:00', 0),
(217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th', 92, 0, 1, 0, '0000-00-00 00:00:00', 0),
(222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt', 79, 0, 1, 0, '0000-00-00 00:00:00', 0),
(227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr', 83, 0, 1, 0, '0000-00-00 00:00:00', 0),
(229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua', 54, 0, 1, 0, '0000-00-00 00:00:00', 0),
(234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk', 53, 0, 1, 0, '0000-00-00 00:00:00', 0),
(236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy', 70, 0, 1, 0, '0000-00-00 00:00:00', 0),
(239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve', 63, 0, 1, 0, '0000-00-00 00:00:00', 0),
(243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi', 90, 0, 1, 0, '0000-00-00 00:00:00', 0),
(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(252, 'YU', 'Yugoslavia', 'Socialist Federal Republic of Yugoslavia', 'YUG', '891', 'no', '', '', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0)$$

DROP PROCEDURE IF EXISTS `sp_MigrateAHI`$$
CREATE DEFINER=`ahiafgha`@`localhost` PROCEDURE `sp_MigrateAHI`()
    NO SQL
BEGIN

TRUNCATE TABLE mu9ez_pedigree_colors;
TRUNCATE TABLE mu9ez_pedigree_breeders;
TRUNCATE TABLE mu9ez_pedigree_owners;
TRUNCATE TABLE mu9ez_pedigree_registrations;
TRUNCATE TABLE mu9ez_pedigree_judging;
TRUNCATE TABLE mu9ez_pedigree_people_delegation;
TRUNCATE TABLE mu9ez_pedigree_people;
/*TRUNCATE TABLE mu9ez_pedigree_dogs_delegation;
TRUNCATE TABLE mu9ez_pedigree_dogs;*/

/* Lookup Tables First */
CALL sp_InsertCoats();
CALL sp_InsertCountries();


CALL sp_ImportUsers();
CALL sp_ImportPeople();
CALL sp_ImportDogs();
CALL sp_ImportOwners();

CALL sp_ForeignKeys();

END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `fn_LoopPath`$$
CREATE DEFINER=`ahiafgha`@`localhost` FUNCTION `fn_LoopPath`(`varId` INT(11)) RETURNS varchar(1000) CHARSET utf8
    READS SQL DATA
    SQL SECURITY INVOKER
BEGIN

DECLARE varParentId INT(11) DEFAULT 1;
DECLARE varPath VARCHAR(128) DEFAULT '';
DECLARE varRetPath VARCHAR(1000) DEFAULT '';


WHILE (varPath IS NOT NULL) DO

SELECT a.g_parentId, b.g_pathComponent
INTO varParentId, varPath
FROM g2_ChildEntity a
INNER JOIN g2_FileSystemEntity b ON a.g_id = b.g_id
WHERE a.g_id = varId
LIMIT 1;

SET varId = varParentId;

IF (varPath IS NOT NULL) THEN 
  IF varRetPath != '' THEN SET varRetPath = CONCAT('/', varRetPath);
	END IF;
  SET varRetPath = CONCAT(varPath, varRetPath);
END IF;

END WHILE;


RETURN varRetPath;


END$$

DELIMITER ;

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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
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
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_countries`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_countries`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `short_name` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `long_name` varchar(80) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `iso3` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `numcode` varchar(6) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `un_member` varchar(12) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `calling_code` varchar(8) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `cctld` varchar(5) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `id_oldval` int(8) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_iso2` (`iso2`),
  UNIQUE KEY `idx_short_name` (`short_name`),
  UNIQUE KEY `idx_long_name` (`long_name`),
  UNIQUE KEY `idx_iso3` (`iso3`),
  UNIQUE KEY `idx_numcode` (`numcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_dogs`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_dogs`;
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

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_dogs_delegation`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_dogs_delegation`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_dogs_delegation` (
  `id` int(11) NOT NULL,
  `id_dog` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_Person_Dog` (`id_person`,`id_dog`),
  KEY `idx_Person` (`id_person`),
  KEY `idx_Dog` (`id_dog`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_patterns`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_patterns`;
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
  `province` varchar(128) DEFAULT NULL,
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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_last_first_country` (`last_name`,`first_name`,`id_country`,`kennel_name`),
  KEY `idx_country` (`id_country`),
  KEY `idx_kennel` (`kennel_name`),
  KEY `idx_lastname` (`last_name`(5))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Owners and Breeders' AUTO_INCREMENT=104285 ;

-- --------------------------------------------------------

--
-- Table structure for table `mu9ez_pedigree_people_delegation`
--

DROP TABLE IF EXISTS `mu9ez_pedigree_people_delegation`;
CREATE TABLE IF NOT EXISTS `mu9ez_pedigree_people_delegation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_person` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_dog_country` (`id_dog`,`id_country`),
  KEY `idx_dog` (`id_dog`),
  KEY `idx_country` (`id_country`)
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
  ADD CONSTRAINT `fk_color_dog` FOREIGN KEY (`id_Color`) REFERENCES `mu9ez_pedigree_colors` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dam_dog` FOREIGN KEY (`id_Dam`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dogs_color` FOREIGN KEY (`id_color`) REFERENCES `mu9ez_pedigree_colors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_dam` FOREIGN KEY (`id_dam`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_pattern` FOREIGN KEY (`id_pattern`) REFERENCES `mu9ez_pedigree_patterns` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dogs_sire` FOREIGN KEY (`id_sire`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pattern_dog` FOREIGN KEY (`id_Pattern`) REFERENCES `mu9ez_pedigree_patterns` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sire_dog` FOREIGN KEY (`id_Sire`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `mu9ez_pedigree_dogs_delegation`
--
ALTER TABLE `mu9ez_pedigree_dogs_delegation`
  ADD CONSTRAINT `fk_delecation_user` FOREIGN KEY (`id_User`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delegation_dog` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delegation_user` FOREIGN KEY (`id_user`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mu9ez_pedigree_dogs_delegation_ibfk_1` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_owners_dog` FOREIGN KEY (`id_Dog`) REFERENCES `mu9ez_pedigree_dogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owners_people` FOREIGN KEY (`id_Person`) REFERENCES `mu9ez_pedigree_people` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owners_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner_dog` FOREIGN KEY (`id_dog`) REFERENCES `mu9ez_pedigree_dogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mu9ez_pedigree_people_delegation`
--
ALTER TABLE `mu9ez_pedigree_people_delegation`
  ADD CONSTRAINT `fk_delegation_person` FOREIGN KEY (`id_person`) REFERENCES `mu9ez_pedigree_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idx_Delegation_Person` FOREIGN KEY (`id_Person`) REFERENCES `mu9ez_pedigree_people` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idx_Delegation_User` FOREIGN KEY (`id_User`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mu9ez_pedigree_people_delegation_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mu9ez_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
