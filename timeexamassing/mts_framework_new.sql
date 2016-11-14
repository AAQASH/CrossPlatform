-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2015 at 10:04 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mts_framework_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `mts_account_type`
--

DROP TABLE IF EXISTS `mts_account_type`;
CREATE TABLE IF NOT EXISTS `mts_account_type` (
  `account_type_id` int(5) NOT NULL AUTO_INCREMENT,
  `accounttype` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`account_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mts_account_type`
--

INSERT INTO `mts_account_type` (`account_type_id`, `accounttype`, `added_date`, `is_active`) VALUES
(1, 'Admin', '2011-06-03 20:52:24', 1),
(2, 'User', '2011-06-03 20:52:29', 1),
(3, 'Merchant', '2012-01-16 10:42:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_address`
--

DROP TABLE IF EXISTS `mts_address`;
CREATE TABLE IF NOT EXISTS `mts_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `entity_type_id_fk` int(5) NOT NULL,
  `prefix` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `middlename` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `suffix` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `address1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `state_id_fk` int(11) NOT NULL,
  `city_id_fk` int(11) NOT NULL,
  `zipcode` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `phoneno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `faxno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mts_address`
--

INSERT INTO `mts_address` (`address_id`, `UID`, `entity_type_id_fk`, `prefix`, `firstname`, `middlename`, `lastname`, `suffix`, `address1`, `address2`, `country_id_fk`, `state_id_fk`, `city_id_fk`, `zipcode`, `phoneno`, `faxno`, `is_active`) VALUES
(1, 21, 1, 'Mr.', 'Gunnar', '', 'Eensalu', '', '20205 N. 67TH Ave No. 100  ', '', 223, 4, 3, '85308', '623-572-8814', '', 1),
(2, 21, 1, 'Miss.', 'Parisaaa', 'Amol', 'Louieeee', 'S', '5860 W. Thunderbird UK', 'this is my second address', 223, 1, 3, '853064', '602-863-9700', 'this is my fax no.', 1),
(3, 21, 1, 'Mr.', 'amol s _ 0', ' arun _ 0', 'sananse _ 0', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 0', '9225533196', '', 1),
(4, 21, 1, 'Mr.', 'amol s _ 1', ' arun _ 1', 'sananse _ 1', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 1', '9225533196', '', 1),
(5, 21, 1, 'Mr.', 'amol s _ 2', ' arun _ 2', 'sananse _ 2', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 2', '9225533196', '', 1),
(6, 21, 1, 'Mr.', 'amol s _ 3', ' arun _ 3', 'sananse _ 3', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 3', '9225533196', '', 1),
(7, 21, 1, 'Mr.', 'amol s _ 4', ' arun _ 4', 'sananse _ 4', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 4', '9225533196', '', 1),
(8, 21, 1, 'Mr.', 'amol s _ 5', ' arun _ 5', 'sananse _ 5', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 5', '9225533196', '', 1),
(9, 21, 1, 'Mr.', 'amol s _ 6', ' arun _ 6', 'sananse _ 6', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 6', '9225533196', '', 1),
(11, 21, 1, 'Mr.', 'amol s _ 8', ' arun _ 8', 'sananse _ 8', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 8', '9225533196', '', 1),
(12, 21, 1, 'Mr.', 'amol s _ 9', ' arun _ 9', 'sananse _ 9', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 9', '9225533196', '', 1),
(13, 21, 1, 'Mr.', 'amol s _ 10', ' arun _ 10', 'sananse _ 10', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 1', '9225533196', '', 1),
(14, 21, 1, 'Mr.', 'amol s _ 11', ' arun _ 11', 'sananse _ 11', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 1', '9225533196', '', 1),
(15, 21, 1, 'Mr.', 'amol s _ 12', ' arun _ 12', 'sananse _ 12', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 1', '9225533196', '', 1),
(16, 21, 1, 'Mr.', 'amol s _ 13', ' arun _ 13', 'sananse _ 13', '', 'this is my address', 'this is my address 2', 223, 4, 3, '422101 _ 1', '9225533196', '', 1),
(23, 21, 1, 'Mr.', 'Amol', 'Arun', 'Sananse', 'MCM', 'Jagtap mala, Gajanan Nagar, Nashik Road', 'Nashik', 223, 1, 3, '422101', '9225533196', '989898989898', 1),
(24, 21, 1, 'Mr', 'Merchant Amol', 'Merchant Arun', 'Merchant Sananse', 'MCM', 'this is my address', 'this is my second address', 223, 1, 1, '422101', '9225533196', '', 1),
(25, 1, 1, '', 'Amol', 'A', 'Sananse', '', '4, Leela Bunglow', 'Jagtap Mala', 223, 1, 3, '10001', '9225533196', '', 1),
(26, 8, 1, '', 'test', '', 'test', '', 'test', 'test', 223, 1, 3, '10001', '9225533196', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_attribute`
--

DROP TABLE IF EXISTS `mts_attribute`;
CREATE TABLE IF NOT EXISTS `mts_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_type_id_fk` int(11) NOT NULL,
  `attribute_code` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `backend_type` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `frontend_input` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `frontend_label` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `frontend_class` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_global` tinyint(1) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  `is_user_defined` tinyint(1) NOT NULL,
  `default_value` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_searchable` tinyint(1) NOT NULL,
  `is_filterable` tinyint(1) NOT NULL,
  `is_compareable` tinyint(1) NOT NULL,
  `is_unique` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`attribute_id`),
  KEY `entity_type_id_fk` (`entity_type_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `mts_attribute`
--

INSERT INTO `mts_attribute` (`attribute_id`, `entity_type_id_fk`, `attribute_code`, `backend_type`, `frontend_input`, `frontend_label`, `frontend_class`, `is_global`, `is_visible`, `is_required`, `is_user_defined`, `default_value`, `is_searchable`, `is_filterable`, `is_compareable`, `is_unique`, `position`, `is_active`) VALUES
(1, 1, 'name', 'varchar', 'text', 'Name', 'name', 1, 1, 1, 1, '1', 1, 1, 1, 0, 0, 0),
(2, 1, 'attribute_code - 0', 'varchar', 'textbox', 'frontend_label - 0', 'frontend_class - 0', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(3, 1, 'attribute_code - 1', 'varchar', 'textbox', 'frontend_label - 1', 'frontend_class - 1', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(4, 1, 'attribute_code - 2', 'varchar', 'textbox', 'frontend_label - 2', 'frontend_class - 2', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(5, 1, 'attribute_code - 3', 'varchar', 'textbox', 'frontend_label - 3', 'frontend_class - 3', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(6, 1, 'attribute_code - 4', 'varchar', 'textbox', 'frontend_label - 4', 'frontend_class - 4', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(7, 1, 'attribute_code - 5', 'varchar', 'textbox', 'frontend_label - 5', 'frontend_class - 5', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(8, 1, 'attribute_code - 6', 'varchar', 'textbox', 'frontend_label - 6', 'frontend_class - 6', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(9, 1, 'attribute_code - 7', 'varchar', 'textbox', 'frontend_label - 7', 'frontend_class - 7', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(10, 1, 'attribute_code - 8', 'varchar', 'textbox', 'frontend_label - 8', 'frontend_class - 8', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(11, 1, 'attribute_code - 9', 'varchar', 'textbox', 'frontend_label - 9', 'frontend_class - 9', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(12, 1, 'attribute_code - 10', 'varchar', 'textbox', 'frontend_label - 10', 'frontend_class - 10', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(13, 1, 'attribute_code - 11', 'varchar', 'textbox', 'frontend_label - 11', 'frontend_class - 11', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(14, 1, 'attribute_code - 12', 'varchar', 'textbox', 'frontend_label - 12', 'frontend_class - 12', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(15, 1, 'attribute_code - 13', 'varchar', 'textbox', 'frontend_label - 13', 'frontend_class - 13', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(16, 1, 'attribute_code - 14', 'varchar', 'textbox', 'frontend_label - 14', 'frontend_class - 14', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(17, 1, 'attribute_code - 15', 'varchar', 'textbox', 'frontend_label - 15', 'frontend_class - 15', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(18, 1, 'attribute_code - 16', 'varchar', 'textbox', 'frontend_label - 16', 'frontend_class - 16', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(19, 1, 'attribute_code - 17', 'varchar', 'textbox', 'frontend_label - 17', 'frontend_class - 17', 1, 1, 1, 1, '', 1, 1, 1, 1, 1, 0),
(22, 0, 'wwwwwww', '', 'listbox', 'wwwwwwwwww', '', 1, 1, 0, 1, '', 1, 1, 1, 0, 1, 1),
(23, 0, 'wwwwwww', '', 'listbox', 'wwwwwwwwww', '', 1, 1, 0, 1, '', 1, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_attribute_option_value`
--

DROP TABLE IF EXISTS `mts_attribute_option_value`;
CREATE TABLE IF NOT EXISTS `mts_attribute_option_value` (
  `attribute_option_value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id_fk` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_default_selected` tinyint(1) NOT NULL,
  PRIMARY KEY (`attribute_option_value_id`),
  KEY `FK_ATTRIBUTE_OPTION_ATTRIBUTE` (`attribute_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Attributes option (for source model)' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mts_attribute_option_value`
--

INSERT INTO `mts_attribute_option_value` (`attribute_option_value_id`, `attribute_id_fk`, `value`, `sort_order`, `is_default_selected`) VALUES
(14, 23, 'one 1', 1, 0),
(13, 23, 'Two', 2, 1),
(12, 23, 'Three', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_city`
--

DROP TABLE IF EXISTS `mts_city`;
CREATE TABLE IF NOT EXISTS `mts_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id_fk` int(11) NOT NULL DEFAULT '0',
  `country_id_fk` int(11) NOT NULL DEFAULT '0',
  `city` varchar(250) NOT NULL,
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `active_city` int(2) NOT NULL DEFAULT '1',
  `timezone_id_fk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`city_id`),
  KEY `state_id_fk` (`state_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mts_city`
--

INSERT INTO `mts_city` (`city_id`, `state_id_fk`, `country_id_fk`, `city`, `latitude`, `longitude`, `is_active`, `active_city`, `timezone_id_fk`) VALUES
(1, 1, 223, 'ABCD', 0, 0, 1, 1, 0),
(3, 1, 223, 'Nashik', 0, 0, 1, 1, 0),
(4, 226, 1, 'Nashik', 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mts_contactus`
--

DROP TABLE IF EXISTS `mts_contactus`;
CREATE TABLE IF NOT EXISTS `mts_contactus` (
  `contactus_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone_no` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `comments` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`contactus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mts_contactus`
--

INSERT INTO `mts_contactus` (`contactus_id`, `first_name`, `last_name`, `email`, `address`, `phone_no`, `comments`) VALUES
(5, 'amol - 3', 'sananse - 3', 'amol.sananse3@gmail.com', 'this is my address - 3', '0000000003', 'this is my comment - 3'),
(6, 'amol - 4', 'sananse - 4', 'amol.sananse4@gmail.com', 'this is my address - 4', '0000000004', 'this is my comment - 4'),
(7, 'amol - 5', 'sananse - 5', 'amol.sananse5@gmail.com', 'this is my address - 5', '0000000005', 'this is my comment - 5'),
(8, 'amol - 6', 'sananse - 6', 'amol.sananse6@gmail.com', 'this is my address - 6', '0000000006', 'this is my comment - 6'),
(9, 'amol - 7', 'sananse - 7', 'amol.sananse7@gmail.com', 'this is my address - 7', '0000000007', 'this is my comment - 7'),
(10, 'amol - 8', 'sananse - 8', 'amol.sananse8@gmail.com', 'this is my address - 8', '0000000008', 'this is my comment - 8'),
(11, 'amol - 9', 'sananse - 9', 'amol.sananse9@gmail.com', 'this is my address - 9', '0000000009', 'this is my comment - 9'),
(15, 'amol - 13', 'sananse - 13', 'amol.sananse13@gmail.com', 'this is my address - 13', '00000000013', 'this is my comment - 13'),
(16, 'amol - 14', 'sananse - 14', 'amol.sananse14@gmail.com', 'this is my address - 14', '00000000014', 'this is my comment - 14'),
(17, 'amol - 15', 'sananse - 15', 'amol.sananse15@gmail.com', 'this is my address - 15', '00000000015', 'this is my comment - 15'),
(18, 'amol - 16', 'sananse - 16', 'amol.sananse16@gmail.com', 'this is my address - 16', '00000000016', 'this is my comment - 16'),
(19, 'amol - 17', 'sananse - 17', 'amol.sananse17@gmail.com', 'this is my address - 17', '00000000017', 'this is my comment - 17'),
(20, 'amol - 18', 'sananse - 18', 'amol.sananse18@gmail.com', 'this is my address - 18', '00000000018', 'this is my comment - 18'),
(21, 'amol - 19', 'sananse - 19', 'amol.sananse19@gmail.com', 'this is my address - 19', '00000000019', 'this is my comment - 19');

-- --------------------------------------------------------

--
-- Table structure for table `mts_contactus_reply`
--

DROP TABLE IF EXISTS `mts_contactus_reply`;
CREATE TABLE IF NOT EXISTS `mts_contactus_reply` (
  `contactus_reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `contactus_id_fk` int(11) NOT NULL,
  `subject` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `message` varchar(1000) COLLATE latin1_general_ci NOT NULL,
  `added_datetime` datetime NOT NULL,
  PRIMARY KEY (`contactus_reply_id`),
  KEY `contactus_id_fk` (`contactus_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mts_contactus_reply`
--

INSERT INTO `mts_contactus_reply` (`contactus_reply_id`, `contactus_id_fk`, `subject`, `message`, `added_datetime`) VALUES
(1, 4, 'test reply', '<p>\r\n	test</p>\r\n', '2014-06-27 03:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `mts_contentpage`
--

DROP TABLE IF EXISTS `mts_contentpage`;
CREATE TABLE IF NOT EXISTS `mts_contentpage` (
  `contentpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `urlkey` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_allow_comment` tinyint(2) NOT NULL,
  `page_template_id` tinyint(2) NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `page_type` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`contentpage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mts_contentpage`
--

INSERT INTO `mts_contentpage` (`contentpage_id`, `urlkey`, `meta_description`, `meta_keywords`, `title`, `is_allow_comment`, `page_template_id`, `description`, `page_type`, `added_date`, `modified_date`, `is_active`) VALUES
(4, 'customer-service.html', 'Customer Service', 'Customer Service', 'Customer Service', 1, 1, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pellentesque enim ac augue sodales eget porta tortor eleifend. Nulla sit amet purus dolor, vitae ullamcorper lorem. Nam pulvinar lectus erat, ac venenatis metus. Curabitur vitae neque quis turpis rutrum blandit. Integer sit amet dui diam. Curabitur varius dictum laoreet. Duis sagittis, nulla adipiscing sodales vestibulum, urna dui consectetur nisl, eget congue tellus odio vitae purus.</p>\r\n<p>\r\n	Proin luctus velit adipiscing massa aliquet eu sodales erat interdum. Nullam fringilla sapien eu nunc aliquet consectetur. Vestibulum quis lobortis risus. Curabitur in urna nec dolor placerat condimentum. Ut id sem non ipsum sagittis eleifend ac eget metus. Ut vel elit eget felis elementum mattis. Nullam neque nulla, suscipit sed fringilla a, sodales quis mauris. Vivamus lobortis purus nec enim rutrum vitae blandit libero venenatis. Duis eu justo nec nisi fringilla posuere quis in tellus. Donec iaculis imperdiet commodo. Ut condimentum mattis hendrerit.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n	<li>\r\n		Etiam ut ante turpis, ac vehicula nisl.</li>\r\n	<li>\r\n		Praesent tincidunt mi id magna fermentum luctus.</li>\r\n	<li>\r\n		Quisque consectetur elit sit amet nisl ornare ac rutrum velit mollis.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Nam eget sapien orci, id adipiscing sapien.</li>\r\n	<li>\r\n		Nullam vel nibh vel ipsum scelerisque venenatis faucibus eget sem.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Donec consequat magna augue, vitae tempus justo.</li>\r\n	<li>\r\n		Mauris pharetra nisl vestibulum magna tristique ut suscipit mauris pellentesque.</li>\r\n	<li>\r\n		Nam ullamcorper pellentesque sapien, quis viverra odio laoreet id.</li>\r\n	<li>\r\n		In id ipsum mauris, id volutpat tellus.</li>\r\n	<li>\r\n		Nam at ligula ut libero egestas vehicula.</li>\r\n	<li>\r\n		Nullam non ligula est, a egestas sapien.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Pellentesque non sem pretium lectus euismod fringilla.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Praesent scelerisque suscipit ligula, ut fringilla risus ultrices non.</li>\r\n	<li>\r\n		Vestibulum scelerisque mi luctus quam ultrices hendrerit semper ante facilisis.</li>\r\n	<li>\r\n		Sed nec mauris lorem, in cursus est.</li>\r\n	<li>\r\n		Pellentesque eu metus eu felis volutpat ullamcorper non in dolor.</li>\r\n	<li>\r\n		Pellentesque vulputate mi sit amet enim rutrum consequat.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Integer vitae dui nulla, a venenatis lacus.</li>\r\n	<li>\r\n		Phasellus quis tortor arcu, ut pretium tellus.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Vivamus quis ante tortor, non tempor sapien.</li>\r\n	<li>\r\n		Donec sit amet justo velit, id convallis justo.</li>\r\n	<li>\r\n		Morbi vitae ligula vitae mi egestas ullamcorper.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Nam tincidunt sem ut nulla molestie dignissim.</li>\r\n	<li>\r\n		Curabitur ut magna ut arcu porttitor pellentesque at nec leo.</li>\r\n	<li>\r\n		Nunc vitae tellus in ante malesuada ullamcorper et quis nisl.</li>\r\n	<li>\r\n		Donec vulputate nisl rhoncus ipsum hendrerit lobortis.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Donec quis justo nec libero euismod sodales.</li>\r\n	<li>\r\n		Maecenas sagittis quam vel dui gravida porttitor.</li>\r\n	<li>\r\n		Morbi pellentesque mattis lectus, consectetur elementum massa porttitor eget.</li>\r\n	<li>\r\n		Cras accumsan lectus non felis semper bibendum.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Phasellus vitae purus massa, sed semper elit.</li>\r\n	<li>\r\n		Sed at libero ac turpis cursus vulputate sit amet quis risus.</li>\r\n	<li>\r\n		Vivamus auctor nisl eget sapien dictum egestas ullamcorper nulla hendrerit.</li>\r\n	<li>\r\n		Donec eu enim et lorem aliquam vestibulum id a leo.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Integer rhoncus lacus sit amet metus eleifend egestas sit amet eget risus.</li>\r\n	<li>\r\n		Vestibulum quis mauris malesuada libero sagittis sagittis.</li>\r\n	<li>\r\n		Cras id turpis sit amet enim molestie elementum ac ac eros.</li>\r\n	<li>\r\n		Nullam porta imperdiet justo, eu accumsan nunc volutpat a.</li>\r\n	<li>\r\n		Nam in diam in urna commodo adipiscing nec nec nulla.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Nunc molestie tortor mauris, vitae fringilla velit.</li>\r\n	<li>\r\n		Aliquam non ligula ornare mi gravida pulvinar at id est.</li>\r\n	<li>\r\n		Curabitur molestie nisi eros, eu mattis erat.</li>\r\n	<li>\r\n		Nullam ornare placerat felis, in suscipit ligula interdum sed.</li>\r\n	<li>\r\n		Morbi commodo justo ac turpis mattis in tristique orci pharetra.</li>\r\n	<li>\r\n		Donec malesuada neque et urna vehicula sodales nec eget nisl.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Morbi aliquam est eu justo euismod et vulputate nisl consequat.</li>\r\n	<li>\r\n		Nulla facilisis neque in augue semper lacinia.</li>\r\n	<li>\r\n		Praesent pharetra tincidunt odio, non fringilla sem dignissim id.</li>\r\n	<li>\r\n		Curabitur eu orci tellus, ac lobortis turpis.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Aliquam nec velit cursus dui dignissim porta.</li>\r\n	<li>\r\n		Etiam porta sem at turpis dictum sagittis.</li>\r\n	<li>\r\n		Duis pellentesque molestie orci, non tristique nunc scelerisque at.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Fusce a neque ligula, vitae semper neque.</li>\r\n	<li>\r\n		Praesent vehicula lorem vel nisi consequat feugiat.</li>\r\n</ul>', 'page', '2012-12-02 08:39:00', '2012-12-25 01:45:03', 0),
(3, 'about-us.html', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'About Us', 1, 1, '<p>\r\n	<strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Suspendisse cursus diam at risus hendrerit sed venenatis velit hendrerit. Curabitur dui elit, ultricies et euismod in, aliquet pellentesque diam. Nullam adipiscing odio a odio dapibus elementum. Suspendisse id mauris quis nisl eleifend venenatis id in justo. Vestibulum diam sapien, pharetra vitae gravida venenatis, laoreet id sem. Phasellus varius nibh pharetra sem elementum ullamcorper. Quisque vitae tempus diam. Phasellus tincidunt nisi at ante posuere dignissim. Donec commodo adipiscing tincidunt. Vivamus dapibus justo sit amet lacus lacinia at interdum tellus porttitor. Phasellus dignissim interdum odio non euismod. Nullam nisl urna, auctor sed vehicula sed, molestie eu enim. Quisque dolor nunc, sagittis eu hendrerit ut, lacinia nec sem. Quisque consequat rhoncus turpis vitae rhoncus.<br />\r\n	<br />\r\n	Quisque sit amet sapien nisl. Ut et urna at eros dapibus iaculis. Nam quis cursus eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur arcu mi, laoreet vel ornare id, fringilla nec sapien. Sed eget est ac enim ullamcorper hendrerit. Fusce ut nibh nibh. Quisque egestas, dolor in dignissim interdum, sapien sapien aliquet ligula, et interdum felis dolor at eros. Nunc in odio diam. Proin eget tellus nec ligula fermentum rhoncus in et massa.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n	<li>\r\n		Suspendisse auctor sollicitudin metus, quis scelerisque justo tristique vitae.</li>\r\n	<li>\r\n		Donec ut purus at lacus ultrices vehicula ac sed lorem.</li>\r\n	<li>\r\n		Ut eu arcu id velit facilisis porta eu in neque.</li>\r\n	<li>\r\n		Duis viverra sem sed tortor pretium vel aliquet magna venenatis.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Nunc pretium purus at metus gravida at porta libero bibendum.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Donec vitae ante ut erat dictum bibendum.</li>\r\n	<li>\r\n		Mauris vulputate risus sed libero molestie quis tempus ligula auctor.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Cras id mauris velit, nec commodo nulla.</li>\r\n	<li>\r\n		Maecenas at enim nisi, vel luctus purus.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Ut mollis turpis a leo suscipit quis vestibulum erat pharetra.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Morbi non sem quis eros eleifend ultrices.</li>\r\n	<li>\r\n		Sed tristique neque at diam gravida dictum sit amet ac erat.</li>\r\n	<li>\r\n		Donec lobortis erat sed nibh adipiscing eu blandit sapien luctus.</li>\r\n	<li>\r\n		Sed eu augue id mi tristique tristique.</li>\r\n	<li>\r\n		Nam pretium orci sit amet tortor posuere vehicula vitae non massa.</li>\r\n	<li>\r\n		Fusce sit amet risus velit, nec ullamcorper nulla.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Donec sodales est id est pellentesque molestie ut ac nisl.</li>\r\n	<li>\r\n		Donec viverra dolor eget elit fermentum tempus.</li>\r\n	<li>\r\n		Donec pretium posuere quam, sed tempor nibh viverra a.</li>\r\n	<li>\r\n		Fusce ut tellus sed mi sodales imperdiet.</li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Nam eget diam ac tellus blandit scelerisque vel in urna.</li>\r\n	<li>\r\n		Duis condimentum felis vel velit dignissim cursus</li>\r\n</ul>', 'page', '2012-12-01 10:34:00', '2012-12-31 06:24:26', 0),
(6, 'shipping-policy.html', 'Shipping Policy', 'Shipping Policy', 'Shipping Policy', 0, 1, '<div id=\\"lipsum\\">\r\n	<p>\r\n		Donec nec leo nec nisi venenatis mollis. Maecenas facilisis, enim lacinia cursus feugiat, nisl nibh interdum sem, fermentum pellentesque mauris lorem sed elit. Nunc vitae dui sit amet urna sollicitudin rhoncus nec eget est. Aliquam erat volutpat. Etiam rutrum tempus magna, ut dictum dui accumsan in. Cras sed libero ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis vehicula urna eu leo vehicula mattis. Etiam sed erat erat. Nullam quis mi eget velit sollicitudin vulputate. Etiam sagittis, arcu in elementum sodales, sapien tortor interdum nulla, ac rhoncus elit diam in eros. Pellentesque faucibus luctus arcu sit amet porta. Fusce nulla mi, porta ut feugiat quis, ornare in ante. Aenean non felis lorem. Donec suscipit aliquam justo id dapibus.</p>\r\n	<p>\r\n		Donec rhoncus scelerisque aliquet. Etiam quis ipsum eget justo sollicitudin consectetur posuere ac nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam sit amet luctus urna. Ut diam nisl, hendrerit at pellentesque non, tempus nec erat. Nullam eu erat neque, quis tincidunt purus. Vestibulum id sem nec justo hendrerit cursus id at dolor. Praesent at posuere nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel libero a mauris posuere volutpat vitae ut felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris eget elit urna, quis adipiscing odio. Duis enim purus, varius vel ultricies vitae, vehicula nec nunc.</p>\r\n	<p>\r\n		Morbi vel ante massa. Vestibulum diam dolor, rhoncus id pulvinar at, tempus et nunc. Phasellus ultrices rutrum tempus. Vestibulum dignissim sapien in turpis pharetra vehicula. Nulla facilisi. Morbi vulputate placerat tortor sed mattis. Mauris suscipit ligula nec enim condimentum accumsan. Proin dignissim pretium neque vitae eleifend. Sed pretium nunc vestibulum neque semper in tincidunt tortor pretium. Phasellus eget sapien eu diam volutpat ornare et sed sem. Nunc mi sem, ullamcorper quis tempus et, tempus in augue.</p>\r\n	<p>\r\n		Nulla facilisi. Maecenas imperdiet, lacus nec molestie pharetra, enim erat placerat ante, id aliquam leo massa viverra turpis. Quisque lacinia nulla a lacus porta interdum. Vestibulum ut lorem et nunc iaculis sollicitudin. Quisque a odio magna, quis viverra tellus. In ut ipsum massa, at lobortis nisl. Proin laoreet risus eget ipsum egestas at vestibulum nibh fringilla. Donec ornare lacus et lectus pulvinar eget tristique dui eleifend. Phasellus vitae odio dui, ac auctor elit. Suspendisse quis sapien nisi, ut porttitor augue. Ut rhoncus tempus consectetur. Mauris tincidunt augue nec dolor malesuada consectetur. Suspendisse tristique tincidunt ipsum sed pharetra. Etiam eu tellus velit. Nulla facilisi.</p>\r\n	<p>\r\n		Quisque convallis, erat sollicitudin imperdiet gravida, lacus risus consectetur nisi, id vulputate elit dui non elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin mi massa, facilisis a consequat eget, elementum non quam. Mauris urna lacus, facilisis eget bibendum sit amet, porta ut sem. In consequat fringilla mi quis imperdiet. Maecenas at odio non justo condimentum tincidunt vitae a metus. Duis ac ante nec dui vestibulum viverra eget cursus orci. Suspendisse potenti. Vivamus pharetra orci nec nibh iaculis lacinia. Suspendisse in augue id est adipiscing ultrices. Morbi at risus lacus. Etiam vel rutrum felis. Praesent rhoncus tortor in urna sollicitudin sed dignissim magna imperdiet. Cras tempor ullamcorper ipsum. Pellentesque sem est, blandit sed consequat quis, pulvinar nec velit. Mauris magna metus, porttitor sit amet placerat eget, sollicitudin sollicitudin nibh. In hac habitasse platea dictumst. Quisque nec tellus sit amet sapien tempor semper. Pellentesque commodo mi volutpat lorem porttitor eu lacinia nibh tincidunt.</p>\r\n</div>', 'page', '2012-12-10 13:32:00', '2012-12-25 01:45:23', 0),
(5, 'terms--condition.html', 'Terms & Condition', 'Terms & Condition', 'Terms & Condition', 0, 1, '<div id=\\"lipsum\\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel malesuada tellus. Vivamus imperdiet nibh et arcu interdum eget commodo lectus pulvinar. Vivamus consequat facilisis neque, id bibendum orci euismod eu. Phasellus egestas gravida sapien, vitae rutrum nulla hendrerit eget. Sed enim erat, molestie pulvinar placerat non, lobortis in dolor. Sed accumsan posuere lobortis. Morbi vehicula accumsan nisi, nec consequat diam tempor in. Aliquam egestas nunc pellentesque neque cursus bibendum nec quis arcu. Donec porta porttitor mollis. Phasellus imperdiet lobortis consequat. Curabitur hendrerit, leo pulvinar fringilla auctor, metus ante pellentesque lorem, et adipiscing risus nisl in elit. Duis ac neque ante, nec faucibus eros. Quisque vestibulum lacinia faucibus. Duis eu augue orci, sagittis tristique justo. Fusce justo lorem, scelerisque vitae convallis at, suscipit sit amet metus.</p>\r\n	<p>\r\n		In pharetra enim ac arcu tempus quis tincidunt lorem aliquam. Maecenas quam ligula, porttitor nec feugiat non, volutpat ac velit. Nunc porta eleifend nunc eu rutrum. Praesent purus nulla, placerat id consectetur vitae, lobortis vel massa. Sed massa nisl, faucibus sit amet eleifend sed, porttitor id enim. Maecenas malesuada mollis augue ac tempor. Donec sed scelerisque quam. Fusce gravida sem nec diam sollicitudin aliquam. Vivamus sapien ante, hendrerit at bibendum in, condimentum vitae nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla sem erat, adipiscing quis laoreet vitae, ornare sed purus. Aenean dictum semper enim, sed bibendum tellus tempus nec. Cras vitae varius elit. Cras leo augue, pellentesque id feugiat id, accumsan nec lectus. Nullam mi libero, elementum quis fermentum a, ultricies ullamcorper diam. Ut congue tempor purus, scelerisque commodo magna lacinia eu. Vivamus dictum orci id orci molestie non tempor felis mattis.</p>\r\n	<p>\r\n		Duis placerat magna ornare mi rhoncus in mollis purus dictum. Duis dapibus posuere lacus. Ut ac ultricies leo. Pellentesque ornare leo sed dolor faucibus nec feugiat lacus eleifend. Mauris eget lacus id tellus blandit posuere. Aliquam ultrices tellus ac eros lacinia lobortis. Duis nisi lacus, viverra vitae aliquam sed, dictum non lectus. Integer semper laoreet nisl, at tempor nisi feugiat sit amet. Nunc magna diam, sodales mattis rutrum fermentum, porta non sapien. Aliquam quis tellus quam.</p>\r\n	<p>\r\n		Ut vel tincidunt sem. Cras condimentum luctus cursus. Pellentesque gravida, lectus tristique elementum suscipit, est est ullamcorper urna, sed ultrices justo augue in est. Morbi libero mi, posuere eu dictum sed, eleifend sed orci. Quisque enim neque, facilisis eu ullamcorper vitae, ornare nec turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc neque tortor, bibendum eu bibendum nec, sagittis in enim. Nam faucibus imperdiet enim in mollis. Cras eu odio a justo adipiscing rutrum. Nam semper mauris id est fringilla congue. Integer posuere bibendum elit, in suscipit mauris ullamcorper non. Cras ornare dapibus bibendum. Quisque est leo, euismod ac blandit sit amet, scelerisque ac felis. Nulla et nulla urna, id semper mi. Nullam vitae nisl lorem, at eleifend massa. Nam elementum diam et sem laoreet consectetur nec ac sapien. Quisque et felis nec turpis posuere interdum.</p>\r\n	<p>\r\n		Cras semper nisl et enim venenatis posuere. Praesent sit amet elit magna. Sed vitae lacus orci, sed mollis dolor. Donec ultrices nisi mi. Sed ac turpis dui, id euismod enim. Pellentesque nec massa purus. Fusce vitae orci in felis pellentesque luctus. Donec consectetur dapibus nulla, eu ultrices dolor malesuada id. Nulla facilisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum fringilla varius venenatis. Maecenas faucibus lorem gravida justo laoreet accumsan.</p>\r\n</div>', 'page', '2012-12-05 17:39:18', '2012-12-25 01:45:12', 0),
(7, 'pravicy-policy.html', 'Pravicy Policy', 'Pravicy Policy', 'Pravicy Policy', 0, 1, '<div id=\\"\\\\&quot;lipsum\\\\&quot;\\">\r\n	<p>\r\n		Donec nec leo nec nisi venenatis mollis. Maecenas facilisis, enim lacinia cursus feugiat, nisl nibh interdum sem, fermentum pellentesque mauris lorem sed elit. Nunc vitae dui sit amet urna sollicitudin rhoncus nec eget est. Aliquam erat volutpat. Etiam rutrum tempus magna, ut dictum dui accumsan in. Cras sed libero ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis vehicula urna eu leo vehicula mattis. Etiam sed erat erat. Nullam quis mi eget velit sollicitudin vulputate. Etiam sagittis, arcu in elementum sodales, sapien tortor interdum nulla, ac rhoncus elit diam in eros. Pellentesque faucibus luctus arcu sit amet porta. Fusce nulla mi, porta ut feugiat quis, ornare in ante. Aenean non felis lorem. Donec suscipit aliquam justo id dapibus.</p>\r\n	<p>\r\n		Donec rhoncus scelerisque aliquet. Etiam quis ipsum eget justo sollicitudin consectetur posuere ac nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam sit amet luctus urna. Ut diam nisl, hendrerit at pellentesque non, tempus nec erat. Nullam eu erat neque, quis tincidunt purus. Vestibulum id sem nec justo hendrerit cursus id at dolor. Praesent at posuere nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel libero a mauris posuere volutpat vitae ut felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris eget elit urna, quis adipiscing odio. Duis enim purus, varius vel ultricies vitae, vehicula nec nunc.</p>\r\n	<p>\r\n		Morbi vel ante massa. Vestibulum diam dolor, rhoncus id pulvinar at, tempus et nunc. Phasellus ultrices rutrum tempus. Vestibulum dignissim sapien in turpis pharetra vehicula. Nulla facilisi. Morbi vulputate placerat tortor sed mattis. Mauris suscipit ligula nec enim condimentum accumsan. Proin dignissim pretium neque vitae eleifend. Sed pretium nunc vestibulum neque semper in tincidunt tortor pretium. Phasellus eget sapien eu diam volutpat ornare et sed sem. Nunc mi sem, ullamcorper quis tempus et, tempus in augue.</p>\r\n	<p>\r\n		Nulla facilisi. Maecenas imperdiet, lacus nec molestie pharetra, enim erat placerat ante, id aliquam leo massa viverra turpis. Quisque lacinia nulla a lacus porta interdum. Vestibulum ut lorem et nunc iaculis sollicitudin. Quisque a odio magna, quis viverra tellus. In ut ipsum massa, at lobortis nisl. Proin laoreet risus eget ipsum egestas at vestibulum nibh fringilla. Donec ornare lacus et lectus pulvinar eget tristique dui eleifend. Phasellus vitae odio dui, ac auctor elit. Suspendisse quis sapien nisi, ut porttitor augue. Ut rhoncus tempus consectetur. Mauris tincidunt augue nec dolor malesuada consectetur. Suspendisse tristique tincidunt ipsum sed pharetra. Etiam eu tellus velit. Nulla facilisi.</p>\r\n	<p>\r\n		Quisque convallis, erat sollicitudin imperdiet gravida, lacus risus consectetur nisi, id vulputate elit dui non elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin mi massa, facilisis a consequat eget, elementum non quam. Mauris urna lacus, facilisis eget bibendum sit amet, porta ut sem. In consequat fringilla mi quis imperdiet. Maecenas at odio non justo condimentum tincidunt vitae a metus. Duis ac ante nec dui vestibulum viverra eget cursus orci. Suspendisse potenti. Vivamus pharetra orci nec nibh iaculis lacinia. Suspendisse in augue id est adipiscing ultrices. Morbi at risus lacus. Etiam vel rutrum felis. Praesent rhoncus tortor in urna sollicitudin sed dignissim magna imperdiet. Cras tempor ullamcorper ipsum. Pellentesque sem est, blandit sed consequat quis, pulvinar nec velit. Mauris magna metus, porttitor sit amet placerat eget, sollicitudin sollicitudin nibh. In hac habitasse platea dictumst. Quisque nec tellus sit amet sapien tempor semper. Pellentesque commodo mi volutpat lorem porttitor eu lacinia nibh tincidunt.</p>\r\n</div>', 'page', '2012-12-15 13:32:00', '2012-12-25 01:45:43', 0),
(17, 'error-document.html', '', '', '404 Page not found', 1, 1, '<p>  Aliquam orci nisi, faucibus et semper id, feugiat vel nibh. Etiam congue lacinia urna ac volutpat. Morbi at elit in enim scelerisque condimentum in ac mi. Nunc quis justo id lacus tempus bibendum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In fermentum mattis est, quis ullamcorper felis sollicitudin bibendum. Donec orci neque, semper ac porttitor in, aliquam sed quam. Proin egestas, mauris et aliquet dignissim, lorem erat pretium nunc, a feugiat elit augue id augue. Fusce in turpis neque. Suspendisse convallis, tortor id ullamcorper aliquet, nisl arcu gravida elit, in varius arcu ligula a nisi. Suspendisse dignissim sapien vitae sapien posuere sed faucibus felis adipiscing. Phasellus eget nisl vitae est viverra lobortis a ac lorem. Sed velit augue, mattis quis hendrerit eu, ultrices vel velit. Cras ornare diam eget diam dignissim a consequat enim tincidunt.</p> <p>  Duis adipiscing, metus quis fermentum fermentum, dolor ipsum rhoncus turpis, et sollicitudin elit nisi in erat. Praesent massa neque, feugiat id dictum in, mollis tristique ligula. Suspendisse pulvinar tincidunt tellus imperdiet semper. Mauris non quam vitae arcu aliquet porta. Pellentesque tincidunt venenatis vestibulum. Aliquam at quam nec lectus commodo vehicula. Aenean ultricies imperdiet mi vel placerat. Praesent ullamcorper, dolor a pretium consequat, nisl dolor laoreet tortor, id placerat urna urna sit amet mi. Suspendisse diam ipsum, ornare eu volutpat eget, aliquet et purus. Mauris sed risus in ipsum elementum pellentesque sit amet ac eros.</p> <ul>  <li>   Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li> </ul> <p>  &nbsp;</p> <ul>  <li>   Sed posuere sagittis nunc, eget venenatis elit vehicula in.</li>  <li>   Integer et eros non eros dignissim cursus.</li>  <li>   Etiam fringilla feugiat risus, eu blandit arcu tempus eget.</li> </ul> <p>  &nbsp;</p> <ul>  <li>   Nam at felis vel magna tristique feugiat.</li>  <li>   Nullam eu mi id erat pellentesque ornare.</li>  <li>   Nulla dictum enim quis orci commodo pulvinar.</li>  <li>   Maecenas sed ante felis, a vulputate metus.</li>  <li>   Quisque ultricies massa est, vel blandit nisi.</li> </ul>', 'page', '2012-12-17 13:32:00', '0000-00-00 00:00:00', 0),
(18, 'amol.html', '', '', 'This is my blog', 1, 1, '<p>\r\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<div class=\\"rc\\">\r\n	<p>\r\n		It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>', 'post', '2012-12-20 13:32:00', '2012-12-25 01:43:00', 0),
(19, 'invitation-from-jesus.html', '', '', 'INVITATION FROM JESUS', 1, 1, '<p>\r\n	INVITATION FROM JESUS<br />\r\n	As you well know, we are getting closer to my birthday. Every year there is a celebration in my honour and I think that this year the celebration will be repeated. During this time there are many people shopping for gifts, there are many radio announcements, TV commercials, and in every part of the world everyone is talking that my birthday is getting closer and closer.<br />\r\n	It is really very nice to know, that at least once a year, some people think of me. As you know, the celebration of my birthday began many years ago. At first people seemed to understand and be thankful of all that I did for them, but in these times, no one seems to know the reason for the celebration. Family and friends get together and have a lot of fun, but they don&#39;t know the meaning of the celebration.<br />\r\n	I remember that last year there was a great feast in my honour. The dinner table was full of delicious foods, pastries, fruits, assorted nuts and chocolates.&nbsp; The decorations were exquisite and there were many, many beautifully wrapped gifts.<br />\r\n	But, do you want to know something? I wasn&#39;t invited. I was the guest of honour and they didn&#39;t remember to send me an invitation. The party was for me, but when that great day came, I was left outside, they closed the door in my face......... and I wanted to be with them and share their table. In truth, that didn&#39;t surprise me because in the last few years all close their doors to me.<br />\r\n	Since I was not invited, I decided to enter the party without making any noise. I went in and stood in a corner. They were all drinking; there were some who were drunk and telling jokes and laughing at everything. They were having a great time. To top it all, this big fat man all dressed in red wearing a long white beard entered the room yelling Ho-Ho-Ho!&nbsp; He seemed drunk. He sat on the sofa and all the children ran to him, saying: &quot;Santa Claus, Santa Claus&quot;...&nbsp;&nbsp; as if the party were in his honour!<br />\r\n	At 12 midnight all the people began to hug each other; I extended my arms waiting for someone to hug me and&nbsp; ....&nbsp; do you know .... no one hugged me. Suddenly they all began to share gifts. They opened them one by one with great expectation. When all had been opened, I looked to see if, maybe, there was one for me. What would you feel if on your birthday everybody shared gifts and you did not get one? I then understood that I was unwanted at that party and quietly left.<br />\r\n	Every year it gets worse. People only remember to eat and drink, the gifts, the parties and nobody remembers me. I would like this Christmas that you allow me to enter into your life. I would like that you recognise the fact that almost two thousand years ago I came to this world to give my life for you, on the cross, to save you. Today, I only want that you believe this with all your heart.<br />\r\n	I want to share something with you.<br />\r\n	As many didn&#39;t invite me to their party, I will have my own celebration, a grandiose party that no one has ever imagined, a spectacular party. I am still making the final arrangements. Today I am sending out many invitations and there is an invitation for you.<br />\r\n	I want to know if you wish to attend and I will make a reservation for you and write your name with golden letters in my great guest book. Only those on the guest list will be invited to the party. Those who don&#39;t answer the invitation, will be left outside.<br />\r\n	Do you know how you can answer this invitation?<br />\r\n	It is by extending it to others whom you care for.....and the elderly....and the lonely and sick! &nbsp;<br />\r\n	I&#39;ll be waiting for all of you to attend my party this year...<br />\r\n	See you soon&nbsp; ....&nbsp;&nbsp;&nbsp; I love you ! &nbsp;<br />\r\n	-Jesus</p>', 'post', '2012-12-22 13:32:00', '2012-12-26 03:00:11', 0),
(20, 'this-is-good.html', '', '', 'this is good', 1, 1, '<p>\r\n	this is good</p>', 'post', '2012-12-25 03:17:38', '2012-12-25 03:25:52', 0),
(21, 'testing-1', '', '', 'this is testing page 1', 1, 1, '<p>\r\n	test</p>\r\n', 'page', '2014-06-26 05:46:54', '2014-06-26 05:47:31', 0),
(22, 'testing-content-post', '', '', 'testing content post', 1, 1, '<p>\r\n	testing content post</p>\r\n', 'post', '2014-06-26 05:52:50', '2014-06-26 05:53:19', 0),
(23, 'page', '', '', 'page', 1, 1, '<p>\r\n	test</p>\r\n', 'page', '2014-11-17 01:11:48', '2014-11-17 01:11:48', 0),
(24, 'page-1', '', '', 'page', 1, 1, '<p>\r\n	test</p>\r\n', 'page', '2014-11-17 01:12:12', '2014-11-17 01:12:12', 0),
(25, 'tttttttt', '', '', 'tttttttt', 1, 1, '<p>\r\n	tttttttttttttttttttttttt</p>\r\n', 'post', '2014-11-17 01:18:26', '2014-11-17 01:18:26', 0),
(26, 'tttttttt-1', '', '', 'tttttttt', 1, 1, '<p>\r\n	tttttttt</p>\r\n', 'post', '2014-11-17 01:19:25', '2014-11-17 01:19:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mts_core_config_data`
--

DROP TABLE IF EXISTS `mts_core_config_data`;
CREATE TABLE IF NOT EXISTS `mts_core_config_data` (
  `core_config_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`core_config_data_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mts_core_config_data`
--

INSERT INTO `mts_core_config_data` (`core_config_data_id`, `path`, `value`) VALUES
(1, 'payment/authorizenet/active', 'yes'),
(2, 'payment/authorizenet/title', 'Authorize.net'),
(3, 'payment/authorizenet/login', '424guXKM'),
(4, 'payment/authorizenet/trans_key', '27Rrsxcc82Y8W7t8'),
(5, 'payment/authorizenet/test_mode', 'yes'),
(6, 'payment/paypal_standard/active', 'yes'),
(7, 'payment/paypal_standard/title', 'PayPal Website Payments Standered'),
(8, 'payment/paypal_standard/payment_action', 'yes'),
(9, 'payment/paypal_standard/types', 'yes'),
(10, 'payment/paypal_standard/test_mode', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `mts_country`
--

DROP TABLE IF EXISTS `mts_country`;
CREATE TABLE IF NOT EXISTS `mts_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country_iso_code_2` char(2) COLLATE latin1_general_ci NOT NULL,
  `country_iso_code_3` char(3) COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `IDX_COUNTRIES_NAME` (`country_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=281 ;

--
-- Dumping data for table `mts_country`
--

INSERT INTO `mts_country` (`country_id`, `country_name`, `country_iso_code_2`, `country_iso_code_3`, `is_active`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 1),
(2, 'Albania', 'AL', 'ALB', 1),
(3, 'Algeria', 'DZ', 'DZA', 1),
(4, 'American Samoa', 'AS', 'ASM', 1),
(5, 'Andorra', 'AD', 'AND', 1),
(6, 'Angola', 'AO', 'AGO', 1),
(7, 'Anguilla', 'AI', 'AIA', 1),
(8, 'Antarctica', 'AQ', 'ATA', 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 1),
(10, 'Argentina', 'AR', 'ARG', 1),
(11, 'Armenia', 'AM', 'ARM', 1),
(12, 'Aruba', 'AW', 'ABW', 1),
(13, 'Australia', 'AU', 'AUS', 1),
(14, 'Austria', 'AT', 'AUT', 1),
(15, 'Azerbaijan', 'AZ', 'AZE', 1),
(16, 'Bahamas', 'BS', 'BHS', 1),
(17, 'Bahrain', 'BH', 'BHR', 1),
(18, 'Bangladesh', 'BD', 'BGD', 1),
(19, 'Barbados', 'BB', 'BRB', 1),
(20, 'Belarus', 'BY', 'BLR', 1),
(21, 'Belgium', 'BE', 'BEL', 1),
(22, 'Belize', 'BZ', 'BLZ', 1),
(23, 'Benin', 'BJ', 'BEN', 1),
(24, 'Bermuda', 'BM', 'BMU', 1),
(25, 'Bhutan', 'BT', 'BTN', 1),
(26, 'Bolivia', 'BO', 'BOL', 1),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1),
(28, 'Botswana', 'BW', 'BWA', 1),
(29, 'Bouvet Island', 'BV', 'BVT', 1),
(30, 'Brazil', 'BR', 'BRA', 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 0),
(32, 'Brunei Darussalam', 'BN', 'BRN', 0),
(33, 'Bulgaria', 'BG', 'BGR', 0),
(34, 'Burkina Faso', 'BF', 'BFA', 0),
(35, 'Burundi', 'BI', 'BDI', 0),
(36, 'Cambodia', 'KH', 'KHM', 0),
(37, 'Cameroon', 'CM', 'CMR', 0),
(38, 'Canada', 'CA', 'CAN', 0),
(39, 'Cape Verde', 'CV', 'CPV', 0),
(40, 'Cayman Islands', 'KY', 'CYM', 0),
(41, 'Central African Republic', 'CF', 'CAF', 0),
(42, 'Chad', 'TD', 'TCD', 0),
(43, 'Chile', 'CL', 'CHL', 0),
(44, 'China', 'CN', 'CHN', 0),
(45, 'Christmas Island', 'CX', 'CXR', 0),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 0),
(47, 'Colombia', 'CO', 'COL', 0),
(48, 'Comoros', 'KM', 'COM', 0),
(49, 'Congo', 'CG', 'COG', 0),
(50, 'Cook Islands', 'CK', 'COK', 0),
(51, 'Costa Rica', 'CR', 'CRI', 0),
(52, 'Cote D''Ivoire', 'CI', 'CIV', 0),
(53, 'Croatia', 'HR', 'HRV', 0),
(54, 'Cuba', 'CU', 'CUB', 0),
(55, 'Cyprus', 'CY', 'CYP', 0),
(56, 'Czech Republic', 'CZ', 'CZE', 0),
(57, 'Denmark', 'DK', 'DNK', 0),
(58, 'Djibouti', 'DJ', 'DJI', 0),
(59, 'Dominica', 'DM', 'DMA', 0),
(60, 'Dominican Republic', 'DO', 'DOM', 0),
(61, 'East Timor', 'TP', 'TMP', 0),
(62, 'Ecuador', 'EC', 'ECU', 0),
(63, 'Egypt', 'EG', 'EGY', 0),
(64, 'El Salvador', 'SV', 'SLV', 0),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 0),
(66, 'Eritrea', 'ER', 'ERI', 0),
(67, 'Estonia', 'EE', 'EST', 0),
(68, 'Ethiopia', 'ET', 'ETH', 0),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 0),
(70, 'Faroe Islands', 'FO', 'FRO', 0),
(71, 'Fiji', 'FJ', 'FJI', 0),
(72, 'Finland', 'FI', 'FIN', 0),
(73, 'France', 'FR', 'FRA', 0),
(74, 'France, Metropolitan', 'FX', 'FXX', 0),
(75, 'French Guiana', 'GF', 'GUF', 0),
(76, 'French Polynesia', 'PF', 'PYF', 0),
(77, 'French Southern Territories', 'TF', 'ATF', 0),
(78, 'Gabon', 'GA', 'GAB', 0),
(79, 'Gambia', 'GM', 'GMB', 0),
(80, 'Georgia', 'GE', 'GEO', 0),
(81, 'Germany', 'DE', 'DEU', 0),
(82, 'Ghana', 'GH', 'GHA', 0),
(83, 'Gibraltar', 'GI', 'GIB', 0),
(84, 'Greece', 'GR', 'GRC', 0),
(85, 'Greenland', 'GL', 'GRL', 0),
(86, 'Grenada', 'GD', 'GRD', 0),
(87, 'Guadeloupe', 'GP', 'GLP', 0),
(88, 'Guam', 'GU', 'GUM', 0),
(89, 'Guatemala', 'GT', 'GTM', 0),
(90, 'Guinea', 'GN', 'GIN', 0),
(91, 'Guinea-bissau', 'GW', 'GNB', 0),
(92, 'Guyana', 'GY', 'GUY', 0),
(93, 'Haiti', 'HT', 'HTI', 0),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 0),
(95, 'Honduras', 'HN', 'HND', 0),
(96, 'Hong Kong', 'HK', 'HKG', 0),
(97, 'Hungary', 'HU', 'HUN', 0),
(98, 'Iceland', 'IS', 'ISL', 0),
(99, 'India', 'IN', 'IND', 0),
(100, 'Indonesia', 'ID', 'IDN', 0),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 0),
(102, 'Iraq', 'IQ', 'IRQ', 0),
(103, 'Ireland', 'IE', 'IRL', 0),
(104, 'Israel', 'IL', 'ISR', 0),
(105, 'Italy', 'IT', 'ITA', 0),
(106, 'Jamaica', 'JM', 'JAM', 0),
(107, 'Japan', 'JP', 'JPN', 0),
(108, 'Jordan', 'JO', 'JOR', 0),
(109, 'Kazakhstan', 'KZ', 'KAZ', 0),
(110, 'Kenya', 'KE', 'KEN', 0),
(111, 'Kiribati', 'KI', 'KIR', 0),
(112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 0),
(113, 'Korea, Republic of', 'KR', 'KOR', 0),
(114, 'Kuwait', 'KW', 'KWT', 0),
(115, 'Kyrgyzstan', 'KG', 'KGZ', 0),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 0),
(117, 'Latvia', 'LV', 'LVA', 0),
(118, 'Lebanon', 'LB', 'LBN', 0),
(119, 'Lesotho', 'LS', 'LSO', 0),
(120, 'Liberia', 'LR', 'LBR', 0),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 0),
(122, 'Liechtenstein', 'LI', 'LIE', 0),
(123, 'Lithuania', 'LT', 'LTU', 0),
(124, 'Luxembourg', 'LU', 'LUX', 0),
(125, 'Macau', 'MO', 'MAC', 0),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 0),
(127, 'Madagascar', 'MG', 'MDG', 0),
(128, 'Malawi', 'MW', 'MWI', 0),
(129, 'Malaysia', 'MY', 'MYS', 0),
(130, 'Maldives', 'MV', 'MDV', 0),
(131, 'Mali', 'ML', 'MLI', 0),
(132, 'Malta', 'MT', 'MLT', 0),
(133, 'Marshall Islands', 'MH', 'MHL', 0),
(134, 'Martinique', 'MQ', 'MTQ', 0),
(135, 'Mauritania', 'MR', 'MRT', 0),
(136, 'Mauritius', 'MU', 'MUS', 0),
(137, 'Mayotte', 'YT', 'MYT', 0),
(138, 'Mexico', 'MX', 'MEX', 0),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', 0),
(140, 'Moldova, Republic of', 'MD', 'MDA', 0),
(141, 'Monaco', 'MC', 'MCO', 0),
(142, 'Mongolia', 'MN', 'MNG', 0),
(143, 'Montserrat', 'MS', 'MSR', 0),
(144, 'Morocco', 'MA', 'MAR', 0),
(145, 'Mozambique', 'MZ', 'MOZ', 0),
(146, 'Myanmar', 'MM', 'MMR', 0),
(147, 'Namibia', 'NA', 'NAM', 0),
(148, 'Nauru', 'NR', 'NRU', 0),
(149, 'Nepal', 'NP', 'NPL', 0),
(150, 'Netherlands', 'NL', 'NLD', 0),
(151, 'Netherlands Antilles', 'AN', 'ANT', 0),
(152, 'New Caledonia', 'NC', 'NCL', 0),
(153, 'New Zealand', 'NZ', 'NZL', 0),
(154, 'Nicaragua', 'NI', 'NIC', 0),
(155, 'Niger', 'NE', 'NER', 0),
(156, 'Nigeria', 'NG', 'NGA', 0),
(157, 'Niue', 'NU', 'NIU', 0),
(158, 'Norfolk Island', 'NF', 'NFK', 0),
(159, 'Northern Mariana Islands', 'MP', 'MNP', 0),
(160, 'Norway', 'NO', 'NOR', 0),
(161, 'Oman', 'OM', 'OMN', 0),
(162, 'Pakistan', 'PK', 'PAK', 0),
(163, 'Palau', 'PW', 'PLW', 0),
(164, 'Panama', 'PA', 'PAN', 0),
(165, 'Papua New Guinea', 'PG', 'PNG', 0),
(166, 'Paraguay', 'PY', 'PRY', 0),
(167, 'Peru', 'PE', 'PER', 0),
(168, 'Philippines', 'PH', 'PHL', 0),
(169, 'Pitcairn', 'PN', 'PCN', 0),
(170, 'Poland', 'PL', 'POL', 0),
(171, 'Portugal', 'PT', 'PRT', 0),
(172, 'Puerto Rico', 'PR', 'PRI', 0),
(173, 'Qatar', 'QA', 'QAT', 0),
(174, 'Reunion', 'RE', 'REU', 0),
(175, 'Romania', 'RO', 'ROM', 0),
(176, 'Russian Federation', 'RU', 'RUS', 0),
(177, 'Rwanda', 'RW', 'RWA', 0),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 0),
(179, 'Saint Lucia', 'LC', 'LCA', 0),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 0),
(181, 'Samoa', 'WS', 'WSM', 0),
(182, 'San Marino', 'SM', 'SMR', 0),
(183, 'Sao Tome and Principe', 'ST', 'STP', 0),
(184, 'Saudi Arabia', 'SA', 'SAU', 0),
(185, 'Senegal', 'SN', 'SEN', 0),
(186, 'Seychelles', 'SC', 'SYC', 0),
(187, 'Sierra Leone', 'SL', 'SLE', 0),
(188, 'Singapore', 'SG', 'SGP', 0),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 0),
(190, 'Slovenia', 'SI', 'SVN', 0),
(191, 'Solomon Islands', 'SB', 'SLB', 0),
(192, 'Somalia', 'SO', 'SOM', 0),
(193, 'South Africa', 'ZA', 'ZAF', 0),
(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 0),
(195, 'Spain', 'ES', 'ESP', 0),
(196, 'Sri Lanka', 'LK', 'LKA', 0),
(197, 'St. Helena', 'SH', 'SHN', 0),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 0),
(199, 'Sudan', 'SD', 'SDN', 0),
(200, 'Suriname', 'SR', 'SUR', 0),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 0),
(202, 'Swaziland', 'SZ', 'SWZ', 0),
(203, 'Sweden', 'SE', 'SWE', 0),
(204, 'Switzerland', 'CH', 'CHE', 0),
(205, 'Syrian Arab Republic', 'SY', 'SYR', 0),
(206, 'Taiwan', 'TW', 'TWN', 0),
(207, 'Tajikistan', 'TJ', 'TJK', 0),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 0),
(209, 'Thailand', 'TH', 'THA', 0),
(210, 'Togo', 'TG', 'TGO', 0),
(211, 'Tokelau', 'TK', 'TKL', 0),
(212, 'Tonga', 'TO', 'TON', 0),
(213, 'Trinidad and Tobago', 'TT', 'TTO', 0),
(214, 'Tunisia', 'TN', 'TUN', 0),
(215, 'Turkey', 'TR', 'TUR', 0),
(216, 'Turkmenistan', 'TM', 'TKM', 0),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', 0),
(218, 'Tuvalu', 'TV', 'TUV', 0),
(219, 'Uganda', 'UG', 'UGA', 0),
(220, 'Ukraine', 'UA', 'UKR', 0),
(221, 'United Arab Emirates', 'AE', 'ARE', 0),
(222, 'United Kingdom', 'GB', 'GBR', 0),
(223, 'United States', 'US', 'USA', 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 0),
(225, 'Uruguay', 'UY', 'URY', 0),
(226, 'Uzbekistan', 'UZ', 'UZB', 0),
(227, 'Vanuatu', 'VU', 'VUT', 0),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 0),
(229, 'Venezuela', 'VE', 'VEN', 0),
(230, 'Viet Nam', 'VN', 'VNM', 0),
(231, 'Virgin Islands (British)', 'VG', 'VGB', 0),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 0),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 0),
(234, 'Western Sahara', 'EH', 'ESH', 0),
(235, 'Yemen', 'YE', 'YEM', 0),
(236, 'Yugoslavia', 'YU', 'YUG', 0),
(237, 'Zaire', 'ZR', 'ZAR', 0),
(238, 'Zambia', 'ZM', 'ZMB', 0),
(239, 'Zimbabwe', 'ZW', 'ZWE', 0),
(240, 'test - 0', 'is', 'iso', 0),
(241, 'test - 1', 'is', 'iso', 0),
(242, 'test - 2', 'is', 'iso', 0),
(243, 'test - 3', 'is', 'iso', 0),
(244, 'test - 4', 'is', 'iso', 0),
(245, 'test - 5', 'is', 'iso', 0),
(246, 'test - 6', 'is', 'iso', 0),
(247, 'test - 7', 'is', 'iso', 0),
(248, 'test - 8', 'is', 'iso', 0),
(249, 'test - 9', 'is', 'iso', 0),
(250, 'test - 10', 'is', 'iso', 0),
(251, 'test - 11', 'is', 'iso', 0),
(252, 'test - 12', 'is', 'iso', 0),
(253, 'test - 13', 'is', 'iso', 0),
(254, 'test - 14', 'is', 'iso', 0),
(255, 'test - 15', 'is', 'iso', 0),
(256, 'test - 16', 'is', 'iso', 0),
(257, 'test - 17', 'is', 'iso', 0),
(258, 'test - 18', 'is', 'iso', 0),
(259, 'test - 19', 'is', 'iso', 0),
(260, 'test - 0', 'is', 'iso', 0),
(261, 'test - 1', 'is', 'iso', 0),
(262, 'test - 2', 'is', 'iso', 0),
(263, 'test - 3', 'is', 'iso', 0),
(264, 'test - 4', 'is', 'iso', 0),
(265, 'test - 5', 'is', 'iso', 0),
(266, 'test - 6', 'is', 'iso', 0),
(267, 'test - 7', 'is', 'iso', 0),
(268, 'test - 8', 'is', 'iso', 0),
(269, 'test - 9', 'is', 'iso', 0),
(270, 'test - 10', 'is', 'iso', 0),
(271, 'test - 11', 'is', 'iso', 0),
(272, 'test - 12', 'is', 'iso', 0),
(273, 'test - 13', 'is', 'iso', 0),
(274, 'test - 14', 'is', 'iso', 0),
(280, 'APCI', 'AP', 'AFT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_deal`
--

DROP TABLE IF EXISTS `mts_deal`;
CREATE TABLE IF NOT EXISTS `mts_deal` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id_fk` int(11) NOT NULL,
  `deal_type` enum('Todays Deal','Side Deal') COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sub_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `slogan` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `urlkey` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `key_features` text COLLATE latin1_general_ci NOT NULL,
  `highlights` text COLLATE latin1_general_ci NOT NULL,
  `fine_print` text COLLATE latin1_general_ci NOT NULL,
  `deal_description` text COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE latin1_general_ci NOT NULL,
  `other_product_url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `video_link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `saving` int(11) NOT NULL,
  `discount_percent` decimal(10,2) NOT NULL,
  `min_qty_to_active` int(11) NOT NULL,
  `max_qty` int(11) NOT NULL,
  `min_limit_per_user` int(11) NOT NULL,
  `max_limit_per_user` int(11) NOT NULL,
  `referral_amount` decimal(10,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `start_time` time NOT NULL,
  `end_date` datetime NOT NULL,
  `end_time` time NOT NULL,
  `voucher_start_date` datetime NOT NULL,
  `voucher_start_time` time NOT NULL,
  `voucher_end_date` datetime NOT NULL,
  `voucher_end_time` time NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mts_deal`
--

INSERT INTO `mts_deal` (`deal_id`, `merchant_id_fk`, `deal_type`, `title`, `sub_title`, `slogan`, `urlkey`, `meta_description`, `meta_keywords`, `key_features`, `highlights`, `fine_print`, `deal_description`, `comment`, `other_product_url`, `video_link`, `address`, `image_name`, `buy_price`, `original_price`, `saving`, `discount_percent`, `min_qty_to_active`, `max_qty`, `min_limit_per_user`, `max_limit_per_user`, `referral_amount`, `start_date`, `start_time`, `end_date`, `end_time`, `voucher_start_date`, `voucher_start_time`, `voucher_end_date`, `voucher_end_time`, `is_active`) VALUES
(2, 3, 'Todays Deal', 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'It is a long established fact that a reader will be distracted by the', 'Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', 'section-1.10.33-of-quot;de-finibus-bonorum-et-malorumquot;-written-by-cicero-in-45-bc', 'Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', 'Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', 'http://www.thisismyurl/', '', 'On the other hand, we denounce with,righteous i', '', 900.00, 1000.00, 100, 10.00, 10, 10, 0, 0, 1.00, '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', 1),
(3, 3, 'Todays Deal', 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'It is a long established fact that a reader will be distracted by the', 'Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', 'section-1.10.33-of-quot;de-finibus-bonorum-et-malorumquot;-written-by-cicero-in-45-bc-1', 'Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', 'Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '<h3> The standard Lorem Ipsum passage, used since the 1500s</h3><p> &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p><h3> Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3><p> &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p><h3> 1914 translation by H. Rackham</h3><p> &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', 'http://www.thisismyurl/', '', 'On the other hand, we denounce with,righteous i', '', 900.00, 1000.00, 100, 10.00, 10, 10, 0, 0, 1.00, '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', 1),
(4, 3, 'Todays Deal', 'my friend', 'my friend', 'ttt fff eee', 'my-friend', 'ddddddddddd', 'eeeeeeeeeeeee', '<p> dddddddddddddd</p>', '<p> ddddddddddddddddddddddddd</p>', '<p> ddddddddddddddddddddd</p>', '<p> ddddddddddddddddddddd</p>', '<p> dddddddddddddddddddddddddddd</p>', '', '', '', '', 90.00, 100.00, 10, 10.00, 12, 20, 0, 0, 100.00, '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', '1969-12-31 16:00:00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_deal_city`
--

DROP TABLE IF EXISTS `mts_deal_city`;
CREATE TABLE IF NOT EXISTS `mts_deal_city` (
  `deal_id_fk` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `state_id_fk` int(11) NOT NULL,
  `city_id_fk` double NOT NULL,
  KEY `deal_id_fk` (`deal_id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mts_deal_city`
--

INSERT INTO `mts_deal_city` (`deal_id_fk`, `country_id_fk`, `state_id_fk`, `city_id_fk`) VALUES
(2, 1, 226, 4),
(3, 1, 226, 4),
(4, 223, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mts_deal_image`
--

DROP TABLE IF EXISTS `mts_deal_image`;
CREATE TABLE IF NOT EXISTS `mts_deal_image` (
  `deal_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id_fk` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`deal_image_id`),
  KEY `deal_id_fk` (`deal_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `mts_deal_image`
--

INSERT INTO `mts_deal_image` (`deal_image_id`, `deal_id_fk`, `image_name`, `added_date`, `is_default`, `is_active`) VALUES
(7, 2, '1416216912_dock.jpg', '2014-06-27 06:42:43', 1, 1),
(2, 3, '1416216912_dock.jpg', '2014-06-27 06:37:24', 1, 1),
(3, 3, '1416216912_dock.jpg', '2014-06-27 06:37:26', 0, 1),
(4, 3, '1416216912_dock.jpg', '2014-06-27 06:37:26', 0, 1),
(5, 3, '1416216912_dock.jpg', '2014-06-27 06:37:27', 0, 1),
(6, 3, '1416216912_dock.jpg', '2014-06-27 06:37:27', 0, 1),
(12, 4, '1416216912_dock.jpg', '2014-11-17 01:35:13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_emailtemplate`
--

DROP TABLE IF EXISTS `mts_emailtemplate`;
CREATE TABLE IF NOT EXISTS `mts_emailtemplate` (
  `emailtemplate_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email_message` text COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`emailtemplate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mts_emailtemplate`
--

INSERT INTO `mts_emailtemplate` (`emailtemplate_id`, `subject`, `email_message`, `is_active`) VALUES
(1, 'Hello [[name]], Welcome To - test', '<p> <span style=&quot;font-family: Arial, Verdana, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); font-size: 14px; font-weight: bold; color: rgb(102, 153, 0);&quot;>Hi [[name]],</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Congratulations on becoming part of the community.</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <strong style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;>Save Your Account Information</strong><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Name : [[name]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Email : [[email]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Password : [[password]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Sincerely,</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Customer Service</span></p>', 1),
(2, 'Password recovery for [[SITETITLE]]', '<p><span style="font-size: 13px; font-family: Arial,Helvetica,sans-serif; color: rgb(0, 153, 204);"><strong>Hi [[email]]</strong></span></p>\n<p style="margin: 0pt; padding: 0pt;">Congratulations on becoming part of the [[SITETITLE]]</p>\n<br />\n<p style="margin: 0pt; padding: 0pt; font-weight: bold;">Below is your account information. You can get new password and open your account [[SITETITLE]]</p>\n<br />\n<p style="margin: 0pt; padding: 0pt;"><span style="display: block;">Email Address: [[email]]</span> <span style="display: block;">password: [[password]]</span></p>\n<p><br />\nSincerely,<br />\nCustomer Service</p>', 1),
(3, 'Hello [[name]], Welcome To', '<p><span style="font-size: 14px; font-weight: bold; color: rgb(102, 153, 0);">Hi [[name]],</span> <br />\n<br />\nCongratulations on becoming part of the community. <br />\n<br />\n<br />\n<strong>Save Your Account Information</strong> <br />\nName : [[name]]<br />\nEmail : [[email]]<br />\nPassword : [[password]] <br />\n<br />\n<br />\nSincerely,<br />\nCustomer Service</p>', 1),
(4, 'Thank you for registering with [[SITETITLE]]', '<p>\r\n Hi [[firstname]],</p>\r\n<p>\r\n Thank you very much for registering with [[SITETITLE]]. You need to verify your email address.</p>\r\n<p>\r\n Please click on the link below in order to verify your email address and activate your account at [[SITETITLE]].</p>\r\n<p>\r\n [[link]]</p>\r\n<p>\r\n This should take you directly to an email confirmation page. If it does not, please copy and paste the full URL into your web browser&#39;s address box and hit the &quot;Enter&quot; key on your keyboard. Once you&#39;ve confirmed your email, you&#39;ll be able to log in to your account with the user name and password that you submitted with your signup application.</p>\r\n<p>\r\n Here&#39;s your new login information:<br />\r\n Your Email Id: [[email]]<br />\r\n Password: [[password]]</p>\r\n<p>\r\n Kind regards,<br />\r\n [[SITETITLE]] Customer Service</p>\r\n', 1),
(7, 'Thank you for registering with [[SITETITLE]]', '<p>\r\n Hi [[firstname]],</p>\r\n<p>\r\n Thank you very much for registering with [[SITETITLE]]. You need to verify your email address.</p>\r\n<p>\r\n Here&#39;s your new login information:</p>\r\n<p>\r\n Your Email Id: [[email]]<br />\r\n Password: [[password]]</p>\r\n<p>\r\n Kind regards,<br />\r\n [[SITETITLE]] Customer Service</p>\r\n', 1),
(8, '[[SITETITLE]]: Your account has been blocked by admin', '<p>\r\n Dear [[user_full_name]],<br />\r\n <br />\r\n Your account has been blocked by admin.<br />\r\n [[reason]]<br />\r\n <br />\r\n Sincerely,<br />\r\n Customer Service<br />\r\n [[SITETITLE]]</p>\r\n', 1),
(9, '[[SITETITLE]]: Congratulations Your account is unblocked', '<p>\r\n Dear [[user_full_name]],<br />\r\n <br />\r\n Congratulations Your account is unblocked.<br />\r\n [[reason]]<br />\r\n <br />\r\n Sincerely,<br />\r\n Customer Service<br />\r\n [[SITETITLE]]</p>\r\n', 1),
(10, 'Hello [[name]], Welcome To - test', '<p> <span style=&quot;font-family: Arial, Verdana, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); font-size: 14px; font-weight: bold; color: rgb(102, 153, 0);&quot;>Hi [[name]],</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Congratulations on becoming part of the community.</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <strong style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot;>Save Your Account Information</strong><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Name : [[name]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Email : [[email]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Password : [[password]]</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Sincerely,</span><br style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);&quot; /> <span style=&quot;color: rgb(34, 34, 34); font-family: Arial, Verdana, sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;&quot;>Customer Service</span></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_error_log`
--

DROP TABLE IF EXISTS `mts_error_log`;
CREATE TABLE IF NOT EXISTS `mts_error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `requested_url` varchar(500) CHARACTER SET utf8 NOT NULL,
  `error_message` varchar(500) CHARACTER SET utf8 NOT NULL,
  `added_on_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mts_faq`
--

DROP TABLE IF EXISTS `mts_faq`;
CREATE TABLE IF NOT EXISTS `mts_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_category_id_fk` int(11) NOT NULL,
  `faq_question` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faq_answer` text COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`faq_id`),
  KEY `faq_category_id_fk` (`faq_category_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mts_faq`
--

INSERT INTO `mts_faq` (`faq_id`, `faq_category_id_fk`, `faq_question`, `faq_answer`, `is_active`) VALUES
(1, 1, 'this is my question - 0', 'this is my answer - 0', 0),
(2, 1, 'this is my question - 1', 'this is my answer - 1', 0),
(3, 1, 'this is my question - 2', 'this is my answer - 2', 0),
(4, 1, 'this is my question - 3', 'this is my answer - 3', 0),
(5, 1, 'this is my question - 4', 'this is my answer - 4', 0),
(6, 1, 'this is my question - 5', 'this is my answer - 5', 0),
(7, 1, 'this is my question - 6', 'this is my answer - 6', 0),
(8, 1, 'this is my question - 7', 'this is my answer - 7', 0),
(9, 1, 'this is my question - 8', 'this is my answer - 8', 0),
(10, 1, 'this is my question - 9', 'this is my answer - 9', 0),
(11, 1, 'this is my question - 10', 'this is my answer - 10', 0),
(12, 1, 'this is my question - 11', 'this is my answer - 11', 0),
(13, 1, 'this is my question - 12', 'this is my answer - 12', 0),
(14, 1, 'this is my question - 13', 'this is my answer - 13', 0),
(15, 1, 'this is my question - 14', 'this is my answer - 14', 0),
(16, 1, 'this is my question - 15', 'this is my answer - 15', 0),
(17, 1, 'this is my question - 16', 'this is my answer - 16', 0),
(18, 1, 'this is my question - 17', 'this is my answer - 17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mts_faq_category`
--

DROP TABLE IF EXISTS `mts_faq_category`;
CREATE TABLE IF NOT EXISTS `mts_faq_category` (
  `faq_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`faq_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mts_faq_category`
--

INSERT INTO `mts_faq_category` (`faq_category_id`, `category_name`, `is_active`) VALUES
(1, 'Test', 1),
(3, 'new name', 0),
(4, 'new name one', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_homepage_slider_image`
--

DROP TABLE IF EXISTS `mts_homepage_slider_image`;
CREATE TABLE IF NOT EXISTS `mts_homepage_slider_image` (
  `hps_image_id` int(5) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sort_order` int(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`hps_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `mts_homepage_slider_image`
--

INSERT INTO `mts_homepage_slider_image` (`hps_image_id`, `image_name`, `title`, `description`, `sort_order`, `is_active`) VALUES
(1, '', 'Image 1', 'Image 1', 1, 1),
(2, '1335857245_anoi.jpg', 'Image 2', 'Image 2', 2, 1),
(3, '1335857266_anterns.jpg', 'Image 3', 'Image 3', 3, 1),
(4, '1335857293_ine-cone.jpg', 'Image 4', 'Image 4', 4, 1),
(5, '1335857311_hore.jpg', 'Image 5', 'Image 5', 5, 1),
(6, '1335857336_rolley.jpg', 'Image 6', 'Image 6', 6, 1),
(11, '', 'Jaguar', 'jaguar', 8, 1),
(12, '', 'j1', 'j1', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_newsletter_subscriber`
--

DROP TABLE IF EXISTS `mts_newsletter_subscriber`;
CREATE TABLE IF NOT EXISTS `mts_newsletter_subscriber` (
  `newsletter_sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `subscriber_email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subscriber_type` enum('Guest','Customer') COLLATE latin1_general_ci NOT NULL,
  `subscriber_status` enum('Not Activated','Subscribed','Unsubscribed') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`newsletter_sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mts_newsletter_subscriber`
--

INSERT INTO `mts_newsletter_subscriber` (`newsletter_sc_id`, `UID`, `subscriber_email`, `subscriber_type`, `subscriber_status`) VALUES
(1, 1, 'amol.sananse@gmail.com', 'Guest', 'Unsubscribed'),
(2, 2, 'mukesh.rane@gmail.com', 'Guest', 'Unsubscribed');

-- --------------------------------------------------------

--
-- Table structure for table `mts_product`
--

DROP TABLE IF EXISTS `mts_product`;
CREATE TABLE IF NOT EXISTS `mts_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sku` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `urlkey` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `new_from_date` date NOT NULL,
  `new_to_date` date NOT NULL,
  `qty` int(11) NOT NULL,
  `tax_class_id_fk` int(11) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discount_percent` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `meta_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `short_description` text COLLATE latin1_general_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=125 ;

--
-- Dumping data for table `mts_product`
--

INSERT INTO `mts_product` (`product_id`, `name`, `sku`, `weight`, `urlkey`, `new_from_date`, `new_to_date`, `qty`, `tax_class_id_fk`, `original_price`, `discount_percent`, `discount_amount`, `discounted_price`, `cost`, `meta_title`, `meta_keywords`, `meta_description`, `image_name`, `description`, `short_description`, `added_date`, `is_active`) VALUES
(1, 'Nokia 2610 Phone', 'n2610', 3.20, 'nokia-2610-phone', '0000-00-00', '0000-00-00', 996, 1, 149.99, 0.00, 0.00, 149.99, 20.00, 'Nokia 2610', 'Offering advanced media and calling features without breaking the bank, The Nokia 2610 is an easy to use', 'Offering advanced media and calling features without breaking the bank, The Nokia 2610 is an easy to use', 'nonokia-2610-phone-2.jpg', 'The Nokia 2610 is an easy to use device that combines multiple messaging options including email, instant messaging, and more. You can even download MP3 ringtones, graphics, and games straight to the', 'The words "entry level" no longer mean "low-end," especially when it comes to the Nokia 2610. Offering advanced media and calling features without breaking the bank', '2012-09-05 00:00:00', 1),
(2, 'BlackBerry 8100 Pearl', 'bb8100', 15.20, 'blackberry-8100-pearl', '0000-00-00', '0000-00-00', 797, 1, 349.99, 0.00, 0.00, 349.99, 29.99, 'BlackBerry 8100 Pearl', 'BlackBerry 8100 Pearl sports a large 240 x 260 screen that supports over 65,000 colors-- plenty of real estate to view your e-mails, Web browser content, messaging sessions, and attachments.', 'BlackBerry 8100 Pearl sports a large 240 x 260 screen that supports over 65,000 colors-- plenty of real estate to view your e-mails, Web browser content, messaging sessions, and attachments.', 'blblackberry-8100-pearl-2.jpg', 'Like the BlackBerry 7105t, the BlackBerry 8100 Pearl is \r\nThe BlackBerry 8100 Pearl sports a large 240 x 260 screen that supports over 65,000 colors-- plenty of real estate to view your e-mails, Web', 'The BlackBerry 8100 Pearl is a departure from the form factor of previous BlackBerry devices. This BlackBerry handset is far more phone-like, and RIM''s engineers have managed to fit a QWERTY keyboard', '2012-09-05 00:00:00', 1),
(3, 'Sony Ericsson W810i', 'sw810i', 13.60, 'sony-ericsson-w810i', '0000-00-00', '0000-00-00', 989, 1, 399.99, 0.00, 0.00, 399.99, 29.99, 'Sony Ericsson W810i', 'The W810i follows a long tradition of beautifully designed and crafted phones from Sony Ericsson. The same candy-bar style that graced the W800 is here, as is the horizontally-oriented camera unit on', 'The W810i follows a long tradition of beautifully designed and crafted phones from Sony Ericsson. The same candy-bar style that graced the W800 is here, as is the horizontally-oriented camera unit on', 'sosony-ericsson-w810i-2.jpg', 'The W810i''s screen sports 176 x 220 pixel resolution with support for 262,000 colors. Quick access buttons below the screen make it easy to control the phone''s Walkman music features, while a five-way', 'The W810i follows a long tradition of beautifully designed and crafted phones from Sony Ericsson. The same candy-bar style that graced the W800 is here.', '2012-09-05 00:00:00', 1),
(4, 'AT&T 8525 PDA', '8525PDA', 30.00, 'atandt-8525-pda', '0000-00-00', '0000-00-00', 328, 1, 199.99, 0.00, 0.00, 199.99, 29.99, 'AT&T 8525 PDA Phone', 'nder the hood, the 8525 features 128MB of embedded memory and 64MB RAM, running on a 400 MHz Samsung processor. Up front, the 240 x 320 LCD touch-screen supports over 65,000 colors, while the rear of', 'nder the hood, the 8525 features 128MB of embedded memory and 64MB RAM, running on a 400 MHz Samsung processor. Up front, the 240 x 320 LCD touch-screen supports over 65,000 colors, while the rear of', 'atat-t-8525-pda-1.jpg', 'The design of the 8525 is clean and uncluttered, with just a few buttons for mail, Internet Explorer, and contextual menus. Meanwhile, call answer and end buttons surround a five-way toggle that allo', 'Under the hood, the 8525 features 128MB of embedded memory and 64MB RAM, running on a 400 MHz Samsung processor. Up front, the 240 x 320 LCD touch-screen supports over 65,000 colors, while the rear of', '2012-09-05 00:00:00', 1),
(5, 'Samsung MM-A900M Ace', 'MM-A900M', 1.00, 'samsung-mm-a900m-ace', '0000-00-00', '0000-00-00', 361, 1, 150.00, 0.00, 0.00, 150.00, 29.99, 'Samsung MM-A900M Ace Phone', 'New services supported by both the MM-A900m include the newly announced Sprint Music StoreSM, which allows users to immediately buy and download complete songs directly to their phone', 'New services supported by both the MM-A900m include the newly announced Sprint Music StoreSM, which allows users to immediately buy and download complete songs directly to their phone', 'sasamsung-mm-a900m-ace.jpg', 'New services supported by both the MM-A900m include the newly announced Sprint Music StoreSM, which allows users to immediately buy and download complete songs directly to their phone; 30 channels of', 'The MM-A900m offers great-looking design with the ability to download a rich selection of content directly to the phone.', '2012-09-05 00:00:00', 1),
(6, 'Apple MacBook Pro MA464LL/A 15.4" Notebook PC', 'MA464LL/A', 10.60, 'apple-macbook-pro-ma464ll-a-15-4-notebook-pc-2-0-ghz-intel-core-duo-1-gb-ram-100-gb-hard-drive-superdrive', '0000-00-00', '0000-00-00', 143, 1, 2299.99, 0.00, 0.00, 2299.99, 1299.99, 'Apple MacBook Pro MA464LL/A 15.4" Notebook PC (2.0 GHz Intel Core Duo, 1 GB RAM, 100 GB Hard Drive, SuperDrive)', 'Apple MacBook Pro MA464LL/A 15.4" Notebook PC (2.0 GHz Intel Core Duo, 1 GB RAM, 100 GB Hard Drive, SuperDrive)', 'Apple MacBook Pro MA464LL/A 15.4" Notebook PC (2.0 GHz Intel Core Duo, 1 GB RAM, 100 GB Hard Drive, SuperDrive)', 'apapple-macbook-pro-ma464ll-a-15-4-notebook-pc.jpg', 'This, combined with myriad other engineering leaps, boosts performance up to four times higher than the PowerBook G4. With this awesome power, it''s a breeze to render complex 3D models, enjoy smooth p', 'You''ve seen improvements in notebook performance before - but never on this scale. The Intel Core Duo powering MacBook Pro is actually two processors built into a single chip.', '2012-09-05 00:00:00', 1),
(7, 'Acer Ferrari 3200 Notebook Computer PC', 'LX.FR206.001', 11.40, 'acer-ferrari-3200-notebook-computer-pc', '0000-00-00', '0000-00-00', 11, 1, 1799.99, 0.00, 0.00, 1799.99, 999.99, 'Acer Ferrari 3200 Notebook Computer PC', 'Acer Ferrari 3200 Notebook Computer PC', 'Acer Ferrari 3200 Notebook Computer PC', 'acacer-ferrari-3200-notebook-computer-pc.jpg', 'Acer has flawlessly designed the Ferrari 3200, instilling it with exceptional performance, brilliant graphics, and lightning-fast connectivity. This exclusive edition is another striking symbol of co', 'This exclusive edition is another striking symbol of cooperation between Acer and Ferrari -- two progressive companies with proud heritages built on passion, innovation, power and success', '2012-09-05 00:00:00', 1),
(8, 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC', 'VGN-TXN27N/B', 2.80, 'sony-vaio-vgn-txn27n-b-11-1-notebook-pc', '0000-00-00', '0000-00-00', 595, 1, 2699.99, 0.00, 0.00, 2699.99, 899.99, 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'sosony-vaio-vgn-txn27n-b-11-1-notebook-pc.jpg', 'Weighing in at just an amazing 2.84 pounds and offering a sleek, durable carbon-fiber case in charcoal black. And with 4 to 10 hours of standard battery life, it has the stamina to power you through', 'Take a load off your shoulders when you''re racing for your plane with the sleekly designed and ultra-portable Sony Vaio VGN-TXN27N/B notebook PC.', '2012-09-05 00:00:00', 1),
(9, 'Toshiba M285-E 14"', 'M285-E', 10.00, 'toshiba-satellite-a135-s4527-155-4-notebook-pc-intel-pentium-dual-core-processor-t2080-1-gb-ram-120-gb-hard-drive-supermulti-dvd-drive-vista-premium', '0000-00-00', '0000-00-00', 681, 1, 1599.99, 0.00, 0.00, 1599.99, 899.99, 'Toshiba Satellite A135-S4527 155.4" Notebook PC (Intel Pentium Dual Core Processor T2080, 1 GB RAM, 120 GB Hard Drive, SuperMulti DVD Drive, Vista Premium)', 'Toshiba M285-E 14" Convertible Notebook PC (Intel Core Duo Processor T2300E, 1 GB RAM, 60', 'Toshiba M285-E 14" Convertible Notebook PC (Intel Core Duo Processor T2300E, 1 GB RAM, 60', 'totoshiba-m285-e-14.jpg', 'Easily mobile at just 6 pounds, the Toshiba Satellite A135-S4527 makes it easy to get your work done with a large, bright 15.4-inch widescreen LCD. The XGA-resolution screen (1280 x 800) permits side-', 'Get the competitive edge with the Gateway M285-E. This widescreen Convertible Notebook functions as both a conventional notebook and a tablet.', '2012-09-05 00:00:00', 1),
(10, 'CN Clogs Beach/Garden Clog', 'cn_3', 1.00, 'cn-clogs-beach-garden-clog-3', '0000-00-00', '0000-00-00', 16, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog-2.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(12, 'Steven by Steve Madden Pryme Pump', 'steve_4', 2.00, 'steven-by-steve-madden-pryme-pump-4', '0000-00-00', '0000-00-00', 441, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump-2.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', '2012-09-05 00:00:00', 1),
(14, 'ECCO Womens Golf Flexor Golf Shoe', 'ecco_3', 4.00, 'ecco-womens-golf-flexor-golf-shoe-3', '0000-00-00', '0000-00-00', 386, 1, 159.99, 0.00, 0.00, 159.99, 29.99, 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ececco-womens-golf-flexor-golf-shoe-2.jpg', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links. The contrasting embossed snakeskin panels at', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links.', '2012-09-05 00:00:00', 1),
(15, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken_8', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on-8', '0000-00-00', '0000-00-00', 718, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on-2.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', '2012-09-05 00:00:00', 1),
(18, 'The Only Children: Paisley T-Shirt', 'oc_sm', 0.44, 'the-only-children-paisley-t-shirt-sm', '0000-00-00', '0000-00-00', 722, 1, 15.00, 0.00, 0.00, 15.00, 2.00, 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'ththe-only-children-paisley-t-shirt-1.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California cotton T shirst.', '2012-09-05 00:00:00', 1),
(19, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_r_sm', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-r-sm', '0000-00-00', '0000-00-00', 99, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-1.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(20, 'The Get Up Kids: Band Camp Pullover Hoodie', '4fasd5f5', 1.75, 'the-get-up-kids-band-camp-pullover-hoodie', '0000-00-00', '0000-00-00', 234, 1, 30.00, 0.00, 0.00, 30.00, 5.00, 'The Get Up Kids: Band Camp Pullover Hoodie', 'The Get Up Kids: Band Camp Pullover Hoodie', 'The Get Up Kids: Band Camp Pullover Hoodie', 'ththe-get-up-kids-band-camp-pullover-hoodie-1.jpg', 'Printed on American Apparel Classic style 5495 California Fleece Pull-Over Hoodies.  Sizing info is available here.', 'Printed on American Apparel Classic style 5495 California Fleece Pull-Over Hoodies.', '2012-09-05 00:00:00', 1),
(21, 'Akio Dresser', '384822', 128.97, 'akio-dresser', '0000-00-00', '0000-00-00', 339, 1, 399.99, 0.00, 0.00, 399.99, 100.00, 'Akio Dresser', 'Our Akio dresser has a solid hardwood frame.  Features include inset panel sides and for spacious drawers and two wicker baskets.', 'Our Akio dresser has a solid hardwood frame.  Features include inset panel sides and for spacious drawers and two wicker baskets.', 'akakio-dresser.jpg', 'Features include inset panel sides and for spacious drawers and two wicker baskets. 41"Wx18"Dx36"H.', 'Our Akio dresser has a solid hardwood frame.', '2012-09-05 00:00:00', 1),
(22, 'Barcelona Bamboo Platform Bed', 'bar1234', 150.00, 'barcelona-bamboo-platform-bed', '0000-00-00', '0000-00-00', 994, 1, 2299.00, 0.00, 0.00, 2299.00, 800.00, 'Barcelona Bamboo Platform Bed', 'Our Barcelona platform bed captures the spirit and drama of late 20th century design with a variety of subtle details.', 'Our Barcelona platform bed captures the spirit and drama of late 20th century design with a variety of subtle details.', 'babarcelona-bamboo-platform-bed.jpg', 'Entirely handcrafted of solid Bamboo. Designed for use with a mattress alone, it includes a sturdy, padded wood platform for comfort and proper mattress support.', 'Our Barcelona platform bed captures the spirit and drama of late 20th century design with a variety of subtle details.', '2012-09-05 00:00:00', 1),
(23, 'Canon Digital Rebel XT 8MP Digital SLR Camera', 'Rebel XT', 4.00, 'canon-digital-rebel-xt-8mp-digital-slr-camera-with-ef-s-18-55mm-f3-5-5-6-lens-black', '0000-00-00', '0000-00-00', 452, 1, 550.00, 0.00, 0.00, 550.00, 200.00, 'Canon Digital Rebel XT 8MP Digital SLR Camera with EF-S 18-55mm f3.5-5.6 Lens (Black)', 'Canon Digital Rebel XT 8MP Digital SLR Camera with EF-S 18-55mm f3.5-5.6 Lens (Black)', 'Canon Digital Rebel XT 8MP Digital SLR Camera with EF-S 18-55mm f3.5-5.6 Lens (Black)', 'cacanon-digital-rebel-xt-8mp-digital-slr-camera-1.jpg', 'The Canon EOS Digital Rebel camera now has a new, faster, even smaller big brother. Sibling rivalries aside, the 8.0-megapixel Canon EOS Digital Rebel XT SLR adds resolution, speed, extra creative con', 'Canon EOS Digital Rebel XT SLR adds resolution, speed, extra creative control, and enhanced comfort in the hand to one of the smallest and lightest digital cameras in its class.', '2012-09-05 00:00:00', 1),
(24, 'Argus QC-2185 Quick Click 5MP Digital Camera', 'QC-2185', 1.00, 'argus-qc-2185-quick-click-5mp-digital-camera', '0000-00-00', '0000-00-00', 120, 1, 37.49, 0.00, 0.00, 37.49, 20.00, 'Argus QC-2185 Quick Click 2MP Digital Camera', 'Argus QC-2185 Quick Click 2MP Digital Camera', 'Argus QC-2185 Quick Click 2MP Digital Camera', 'arargus-qc-2185-quick-click-5mp-digital-camera-2.jpg', 'The Argus QC-2185 Quick Click 5MP digital camera offers all the basic features you need in a compact and stylish digital camera. This unit is easy to use, and is perfect for those who want a completel', 'The Argus QC-2185 Quick Click 5MP digital camera offers all the basic features you need in a compact and stylish digital camera. This unit is easy to use, and is perfect for those who want a completel', '2012-09-05 00:00:00', 1),
(25, 'Olympus Stylus 750 7.1MP Digital Camera', '750', 2.00, 'olympus-stylus-750-7-1mp-digital-camera', '0000-00-00', '0000-00-00', 932, 1, 161.94, 0.00, 0.00, 161.94, 29.99, 'Olympus Stylus 750 7.1MP Digital Camera with Digital Image Stabilized 5x Optical Zoom and CCD Shift Stabilization (Silver)', 'Olympus Stylus 750 7.1MP Digital Camera with Digital Image Stabilized 5x Optical Zoom and CCD Shift Stabilization (Silver)', 'Olympus Stylus 750 7.1MP Digital Camera with Digital Image Stabilized 5x Optical Zoom and CCD Shift Stabilization (Silver)', 'ololympus-stylus-750-7-1mp-digital-camera-2.jpg', 'Olympus continues to innovate with the launch of the Stylus 750 digital camera, a technically sophisticated point-and-shoot camera offering a number of pioneering technologies such as Dual Image Stabi', 'A technically sophisticated point-and-shoot camera offering a number of pioneering technologies such as Dual Image Stabilization, Bright Capture Technology, and TruePic Turbo, as well as a powerful 5x', '2012-09-05 00:00:00', 1),
(26, 'Canon PowerShot A630 8MP Digital Camera with 4x Optical Zoom', 'A630', 3.00, 'canon-powershot-a630-8mp-digital-camera-with-4x-optical-zoom', '0000-00-00', '0000-00-00', 673, 1, 329.99, 0.00, 0.00, 329.99, 29.99, 'Canon PowerShot A630 8MP Digital Camera with 4x Optical Zoom', 'Canon PowerShot A630 8MP Digital Camera with 4x Optical Zoom', 'Canon PowerShot A630 8MP Digital Camera with 4x Optical Zoom', 'cacanon-powershot-a630-8mp-digital-camera-with-4x-optical-zoom-2.jpg', 'Replacing the highly popular PowerShot A620, the PowerShot A630 features a rotating 2.5-inch vari-angle LCD, 4x optical zoom lens, and a vast array of creative shooting modes.<br>\r\n\r\nThe PowerShot A63', 'Replacing the highly popular PowerShot A620, the PowerShot A630 features a rotating 2.5-inch vari-angle LCD, 4x optical zoom lens, and a vast array of creative shooting modes.', '2012-09-05 00:00:00', 1),
(27, 'Kodak EasyShare C530 5MP Digital Camera', 'C530', 2.00, 'kodak-easyshare-c530-5mp-digital-camera', '0000-00-00', '0000-00-00', 872, 1, 199.99, 0.00, 0.00, 199.99, 29.99, 'Kodak EasyShare C530 5MP Digital Camera', 'Kodak EasyShare C530 5MP Digital Camera', 'Kodak EasyShare C530 5MP Digital Camera', 'kokodak-easyshare-c530-5mp-digital-camera-2.jpg', 'Small on size. Big on value. Kodak''s newest C-Series digital camera, the C530, sports awesome features--such as 5.0-megapixel CCD resolution, on-camera image cropping, and an on-camera Share button--a', 'Small on size. Big on value. Kodak''s newest C-Series digital camera, the C530, sports awesome features', '2012-09-05 00:00:00', 1),
(28, 'Anashria Womens Premier Leather Sandal', 'ana_9', 2.00, 'anashria-womens-premier-leather-sandal-9', '0000-00-00', '0000-00-00', 456, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal-2.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(29, 'Ottoman', '1111', 20.00, 'ottoman', '0000-00-00', '0000-00-00', 706, 1, 299.99, 0.00, 0.00, 299.99, 50.00, 'Ottoman', 'Ottoman', 'Ottoman', 'otottoman.jpg', 'The Magento ottoman will impress with its style while it delivers on quality. This piece of living room furniture is built to last with durable solid wood framing, generous padding and plush stain-res', 'With durable solid wood framing, generous padding and plush stain-resistant microfiber upholstery.', '2012-09-05 00:00:00', 1),
(30, 'Chair', '1112', 50.00, 'chair', '0000-00-00', '0000-00-00', 724, 1, 129.99, 0.00, 0.00, 129.99, 50.00, 'Chair', 'Chair', 'Chair', 'chchair.jpg', 'This Magento chair features a fun, futuristic design, with fluid curves and gentle angles that follow the shape of the body to enhance ultimate relaxation. It combines a hint of nostalgia with the up-', 'Combining a hint of nostalgia with the up-to-date sensibility and function of modern chairs. It is in soft, velvety microfiber.', '2012-09-05 00:00:00', 1),
(31, 'Couch', '1113', 200.00, 'couch', '0000-00-00', '0000-00-00', 956, 1, 599.99, 0.00, 0.00, 599.99, 200.00, 'Couch', 'Couch', 'Couch', 'cocouch.jpg', 'Inspired by the classic camelback sofa, Magento offers comfort and style in a low maintenance package.  For a sleek, simple and stylish piece, look no further than the Magento sofa - or sofabed!', 'For a sleek, simple and stylish piece, look no further than the Magento sofa - or sofabed!', '2012-09-05 00:00:00', 1),
(32, 'Magento Red Furniture Set', '1114', 500.00, 'magento-red-furniture-set', '0000-00-00', '0000-00-00', 960, 1, 699.99, 0.00, 0.00, 699.99, 300.00, 'Magento Red Furniture Set', 'Magento Red Furniture Set', 'Magento Red Furniture Set', 'mamagento-red-furniture-set.jpg', 'The perfect furniture set for the living room!  Love red?  You''ll love these pieces of handmade modern furniture!', 'Love red?  You''ll love these pieces of handmade modern furniture!', '2012-09-05 00:00:00', 1),
(33, 'Anashria Womens Premier Leather Sandal', 'ana_3', 2.00, 'anashria-womens-premier-leather-sandal-3', '0000-00-00', '0000-00-00', 999, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(34, 'Anashria Womens Premier Leather Sandal', 'ana_4', 2.00, 'anashria-womens-premier-leather-sandal-4', '0000-00-00', '0000-00-00', 617, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal-2.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(35, 'Anashria Womens Premier Leather Sandal', 'ana_5', 2.00, 'anashria-womens-premier-leather-sandal-5', '0000-00-00', '0000-00-00', 797, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(36, 'Anashria Womens Premier Leather Sandal', 'ana_6', 2.00, 'anashria-womens-premier-leather-sandal-6', '0000-00-00', '0000-00-00', 856, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(37, 'Anashria Womens Premier Leather Sandal', 'ana_7', 2.00, 'anashria-womens-premier-leather-sandal-7', '0000-00-00', '0000-00-00', 660, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(38, 'Anashria Womens Premier Leather Sandal', 'ana_8', 2.00, 'anashria-womens-premier-leather-sandal-8', '0000-00-00', '0000-00-00', 321, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', 'Womens Premier Leather Single Layer Narrow Strap - NEW Colors Available - Womens Style - Genuine Top Grain Premier Leather - Rich Color Tones - Straps lined with 2000 lb test nylon - Guaranteed for th', '2012-09-05 00:00:00', 1),
(39, 'CN Clogs Beach/Garden Clog', 'cn', 1.00, 'cn-clogs-beach-garden-clog', '0000-00-00', '0000-00-00', 986, 1, 15.99, 0.00, 0.00, 15.99, 2.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(40, 'CN Clogs Beach/Garden Clog', 'cn_4', 1.00, 'cn-clogs-beach-garden-clog-4', '0000-00-00', '0000-00-00', 859, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(41, 'CN Clogs Beach/Garden Clog', 'cn_5', 1.00, 'cn-clogs-beach-garden-clog-5', '0000-00-00', '0000-00-00', 31, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(42, 'CN Clogs Beach/Garden Clog', 'cn_6', 1.00, 'cn-clogs-beach-garden-clog-6', '0000-00-00', '0000-00-00', 303, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(43, 'CN Clogs Beach/Garden Clog', 'cn_7', 1.00, 'cn-clogs-beach-garden-clog-7', '0000-00-00', '0000-00-00', 621, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(44, 'CN Clogs Beach/Garden Clog', 'cn_m8', 1.00, 'cn-clogs-beach-garden-clog-8', '0000-00-00', '0000-00-00', 191, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(45, 'CN Clogs Beach/Garden Clog', 'cn_m9', 1.00, 'cn-clogs-beach-garden-clog-9', '0000-00-00', '0000-00-00', 948, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(46, 'CN Clogs Beach/Garden Clog', 'cn_m10', 1.00, 'cn-clogs-beach-garden-clog-10', '0000-00-00', '0000-00-00', 533, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(47, 'CN Clogs Beach/Garden Clog', 'cn_m11', 1.00, 'cn-clogs-beach-garden-clog-11', '0000-00-00', '0000-00-00', 293, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(48, 'CN Clogs Beach/Garden Clog', 'cn_m12', 1.00, 'cn-clogs-beach-garden-clog-12', '0000-00-00', '0000-00-00', 563, 1, 15.99, 0.00, 0.00, 15.99, 1.00, 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'CN Clogs Beach/Garden Clog', 'cncn-clogs-beach-garden-clog.jpg', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear. Wear them either at the beach, in your garden, at the mall or just about anywhere you would want to be comfortable.', 'Comfortable and fun to wear these clogs are the latest trend in fashion footwear', '2012-09-05 00:00:00', 1),
(49, 'ASICSÂ® Men''s GEL-KayanoÂ® XII', 'asc', 3.00, 'asics-men-s-gel-kayano-xii', '0000-00-00', '0000-00-00', 767, 1, 134.99, 0.00, 0.00, 134.99, 29.99, 'ASICSÂ® Men''s GEL-KayanoÂ® XII', 'ASICSÂ® Men''s GEL-KayanoÂ® XII', 'ASICSÂ® Men''s GEL-KayanoÂ® XII', 'asasics-men-s-gel-kayano-xii-2.jpg', 'Biomorphic Fitâ„¢ upper offers enhanced upper fit and comfort while decreasing the potential for irritation. Solyte midsole material is lighter than standard EVA and SpEVAÂ® combined with improved cus', 'The ASICSÂ® GEL-KayanoÂ® XII running shoe delivers the ultimate blend of cushioning and support.', '2012-09-05 00:00:00', 1),
(54, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on', '0000-00-00', '0000-00-00', 114, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe.', '2012-09-05 00:00:00', 1),
(55, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken_9', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on-9', '0000-00-00', '0000-00-00', 618, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', '2012-09-05 00:00:00', 1),
(56, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken_10', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on-10', '0000-00-00', '0000-00-00', 820, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', '2012-09-05 00:00:00', 1),
(57, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken_11', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on-11', '0000-00-00', '0000-00-00', 966, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', '2012-09-05 00:00:00', 1),
(58, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'ken_12', 2.00, 'kenneth-cole-new-york-men-s-con-verge-slip-on-12', '0000-00-00', '0000-00-00', 898, 1, 160.99, 0.00, 0.00, 160.99, 29.99, 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'Kenneth Cole New York Men''s Con-verge Slip-on', 'kekenneth-cole-new-york-men-s-con-verge-slip-on.jpg', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', 'High fashion and classic good looks converge in this suave slip on from Kenneth Cole. Smooth leather upper in a dress slip on style, with a stitched and covered seam moc-inspired square toe, quarter p', '2012-09-05 00:00:00', 1),
(59, 'Steven by Steve Madden Pryme Pump', 'steve', 2.00, 'steven-by-steve-madden-pryme-pump', '0000-00-00', '0000-00-00', 961, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surrounding the collar, and a vampy almond shaped toe', '2012-09-05 00:00:00', 1),
(60, 'Steven by Steve Madden Pryme Pump', 'steve_5', 2.00, 'steven-by-steve-madden-pryme-pump-5', '0000-00-00', '0000-00-00', 641, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', '2012-09-05 00:00:00', 1),
(61, 'Steven by Steve Madden Pryme Pump', 'steve_6', 2.00, 'steven-by-steve-madden-pryme-pump-6', '0000-00-00', '0000-00-00', 537, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', '2012-09-05 00:00:00', 1),
(62, 'Steven by Steve Madden Pryme Pump', 'steve_7', 2.00, 'steven-by-steve-madden-pryme-pump-7', '0000-00-00', '0000-00-00', 808, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', '2012-09-05 00:00:00', 1),
(63, 'Steven by Steve Madden Pryme Pump', 'steve_8', 2.00, 'steven-by-steve-madden-pryme-pump-8', '0000-00-00', '0000-00-00', 718, 1, 69.99, 0.00, 0.00, 69.99, 29.99, 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'Steven by Steve Madden Pryme Pump', 'ststeven-by-steve-madden-pryme-pump.jpg', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', 'Nothing will turn his head faster than you wearing the sexy Pryme pump from Steven by Steve Madden. This daring pump has a pretty patent leather upper with light shirring, a double stitch detail surro', '2012-09-05 00:00:00', 1),
(64, 'Nine West Women''s Lucero Pump', 'nine', 2.00, 'nine-west-women-s-lucero-pump', '0000-00-00', '0000-00-00', 384, 1, 89.99, 0.00, 0.00, 89.99, 29.99, 'Nine West Women''s Lucero Pump', 'Nine West Women''s Lucero Pump', 'Nine West Women''s Lucero Pump', 'ninine-west-women-s-lucero-pump.jpg', 'The Lucero pump from Nine West may just leave him at a loss for words. This flirty pump has a leather upper, a pretty almond-shaped toe with a slight V-cut vamp, leather linings, and a cushioned insol', 'This flirty pump has a leather upper, a pretty almond-shaped toe with a slight V-cut vamp', '2012-09-05 00:00:00', 1),
(68, 'ECCO Womens Golf Flexor Golf Shoe', 'ecco', 4.00, 'ecco-womens-golf-flexor-golf-shoe', '0000-00-00', '0000-00-00', 264, 1, 159.99, 0.00, 0.00, 159.99, 29.99, 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ececco-womens-golf-flexor-golf-shoe.jpg', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links. The contrasting embossed snakeskin panels at', 'With a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links.', '2012-09-05 00:00:00', 1),
(69, 'ECCO Womens Golf Flexor Golf Shoe', 'ecco_4', 4.00, 'ecco-womens-golf-flexor-golf-shoe-4', '0000-00-00', '0000-00-00', 336, 1, 159.99, 0.00, 0.00, 159.99, 29.99, 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ececco-womens-golf-flexor-golf-shoe.jpg', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links. The contrasting embossed snakeskin panels at', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links.', '2012-09-05 00:00:00', 1),
(70, 'ECCO Womens Golf Flexor Golf Shoe', 'ecco_5', 4.00, 'ecco-womens-golf-flexor-golf-shoe-5', '0000-00-00', '0000-00-00', 374, 1, 159.99, 0.00, 0.00, 159.99, 29.99, 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ececco-womens-golf-flexor-golf-shoe.jpg', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links. The contrasting embossed snakeskin panels at', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links.', '2012-09-05 00:00:00', 1),
(71, 'ECCO Womens Golf Flexor Golf Shoe', 'ecco_6', 4.00, 'ecco-womens-golf-flexor-golf-shoe-6', '0000-00-00', '0000-00-00', 343, 1, 159.99, 0.00, 0.00, 159.99, 29.99, 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ECCO Womens Golf Flexor Golf Shoe', 'ececco-womens-golf-flexor-golf-shoe.jpg', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links. The contrasting embossed snakeskin panels at', 'Featuring a wide toe box and delivering optimum support, the sporty Golf Flexor golf shoe is a stylish cleat that you''ll love wearing on and off the links.', '2012-09-05 00:00:00', 1),
(74, 'Coalesce: Functioning On Impatience T-Shirt', 'coal_1', 0.50, 'coalesce-functioning-on-impatience-t-shirt', '0000-00-00', '0000-00-00', 466, 1, 15.00, 0.00, 0.00, 15.00, 2.00, 'Coalesce: Functioning On Impatience T-Shirt', 'Coalesce: Functioning On Impatience T-Shirt', 'Coalesce: Functioning On Impatience T-Shirt', 'cocoalesce-functioning-on-impatience-t-shirt-1.jpg', 'Comfortable preshrunk shirts.  Highest Quality Printing.<br><br>\r\n<ul>\r\n<ul class="disc">\r\n<li>6.1 oz. 100% preshrunk heavyweight cotton<br></li>\r\n<li>Shoulder-to-shoulder taping<br></li>\r\n<li>Double-', '<ul>\r\n<ul class="disc">\r\n\r\n<li>6.1 oz. 100% preshrunk heavyweight cotton<br></li>\r\n<li>Shoulder-to-shoulder taping<br></li>\r\n<li>Double-needle sleeves and bottom hem<br></li>\r\n</ul>', '2012-09-05 00:00:00', 1),
(75, 'Ink Eater: Krylon Bombear Destroyed Tee', 'ink', 0.50, 'ink-eater-krylon-bombear-destroyed-tee', '0000-00-00', '0000-00-00', 896, 1, 22.00, 0.00, 0.00, 22.00, 2.00, 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'inink-eater-krylon-bombear-destroyed-tee.jpg', 'We bought these with the intention of making shirts for our family reunion, only to come back the next day to find each and every one of them had been tagged by The Bear.  Oh well -- can''t argue with', 'Now you can make your grandparents proud by wearing an original piece of graf work to YOUR family reunion!', '2012-09-05 00:00:00', 1),
(76, 'Ink Eater: Krylon Bombear Destroyed Tee', 'ink_med', 0.50, 'ink-eater-krylon-bombear-destroyed-tee-med', '0000-00-00', '0000-00-00', 812, 1, 22.00, 0.00, 0.00, 22.00, 2.00, 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'inink-eater-krylon-bombear-destroyed-tee.jpg', 'We bought these with the intention of making shirts for our family reunion, only to come back the next day to find each and every one of them had been tagged by The Bear.  Oh well -- can''t argue with', 'We bought these with the intention of making shirts for our family reunion, only to come back the next day to find each and every one of them had been tagged by The Bear.  Oh well -- can''t argue with', '2012-09-05 00:00:00', 1),
(77, 'Ink Eater: Krylon Bombear Destroyed Tee', 'ink_lrg', 0.50, 'ink-eater-krylon-bombear-destroyed-tee-lrg', '0000-00-00', '0000-00-00', 469, 1, 22.00, 0.00, 0.00, 22.00, 2.00, 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'Ink Eater: Krylon Bombear Destroyed Tee', 'inink-eater-krylon-bombear-destroyed-tee.jpg', 'We bought these with the intention of making shirts for our family reunion, only to come back the next day to find each and every one of them had been tagged by The Bear.  Oh well -- can''t argue with', 'We bought these with the intention of making shirts for our family reunion, only to come back the next day to find each and every one of them had been tagged by The Bear.  Oh well -- can''t argue with', '2012-09-05 00:00:00', 1),
(78, 'The Only Children: Paisley T-Shirt', 'oc', 0.44, 'the-only-children-paisley-t-shirt', '0000-00-00', '0000-00-00', 555, 1, 100.00, 0.00, 0.00, 100.00, 2.00, 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'ththe-only-children-paisley-t-shirt.jpg', '<ul>\r\n<ul class="disc">\r\n<li>6.1 oz. 100% preshrunk heavyweight cotton <br></li>\r\n<li>Double-needle sleeves and bottom hem</li>\r\n</ul>', 'Printed on American Apparel Classic style 5495 California cotton T shirt.', '2012-09-05 00:00:00', 1),
(79, 'The Only Children: Paisley T-Shirt', 'oc_med', 0.44, 'the-only-children-paisley-t-shirt-med', '0000-00-00', '0000-00-00', 241, 1, 15.00, 0.00, 0.00, 15.00, 2.00, 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'ththe-only-children-paisley-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California cotton T shirst.', '2012-09-05 00:00:00', 1),
(80, 'The Only Children: Paisley T-Shirt', 'oc_lrg', 0.44, 'the-only-children-paisley-t-shirt-lrg', '0000-00-00', '0000-00-00', 422, 1, 15.00, 0.00, 0.00, 15.00, 2.00, 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'The Only Children: Paisley T-Shirt', 'ththe-only-children-paisley-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California cotton T shirst.', '2012-09-05 00:00:00', 1);
INSERT INTO `mts_product` (`product_id`, `name`, `sku`, `weight`, `urlkey`, `new_from_date`, `new_to_date`, `qty`, `tax_class_id_fk`, `original_price`, `discount_percent`, `discount_amount`, `discounted_price`, `cost`, `meta_title`, `meta_keywords`, `meta_description`, `image_name`, `description`, `short_description`, `added_date`, `is_active`) VALUES
(81, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt', '0000-00-00', '0000-00-00', 832, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '<ul>\r\n<ul class="disc")\r\n<li> 6.1 oz. 100% preshrunk heavyweight cotton <br></li>\r\n<li> Shoulder-to-shoulder taping<br></li>\r\n<li>Double-needle sleeves and bottom hem<br></li>\r\n</ul>', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(82, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_g_sm', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-g-sm', '0000-00-00', '0000-00-00', 113, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(83, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_r_med', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-r-med', '0000-00-00', '0000-00-00', 463, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(84, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_g_med', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-g-med', '0000-00-00', '0000-00-00', 45, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(85, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_r_lrg', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-r-lrg', '0000-00-00', '0000-00-00', 687, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(86, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_g_lrg', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-g-lrg', '0000-00-00', '0000-00-00', 105, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(87, 'SLR Camera Tripod', 'ac674', 42.00, 'slr-camera-tripod', '0000-00-00', '0000-00-00', 162, 1, 99.00, 0.00, 0.00, 99.00, 0.00, '', '', '', 'slslr-camera-tripod.jpg', 'Sturdy, lightweight tripods are designed to meet the needs of amateur and professional photographers and videographers.', 'Sturdy, lightweight tripods are designed to meet the needs of amateur and professional photographers and videographers.', '2012-09-05 00:00:00', 1),
(88, 'Universal Camera Case', 'ac9003', 0.00, 'universal-camera-case', '0000-00-00', '0000-00-00', 398, 1, 34.00, 0.00, 0.00, 34.00, 0.00, '', '', '', 'ununiversal-camera-case.jpg', 'A stylish digital camera demands stylish protection. This leather carrying case will defend your camera from the dings and scratches of travel and everyday use while looking smart all the time.', 'A stylish digital camera demands stylish protection. This leather carrying case will defend your camera from the dings and scratches of travel and everyday use while looking smart all the time.', '2012-09-05 00:00:00', 1),
(89, 'Universal Camera Charger', 'ac-66332', 5.00, 'universal-camera-charger', '0000-00-00', '0000-00-00', 377, 1, 19.00, 0.00, 0.00, 19.00, 0.00, '', '', '', 'ununiversal-camera-charger.jpg', 'Features foldable Flat Pin for Easy Storage/ Slim/ Lightweight Design and Smart Charging LED Indicator.', 'Features foldable Flat Pin for Easy Storage/ Slim/ Lightweight Design and Smart Charging LED Indicator.', '2012-09-05 00:00:00', 1),
(90, 'Anashria Womens Premier Leather Sandal', 'ana', 2.00, 'anashria-womens-premier-leather-sandal', '0000-00-00', '0000-00-00', 998, 1, 41.95, 0.00, 0.00, 41.95, 10.00, 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'Anashria Womens Premier Leather Sandal', 'ananashria-womens-premier-leather-sandal.jpg', 'Smooth kidskin upper in a dress platform wedge t-strap sandal style, with a round open toe, front and ankle adjustable buckles and tonal stitching accents. Ankle buckle features elastic panel. Smooth', 'Buckle embellished contrasting straps adorn both the heel and canvas covered wedge of this t-strap sandal to make it a truly unique addition to your wardrobe', '2012-09-05 00:00:00', 1),
(91, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zol_b_med', 0.44, 'zolof-the-rock-and-roll-destroyer-lol-cat-t-shirt-b-med', '0000-00-00', '0000-00-00', 427, 1, 13.50, 0.00, 0.00, 13.50, 2.00, 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'Zolof The Rock And Roll Destroyer: LOL Cat T-shirt', 'zozolof-the-rock-and-roll-destroyer-lol-cat-t-shirt.jpg', '# 6.1 oz. 100% preshrunk heavyweight cotton \r\n# Shoulder-to-shoulder taping\r\n# Double-needle sleeves and bottom hem', 'Printed on American Apparel Classic style 5495 California t-shirts.', '2012-09-05 00:00:00', 1),
(92, 'Apevia Black X-Cruiser Case ATX Mid-Tower Case (Default)', 'apevia-black', 10.00, 'apevia-black-x-cruiser-case-atx-mid-tower-case', '0000-00-00', '0000-00-00', 702, 1, 150.00, 0.00, 0.00, 150.00, 0.00, '', '', '', 'apapevia-black-x-cruiser-case-atx-mid-tower-case-default.jpg', 'This superb, multi-functional Aspire X-Cruiser mid tower case is designed to follow Intel''s recommendations to achieve the highest level of thermal performance. This gorgeous case outperforms most of', 'This magnificent new case features 2 x 80mm built-in fans with space for 2 optional fans. The Aspire X-Cruiser features front temperature gauge, front fan speed controller and gauge, and front volume', '2012-09-05 00:00:00', 1),
(93, 'NZXT Lexa Silver Aluminum ATX Mid-Tower Case (Default)', 'nzxtlexa', 10.00, 'nzxt-lexa-silver-aluminum-atx-mid-tower-case', '0000-00-00', '0000-00-00', 743, 1, 199.99, 0.00, 0.00, 199.99, 0.00, '', '', '', 'nznzxt-lexa-silver-aluminum-atx-mid-tower-case-default.jpg', 'Introducing the next advancement in case design and technology, the Lexa. Designed from ground up to be symmetrical, the Lexa is representative of the modern lifestyle design cues of today. The Lexa''s', 'The Lexa boasts a ridgid, but light weight aluminum chassis. The Lexa''s high-air-flow design, while quiet, ensures cooling options for the more ambitious computing enthusiasts. Three thermal probes pr', '2012-09-05 00:00:00', 1),
(94, 'Crucial 2GB PC4200 DDR2 533MHz Memory', '2gbdimm', 1.00, 'crucial-2gb-pc4200-ddr2-533mhz-memory', '0000-00-00', '0000-00-00', 769, 1, 199.99, 0.00, 0.00, 199.99, 0.00, '', '', '', 'crcrucial-2gb-pc4200-ddr2-533mhz-memory.jpg', 'Crucial 2GB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memory,', 'Crucial 2GB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memory,', '2012-09-05 00:00:00', 1),
(95, 'Crucial 1GB PC4200 DDR2 533MHz Memory', '1gbdimm', 1.00, 'crucial-1gb-pc4200-ddr2-533mhz-memory', '0000-00-00', '0000-00-00', 853, 1, 150.99, 0.00, 0.00, 150.99, 0.00, '', '', '', 'crcrucial-1gb-pc4200-ddr2-533mhz-memory.jpg', 'Crucial 1024MB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memor', 'Crucial 1024MB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memor', '2012-09-05 00:00:00', 1),
(97, 'Crucial 512MB PC4200 DDR2 533MHz Memory', '512dimm', 1.00, 'crucial-512mb-pc4200-ddr2-533mhz-memory', '0000-00-00', '0000-00-00', 132, 1, 99.99, 0.00, 0.00, 99.99, 0.00, '', '', '', 'crcrucial-512mb-pc4200-ddr2-533mhz-memory.jpg', 'Crucial 512MB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memory', 'Crucial 512MB PC4200 DDR2 533MHz Memory\r\nCrucial Technologies is part of Micron, the largest DRAM manufacturer in the U.S. and one of the largest in the world. Because they actually manufacture memory', '2012-09-05 00:00:00', 1),
(99, 'AMD Phenom X4 9850 Black Ed. 2.50GHz Retail', 'amdphenom', 1.00, 'amd-phenom-x4-9850-black-ed-2-50ghz-retail', '0000-00-00', '0000-00-00', 538, 1, 335.99, 0.00, 0.00, 335.99, 0.00, '', '', '', 'amamd-phenom-x4-9850-black-ed-2-50ghz-retail.jpg', 'Overclockerâ€™s dream! Deliver more sophisticated solutions with the leading-edge technology of AMD Phenomâ„¢ 9000 Series processor. Built from the ground up for true quad-core performance, AMD Phenom', 'Deliver more sophisticated solutions with the leading-edge technology of AMD Phenomâ„¢ 9000 Series processor.', '2012-09-05 00:00:00', 1),
(101, '22" Syncmaster LCD Monitor', '226bw', 1.00, '22-syncmaster-lcd-monitor', '0000-00-00', '0000-00-00', 385, 1, 399.99, 0.00, 0.00, 399.99, 0.00, '', '', '', '2222-syncmaster-lcd-monitor.jpg', 'The wide, 16:10 format of SAMSUNG''s 226BW digital/Analog widescreen LCD monitor gives you plenty of room for all your computer applications and multiple images. DC 3000:1 contrast ratio creates crisp,', 'The wide, 16:10 format of SAMSUNG''s 226BW digital/Analog widescreen LCD monitor gives you plenty of room for all your computer applications and multiple images. DC 3000:1 contrast ratio creates crisp,', '2012-09-05 00:00:00', 1),
(102, 'AMD A64 X2 3800+ 2.0GHz OEM', 'amda64', 1.00, 'amd-a64-x2-3800-2-0ghz-oem', '0000-00-00', '0000-00-00', 303, 1, 98.99, 0.00, 0.00, 98.99, 0.00, '', '', '', 'amamd-a64-x2-3800-2-0ghz-oem.jpg', 'Frustrated by staring at the hourglass icon as soon as you try to work on more than three programs at once, especially when youâ€™re working with digital media? Increase your performance with the AMD', 'AMD Athlon 64 X2 3800+ Processor ADO3800IAA5CZ - 2.0GHz, 2 x 512KB Cache, 1000MHz (2000 MT/s) FSB, Windsor, Dual Core, OEM, Socket AM2, Processor', '2012-09-05 00:00:00', 1),
(103, 'Western Digital - 1TB HD - 7200RPM', '1tb7200', 1.00, '1tb-7200rpm', '0000-00-00', '0000-00-00', 74, 1, 399.00, 0.00, 0.00, 399.00, 0.00, '', '', '', 'wewestern-digital-1tb-hd-7200rpm.jpg', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '2012-09-05 00:00:00', 1),
(104, 'Western Digital 500GB HD - 7200RPM', '500gb7200', 1.00, '500gb-7200rpm', '0000-00-00', '0000-00-00', 16, 1, 299.00, 0.00, 0.00, 299.00, 0.00, '', '', '', 'wewestern-digital-500gb-hd-7200rpm.jpg', '500GB- 7200RPM, SATA 3.0Gb/s, 32MB Cache', '500GB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '2012-09-05 00:00:00', 1),
(105, 'Intel C2D E8400 3.0GHz Retail', 'intelc2d', 1.00, 'intel-c2d-e8400-3-0ghz-retail', '0000-00-00', '0000-00-00', 846, 1, 98.99, 0.00, 0.00, 98.99, 0.00, '', '', '', 'inintel-c2d-e8400-3-0ghz-retail.jpg', 'IntelÂ® Coreâ„¢2 Duo processor is the new brand name for our next-generation energy-efficient performance desktop and mobile processors. Formerly known by their codenames Conroe and Merom, the IntelÂ®', 'IntelÂ® Coreâ„¢2 Duo processor is the new brand name for our next-generation energy-efficient performance desktop and mobile processors.', '2012-09-05 00:00:00', 1),
(106, '24" Widescreen Flat-Panel LCD Monitor', 'W2452T-TF', 1.00, '24-widescreen-flat-panel-lcd-monitor', '0000-00-00', '0000-00-00', 504, 1, 699.99, 0.00, 0.00, 699.99, 0.00, '', '', '', '2424-widescreen-flat-panel-lcd-monitor.jpg', 'With ultrafine 10,000:1 contrast and wide 170Â° viewing angles, this 24" widescreen LCD monitor delivers crystal-clear high-definition visuals for gaming and work projects. The DVI-D input lets you co', '5 ms response time; 10,000:1 contrast ratio; 400 cd/mÂ² brightness; 1920 x 1200 maximum resolution; DVI-D and 15-pin D-sub inputs', '2012-09-05 00:00:00', 1),
(107, 'Intel Core 2 Extreme QX9775 3.20GHz Retail', 'intelcore2extreme', 1.00, 'intel-core-2-extreme-qx9775-3-20ghz-retail', '0000-00-00', '0000-00-00', 549, 1, 2049.99, 0.00, 0.00, 2049.99, 0.00, '', '', '', 'inintel-core-2-extreme-qx9775-3-20ghz-retail.jpg', 'The new IntelÂ® Coreâ„¢2 Extreme processor QX9775 with hafnium-infused chip design delivers unrivaled gaming performance1 with four independent processing cores, 12 MB of cache, 1600 MHz Front Side Bu', 'Intel Core 2 Extreme QX9775 Processor BX80574QX9775 - 45nm, 3.20GHz, 12MB Cache, 1600MHz FSB, Yorkfield XE, Quad-Core, Retail, Socket 771, Processor', '2012-09-05 00:00:00', 1),
(108, 'Seagate 500GB HD - 5400RPM', '500gb5400', 1.00, '500gb-5400rpm', '0000-00-00', '0000-00-00', 313, 1, 299.00, 0.00, 0.00, 299.00, 0.00, '', '', '', 'seseagate-500gb-hd-5400rpm.jpg', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '2012-09-05 00:00:00', 1),
(109, 'Seagate 250GB HD - 5400RPM', '250gb5400', 1.00, '250gb-5400rpm', '0000-00-00', '0000-00-00', 363, 1, 99.00, 0.00, 0.00, 99.00, 0.00, '', '', '', 'seseagate-250gb-hd-5400rpm.jpg', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '1 TB - 7200RPM, SATA 3.0Gb/s, 32MB Cache', '2012-09-05 00:00:00', 1),
(110, '19" Widescreen Flat-Panel LCD Monitor', 'W1952TQ-TF', 1.00, '19-widescreen-flat-panel-lcd-monitor', '0000-00-00', '0000-00-00', 453, 1, 399.99, 0.00, 0.00, 399.99, 0.00, '', '', '', '1919-widescreen-flat-panel-lcd-monitor.jpg', 'Experience smooth gaming visuals and crystal-clear video with this 19" flat-panel LCD monitor that features an ultrafast 2 ms response time and sharp 10,000:1 contrast. The DVI-D with HDCP input lets', '2 ms response time; 10,000:1 contrast ratio; 300 cd/mÂ² brightness; 1440 x 900 maximum resolution; DVI-D and 15-pin D-sub inputs', '2012-09-05 00:00:00', 1),
(111, '30" Flat-Panel TFT-LCD Cinema HD Monitor', 'M9179LL', 1.00, '30-flat-panel-tft-lcd-cinema-hd-monitor', '0000-00-00', '0000-00-00', 562, 1, 699.99, 0.00, 0.00, 699.99, 0.00, '', '', '', '3030-flat-panel-tft-lcd-cinema-hd-monitor.jpg', '* Digital (DVI), USB 2.0 and FireWire 400 inputs\r\n    * Cinema HD delivers up to 16.7 million colors across a wide gamut for a breathtaking, vivid picture\r\n    * ColorSync technology lets you crea', 'Computer games, digital photo editing and graphic applications will astound you on this huge 30" flat-panel monitor. Cinema HD and ColorSync technology let you enjoy 16.7 million breathtaking colors a', '2012-09-05 00:00:00', 1),
(112, 'Sony VAIO 11.1" Notebook PC', 'VGN-TXN27N/BW', 0.00, 'sony-vaio-vgn-txn27n-b-11-1-notebook-pc', '0000-00-00', '0000-00-00', 156, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'Sony VAIO VGN-TXN27N/B 11.1" Notebook PC (Intel Core Solo Processor U1500, 2 GB RAM, 100 GB Hard Drive, DVDÂ±RW Drive, Vista Business) Charcoal Black', 'sosony-vaio-11-1-notebook-pc.jpg', '<ul>\r\n<ul class="disc">\r\n<li>Processor: The Ultra Low Voltage Intel Core Solo U1500 processor offers a 1.33 GHz speed paired with a fast 533 MHz front-side bus and large 2 MB L2 cache. (An L2, or sec', 'Weighing in at just an amazing 2.84 pounds and offering a sleek, durable carbon-fiber case in charcoal black. And with 4 to 10 hours of standard battery life, it has the stamina to power you through y', '2012-09-05 00:00:00', 1),
(113, 'Microsoft Natural Ergonomic Keyboard 4000', 'microsoftnatural', 1.00, 'microsoft-natural-ergonomic-keyboard-4000', '0000-00-00', '0000-00-00', 275, 1, 99.99, 0.00, 0.00, 99.99, 0.00, '', '', '', 'mimicrosoft-natural-ergonomic-keyboard-4000.jpg', 'The most comfortable ergonomic keyboard on the market! We just made a great deal for this Microsoft Natural ergonomic keyboard. And we know youâ€™re going to love it. This newest addition to the world', 'The most comfortable ergonomic keyboard on the market! We just made a great deal for this Microsoft Natural ergonomic keyboard.', '2012-09-05 00:00:00', 1),
(114, 'Logitech Cordless Optical Trackman', 'logitechcord', 1.00, 'microsoft-wireless-optical-mouse-5000', '0000-00-00', '0000-00-00', 618, 1, 79.99, 0.00, 0.00, 79.99, 0.00, '', '', '', 'lologitech-cordless-optical-trackman.jpg', 'Our most advanced trackball yet: a comfortable, cordless, finger-operated trackball that works where you need it. Save space and eliminate desktop clutter. Take advantage of extra buttons that help yo', 'Our most advanced trackball yet. It''s comfortable, cordless, finger-operated and works where you need it. Save space and eliminate desktop clutter.', '2012-09-05 00:00:00', 1),
(115, 'Logitech diNovo Edge Keyboard', 'logidinovo', 1.00, 'logitech-dinovo-edge-keyboard', '0000-00-00', '0000-00-00', 209, 1, 239.99, 0.00, 0.00, 239.99, 0.00, '', '', '', 'lologitech-dinovo-edge-keyboard.jpg', 'PerfectStroke key system for the ultimate keyboard feel. Bluetooth wireless and Li-Ion powered. Stylishly sleek with its elegant charging base and backlit controls, the diNovo Edge makes a bold statem', 'PerfectStroke key system for the ultimate keyboard feel. Bluetooth wireless and Li-Ion powered.', '2012-09-05 00:00:00', 1),
(116, 'Microsoft Wireless Optical Mouse 5000', 'micronmouse5000', 1.00, 'microsoft-wireless-optical-mouse-5000', '0000-00-00', '0000-00-00', 760, 1, 59.99, 0.00, 0.00, 59.99, 0.00, '', '', '', 'mimicrosoft-wireless-optical-mouse-5000.jpg', 'Experience smoother tracking and wireless freedom. Navigate with enhanced precision with this ergonomic High Definition Optical mouse. Easily enlarge and edit detail with the new Magnifier and enjoy m', 'Experience smoother tracking and wireless freedom. Navigate with enhanced precision with this ergonomic High Definition Optical mouse.', '2012-09-05 00:00:00', 1),
(117, 'Computer', 'computer', 0.00, 'computer', '0000-00-00', '0000-00-00', 426, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 'cocomputer.jpg', 'Make a computer', 'Make a computer', '2012-09-05 00:00:00', 1),
(118, 'Gaming Computer', 'computer_fixed', 20.00, 'gaming-computer', '0000-00-00', '0000-00-00', 968, 1, 4999.95, 0.00, 0.00, 4999.95, 0.00, '', '', '', 'gagaming-computer.jpg', 'Make a computer', 'Make a computer', '2012-09-05 00:00:00', 1),
(119, 'My Computer', 'mycomputer', 10.00, 'my-computer', '2008-07-30', '0000-00-00', 79, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 'mymy-computer.jpg', 'test description', 'test description', '2012-09-05 00:00:00', 1),
(121, 'samsung smart phone', 'n2610', 25.00, 'samsung-smart-phone', '2014-07-29', '2014-07-29', 10, 0, 16000.00, 6.25, 1000.00, 15000.00, 17000.00, 'samsung smart phone', 'samsung smart phone', 'samsung smart phone', '', '<p>\r\n	samsung smart phone</p>\r\n', '<p>\r\n	samsung smart phone</p>\r\n', '2014-06-27 05:11:39', 1),
(122, 'dddddd', 'ddddd', 33.00, 'ddddd', '2014-11-17', '2014-11-18', 111, 0, 100.00, 10.00, 10.00, 90.00, 100.00, 'sssssss', 'ssssssssssssss', 'sssssssssssss', '', '<p>\r\n	test desc</p>\r\n', '<p>\r\n	test</p>\r\n', '2014-11-17 01:06:06', 1),
(123, 'f r i e n d s', 'rrrrrr', 22.00, 'f-r-i-e-n-d-s', '2014-11-17', '2014-11-25', 111, 0, 100.00, 10.00, 10.00, 90.00, 100.00, 'sssssss', '', '', '', '<p>\r\n	f r i e n d s</p>\r\n', '<p>\r\n	f r i e n d s</p>\r\n', '2014-11-17 01:28:08', 1),
(124, 'f r i e n d s', 'ddddd', 22.00, 'f-r-i-e-n-d-s-1', '2014-11-17', '2014-11-25', 111, 0, 100.00, 10.00, 10.00, 90.00, 100.00, 'sssssss', '', '', '', '<p>\r\n	f r i e n d s</p>\r\n', '<p>\r\n	f r i e n d s</p>\r\n', '2014-11-17 01:29:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_product_image`
--

DROP TABLE IF EXISTS `mts_product_image`;
CREATE TABLE IF NOT EXISTS `mts_product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_fk` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mts_product_image`
--

INSERT INTO `mts_product_image` (`product_image_id`, `product_id_fk`, `image_name`, `added_date`, `is_default`, `is_active`) VALUES
(1, 121, '1403868405_nonokia-2610-phone-2.jpg', '2014-06-27 04:26:46', 1, 1),
(2, 121, '1403868672_Facebook-covers2.jpg', '2014-06-27 04:31:12', 0, 1),
(3, 121, '1403868672_jaguar1.jpg', '2014-06-27 04:31:13', 0, 1),
(4, 121, '1403868673_ththe-get-up-kids-band-camp-pullover-hoodie-1.jpg', '2014-06-27 04:31:13', 0, 1),
(5, 121, '1403868673_zovi-tshirts.jpg', '2014-06-27 04:31:14', 0, 1),
(6, 122, '1416215166_camera.jpg', '2014-11-17 01:06:06', 1, 1),
(7, 123, '1416216488_camera.jpg', '2014-11-17 01:28:11', 1, 1),
(8, 124, '1416216557_4406aaa9f3424dec9e9b4fead25d3fc8.jpg', '2014-11-17 01:29:18', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_seo_content_management`
--

DROP TABLE IF EXISTS `mts_seo_content_management`;
CREATE TABLE IF NOT EXISTS `mts_seo_content_management` (
  `seo_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type` enum('custom','system') COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `request_uri` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seo_id`),
  UNIQUE KEY `request_uri` (`request_uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `mts_sitesetting`
--

DROP TABLE IF EXISTS `mts_sitesetting`;
CREATE TABLE IF NOT EXISTS `mts_sitesetting` (
  `sitesetting_id` int(2) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` text COLLATE utf8_unicode_ci,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'sitesetting',
  PRIMARY KEY (`sitesetting_id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mts_sitesetting`
--

INSERT INTO `mts_sitesetting` (`sitesetting_id`, `label`, `type`, `value`, `module_name`) VALUES
(1, '', 'TEMPLATEDIR', 'default', 'sitesetting'),
(2, '', 'SITELANGUAGE', 'ENGLISH', 'sitesetting'),
(3, '', 'SITETITLE', 'Mindtricks Software', 'sitesetting'),
(5, '', 'EMAIL_FROM', 'admin', 'sitesetting'),
(6, '', 'SITE_EMAIL', 'mindtrickssoftware@gmail.com', 'sitesetting'),
(9, '', 'SITENAME', 'PHP Custom Framework', 'sitesetting'),
(11, '', 'SMTP_HOST', 'mail.mindtrickssoftware.com', 'sitesetting'),
(12, '', 'SMTP_USER', 'amol.sananse@mindtrickssoftware.com', 'sitesetting'),
(13, '', 'SMTP_PASSWORD', 'test', 'sitesetting'),
(14, '', 'SMTP_PORT', '21', 'sitesetting'),
(15, '', 'SMTP_NOREPLY', 'amol.sananse@mindtrickssoftware.com', 'sitesetting'),
(16, '', 'SMTP_FROM_ADDRE', 'amol.sananse@mindtrickssoftware.com', 'sitesetting'),
(17, '', 'SMTP_FROM_NAME', 'Mindtricks Software - Mind that works for you.', 'sitesetting'),
(18, '', 'ROW_PER_PAGE_ADMIN', '30', 'sitesetting'),
(19, '', 'LINK_PER_PAGE', '6', 'sitesetting'),
(20, '', 'MAILER', 'mail', 'sitesetting'),
(24, 'App Id', 'FCONNECT_APPID', '', 'FCONNECT'),
(25, 'App Secret', 'FCONNECT_SECRET', '', 'FCONNECT'),
(26, 'Calculate Tax (Yes = will calculate tax on check out page)', 'CALCULATE_TAX', 'Yes', 'sitesetting'),
(27, '', 'COPYRIGHT', 'Copyright &copy; 2014 Mindtricks Software PHP Framework. All Rights Reserved. ', 'sitesetting'),
(28, '', 'ROW_PER_PAGE_FRONT', '15', 'sitesetting');

-- --------------------------------------------------------

--
-- Table structure for table `mts_state`
--

DROP TABLE IF EXISTS `mts_state`;
CREATE TABLE IF NOT EXISTS `mts_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_fk` int(11) NOT NULL,
  `state_code` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `idx_zones_country_id` (`country_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=227 ;

--
-- Dumping data for table `mts_state`
--

INSERT INTO `mts_state` (`state_id`, `country_id_fk`, `state_code`, `state`, `is_active`) VALUES
(1, 223, 'AL', 'Alabama', 1),
(2, 223, 'AK', 'Alaska', 1),
(3, 223, 'AS', 'American Samoa', 1),
(4, 223, 'AZ', 'Arizona', 1),
(5, 223, 'AR', 'Arkansas', 1),
(6, 223, 'AF', 'Armed Forces Africa', 1),
(7, 223, 'AA', 'Armed Forces Americas', 1),
(8, 223, 'AC', 'Armed Forces Canada', 1),
(9, 223, 'AE', 'Armed Forces Europe', 1),
(10, 223, 'AM', 'Armed Forces Middle East', 1),
(11, 223, 'AP', 'Armed Forces Pacific', 1),
(12, 223, 'CA', 'California', 1),
(13, 223, 'CO', 'Colorado', 1),
(14, 223, 'CT', 'Connecticut', 1),
(15, 223, 'DE', 'Delaware', 1),
(16, 223, 'DC', 'District of Columbia', 1),
(17, 223, 'FM', 'Federated States Of Micronesia', 1),
(18, 223, 'FL', 'Florida', 1),
(19, 223, 'GA', 'Georgia', 1),
(20, 223, 'GU', 'Guam', 1),
(21, 223, 'HI', 'Hawaii', 1),
(22, 223, 'ID', 'Idaho', 1),
(23, 223, 'IL', 'Illinois', 1),
(24, 223, 'IN', 'Indiana', 1),
(25, 223, 'IA', 'Iowa', 1),
(26, 223, 'KS', 'Kansas', 1),
(27, 223, 'KY', 'Kentucky', 1),
(28, 223, 'LA', 'Louisiana', 1),
(29, 223, 'ME', 'Maine', 1),
(30, 223, 'MH', 'Marshall Islands', 1),
(31, 223, 'MD', 'Maryland', 1),
(32, 223, 'MA', 'Massachusetts', 1),
(33, 223, 'MI', 'Michigan', 1),
(34, 223, 'MN', 'Minnesota', 1),
(35, 223, 'MS', 'Mississippi', 1),
(36, 223, 'MO', 'Missouri', 1),
(37, 223, 'MT', 'Montana', 1),
(38, 223, 'NE', 'Nebraska', 1),
(39, 223, 'NV', 'Nevada', 1),
(40, 223, 'NH', 'New Hampshire', 1),
(41, 223, 'NJ', 'New Jersey', 1),
(42, 223, 'NM', 'New Mexico', 1),
(43, 223, 'NY', 'New York', 1),
(44, 223, 'NC', 'North Carolina', 1),
(45, 223, 'ND', 'North Dakota', 1),
(46, 223, 'MP', 'Northern Mariana Islands', 1),
(47, 223, 'OH', 'Ohio', 1),
(48, 223, 'OK', 'Oklahoma', 1),
(49, 223, 'OR', 'Oregon', 1),
(50, 223, 'PW', 'Palau', 1),
(51, 223, 'PA', 'Pennsylvania', 1),
(52, 223, 'PR', 'Puerto Rico', 1),
(53, 223, 'RI', 'Rhode Island', 1),
(54, 223, 'SC', 'South Carolina', 1),
(55, 223, 'SD', 'South Dakota', 1),
(56, 223, 'TN', 'Tennessee', 1),
(57, 223, 'TX', 'Texas', 1),
(58, 223, 'UT', 'Utah', 1),
(59, 223, 'VT', 'Vermont', 1),
(60, 223, 'VI', 'Virgin Islands', 1),
(61, 223, 'VA', 'Virginia', 1),
(62, 223, 'WA', 'Washington', 1),
(63, 223, 'WV', 'West Virginia', 1),
(64, 223, 'WI', 'Wisconsin', 1),
(65, 223, 'WY', 'Wyoming', 1),
(66, 38, 'AB', 'Alberta', 1),
(67, 38, 'BC', 'British Columbia', 1),
(68, 38, 'MB', 'Manitoba', 1),
(69, 38, 'NF', 'Newfoundland', 1),
(70, 38, 'NB', 'New Brunswick', 1),
(71, 38, 'NS', 'Nova Scotia', 1),
(72, 38, 'NT', 'Northwest Territories', 1),
(73, 38, 'NU', 'Nunavut', 1),
(74, 38, 'ON', 'Ontario', 1),
(75, 38, 'PE', 'Prince Edward Island', 1),
(76, 38, 'QC', 'Quebec', 1),
(77, 38, 'SK', 'Saskatchewan', 1),
(78, 38, 'YT', 'Yukon Territory', 1),
(79, 81, 'NDS', 'Niedersachsen', 1),
(80, 81, 'BAW', 'Baden-WÃ¼rttemberg', 1),
(81, 81, 'BAY', 'Bayern', 1),
(82, 81, 'BER', 'Berlin', 1),
(83, 81, 'BRG', 'Brandenburg', 1),
(84, 81, 'BRE', 'Bremen', 1),
(85, 81, 'HAM', 'Hamburg', 1),
(86, 81, 'HES', 'Hessen', 1),
(87, 81, 'MEC', 'Mecklenburg-Vorpommern', 1),
(88, 81, 'NRW', 'Nordrhein-Westfalen', 1),
(89, 81, 'RHE', 'Rheinland-Pfalz', 1),
(90, 81, 'SAR', 'Saarland', 1),
(91, 81, 'SAS', 'Sachsen', 1),
(92, 81, 'SAC', 'Sachsen-Anhalt', 1),
(93, 81, 'SCN', 'Schleswig-Holstein', 1),
(94, 81, 'THE', 'ThÃ¼ringen', 1),
(95, 14, 'WI', 'Wien', 1),
(96, 14, 'NO', 'NiederÃ¶sterreich', 1),
(97, 14, 'OO', 'OberÃ¶sterreich', 1),
(98, 14, 'SB', 'Salzburg', 1),
(99, 14, 'KN', 'KÃ¤rnten', 1),
(100, 14, 'ST', 'Steiermark', 1),
(101, 14, 'TI', 'Tirol', 1),
(102, 14, 'BL', 'Burgenland', 1),
(103, 14, 'VB', 'Voralberg', 1),
(104, 204, 'AG', 'Aargau', 1),
(105, 204, 'AI', 'Appenzell Innerrhoden', 1),
(106, 204, 'AR', 'Appenzell Ausserrhoden', 1),
(107, 204, 'BE', 'Bern', 1),
(108, 204, 'BL', 'Basel-Landschaft', 1),
(109, 204, 'BS', 'Basel-Stadt', 1),
(110, 204, 'FR', 'Freiburg', 1),
(111, 204, 'GE', 'Genf', 1),
(112, 204, 'GL', 'Glarus', 1),
(113, 204, 'JU', 'GraubÃ¼nden', 1),
(114, 204, 'JU', 'Jura', 1),
(115, 204, 'LU', 'Luzern', 1),
(116, 204, 'NE', 'Neuenburg', 1),
(117, 204, 'NW', 'Nidwalden', 1),
(118, 204, 'OW', 'Obwalden', 1),
(119, 204, 'SG', 'St. Gallen', 1),
(120, 204, 'SH', 'Schaffhausen', 1),
(121, 204, 'SO', 'Solothurn', 1),
(122, 204, 'SZ', 'Schwyz', 1),
(123, 204, 'TG', 'Thurgau', 1),
(124, 204, 'TI', 'Tessin', 1),
(125, 204, 'UR', 'Uri', 1),
(126, 204, 'VD', 'Waadt', 1),
(127, 204, 'VS', 'Wallis', 1),
(128, 204, 'ZG', 'Zug', 1),
(129, 204, 'ZH', 'ZÃ¼rich', 1),
(130, 195, 'A CoruÃ±a', 'A CoruÃ±a', 1),
(131, 195, 'Alava', 'Alava', 1),
(132, 195, 'Albacete', 'Albacete', 1),
(133, 195, 'Alicante', 'Alicante', 1),
(134, 195, 'Almeria', 'Almeria', 1),
(135, 195, 'Asturias', 'Asturias', 1),
(136, 195, 'Avila', 'Avila', 1),
(137, 195, 'Badajoz', 'Badajoz', 1),
(138, 195, 'Baleares', 'Baleares', 1),
(139, 195, 'Barcelona', 'Barcelona', 1),
(140, 195, 'Burgos', 'Burgos', 1),
(141, 195, 'Caceres', 'Caceres', 1),
(142, 195, 'Cadiz', 'Cadiz', 1),
(143, 195, 'Cantabria', 'Cantabria', 1),
(144, 195, 'Castellon', 'Castellon', 1),
(145, 195, 'Ceuta', 'Ceuta', 1),
(146, 195, 'Ciudad Real', 'Ciudad Real', 1),
(147, 195, 'Cordoba', 'Cordoba', 1),
(148, 195, 'Cuenca', 'Cuenca', 1),
(149, 195, 'Girona', 'Girona', 1),
(150, 195, 'Granada', 'Granada', 1),
(151, 195, 'Guadalajara', 'Guadalajara', 1),
(152, 195, 'Guipuzcoa', 'Guipuzcoa', 1),
(153, 195, 'Huelva', 'Huelva', 1),
(154, 195, 'Huesca', 'Huesca', 1),
(155, 195, 'Jaen', 'Jaen', 1),
(156, 195, 'La Rioja', 'La Rioja', 1),
(157, 195, 'Las Palmas', 'Las Palmas', 1),
(158, 195, 'Leon', 'Leon', 1),
(159, 195, 'Lleida', 'Lleida', 1),
(160, 195, 'Lugo', 'Lugo', 1),
(161, 195, 'Madrid', 'Madrid', 1),
(162, 195, 'Malaga', 'Malaga', 1),
(163, 195, 'Melilla', 'Melilla', 1),
(164, 195, 'Murcia', 'Murcia', 1),
(165, 195, 'Navarra', 'Navarra', 1),
(166, 195, 'Ourense', 'Ourense', 1),
(167, 195, 'Palencia', 'Palencia', 1),
(168, 195, 'Pontevedra', 'Pontevedra', 1),
(169, 195, 'Salamanca', 'Salamanca', 1),
(170, 195, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 1),
(171, 195, 'Segovia', 'Segovia', 1),
(172, 195, 'Sevilla', 'Sevilla', 1),
(173, 195, 'Soria', 'Soria', 1),
(174, 195, 'Tarragona', 'Tarragona', 1),
(175, 195, 'Teruel', 'Teruel', 1),
(176, 195, 'Toledo', 'Toledo', 1),
(177, 195, 'Valencia', 'Valencia', 1),
(178, 195, 'Valladolid', 'Valladolid', 1),
(179, 195, 'Vizcaya', 'Vizcaya', 1),
(180, 195, 'Zamora', 'Zamora', 1),
(181, 195, 'Zaragoza', 'Zaragoza', 1),
(182, 99, 'NI', 'North India', 1),
(183, 99, 'SI', 'South India', 1),
(184, 99, 'EI', 'East India', 1),
(185, 99, 'CI', 'Central India', 1),
(226, 1, 'ss', 'AlabamaNw', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mts_user`
--

DROP TABLE IF EXISTS `mts_user`;
CREATE TABLE IF NOT EXISTS `mts_user` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL DEFAULT '0000-00-00',
  `gender` enum('Female','Male') NOT NULL DEFAULT 'Female',
  `userimage` varchar(255) NOT NULL,
  `signupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogindate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verificationdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verificationcode` varchar(255) NOT NULL,
  `account_type_id_fk` int(5) NOT NULL,
  `default_billing_id` int(11) NOT NULL,
  `default_shipping_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `blocked_reason` varchar(255) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `account_type_id_fk` (`account_type_id_fk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `mts_user`
--

INSERT INTO `mts_user` (`UID`, `username`, `email`, `password`, `firstname`, `lastname`, `birthdate`, `gender`, `userimage`, `signupdate`, `lastlogindate`, `is_online`, `is_verified`, `verificationdate`, `verificationcode`, `account_type_id_fk`, `default_billing_id`, `default_shipping_id`, `is_active`, `is_blocked`, `blocked_reason`) VALUES
(1, 'admin', 'mindtrickssoftware@gmail.com', '3b89345b1d505c00425dfd17d47e3a83', 'Amol', 'Sananse', '2012-07-01', 'Male', '', '2012-01-01 00:00:00', '0000-00-00 00:00:00', 0, 1, '2012-01-01 00:00:00', '123456', 1, 25, 25, 1, 0, ''),
(2, '', 'amol.sananse@gmail.com', '0c21e207c5bb3967499f491067595e51', 'Amol', 'Sananse', '0000-00-00', 'Male', '1345134686_Ü', '2012-07-22 02:23:12', '2012-08-16 09:31:26', 0, 1, '0000-00-00 00:00:00', '6444441a3efb5ae63c7d5f0db7138f20', 3, 2, 1, 1, 1, 'test'),
(3, 'amolsananse', 's.amol@gmail.com', '0c21e207c5bb3967499f491067595e51', 'Amol', 'Sananse', '1994-08-01', 'Male', '1344166262_Üæ', '2012-08-05 04:31:02', '2012-08-05 04:31:02', 0, 0, '0000-00-00 00:00:00', '51152bf91d711ed9931e48e274bdcca0', 3, 0, 0, 1, 0, ''),
(4, 'amols', 'amol.sananse@mindtrickssoftware.com', '0c21e207c5bb3967499f491067595e51', 'Amol', 'Sananse', '1994-08-01', 'Male', '1356684986_ÝÎ', '2012-08-06 09:03:04', '2012-12-28 00:56:26', 0, 1, '0000-00-00 00:00:00', 'b9cc6e012aafcd496c92f5885c181054', 3, 0, 0, 1, 0, ''),
(8, 'username3', 'email3', '0c21e207c5bb3967499f491067595e51', 'firstname3', 'lastname3', '0000-00-00', 'Female', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '', 2, 26, 26, 1, 0, ''),
(9, 'username4', 'email4', '0c21e207c5bb3967499f491067595e51', 'firstname4', 'lastname4', '0000-00-00', 'Female', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '', 2, 0, 0, 1, 0, ''),
(20, '', 'amol.sananse1@gmail.com', 'cc361a8314e6c4e72d90d5a3850b6540', 'Amol', 'Sananse', '1996-06-26', 'Male', '', '2014-06-26 04:17:20', '2014-06-26 04:20:35', 0, 0, '0000-00-00 00:00:00', 'cc361a8314e6c4e72d90d5a3850b6540', 2, 23, 23, 1, 0, ''),
(21, 'merchant_amol', 'amol.sananse83@gmail.com', 'e5105b4b8c5510f5c38f681346946ad3', 'Merchant', 'User', '1996-06-26', 'Male', '', '2014-06-26 04:46:07', '2014-06-26 04:46:07', 0, 0, '0000-00-00 00:00:00', 'e5105b4b8c5510f5c38f681346946ad3', 2, 24, 24, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `mts_user_login_log`
--

DROP TABLE IF EXISTS `mts_user_login_log`;
CREATE TABLE IF NOT EXISTS `mts_user_login_log` (
  `login_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `http_user_agent` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `http_accept_charset` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `http_accept_language` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `server_addr` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remote_addr` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `login_at` datetime NOT NULL,
  `logout_at` datetime NOT NULL,
  `user_info` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`login_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `mts_user_login_log`
--

INSERT INTO `mts_user_login_log` (`login_log_id`, `UID`, `http_user_agent`, `http_accept_charset`, `http_accept_language`, `server_addr`, `remote_addr`, `login_at`, `logout_at`, `user_info`) VALUES
(1, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-16 09:31:44', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(2, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-17 08:11:47', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(3, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-19 02:56:07', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(4, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-20 00:24:27', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(5, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-21 00:19:32', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(6, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-25 07:31:50', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(7, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-08-28 06:26:06', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(8, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-09-04 04:34:24', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(9, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-09-05 00:28:45', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(10, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-09-06 00:45:34', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}'),
(11, 2, 'Mozilla/5.0 (Windows NT 5.1; rv:15.0) Gecko/20100101 Firefox/15.0', '', 'en-us,en;q=0.5', '127.0.0.1', '127.0.0.1', '2012-09-07 07:56:44', '0000-00-00 00:00:00', 'a:8:{s:8:"username";s:0:"";s:8:"password";s:6:"123456";s:9:"firstname";s:4:"Amol";s:8:"lastname";s:7:"Sananse";s:9:"birthdate";s:10:"0000-00-00";s:6:"gender";s:4:"Male";s:9:"userimage";s:14:"1345134686_Ü";s:16:"verificationdate";s:19:"0000-00-00 00:00:00";}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
