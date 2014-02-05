-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2014 at 05:33 PM
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
-- Table structure for table `mu9ez_pedigree_countries`
--

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
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `mu9ez_pedigree_countries`
--

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
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf', NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
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
(251, 'YU', 'Yugoslavia', 'Socialist Federal Republic of Yugoslavia', 'YUG', '891', 'no', NULL, NULL, NULL, 0, 1, 0, '0000-00-00 00:00:00', 0),
(252, 'YU', 'Yugoslavia', 'Socialist Federal Republic of Yugoslavia', 'YUG', '891', 'no', NULL, NULL, NULL, 0, 1, 0, '0000-00-00 00:00:00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
