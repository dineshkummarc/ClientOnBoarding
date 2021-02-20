-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 02:34 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `category_id` int(2) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id` char(3) NOT NULL,
  `position` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`category_id`, `name`, `id`, `position`) VALUES
(1, 'Company Profile', 'CP', 1),
(2, 'Financial Overview', 'FO', 2),
(3, 'Paymix.pro Account Overview', 'AO', 3);

-- --------------------------------------------------------

--
-- Table structure for table `channel_master`
--

CREATE TABLE `channel_master` (
  `id` int(1) NOT NULL,
  `name` varchar(150) NOT NULL,
  `pmxscore` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_master`
--

INSERT INTO `channel_master` (`id`, `name`, `pmxscore`) VALUES
(1, 'Direct', '10.00'),
(3, 'Referral', '7.00'),
(4, 'CSP', '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `company_id` int(5) NOT NULL,
  `company_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_type` int(1) NOT NULL,
  `company_www` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_curr` int(1) NOT NULL DEFAULT 1,
  `reg_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_dt` date NOT NULL,
  `reg_addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oper_addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `oper_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oper_region` int(1) NOT NULL DEFAULT 8,
  `tax_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noc` int(3) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 0,
  `score` decimal(5,2) NOT NULL,
  `isSent` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_question`
--

CREATE TABLE `company_question` (
  `id` int(20) NOT NULL,
  `company_id` int(5) NOT NULL,
  `category_id` int(1) NOT NULL,
  `question_id` int(5) NOT NULL,
  `category_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_structure`
--

CREATE TABLE `company_structure` (
  `id` int(5) NOT NULL,
  `company_id` int(5) NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE `country_master` (
  `id` int(3) NOT NULL,
  `region_id` int(1) NOT NULL,
  `iso` char(2) NOT NULL,
  `iso3` char(3) NOT NULL,
  `name` varchar(120) NOT NULL,
  `phonecode` text NOT NULL,
  `income` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `pmxscore` decimal(5,2) NOT NULL,
  `isProhibited` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`id`, `region_id`, `iso`, `iso3`, `name`, `phonecode`, `income`, `comments`, `pmxscore`, `isProhibited`) VALUES
(1, 6, 'AF', 'AFG', 'AFGHANISTAN', '93', 'Low income', 'Prohibited', '10.00', 1),
(2, 2, 'AL', 'ALB', 'ALBANIA', '355', 'Upper middle income', 'N/A', '9.00', 0),
(3, 4, 'DZ', 'DZA', 'ALGERIA', '213', 'Upper middle income', 'N/A', '6.28', 0),
(4, 1, 'AS', 'ASM', 'AMERICAN SAMOA', '1684', 'N/A', 'N/A', '10.00', 1),
(5, 2, 'AD', 'AND', 'ANDORRA', '376', 'N/A', 'N/A', '4.69', 0),
(6, 7, 'AO', 'AGO', 'ANGOLA', '244', 'Lower middle income', 'N/A', '10.00', 1),
(7, 3, 'AI', 'AIA', 'ANGUILLA', '1264', 'N/A', 'N/A', '5.50', 0),
(8, 3, 'AG', 'ATG', 'ANTIGUA AND BARBUDA', '1268', 'N/A', 'N/A', '7.00', 0),
(9, 3, 'AR', 'ARG', 'ARGENTINA', '54', 'Upper middle income', 'N/A', '6.50', 0),
(10, 2, 'AM', 'ARM', 'ARMENIA', '374', 'Lower middle income', 'N/A', '5.08', 0),
(11, 3, 'AW', 'ABW', 'ARUBA', '297', 'N/A', 'N/A', '7.00', 0),
(12, 1, 'AU', 'AUS', 'AUSTRALIA', '61', 'High income', 'N/A', '3.97', 0),
(13, 2, 'AT', 'AUT', 'AUSTRIA', '43', 'High income', 'N/A', '4.64', 0),
(14, 2, 'AZ', 'AZE', 'AZERBAIJAN', '994', 'Upper middle income', 'N/A', '9.00', 0),
(15, 3, 'BS', 'BHS', 'BAHAMAS', '1242', 'N/A', 'N/A', '9.00', 0),
(16, 4, 'BH', 'BHR', 'BAHRAIN', '973', 'High income', 'N/A', '9.00', 0),
(17, 6, 'BD', 'BGD', 'BANGLADESH', '880', 'Lower middle income', 'N/A', '10.00', 1),
(18, 3, 'BB', 'BRB', 'BARBADOS', '1246', 'N/A', 'N/A', '9.00', 0),
(19, 2, 'BY', 'BLR', 'BELARUS', '375', 'High income', 'N/A', '4.69', 0),
(20, 2, 'BE', 'BEL', 'BELGIUM', '32', 'High income', 'N/A', '4.29', 0),
(21, 3, 'BZ', 'BLZ', 'BELIZE', '501', 'N/A', 'N/A', '7.00', 0),
(22, 7, 'BJ', 'BEN', 'BENIN', '229', 'Low income', 'N/A', '10.00', 1),
(23, 5, 'BM', 'BMU', 'BERMUDA', '1441', 'N/A', 'N/A', '4.98', 0),
(24, 6, 'BT', 'BTN', 'BHUTAN', '975', 'N/A', 'N/A', '7.85', 0),
(25, 3, 'BO', 'BOL', 'BOLIVIA', '591', 'Lower middle income', 'N/A', '6.01', 0),
(26, 2, 'BA', 'BIH', 'BOSNIA AND HERZEGOVINA', '387', 'Upper middle income', 'N/A', '7.00', 0),
(27, 7, 'BW', 'BWA', 'BOTSWANA', '267', 'Upper middle income', 'High-Risk', '10.00', 1),
(28, 3, 'BR', 'BRA', 'BRAZIL', '55', 'Upper middle income', 'N/A', '4.97', 0),
(29, 3, 'VG', 'VGB', 'BRITISH VIRGIN ISLANDS', '1284', 'N/A', 'N/A', '7.00', 0),
(30, 1, 'BN', 'BRN', 'BRUNEI DARUSSALAM', '673', 'N/A', 'N/A', '5.72', 0),
(31, 2, 'BG', 'BGR', 'BULGARIA', '359', 'Upper middle income', 'N/A', '3.51', 0),
(32, 7, 'BF', 'BFA', 'BURKINA FASO', '226', 'N/A', 'N/A', '6.53', 0),
(33, 7, 'BI', 'BDI', 'BURUNDI', '257', 'N/A', 'N/A', '6.53', 0),
(34, 1, 'KH', 'KHM', 'CAMBODIA', '855', 'Lower middle income', 'N/A', '9.00', 0),
(35, 7, 'CM', 'CMR', 'CAMEROON', '237', 'N/A', 'N/A', '6.53', 0),
(36, 5, 'CA', 'CAN', 'CANADA', '1', 'High income', 'N/A', '4.92', 0),
(37, 7, 'CV', 'CPV', 'CAPE VERDE', '238', 'Lower middle income', 'N/A', '10.00', 1),
(38, 8, 'KY', 'CYM', 'CAYMAN ISLANDS', '1345', 'N/A', 'N/A', '7.00', 0),
(39, 8, 'CF', 'CAF', 'CENTRAL AFRICAN REPUBLIC', '236', 'N/A', 'N/A', '8.00', 0),
(40, 8, 'TD', 'TCD', 'CHAD', '235', 'N/A', 'N/A', '8.00', 0),
(41, 3, 'CL', 'CHL', 'CHILE', '56', 'High income', 'N/A', '4.18', 0),
(42, 1, 'CN', 'CHN', 'CHINA', '86', 'Upper middle income', 'N/A', '9.00', 0),
(43, 3, 'CO', 'COL', 'COLOMBIA', '57', 'Upper middle income', 'N/A', '5.83', 0),
(44, 8, 'KM', 'COM', 'COMOROS', '269', 'N/A', 'N/A', '8.00', 0),
(45, 8, 'CG', 'COG', 'CONGO', '242', 'N/A', 'N/A', '8.00', 0),
(46, 8, 'CK', 'COK', 'COOK ISLANDS', '682', 'N/A', 'N/A', '8.00', 0),
(47, 3, 'CR', 'CRI', 'COSTA RICA', '506', 'Upper middle income', 'N/A', '5.23', 0),
(48, 7, 'CI', 'CIV', 'COTE D\'IVOIRE', '225', 'Lower middle income', 'N/A', '6.62', 0),
(49, 2, 'HR', 'HRV', 'CROATIA', '385', 'Upper middle income', 'N/A', '3.82', 0),
(50, 3, 'cw', 'CUW', 'CURACAO', '599', 'N/A', 'N/A', '7.00', 0),
(51, 8, 'CU', 'CUB', 'CUBA', '53', 'N/A', 'N/A', '7.00', 0),
(52, 2, 'CY', 'CYP', 'CYPRUS', '357', 'High income', 'N/A', '5.01', 0),
(53, 2, 'CZ', 'CZE', 'CZECH REPUBLIC', '420', 'High income', 'N/A', '4.15', 0),
(54, 2, 'DK', 'DNK', 'DENMARK', '45', 'High income', 'N/A', '3.95', 0),
(55, 7, 'DJ', 'DJI', 'DJIBOUTI', '253', 'N/A', 'N/A', '6.53', 0),
(56, 3, 'DM', 'DMA', 'DOMINICA', '1767', 'Upper middle income', 'N/A', '4.40', 0),
(57, 3, 'DO', 'DOM', 'DOMINICAN REPUBLIC', '1809', 'Upper middle income', 'N/A', '5.41', 0),
(58, 3, 'EC', 'ECU', 'ECUADOR', '593', 'Upper middle income', 'N/A', '6.25', 0),
(59, 4, 'EG', 'EGY', 'EGYPT', '20', 'Lower middle income', 'N/A', '4.55', 0),
(60, 3, 'SV', 'SLV', 'EL SALVADOR', '503', 'Lower middle income', 'N/A', '5.46', 0),
(61, 7, 'GQ', 'GNQ', 'EQUATORIAL GUINEA', '240', 'N/A', 'N/A', '6.53', 0),
(62, 7, 'ER', 'ERI', 'ERITREA', '291', 'N/A', 'N/A', '6.53', 0),
(63, 2, 'EE', 'EST', 'ESTONIA', '372', 'High income', 'N/A', '2.68', 0),
(64, 7, 'ET', 'ETH', 'ETHIOPIA', '251', 'N/A', 'N/A', '10.00', 1),
(65, 3, 'FK', 'FLK', 'FALKLAND ISLANDS (MALVINAS)', '500', 'N/A', 'N/A', '5.50', 0),
(66, 2, 'FO', 'FRO', 'FAROE ISLANDS', '298', 'N/A', 'N/A', '4.69', 0),
(67, 1, 'FJ', 'FJI', 'FIJI', '679', 'N/A', 'N/A', '10.00', 1),
(68, 2, 'FI', 'FIN', 'FINLAND', '358', 'High income', 'N/A', '3.17', 0),
(69, 2, 'FR', 'FRA', 'FRANCE', '33', 'High income', 'N/A', '4.09', 0),
(70, 3, 'GF', 'GUF', 'FRENCH GUIANA', '594', 'N/A', 'N/A', '5.50', 0),
(71, 1, 'PF', 'PYF', 'FRENCH POLYNESIA', '689', 'N/A', 'N/A', '5.72', 0),
(72, 7, 'GA', 'GAB', 'GABON', '241', 'N/A', 'N/A', '6.53', 0),
(73, 7, 'GM', 'GMB', 'GAMBIA', '220', 'Low income', 'N/A', '9.00', 0),
(74, 2, 'GE', 'GEO', 'GEORGIA', '995', 'Lower middle income', 'N/A', '5.20', 0),
(75, 2, 'DE', 'DEU', 'GERMANY', '49', 'High income', 'N/A', '4.49', 0),
(76, 7, 'GH', 'GHA', 'GHANA', '233', 'Lower middle income', 'N/A', '10.00', 1),
(77, 2, 'GI', 'GIB', 'GIBRALTAR', '350', 'N/A', 'N/A', '4.70', 0),
(78, 2, 'GR', 'GRC', 'GREECE', '30', 'High income', 'N/A', '4.56', 0),
(79, 5, 'GL', 'GRL', 'GREENLAND', '299', 'N/A', 'N/A', '4.98', 0),
(80, 3, 'GD', 'GRD', 'GRENADA', '1473', 'Upper middle income', 'N/A', '10.00', 1),
(81, 3, 'GP', 'GLP', 'GUADELOUPE', '590', 'N/A', 'N/A', '5.50', 0),
(82, 1, 'GU', 'GUM', 'GUAM', '1671', 'N/A', 'N/A', '10.00', 1),
(83, 3, 'GT', 'GTM', 'GUATEMALA', '502', 'Lower middle income', 'N/A', '4.75', 0),
(84, 7, 'GN', 'GIN', 'GUINEA', '224', 'N/A', 'N/A', '6.53', 0),
(85, 7, 'GW', 'GNB', 'GUINEA-BISSAU', '245', 'N/A', 'N/A', '6.53', 0),
(86, 3, 'GY', 'GUY', 'GUYANA', '592', 'Upper middle income', 'N/A', '6.14', 0),
(87, 3, 'HT', 'HTI', 'HAITI', '509', 'Low income', 'N/A', '10.00', 1),
(88, 2, 'VA', 'VAT', 'HOLY SEE (VATICAN CITY STATE)', '39', 'N/A', 'N/A', '4.69', 0),
(89, 3, 'HN', 'HND', 'HONDURAS', '504', 'Lower middle income', 'N/A', '5.76', 0),
(90, 1, 'HK', 'HKG', 'HONG KONG', '852', 'High income', 'N/A', '7.00', 0),
(91, 2, 'HU', 'HUN', 'HUNGARY', '36', 'High income', 'N/A', '4.90', 0),
(92, 2, 'IS', 'ISL', 'ICELAND', '354', 'High income', 'N/A', '7.00', 0),
(93, 6, 'IN', 'IND', 'INDIA', '91', 'Lower middle income', 'N/A', '5.60', 0),
(94, 1, 'ID', 'IDN', 'INDONESIA', '62', 'Lower middle income', 'N/A', '5.13', 0),
(95, 4, 'IR', 'IRN', 'IRAN', '98', 'N/A', 'Prohibited', '10.00', 1),
(96, 4, 'IQ', 'IRQ', 'IRAQ', '964', 'N/A', 'Prohibited', '10.00', 1),
(97, 2, 'IE', 'IRL', 'IRELAND', '353', 'High income', 'N/A', '4.55', 0),
(98, 2, 'IM', 'IMN', 'ISLE OF MAN', '44', 'N/A', 'N/A', '4.70', 0),
(99, 4, 'IL', 'ISR', 'ISRAEL', '972', 'High income', 'N/A', '3.76', 0),
(100, 2, 'IT', 'ITA', 'ITALY', '39', 'High income', 'N/A', '4.99', 0),
(101, 3, 'JM', 'JAM', 'JAMAICA', '1876', 'Upper middle income', 'N/A', '9.00', 0),
(102, 1, 'JP', 'JPN', 'JAPAN', '81', 'High income', 'N/A', '5.02', 0),
(103, 4, 'JO', 'JOR', 'JORDAN', '962', 'Lower middle income', 'N/A', '4.77', 0),
(104, 2, 'KZ', 'KAZ', 'KAZAKHSTAN', '7', 'Upper middle income', 'N/A', '6.27', 0),
(105, 7, 'KE', 'KEN', 'KENYA', '254', 'Lower middle income', 'N/A', '10.00', 1),
(106, 1, 'KI', 'KIR', 'KIRIBATI', '686', 'N/A', 'N/A', '5.72', 0),
(107, 4, 'KW', 'KWT', 'KUWAIT', '965', 'High income', 'N/A', '6.16', 0),
(108, 2, 'KG', 'KGZ', 'KYRGYZSTAN', '996', 'Lower middle income', 'N/A', '5.86', 0),
(109, 1, 'LA', 'LAO', 'LAOS', '856', 'Lower middle income', 'N/A', '10.00', 1),
(110, 2, 'LV', 'LVA', 'LATVIA', '371', 'High income', 'N/A', '4.89', 0),
(111, 4, 'LB', 'LBN', 'LEBANON', '961', 'Upper middle income', 'N/A', '9.00', 0),
(112, 7, 'LS', 'LSO', 'LESOTHO', '266', 'N/A', 'N/A', '6.53', 0),
(113, 7, 'LR', 'LBR', 'LIBERIA', '231', 'Low income', 'N/A', '9.00', 0),
(114, 4, 'LY', 'LBY', 'LIBYA', '218', 'N/A', 'N/A', '9.00', 0),
(115, 2, 'LI', 'LIE', 'LIECHTENSTEIN', '423', 'N/A', 'N/A', '4.70', 0),
(116, 2, 'LT', 'LTU', 'LITHUANIA', '370', 'High income', 'N/A', '3.55', 0),
(117, 2, 'LU', 'LUX', 'LUXEMBOURG', '352', 'High income', 'N/A', '4.82', 0),
(118, 1, 'MO', 'MAC', 'MACAO', '853', 'N/A', 'N/A', '5.72', 0),
(119, 2, 'MK', 'MKD', 'MACEDONIA', '389', 'Upper middle income', 'N/A', '3.22', 0),
(120, 7, 'MG', 'MDG', 'MADAGASCAR', '261', 'N/A', 'N/A', '6.53', 0),
(121, 7, 'MW', 'MWI', 'MALAWI', '265', 'N/A', 'N/A', '6.53', 0),
(122, 1, 'MY', 'MYS', 'MALAYSIA', '60', 'Upper middle income', 'N/A', '5.28', 0),
(123, 6, 'MV', 'MDV', 'MALDIVES', '960', 'N/A', 'N/A', '7.85', 0),
(124, 7, 'ML', 'MLI', 'MALI', '223', 'N/A', 'N/A', '6.53', 0),
(125, 2, 'MT', 'MLT', 'MALTA', '356', 'High income', 'N/A', '3.94', 0),
(126, 1, 'MH', 'MHL', 'MARSHALL ISLANDS', '692', 'Upper middle income', 'N/A', '9.00', 0),
(127, 3, 'MQ', 'MTQ', 'MARTINIQUE', '596', 'N/A', 'N/A', '5.50', 0),
(128, 4, 'MR', 'MRT', 'MAURITANIA', '222', 'N/A', 'N/A', '6.16', 0),
(129, 7, 'MU', 'MUS', 'MAURITIUS', '230', 'N/A', 'N/A', '9.00', 0),
(130, 3, 'MX', 'MEX', 'MEXICO', '52', 'Upper middle income', 'N/A', '5.13', 0),
(131, 1, 'FM', 'FSM', 'MICRONESIA', '691', 'N/A', 'N/A', '5.72', 0),
(132, 2, 'MD', 'MDA', 'MOLDOVA', '373', 'Lower middle income', 'N/A', '5.29', 0),
(133, 2, 'MC', 'MCO', 'MONACO', '377', 'N/A', 'N/A', '4.69', 0),
(134, 1, 'MN', 'MNG', 'MONGOLIA', '976', 'Lower middle income', 'N/A', '10.00', 1),
(135, 2, 'ME', 'MNE', 'MONTENEGRO', '382', 'Upper middle income', 'N/A', '3.94', 0),
(136, 3, 'MS', 'MSR', 'MONTSERRAT', '1664', 'N/A', 'N/A', '5.50', 0),
(137, 4, 'MA', 'MAR', 'MOROCCO', '212', 'Lower middle income', 'N/A', '6.12', 0),
(138, 7, 'MZ', 'MOZ', 'MOZAMBIQUE', '258', 'Low income', 'N/A', '10.00', 1),
(139, 1, 'MM', 'MMR', 'MYANMAR', '95', 'Lower middle income', 'N/A', '10.00', 1),
(140, 7, 'NA', 'NAM', 'NAMIBIA', '264', 'N/A', 'N/A', '6.53', 0),
(141, 1, 'NR', 'NRU', 'NAURU', '674', 'N/A', 'N/A', '5.72', 0),
(142, 6, 'NP', 'NPL', 'NEPAL', '977', 'N/A', 'N/A', '7.85', 0),
(143, 2, 'NL', 'NLD', 'NETHERLANDS', '31', 'High income', 'N/A', '4.86', 0),
(144, 2, 'AN', 'ANT', 'NETHERLANDS ANTILLES', '599', 'N/A', 'N/A', '4.69', 0),
(145, 1, 'NC', 'NCL', 'NEW CALEDONIA', '687', 'N/A', 'N/A', '5.72', 0),
(146, 1, 'NZ', 'NZL', 'NEW ZEALAND', '64', 'High income', 'N/A', '3.18', 0),
(147, 3, 'NI', 'NIC', 'NICARAGUA', '505', 'Lower middle income', 'N/A', '10.00', 1),
(148, 7, 'NE', 'NER', 'NIGER', '227', 'N/A', 'N/A', '6.53', 0),
(149, 7, 'NG', 'NGA', 'NIGERIA', '234', 'Lower middle income', 'High-Risk', '10.00', 1),
(150, 1, 'NU', 'NIU', 'NIUE', '683', 'N/A', 'N/A', '5.72', 0),
(151, 1, 'NF', 'NFK', 'NORFOLK ISLAND', '672', 'N/A', 'N/A', '5.72', 0),
(152, 1, 'KR', 'KOR', 'NORTH KOREA', '82', 'N/A', 'N/A', '5.72', 0),
(153, 1, 'MP', 'MNP', 'NORTHERN MARIANA ISLANDS', '1670', 'N/A', 'N/A', '5.72', 0),
(154, 2, 'NO', 'NOR', 'NORWAY', '47', 'High income', 'N/A', '3.91', 0),
(155, 4, 'OM', 'OMN', 'OMAN', '968', 'N/A', 'N/A', '9.00', 0),
(156, 6, 'PK', 'PAK', 'PAKISTAN', '92', 'Lower middle income', 'Prohibited', '10.00', 1),
(157, 1, 'PW', 'PLW', 'PALAU', '680', 'N/A', 'N/A', '5.72', 0),
(158, 3, 'PA', 'PAN', 'PANAMA', '507', 'Upper middle income', 'N/A', '9.00', 0),
(159, 1, 'PG', 'PNG', 'PAPUA NEW GUINEA', '675', 'N/A', 'N/A', '5.72', 0),
(160, 3, 'PY', 'PRY', 'PARAGUAY', '595', 'Upper middle income', 'N/A', '6.74', 0),
(161, 3, 'PE', 'PER', 'PERU', '51', 'Upper middle income', 'N/A', '5.33', 0),
(162, 1, 'PH', 'PHL', 'PHILIPPINES', '63', 'Lower middle income', 'N/A', '5.81', 0),
(163, 3, 'PN', 'PCN', 'PITCAIRN', '0', 'N/A', 'N/A', '5.50', 0),
(164, 2, 'PL', 'POL', 'POLAND', '48', 'High income', 'N/A', '4.34', 0),
(165, 2, 'PT', 'PRT', 'PORTUGAL', '351', 'High income', 'N/A', '4.10', 0),
(166, 3, 'PR', 'PRI', 'PUERTO RICO', '1787', 'N/A', 'N/A', '9.00', 0),
(167, 4, 'QA', 'QAT', 'QATAR', '974', 'High income', 'N/A', '9.00', 0),
(168, 7, 'RE', 'REU', 'REUNION', '262', 'N/A', 'N/A', '6.53', 0),
(169, 2, 'RO', 'ROM', 'ROMANIA', '40', 'Upper middle income', 'N/A', '4.76', 0),
(170, 2, 'RU', 'RUS', 'RUSSIAN FEDERATION', '70', 'Upper middle income', 'N/A', '5.75', 0),
(171, 7, 'RW', 'RWA', 'RWANDA', '250', 'N/A', 'N/A', '6.53', 0),
(172, 7, 'SH', 'SHN', 'SAINT HELENA', '290', 'N/A', 'N/A', '6.53', 0),
(173, 3, 'KN', 'KNA', 'SAINT KITTS AND NEVIS', '1869', 'N/A', 'N/A', '5.50', 0),
(174, 3, 'LC', 'LCA', 'SAINT LUCIA', '1758', 'Upper middle income', 'N/A', '4.73', 0),
(175, 5, 'PM', 'SPM', 'SAINT PIERRE AND MIQUELON', '508', 'N/A', 'N/A', '4.98', 0),
(176, 3, 'VC', 'VCT', 'SAINT VINCENT AND THE GRENADINES', '1784', 'Upper middle income', 'N/A', '4.69', 0),
(177, 1, 'WS', 'WSM', 'SAMOA', '684', 'N/A', 'N/A', '10.00', 1),
(178, 2, 'SM', 'SMR', 'SAN MARINO', '378', 'N/A', 'N/A', '4.69', 0),
(179, 7, 'ST', 'STP', 'SAO TOME AND PRINCIPE', '239', 'N/A', 'N/A', '6.53', 0),
(180, 4, 'SA', 'SAU', 'SAUDI ARABIA', '966', 'High income', 'N/A', '9.00', 0),
(181, 7, 'SN', 'SEN', 'SENEGAL', '221', 'Low income', 'N/A', '6.20', 0),
(182, 2, 'RS', 'SRB', 'SERBIA', '381', 'Upper middle income', 'N/A', '6.33', 0),
(183, 7, 'SC', 'SYC', 'SEYCHELLES', '248', 'N/A', 'N/A', '6.53', 0),
(184, 7, 'SL', 'SLE', 'SIERRA LEONE', '232', 'Low income', 'N/A', '7.20', 0),
(185, 1, 'SG', 'SGP', 'SINGAPORE', '65', 'High income', 'N/A', '4.58', 0),
(186, 2, 'SK', 'SVK', 'SLOVAKIA', '421', 'High income', 'N/A', '4.04', 0),
(187, 2, 'SI', 'SVN', 'SLOVENIA', '386', 'High income', 'N/A', '3.70', 0),
(188, 1, 'SB', 'SLB', 'SOLOMON ISLANDS', '677', 'N/A', 'N/A', '5.72', 0),
(189, 7, 'SO', 'SOM', 'SOMALIA', '252', 'N/A', 'N/A', '6.53', 0),
(190, 7, 'ZA', 'ZAF', 'SOUTH AFRICA', '27', 'Upper middle income', 'N/A', '4.83', 0),
(191, 1, 'KP', 'PRK', 'SOUTH KOREA', '850', 'High income', 'N/A', '4.60', 0),
(192, 2, 'ES', 'ESP', 'SPAIN', '34', 'High income', 'N/A', '4.42', 0),
(193, 6, 'LK', 'LKA', 'SRI LANKA', '94', 'N/A', 'N/A', '9.00', 0),
(194, 4, 'SD', 'SDN', 'SUDAN', '249', 'N/A', 'N/A', '6.16', 0),
(195, 3, 'SR', 'SUR', 'SURINAME', '597', 'N/A', 'N/A', '7.00', 0),
(196, 2, 'SJ', 'SJM', 'SVALBARD AND JAN MAYEN', '47', 'N/A', 'N/A', '4.69', 0),
(197, 7, 'SZ', 'SWZ', 'SWAZILAND', '268', 'N/A', 'N/A', '6.53', 0),
(198, 2, 'SE', 'SWE', 'SWEDEN', '46', 'High income', 'N/A', '3.51', 0),
(199, 2, 'CH', 'CHE', 'SWITZERLAND', '41', 'High income', 'N/A', '7.00', 0),
(200, 4, 'SY', 'SYR', 'SYRIAN ARAB REPUBLIC', '963', 'N/A', 'Prohibited', '10.00', 0),
(201, 1, 'TW', 'TWN', 'TAIWAN', '886', 'High income', 'N/A', '4.84', 0),
(202, 2, 'TJ', 'TJK', 'TAJIKISTAN', '992', 'Lower middle income', 'N/A', '9.00', 0),
(203, 7, 'TZ', 'TZA', 'TANZANIA', '255', 'Low income', 'N/A', '6.63', 0),
(204, 1, 'TH', 'THA', 'THAILAND', '66', 'Upper middle income', 'N/A', '6.22', 0),
(205, 7, 'CD', 'COD', 'THE DEMOCRATIC REPUBLIC OF THE CONGO', '242', 'N/A', 'N/A', '6.53', 0),
(206, 7, 'TG', 'TGO', 'TOGO', '228', 'N/A', 'N/A', '6.53', 0),
(207, 1, 'TK', 'TKL', 'TOKELAU', '690', 'N/A', 'N/A', '5.72', 0),
(208, 1, 'TO', 'TON', 'TONGA', '676', 'N/A', 'N/A', '5.72', 0),
(209, 3, 'TT', 'TTO', 'TRINIDAD AND TOBAGO', '1868', 'High income', 'N/A', '10.00', 1),
(210, 4, 'TN', 'TUN', 'TUNISIA', '216', 'N/A', 'N/A', '9.00', 0),
(211, 2, 'TR', 'TUR', 'TURKEY', '90', 'Upper middle income', 'N/A', '6.19', 0),
(212, 2, 'TM', 'TKM', 'TURKMENISTAN', '7370', 'N/A', 'N/A', '4.69', 0),
(213, 3, 'TC', 'TCA', 'TURKS AND CAICOS ISLANDS', '1649', 'N/A', 'N/A', '5.50', 0),
(214, 1, 'TV', 'TUV', 'TUVALU', '688', 'N/A', 'N/A', '5.72', 0),
(215, 3, 'VI', 'VIR', 'U.S. VIRGIN ISLANDS', '1340', 'N/A', 'N/A', '5.50', 0),
(216, 7, 'UG', 'UGA', 'UGANDA', '256', 'N/A', 'N/A', '10.00', 1),
(217, 2, 'UA', 'UKR', 'UKRAINE', '380', 'Lower middle income', 'N/A', '6.01', 0),
(218, 4, 'AE', 'ARE', 'UNITED ARAB EMIRATES', '971', 'High income', 'N/A', '5.60', 0),
(219, 2, 'GB', 'GBR', 'UNITED KINGDOM', '44', 'High income', 'N/A', '4.13', 0),
(220, 5, 'US', 'USA', 'UNITED STATES', '1', 'High income', 'N/A', '5.03', 0),
(221, 3, 'UY', 'URY', 'URUGUAY', '598', 'High income', 'N/A', '3.58', 0),
(222, 2, 'UZ', 'UZB', 'UZBEKISTAN', '998', 'Lower middle income', 'N/A', '9.00', 0),
(223, 1, 'VU', 'VUT', 'VANUATU', '678', 'Lower middle income', 'N/A', '10.00', 1),
(224, 3, 'VE', 'VEN', 'VENEZUELA', '58', 'Upper middle income', 'N/A', '10.00', 1),
(225, 1, 'VN', 'VNM', 'VIETNAM', '84', 'Lower middle income', 'N/A', '9.00', 0),
(226, 1, 'WF', 'WLF', 'WALLIS AND FUTUNA', '681', 'N/A', 'N/A', '5.72', 0),
(227, 4, 'EH', 'ESH', 'WESTERN SAHARA', '212', 'N/A', 'N/A', '6.16', 0),
(228, 4, 'YE', 'YEM', 'YEMEN', '967', 'Lower middle income', 'Prohibited', '10.00', 1),
(229, 7, 'ZM', 'ZMB', 'ZAMBIA', '260', 'N/A', 'N/A', '6.53', 0),
(230, 7, 'ZW', 'ZWE', 'ZIMBABWE', '263', 'Low income', 'N/A', '10.00', 1),
(231, 2, 'XK', 'RKS', 'KOSOVO', '383', 'N/A', 'N/A', '6.33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency_master`
--

CREATE TABLE `currency_master` (
  `id` int(11) NOT NULL,
  `iso` char(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sym` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_master`
--

INSERT INTO `currency_master` (`id`, `iso`, `name`, `sym`) VALUES
(1, 'EUR', 'Euro', ''),
(2, 'USD', 'US Dollar', ''),
(3, 'GBP', 'British Pound', ''),
(4, 'AUD', 'Australian Dollar', ''),
(5, 'AED', 'Emirati Dirham', ''),
(6, 'ARS', 'Argentine Peso', ''),
(7, 'AOA', 'Angolan Kwanza', ''),
(8, 'AFN', 'Afghan Afghani', ''),
(9, 'ALL', 'Albanian Lek', ''),
(10, 'AMD', 'Armenian Dram', ''),
(11, 'AZN', 'Azerbaijan Manat', ''),
(12, 'ANG', 'Dutch Guilder', ''),
(13, 'AWG', 'Aruban or Dutch Guilder', ''),
(14, 'BRL', 'Brazilian Real', ''),
(15, 'BHD', 'Bahraini Dinar', ''),
(16, 'BDT', 'Bangladeshi Taka', ''),
(17, 'BYN', 'Belarusian Ruble', ''),
(18, 'BGN', 'Bulgarian Lev', ''),
(19, 'BOB', 'Bolivian Bolíviano', ''),
(20, 'BBD', 'Barbadian or Bajan Dollar', ''),
(21, 'BND', 'Bruneian Dollar', ''),
(22, 'BWP', 'Botswana Pula', ''),
(23, 'BMD', 'Bermudian Dollar', ''),
(24, 'BAM', 'Bosnian Convertible Mark', ''),
(25, 'BZD', 'Belizean Dollar', ''),
(26, 'BIF', 'Burundian Franc', ''),
(27, 'BSD', 'Bahamian Dollar', ''),
(28, 'BTN', 'Bhutanese Ngultrum', ''),
(29, 'CAD', 'Canadian Dollar', ''),
(30, 'CHF', 'Swiss Franc', ''),
(31, 'CNY', 'Chinese Yuan Renminbi', ''),
(32, 'COP', 'Colombian Peso', ''),
(33, 'CLP', 'Chilean Peso', ''),
(34, 'CZK', 'Czech Koruna', ''),
(35, 'CRC', 'Costa Rican Colon', ''),
(36, 'CUC', 'Cuban Convertible Peso', ''),
(37, 'CDF', 'Congolese Franc', ''),
(38, 'CUP', 'Cuban Peso', ''),
(39, 'CVE', 'Cape Verdean Escudo', ''),
(40, 'DKK', 'Danish Krone', ''),
(41, 'DZD', 'Algerian Dinar', ''),
(42, 'DOP', 'Dominican Peso', ''),
(43, 'DJF', 'Djiboutian Franc', ''),
(44, 'EGP', 'Egyptian Pound', ''),
(45, 'ETB', 'Ethiopian Birr', ''),
(46, 'ERN', 'Eritrean Nakfa', ''),
(47, 'FJD', 'Fijian Dollar', ''),
(48, 'FKP', 'Falkland Island Pound', ''),
(49, 'GEL', 'Georgian Lari', ''),
(50, 'GHS', 'Ghanaian Cedi', ''),
(51, 'GTQ', 'Guatemalan Quetzal', ''),
(52, 'GYD', 'Guyanese Dollar', ''),
(53, 'GMD', 'Gambian Dalasi', ''),
(54, 'GNF', 'Guinean Franc', ''),
(55, 'GIP', 'Gibraltar Pound', ''),
(56, 'GGP', 'Guernsey Pound', ''),
(57, 'HUF', 'Hungarian Forint', ''),
(58, 'HKD', 'Hong Kong Dollar', ''),
(59, 'HRK', 'Croatian Kuna', ''),
(60, 'HNL', 'Honduran Lempira', ''),
(61, 'HTG', 'Haitian Gourde', ''),
(62, 'INR', 'Indian Rupee', ''),
(63, 'IDR', 'Indonesian Rupiah', ''),
(64, 'IQD', 'Iraqi Dinar', ''),
(65, 'ILS', 'Israeli Shekel', ''),
(66, 'IRR', 'Iranian Rial', ''),
(67, 'ISK', 'Icelandic Krona', ''),
(68, 'IMP', 'Isle of Man Pound', ''),
(69, 'JPY', 'Japanese Yen', ''),
(70, 'JOD', 'Jordanian Dinar', ''),
(71, 'JMD', 'Jamaican Dollar', ''),
(72, 'JEP', 'Jersey Pound', ''),
(73, 'KES', 'Kenyan Shilling', ''),
(74, 'KRW', 'South Korean Won', ''),
(75, 'KWD', 'Kuwaiti Dinar', ''),
(76, 'KZT', 'Kazakhstani Tenge', ''),
(77, 'KYD', 'Caymanian Dollar', ''),
(78, 'KPW', 'North Korean Won', ''),
(79, 'KGS', 'Kyrgyzstani Som', ''),
(80, 'KHR', 'Cambodian Riel', ''),
(81, 'KMF', 'Comorian Franc', ''),
(82, 'LKR', 'Sri Lankan Rupee', ''),
(83, 'LYD', 'Libyan Dinar', ''),
(84, 'LBP', 'Lebanese Pound', ''),
(85, 'LAK', 'Lao Kip', ''),
(86, 'LSL', 'Basotho Loti', ''),
(87, 'LRD', 'Liberian Dollar', ''),
(88, 'MYR', 'Malaysian Ringgit', ''),
(89, 'MXN', 'Mexican Peso', ''),
(90, 'MAD', 'Moroccan Dirham', ''),
(91, 'MUR', 'Mauritian Rupee', ''),
(92, 'MOP', 'Macau Pataca', ''),
(93, 'MGA', 'Malagasy Ariary', ''),
(94, 'MZN', 'Mozambican Metical', ''),
(95, 'MWK', 'Malawian Kwacha', ''),
(96, 'MVR', 'Maldivian Rufiyaa', ''),
(97, 'MNT', 'Mongolian Tughrik', ''),
(98, 'MMK', 'Burmese Kyat', ''),
(99, 'MDL', 'Moldovan Leu', ''),
(100, 'MKD', 'Macedonian Denar', ''),
(101, 'MRU', 'Mauritanian Ouguiya', ''),
(102, 'NZD', 'New Zealand Dollar', ''),
(103, 'NOK', 'Norwegian Krone', ''),
(104, 'NGN', 'Nigerian Naira', ''),
(105, 'NPR', 'Nepalese Rupee', ''),
(106, 'NAD', 'Namibian Dollar', ''),
(107, 'NIO', 'Nicaraguan Cordoba', ''),
(108, 'OMR', 'Omani Rial', ''),
(109, 'PHP', 'Philippine Peso', ''),
(110, 'PKR', 'Pakistani Rupee', ''),
(111, 'PLN', 'Polish Zloty', ''),
(112, 'PEN', 'Peruvian Sol', ''),
(113, 'PYG', 'Paraguayan Guarani', ''),
(114, 'PGK', 'Papua New Guinean Kina', ''),
(115, 'PAB', 'Panamanian Balboa', ''),
(116, 'QAR', 'Qatari Riyal', ''),
(117, 'RUB', 'Russian Ruble', ''),
(118, 'RON', 'Romanian Leu', ''),
(119, 'RSD', 'Serbian Dinar', ''),
(120, 'RWF', 'Rwandan Franc', ''),
(121, 'SGD', 'Singapore Dollar', ''),
(122, 'SEK', 'Swedish Krona', ''),
(123, 'SAR', 'Saudi Arabian Riyal', ''),
(124, 'SYP', 'Syrian Pound', ''),
(125, 'SDG', 'Sudanese Pound', ''),
(126, 'SCR', 'Seychellois Rupee', ''),
(127, 'SBD', 'Solomon Islander Dollar', ''),
(128, 'SLL', 'Sierra Leonean Leone', ''),
(129, 'SOS', 'Somali Shilling', ''),
(130, 'STN', 'Sao Tomean Dobra', ''),
(131, 'SZL', 'Swazi Lilangeni', ''),
(132, 'SRD', 'Surinamese Dollar', ''),
(133, 'SVC', 'Salvadoran Colon', ''),
(134, 'SPL', 'Seborgan Luigino', ''),
(135, 'SHP', 'Saint Helenian Pound', ''),
(136, 'THB', 'Thai Baht', ''),
(137, 'TRY', 'Turkish Lira', ''),
(138, 'TWD', 'Taiwan New Dollar', ''),
(139, 'TND', 'Tunisian Dinar', ''),
(140, 'TTD', 'Trinidadian Dollar', ''),
(141, 'TZS', 'Tanzanian Shilling', ''),
(142, 'TOP', 'Tongan Pa\'anga', ''),
(143, 'TJS', 'Tajikistani Somoni', ''),
(144, 'TMT', 'Turkmenistani Manat', ''),
(145, 'TVD', 'Tuvaluan Dollar', ''),
(146, 'UAH', 'Ukrainian Hryvnia', ''),
(147, 'UGX', 'Ugandan Shilling', ''),
(148, 'UZS', 'Uzbekistani Som', ''),
(149, 'UYU', 'Uruguayan Peso', ''),
(150, 'VND', 'Vietnamese Dong', ''),
(151, 'VEF', 'Venezuelan Bolívar', ''),
(152, 'VES', 'Venezuelan Bolívar', ''),
(153, 'VUV', 'Ni-Vanuatu Vatu', ''),
(154, 'WST', 'Samoan Tala', ''),
(155, 'YER', 'Yemeni Rial', ''),
(156, 'ZAR', 'South African Rand', ''),
(157, 'ZWD', 'Zimbabwean Dollar', ''),
(158, 'ZMW', 'Zambian Kwacha', '');

-- --------------------------------------------------------

--
-- Table structure for table `form_comments`
--

CREATE TABLE `form_comments` (
  `id` int(10) NOT NULL,
  `form_id` int(5) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_master`
--

CREATE TABLE `form_master` (
  `id` int(5) NOT NULL,
  `company_id` int(5) NOT NULL,
  `channel_id` int(1) NOT NULL DEFAULT 1,
  `form_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_surname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_desig` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rdt` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industry_master`
--

CREATE TABLE `industry_master` (
  `industry_id` int(3) NOT NULL,
  `industry_name` varchar(150) NOT NULL,
  `pmxscore` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry_master`
--

INSERT INTO `industry_master` (`industry_id`, `industry_name`, `pmxscore`) VALUES
(1, 'VIRTUAL FINANCIAL ASSETS  CRYPTOCURRENCY RELATED ACTIVITIES', '10.00'),
(2, 'GAMBLING AND BETTING ACTIVITIES', '9.00'),
(3, 'CONSTRUCTION', '9.00'),
(4, 'HUMAN HEALTH AND SOCIAL WORK ACTIVITIES', '4.00'),
(5, 'TRUSTS, OTHER FINANCIAL SERVICE ACTIVITIES EXCEPT INSURANCE AND PENSION FUNDING', '9.00'),
(6, 'ADVERTISING AND MARKET RESEARCH', '7.00'),
(7, 'IT AND OTHER INFORMATION SERVICES', '5.50'),
(8, 'FINANCIAL INSTITUTION', '5.50'),
(9, 'REAL ESTATE ACTIVITIES', '9.00'),
(10, 'EXTRATERRITORIAL ORGANISATIONS AND BODIES', '7.00'),
(11, 'OTHER SERVICE ACTIVITIES', '8.00'),
(12, 'AGRICULTURE FORESTRY AND FISHING', '2.50'),
(13, 'MINING AND QUARRYING', '7.00'),
(14, 'MANUFACTURING', '4.00'),
(15, 'ELECTRICITY GAS STEAM AND AIR CONDITIONING SUPPLY', '6.00'),
(16, 'WATER SUPPLY SEWERAGE WASTE MANAGEMENT AND REMEDIATION ACTIVITIES', '6.00'),
(17, 'ACCOMMODATION AND FOOD SERVICE ACTIVITIES', '7.00'),
(18, 'PROFESSIONAL SCIENTIFIC AND TECHNICAL ACTIVITIES', '6.00'),
(19, 'ADMINISTRATIVE AND SUPPORT SERVICE ACTIVITIES', '4.00'),
(20, 'PUBLIC ADMINISTRATION AND DEFENCE COMPULSORY SOCIAL SECURITY', '6.00'),
(21, 'EDUCATION', '6.00'),
(22, 'ARTS ENTERTAINMENT AND RECREATION', '6.00'),
(23, 'ACTIVITIES OF HOUSEHOLDS AS EMPLOYERS;', '6.00'),
(24, 'BUSINESS AND OTHER MANAGEMENT CONSULTANCY ACTIVITIES', '9.00'),
(25, 'REPAIR OF MOTOR VEHICLES AND MOTORCYCLES', '9.00'),
(26, 'LEGAL AND ACCOUNTING ACTIVITIES', '7.00'),
(27, 'HOLDING COMPANIES', '4.00'),
(28, 'INFORMATION AND COMMUNICATION - AUDIOVISUAL PROGRAMMING AND BROADCASTING', '6.00'),
(29, 'WHOLESALE AND RETAIL TRADE', '5.50'),
(30, 'TRANSPORTATION AND STORAGE', '4.00'),
(31, 'INFORMATION AND COMMUNICATION', '5.50'),
(32, 'ACCOUNTANTS AND AUDITORS', '5.50'),
(33, 'HOUSEHOLDS AS EMPLOYERS; UNDIFFERENTIATED GOODS- AND SERVICES', '2.50'),
(34, 'ARTS, ENTERTAINMENT AND RECREATION', '9.00'),
(35, 'CHEMICAL AND PHARMACEUTICALS', '7.00'),
(36, 'CREDIT INSTITUTION', '5.50'),
(37, 'WATER SUPPLY, WASTE MANAGEMENT', '2.50'),
(38, 'VIRTUAL FINANCIAL ASSETS RELATED ACTIVITIES & CRYPTO CURRENCIES', '9.00'),
(39, 'TRUSTEES AND FIDICIARIES', '7.00'),
(40, 'TRADE IN PRECIOUS METALS AND STONES', '9.00'),
(41, 'PUBLIC ADMINISTRATION AND DEFENCE; COMPULSORY SOCIAL SECURITY', '2.50'),
(42, 'PROFESSIONAL, SCIENTIFIC AND TECHNICAL ACTIVITIES', '5.50'),
(43, 'PROFESSIONAL SPORT CLUBS, MANAGERS AND RELATED ACTIVITIES ', '9.00'),
(44, 'NOTARIES', '5.50'),
(45, 'NON-PROFIT ORGANISATION', '9.00'),
(46, 'INVESTMENT AND SECURITIES FIRMS', '5.50'),
(47, 'INSURANCE', '4.00'),
(48, 'FREE PORT', '9.00');

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

CREATE TABLE `question_master` (
  `question_id` int(10) NOT NULL,
  `category_id` int(1) NOT NULL,
  `title` text NOT NULL,
  `quest_desc` text NOT NULL,
  `quest_type` text NOT NULL,
  `quest_opt` text NOT NULL,
  `position` int(3) NOT NULL,
  `isrequired` int(1) NOT NULL DEFAULT 0,
  `israting` int(1) NOT NULL DEFAULT 0,
  `has_multiple` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_master`
--

INSERT INTO `question_master` (`question_id`, `category_id`, `title`, `quest_desc`, `quest_type`, `quest_opt`, `position`, `isrequired`, `israting`, `has_multiple`) VALUES
(1, 1, 'Economic Activity of the Company', '', '10', '', 1, 1, 1, 1),
(2, 1, 'Provide a brief overview of the principal activity of the company*', '', '4', '', 6, 1, 0, 1),
(3, 1, 'Country of Effective Management', '', '8', '', 7, 1, 1, 1),
(4, 1, 'Is this a licensable activity? ', '', '6', 'HIDENEXT', 8, 0, 1, 1),
(5, 1, 'List the Issuing Authorities ', '', '1', '', 9, 1, 0, 1),
(6, 1, 'The services of the company are?', '', '5', 'B2B|B2C|B2G|OTHER', 10, 1, 0, 1),
(7, 1, 'Please list the names of 5 suppliers the company will interact with:', '', '1', '', 11, 1, 0, 5),
(8, 2, 'Annual turnover/revenue of the last fiscal year', '', '11', '', 1, 1, 1, 1),
(9, 2, 'Is the majority of the  income passive in nature?', '', '6', '', 2, 0, 0, 1),
(10, 2, 'Total assets value of the last fiscal year', '', '11', '', 3, 1, 1, 1),
(11, 2, 'Issued and Paid share capital', '', '11', '', 4, 1, 0, 1),
(12, 3, 'Provide a brief overview of the types of activities that will be channelled through the Paymix.pro account. E.g. Revenues from sales, expenses, salaries to employees, payment of tax, dividends, operating/investing/financing activities, directors fees, travelling expenses, cost of goods.', '', '4', '', 1, 1, 0, 1),
(13, 3, 'Estimated value of monthly incoming funds through the Paymix.pro account', '', '11', '', 2, 1, 0, 1),
(14, 3, 'Estimated number of monthly incoming funds through the Paymix.pro account', '', '3', '', 3, 1, 0, 1),
(15, 3, 'Please indicate the top 3 jurisdictions you will be receiving the funds from', '', '8', '', 4, 1, 0, 3),
(16, 3, 'Estimated value of monthly outgoing funds through the Paymix.pro account', '', '11', '', 5, 1, 0, 1),
(17, 3, 'Estimated number of monthly outgoing funds through the Paymix.pro account', '', '3', '', 6, 1, 0, 1),
(18, 3, 'Please indicate the top 3 jurisdictions you will be transfering the funds to', '', '8', '', 7, 1, 0, 3),
(19, 1, 'Do you make use of any blockchain technology/smart contracts within your trade cycle?', '', '6', 'HIDENEXT', 2, 1, 0, 1),
(20, 1, 'Please describe the process briefly', '', '1', '', 3, 0, 0, 1),
(21, 1, 'Do you provide services to any Citizenship by Investment or Golden Visa programme?', '', '6', 'HIDENEXT', 4, 1, 0, 1),
(22, 1, 'Please describe the process briefly', '', '1', '', 5, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `region_master`
--

CREATE TABLE `region_master` (
  `region_id` int(2) NOT NULL,
  `region_name` varchar(150) NOT NULL,
  `pmxscore` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region_master`
--

INSERT INTO `region_master` (`region_id`, `region_name`, `pmxscore`) VALUES
(1, 'East Asia & Pacific', '5.72'),
(2, 'Europe & Central Asia', '4.69'),
(3, 'Latin America & Caribbean', '5.50'),
(4, 'Middle East & North Africa', '6.16'),
(5, 'North America', '4.98'),
(6, 'South Asia', '7.85'),
(7, 'Sub-Saharan Africa', '6.53'),
(8, 'N/A', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings_master`
--

CREATE TABLE `settings_master` (
  `id` int(3) NOT NULL,
  `grp_id` int(5) NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `pmxscore` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ubo_master`
--

CREATE TABLE `ubo_master` (
  `ubo_id` int(10) NOT NULL,
  `company_id` int(5) NOT NULL,
  `ubo_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubo_dob` date NOT NULL,
  `ubo_nationality1` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubo_nationality2` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` int(1) NOT NULL,
  `id_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_expiry` date NOT NULL,
  `id_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_country` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubo_share` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(120) NOT NULL,
  `user_name` varchar(120) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT 3,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_email`, `user_name`, `user_password`, `user_type`, `status`) VALUES
(1, 'admin@admin.com', 'Michael Alvares', '0287040c474dbf44cdeb17eebb99d828', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `channel_master`
--
ALTER TABLE `channel_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `company_question`
--
ALTER TABLE `company_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_structure`
--
ALTER TABLE `company_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_master`
--
ALTER TABLE `country_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_master`
--
ALTER TABLE `currency_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_comments`
--
ALTER TABLE `form_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_master`
--
ALTER TABLE `form_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industry_master`
--
ALTER TABLE `industry_master`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `question_master`
--
ALTER TABLE `question_master`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `region_master`
--
ALTER TABLE `region_master`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `settings_master`
--
ALTER TABLE `settings_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ubo_master`
--
ALTER TABLE `ubo_master`
  ADD PRIMARY KEY (`ubo_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `channel_master`
--
ALTER TABLE `channel_master`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `company_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_question`
--
ALTER TABLE `company_question`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_structure`
--
ALTER TABLE `company_structure`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country_master`
--
ALTER TABLE `country_master`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `currency_master`
--
ALTER TABLE `currency_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `form_comments`
--
ALTER TABLE `form_comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_master`
--
ALTER TABLE `form_master`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry_master`
--
ALTER TABLE `industry_master`
  MODIFY `industry_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `question_master`
--
ALTER TABLE `question_master`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `region_master`
--
ALTER TABLE `region_master`
  MODIFY `region_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings_master`
--
ALTER TABLE `settings_master`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ubo_master`
--
ALTER TABLE `ubo_master`
  MODIFY `ubo_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
