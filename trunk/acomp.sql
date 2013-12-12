-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2013 at 12:38 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acomp`
--

-- --------------------------------------------------------

--
-- Table structure for table `9_category`
--

CREATE TABLE IF NOT EXISTS `9_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `9_content`
--

CREATE TABLE IF NOT EXISTS `9_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_category_gid` int(11) DEFAULT NULL,
  `content_gid` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `alias` varchar(500) DEFAULT NULL,
  `intro_text` text,
  `full_text` text NOT NULL,
  `hit` int(11) DEFAULT '0',
  `last_view_date` int(11) DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  `meta_data` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `genabled` tinyint(1) DEFAULT '0',
  `publish_up_date` int(11) DEFAULT '0',
  `publish_down_date` int(11) DEFAULT '0',
  `sorting` int(11) DEFAULT '1',
  `created_date` int(11) DEFAULT NULL,
  `layout` varchar(255) DEFAULT 'front',
  `images` tinytext,
  `update_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `content_category_gid` (`content_category_gid`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `9_content`
--

INSERT INTO `9_content` (`content_id`, `content_category_gid`, `content_gid`, `lang_id`, `title`, `alias`, `intro_text`, `full_text`, `hit`, `last_view_date`, `param`, `meta_data`, `enabled`, `genabled`, `publish_up_date`, `publish_down_date`, `sorting`, `created_date`, `layout`, `images`, `update_date`) VALUES
(1, 5, 1, 1, 'Title', 'title', NULL, '<p>\r\n	ACIS 2014 , NHA TRANG - VIET NAM</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 0, NULL, NULL, NULL, 1, 1, 0, 0, 11, 1386243775, 'front', '', NULL),
(2, 5, 2, 1, 'Welcome', 'welcome', NULL, '<h4>\r\n	OVERVIEW</h4>\r\n<div class="justify">\r\n	<p>\r\n		The Third Asian Conference on Information Systems, ACIS 2014, following the successes of ACIS2012 (Siem Reap, Cambodia) and ACIS 2013 (Phukhet, Thailand) is the meeting of researchers, professionals and practitioners to discuss various current issues in information systems and related areas with a special focus on the current conditions and the future sustainable developments of Asian countries. The ACIS 2014 is organized by the Ho Chi Minh University of Technology, Vietnam National University at Ho Chi Minh City, Nha Trang University, Nha Trang Association of ICT (KAICT), International Institute of Applied Informatics, Japan (IIAI), and Japan Advance Institute of Science and Technology (JAIST). This event aims to bring together many scholars, researchers and managers of various areas and industries for intellectual exchanges, research cooperation and professional development. This conference features two tracks inviting presentations of theoretical research findings and case reports. Moreover, this program also offers excellent networking opportunities to participants, with a wonderful taste of local culture. High quality research papers and case studies are invited to be submitted electronically through the conference&rsquo;s website. The conference areas of interest include, but are not limited to, the following:</p>\r\n	<table>\r\n		<tbody>\r\n			<tr>\r\n				<td>\r\n					Artificial Intelligence<br />\r\n					Data/Text Mining<br />\r\n					Communication Technology<br />\r\n					Image Processing<br />\r\n					Pattern Recognition<br />\r\n					Information/Cyber Security<br />\r\n					Information Retrieval<br />\r\n					Information Extraction<br />\r\n					Intelligent Systems and Agents<br />\r\n					Natural Language Processing<br />\r\n					Ubiquitous Computing<br />\r\n					RFID Technology<br />\r\n					E-health, E-education<br />\r\n					E-government System<br />\r\n					Enterprise Information Systems<br />\r\n					Decision Support Systems<br />\r\n					ICT For Development (ICT4D/ICTD)<br />\r\n					Information Security<br />\r\n					Encryption Technologies<br />\r\n					Knowledge-based System</td>\r\n				<td style="width:50px">\r\n					&nbsp;</td>\r\n				<td>\r\n					Software Engineering<br />\r\n					Learning-Supported System<br />\r\n					Web-based Intelligent Applications<br />\r\n					Innovative Business Models<br />\r\n					Service Design and Engineering<br />\r\n					Service Science and Management<br />\r\n					Service Innovation and Marketing<br />\r\n					E-Services and Service Computing<br />\r\n					Human Resource Service<br />\r\n					Knowledge complexity and metrics<br />\r\n					Knowledge management<br />\r\n					Knowledge representation/reasoning<br />\r\n					Knowledge verification/validation<br />\r\n					Logistics Management and Innovation<br />\r\n					Control Theory and Applications,<br />\r\n					Adaptive and Learning Control<br />\r\n					System, Fuzzy and Neural Control,<br />\r\n					Mechatronics<br />\r\n					Manufacturing Control Systems<br />\r\n					Process Control Systems<br />\r\n					Robotics and Automation</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<hr />\r\n<h4>\r\n	Important Dates</h4>\r\n<div class="justify">\r\n	<table border="1" style="font-weight: bold;font-family:Sans-serif;font-size:14px;">\r\n		<colgroup>\r\n			<col width="150" />\r\n			<col width="500" />\r\n		</colgroup>\r\n		<tbody>\r\n			<tr>\r\n				<td>\r\n					21 Apr</td>\r\n				<td>\r\n					Workshop Proposal</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					5 May</td>\r\n				<td>\r\n					Workshop Notification</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					4 Jul</td>\r\n				<td>\r\n					Paper submission</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					1 Aug</td>\r\n				<td>\r\n					Notification</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					6 Oct</td>\r\n				<td>\r\n					Camera Ready &amp; Early</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					8-10 Dec</td>\r\n				<td>\r\n					Conference</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</div>\r\n<hr />\r\n<h4>\r\n	More Information</h4>\r\n<div class="justify">\r\n	<p>\r\n		Any question can be sent to process, e-mail <a href="mailto:qttho@cse.hcmut.edu.vn">qttho@cse.hcmut.edu.vn</a></p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 0, NULL, NULL, NULL, 1, 1, 0, 0, 10, 1386243805, 'front', '', NULL),
(3, 5, 3, 1, 'Submisson', 'submisson', NULL, '', 0, NULL, NULL, NULL, 1, 1, 0, 0, 9, 1386243845, 'front', '', NULL),
(4, 5, 4, 1, 'Sponsor', 'sponsor', NULL, '', 0, NULL, NULL, NULL, 1, 1, 0, 0, 8, 1386243862, 'front', '', NULL),
(5, 5, 5, 1, 'Committees', 'committees', NULL, '', 0, NULL, NULL, NULL, 1, 1, 0, 0, 7, 1386243895, 'front', '', NULL),
(10, 5, 10, 1, 'Image', '', NULL, '', 0, NULL, NULL, NULL, 1, 1, 0, 0, 1, 1386504946, 'front', 'media/userfiles/images/1.jpg||media/userfiles/images/2.jpg||media/userfiles/images/3.jpg||media/userfiles/images/4.jpg||media/userfiles/images/5.jpg||media/userfiles/images/6.JPG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `9_content_category`
--

CREATE TABLE IF NOT EXISTS `9_content_category` (
  `content_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_category_gid` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `genabled` tinyint(4) DEFAULT '1',
  `parent_genabled` int(11) DEFAULT '1',
  `sorting` int(11) DEFAULT '1',
  `alias` varchar(255) DEFAULT NULL,
  `description` text,
  `created_date` int(11) DEFAULT NULL,
  `content_deleteable` tinyint(1) DEFAULT '1' COMMENT '0: can not delete this category and its content > help us to protect static content; 1: we can do anything',
  `template` varchar(255) DEFAULT NULL COMMENT 'each category can display with different templates',
  `gid_string` varchar(500) DEFAULT NULL COMMENT 'its id & children''s ids: using for get all content in this category',
  `images` tinytext,
  PRIMARY KEY (`content_category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `gid` (`content_category_gid`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `9_content_category`
--

INSERT INTO `9_content_category` (`content_category_id`, `content_category_gid`, `lang_id`, `parent_id`, `name`, `enabled`, `genabled`, `parent_genabled`, `sorting`, `alias`, `description`, `created_date`, `content_deleteable`, `template`, `gid_string`, `images`) VALUES
(6, 5, 1, NULL, 'Static', 1, 1, 1, 2, 'static', '', 1313547463, 0, 'news', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `9_group`
--

CREATE TABLE IF NOT EXISTS `9_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `default` tinyint(1) DEFAULT '0',
  `description` tinytext,
  `color` varchar(10) DEFAULT '#000000',
  `image_url` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `sorting` int(11) DEFAULT '1',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `9_group`
--

INSERT INTO `9_group` (`group_id`, `name`, `default`, `description`, `color`, `image_url`, `enabled`, `sorting`) VALUES
(1, 'Admin', 0, NULL, '#ff0000', NULL, 1, 4),
(2, 'Uploader', 0, '', '#008000', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `9_group_permission`
--

CREATE TABLE IF NOT EXISTS `9_group_permission` (
  `group_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `expand_table_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`group_permission_id`),
  KEY `Ref_04` (`group_id`),
  KEY `Ref_05` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `9_group_permission`
--

INSERT INTO `9_group_permission` (`group_permission_id`, `group_id`, `permission_id`, `expand_table_id`, `enabled`) VALUES
(1, 1, 1, NULL, 1),
(2, 1, 2, NULL, 1),
(3, 1, 17, 1, 1),
(4, 1, 18, 1, 1),
(5, 1, 19, 1, 1),
(7, 1, 21, NULL, 1),
(8, 1, 22, NULL, 1),
(12, 1, 26, NULL, 1),
(13, 1, 25, NULL, 1),
(14, 1, 24, NULL, 1),
(15, 1, 23, NULL, 1),
(16, 1, 9, NULL, 1),
(17, 1, 8, 1, 1),
(18, 1, 7, 1, 1),
(19, 1, 6, 1, 1),
(20, 1, 16, NULL, 1),
(21, 1, 15, NULL, 1),
(22, 1, 14, NULL, 1),
(23, 1, 13, NULL, 1),
(24, 1, 12, NULL, 1),
(25, 1, 11, NULL, 1),
(26, 1, 10, NULL, 1),
(29, 1, 36, NULL, 1),
(32, 2, 1, NULL, 1),
(33, 2, 36, NULL, 0),
(34, 1, 37, NULL, 1),
(35, 1, 38, NULL, 1),
(36, 1, 33, NULL, 1),
(37, 1, 32, NULL, 1),
(38, 1, 31, NULL, 1),
(39, 2, 33, NULL, 1),
(40, 2, 32, NULL, 1),
(41, 2, 31, NULL, 1),
(46, 2, 2, NULL, 1),
(47, 1, 27, 1, 1),
(48, 1, 28, 1, 1),
(49, 1, 29, 1, 1),
(50, 1, 66, 1, 1),
(51, 1, 67, 1, 1),
(52, 1, 68, 1, 1),
(53, 1, 69, NULL, 1),
(54, 1, 39, 1, 1),
(55, 1, 40, 1, 1),
(56, 1, 41, 1, 1),
(57, 1, 42, NULL, 1),
(58, 1, 34, NULL, 1),
(59, 1, 35, NULL, 1),
(60, 1, 45, NULL, 1),
(61, 1, 46, NULL, 1),
(62, 1, 47, NULL, 1),
(63, 1, 48, 1, 1),
(64, 1, 48, 2, 1),
(65, 1, 48, 3, 1),
(66, 1, 49, NULL, 1),
(67, 1, 50, NULL, 1),
(68, 1, 51, NULL, 1),
(69, 1, 52, NULL, 1),
(70, 1, 53, NULL, 1),
(71, 1, 54, NULL, 1),
(72, 1, 59, NULL, 1),
(73, 1, 60, NULL, 1),
(74, 1, 61, NULL, 1),
(75, 1, 62, NULL, 1),
(76, 1, 63, NULL, 1),
(77, 1, 64, NULL, 1),
(78, 1, 65, NULL, 1),
(79, 1, 70, NULL, 1),
(80, 1, 71, NULL, 1),
(81, 1, 72, NULL, 1),
(82, 1, 73, NULL, 1),
(83, 1, 74, NULL, 1),
(84, 1, 75, NULL, 1),
(85, 1, 76, NULL, 1),
(86, 1, 77, NULL, 1),
(87, 2, 70, NULL, 1),
(88, 2, 71, NULL, 1),
(89, 2, 72, NULL, 1),
(90, 2, 73, NULL, 1),
(91, 2, 13, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `9_lang`
--

CREATE TABLE IF NOT EXISTS `9_lang` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(5) NOT NULL,
  `lang_image` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `sorting` int(11) DEFAULT '1',
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `9_lang`
--

INSERT INTO `9_lang` (`lang_id`, `lang_code`, `lang_image`, `enabled`, `name`, `sorting`) VALUES
(1, 'en', 'media/userfiles/images/icons/flags/language/16/en.png', 1, 'English', 2);

-- --------------------------------------------------------

--
-- Table structure for table `9_list`
--

CREATE TABLE IF NOT EXISTS `9_list` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `custom_value` text,
  `parent_id` int(11) DEFAULT NULL,
  `sorting` int(11) DEFAULT '1',
  PRIMARY KEY (`list_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `9_list`
--

INSERT INTO `9_list` (`list_id`, `name`, `custom_value`, `parent_id`, `sorting`) VALUES
(1, 'Online support', '', NULL, 1),
(2, 'Consulting-support', NULL, NULL, 1),
(3, 'Yahoo', '', 1, 1),
(4, 'Skype', 'dongpham77', 1, 1),
(5, 'Phone', '', 2, 1),
(6, 'Email', '0918 431 802 (Mr.Äá»“ng)', 7, 1),
(7, '0918 431 802 (Mr. Äá»“ng)', '', 5, 1),
(8, '0908 504 816 (Ms. Ãnh)', '', 5, 1),
(9, 'BÃ¬nh DÆ°Æ¡ng', 'audit_ttv', 3, 1),
(10, 'TÃ¢y Ninh', 'newqueenbee', 3, 1),
(11, 'PhÃº YÃªn', 'xitin88xitin88', 3, 1),
(12, 'Skype (Mr. Äá»“ng)', 'dongpham77', 4, 1),
(13, 'info@trithucviet.com.vn', '', 6, 1),
(14, 'Training', NULL, NULL, 1),
(15, 'Ã‚m nháº¡c', '', 14, 1),
(16, 'Kiá»ƒm toÃ¡n', '', 14, 1),
(17, 'Váº­n chuyá»ƒn', '', 14, 1),
(18, 'City', NULL, NULL, 1),
(19, 'Job', NULL, NULL, 1),
(20, 'Source', NULL, NULL, 1),
(21, 'Há»“ ChÃ­ Minh', '', 18, 1),
(22, 'CÃ  Mau', '', 18, 1),
(23, 'BÃ¬nh DÆ°Æ¡ng', '', 18, 1),
(24, 'PhÃº YÃªn', '', 18, 1),
(25, 'Sinh viÃªn', '', 19, 1),
(26, 'Äang Ä‘i lÃ m', '', 19, 1),
(27, 'Há»c sinh', '', 19, 1),
(28, 'Nghá» khÃ¡c', '', 19, 1),
(29, 'BÃ¡o chÃ­', '', 20, 1),
(30, 'Internet', '', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `9_mail`
--

CREATE TABLE IF NOT EXISTS `9_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_gid` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` tinytext,
  `subject` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`mail_id`),
  KEY `mail_gid` (`mail_gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=7 ;

--
-- Dumping data for table `9_mail`
--

INSERT INTO `9_mail` (`mail_id`, `mail_gid`, `lang_id`, `name`, `data`, `subject`, `content`) VALUES
(1, 1, 1, 'contact', '[NAME]<br/>[MAIL]<br/>[ADR]<br/>[PHONE]<br/>[CONTENT]<br/>[CAPTCHA]', 'Contact', '<p>\r\n	Ch&agrave;o Admin,</p>\r\n<p>\r\n	Báº¡n c&oacute; má»™t thÆ° li&ecirc;n há»‡ vá»›i nhá»¯ng th&ocirc;ng tin sau:</p>\r\n<p>\r\n	- T&ecirc;n: [NAME]</p>\r\n<p>\r\n	- Email: [MAIL]</p>\r\n<p>\r\n	- Äá»‹a chá»‰: [ADR]</p>\r\n<p>\r\n	- Äiá»‡n thoáº¡i: [PHONE]</p>\r\n<p>\r\n	- Ná»™i dung:</p>\r\n<p>\r\n	[CONTENT].</p>\r\n'),
(2, 1, 2, 'contact', '[NAME]<br/>[MAIL]<br/>[ADR]<br/>[PHONE]<br/>[CONTENT]<br/>[CAPTCHA]', 'LiÃªn há»‡', '<p>\r\n	Ch&agrave;o Admin,</p>\r\n<p>\r\n	Báº¡n c&oacute; má»™t thÆ° li&ecirc;n há»‡ vá»›i nhá»¯ng th&ocirc;ng tin sau:</p>\r\n<p>\r\n	- T&ecirc;n: [NAME]</p>\r\n<p>\r\n	- Email: [MAIL]</p>\r\n<p>\r\n	- Äá»‹a chá»‰: [ADR]</p>\r\n<p>\r\n	- Äiá»‡n thoáº¡i: [PHONE]</p>\r\n<p>\r\n	- Ná»™i dung:</p>\r\n<p>\r\n	[CONTENT].</p>\r\n'),
(4, 1, 3, 'contact', '[NAME]<br/>[MAIL]<br/>[ADR]<br/>[PHONE]<br/>[CONTENT]<br/>[CAPTCHA]', 'Contact', '<p>\r\n	Ch&agrave;o Admin,</p>\r\n<p>\r\n	Báº¡n c&oacute; má»™t thÆ° li&ecirc;n há»‡ vá»›i nhá»¯ng th&ocirc;ng tin sau:</p>\r\n<p>\r\n	- T&ecirc;n: [NAME]</p>\r\n<p>\r\n	- Email: [MAIL]</p>\r\n<p>\r\n	- Äá»‹a chá»‰: [ADR]</p>\r\n<p>\r\n	- Äiá»‡n thoáº¡i: [PHONE]</p>\r\n<p>\r\n	- Ná»™i dung:</p>\r\n<p>\r\n	[CONTENT].</p>\r\n'),
(5, 3, 1, 'register', '[NAME]<br/>[SEX]<br/>[DATE]<br/>[MONTH]<br/>[YEAR]<br/>[ADDRESS]<br/>[PROVINCE]<br/>[EMAIL]<br/>[PHONE]<br/>[JOB]<br/>[PROGRAM]<br/>[SOURCE]<br/>[COMMENT]', 'register', ''),
(6, 3, 2, 'register', '[NAME]<br/>[SEX]<br/>[DATE]<br/>[MONTH]<br/>[YEAR]<br/>[ADDRESS]<br/>[PROVINCE]<br/>[EMAIL]<br/>[PHONE]<br/>[JOB]<br/>[PROGRAM]<br/>[SOURCE]<br/>[COMMENT]', 'Dang ki', '<p>\r\n	Ch&agrave;o Admin,</p>\r\n<p>\r\n	Báº¡n c&oacute; má»™t thÆ° Ä‘Äƒng k&iacute; vá»›i nhá»¯ng th&ocirc;ng tin sau:</p>\r\n<p>\r\n	- T&ecirc;n: [NAME]</p>\r\n<p>\r\n	- Giá»›i t&iacute;nh: [SEX]</p>\r\n<p>\r\n	- Ng&agrave;y sinh: [DATE] - [MONTH] - [YEAR]</p>\r\n<p>\r\n	- Email: [EMAIL]</p>\r\n<p>\r\n	- Äá»‹a chá»‰: [ADDRESS]</p>\r\n<p>\r\n	- Äiá»‡n thoáº¡i: [PHONE]</p>\r\n<p>\r\n	- Tá»‰nh/Th&agrave;nh phá»‘: [PROVINCE]</p>\r\n<p>\r\n	- C&ocirc;ng viá»‡c: [JOB]</p>\r\n<p>\r\n	- ChÆ°Æ¡ng tr&igrave;nh Ä‘&agrave;o táº¡o: [PROGRAM]</p>\r\n<p>\r\n	- Nguá»“n th&ocirc;ng tin: [SOURCE]</p>\r\n<p>\r\n	- Ná»™i dung:</p>\r\n<p>\r\n	[COMMENT]</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `9_permission`
--

CREATE TABLE IF NOT EXISTS `9_permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `expand_table_name` varchar(255) DEFAULT NULL,
  `expand_table_id` varchar(255) DEFAULT NULL,
  `expand_display_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `9_permission`
--

INSERT INTO `9_permission` (`permission_id`, `name`, `module`, `description`, `expand_table_name`, `expand_table_id`, `expand_display_name`) VALUES
(1, 'access', 'application::admin', 'Access to ''admin'' application', NULL, NULL, NULL),
(2, 'access', 'application::front', 'Access to ''front'' application', NULL, NULL, NULL),
(6, 'see_scontent', 'scontent', 'See all articles/categories', '9_lang', 'lang_id', 'name'),
(7, 'new_scontent', 'scontent', 'Create new article', '9_lang', 'lang_id', 'name'),
(8, 'edit_scontent', 'scontent', 'Edit existed articles', '9_lang', 'lang_id', 'name'),
(9, 'delete_scontent', 'scontent', 'Delete existed articles', NULL, NULL, NULL),
(10, 'see_user', 'user', 'See all users', NULL, NULL, NULL),
(11, 'new_user', 'user', 'Create new user', NULL, NULL, NULL),
(12, 'delete_user', 'user', 'Delete existing user', NULL, NULL, NULL),
(13, 'edit_user', 'user', 'Edit existing user', NULL, NULL, NULL),
(14, 'change_group', 'user', 'Change current group to another group', NULL, NULL, NULL),
(15, 'see_group', 'user', 'See all groups', NULL, NULL, NULL),
(16, 'edit_group', 'user', 'Edit existing group', NULL, NULL, NULL),
(17, 'see_newsletter_mail', 'mail', 'See all newsletter mails', '9_lang', 'lang_id', 'name'),
(18, 'new_newsletter_mail', 'mail', 'Create new newsletter mail', '9_lang', 'lang_id', 'name'),
(19, 'edit_newsletter_mail', 'mail', 'Edit existed newsletter mails', '9_lang', 'lang_id', 'name'),
(21, 'edit_system_mail', 'mail', 'Edit system mails', NULL, NULL, NULL),
(22, 'see_system_mail', 'mail', 'See system mails', NULL, NULL, NULL),
(23, 'see_prospect', 'prospect', 'See all prospects', NULL, NULL, NULL),
(24, 'new_prospect', 'prospect', 'Create new prospect', NULL, NULL, NULL),
(25, 'delete_prospect', 'prospect', 'Delete existed prospect', NULL, NULL, NULL),
(26, 'edit_prospect', 'prospect', 'Edit existed prospect', NULL, NULL, NULL),
(27, 'see_content', 'content', 'See all articles', '9_lang', 'lang_id', 'name'),
(28, 'new_content', 'content', 'Create new article', '9_lang', 'lang_id', 'name'),
(29, 'edit_content', 'content', 'Edit existed articles', '9_lang', 'lang_id', 'name'),
(30, 'delete_content', 'content', 'Delete existed articles', NULL, NULL, NULL),
(31, 'see_feedback', 'feedback', 'See all feedbacks', NULL, NULL, NULL),
(32, 'delete_feedback', 'feedback', 'Delete existing feedback', NULL, NULL, NULL),
(33, 'edit_feedback', 'feedback', 'Edit existing feedback', NULL, NULL, NULL),
(34, 'see_list', 'list', 'See all list', NULL, NULL, NULL),
(35, 'see_value', 'list', 'See all list''s values', NULL, NULL, NULL),
(36, 'manage_feedback', 'permission', 'Enable/Disable permission', NULL, NULL, NULL),
(37, 'see_permission', 'permission', 'See all permissions', NULL, NULL, NULL),
(38, 'rescan_permission', 'permission', 'Rescan all permissions', NULL, NULL, NULL),
(39, 'see_newsletter_mail', 'subcriber', 'See all newsletter mails', '9_lang', 'lang_id', 'name'),
(40, 'new_newsletter_mail', 'subcriber', 'Create new newsletter mail', '9_lang', 'lang_id', 'name'),
(41, 'edit_newsletter_mail', 'subcriber', 'Edit existed newsletter mails', '9_lang', 'lang_id', 'name'),
(42, 'delete_newsletter_mail', 'subcriber', 'Delete existed newsletter mails', NULL, NULL, NULL),
(43, 'edit_system_mail', 'subcriber', 'Edit system mails', NULL, NULL, NULL),
(44, 'see_system_mail', 'subcriber', 'See system mails', NULL, NULL, NULL),
(45, 'new_list', 'list', 'New list', NULL, NULL, NULL),
(46, 'edit_permission', 'permission', 'Edit permission', NULL, NULL, NULL),
(47, 'see_lang', 'lang', 'See all langs', NULL, NULL, NULL),
(48, 'see_all_mails', 'mail', 'See all mails', '9_lang', 'lang_id', 'name'),
(49, 'delete_mail', 'mail', 'Delete existed mails', NULL, NULL, NULL),
(50, 'see_translation', 'language', 'See all translation ', NULL, NULL, NULL),
(51, 'see_ads', 'ads', 'See all ads', NULL, NULL, NULL),
(52, 'new_ads', 'ads', 'Create new ads', NULL, NULL, NULL),
(53, 'edit_ads', 'ads', 'Edit existed ads', NULL, NULL, NULL),
(54, 'delete_ads', 'ads', 'Delete existed ads', NULL, NULL, NULL),
(55, 'see_product', 'product', 'See all articles/categories', 'nine_lang', 'lang_id', 'name'),
(56, 'new_product', 'product', 'Create new article', 'nine_lang', 'lang_id', 'name'),
(57, 'edit_product', 'product', 'Edit existed articles', 'nine_lang', 'lang_id', 'name'),
(58, 'delete_product', 'product', 'Delete existed articles', NULL, NULL, NULL),
(59, 'see_document', 'document', 'See all documents/categories', NULL, NULL, NULL),
(60, 'new_document', 'document', 'Create new document', NULL, NULL, NULL),
(61, 'edit_document', 'document', 'Edit existed document', NULL, NULL, NULL),
(62, 'delete_document', 'document', 'Delete existed document', NULL, NULL, NULL),
(63, 'see_permission', 'default', 'See all permissions', NULL, NULL, NULL),
(64, 'rescan_permission', 'default', 'Rescan all permissions', NULL, NULL, NULL),
(65, 'manage_feedback', 'default', 'Enable/Disable permission', NULL, NULL, NULL),
(66, 'see_category', 'content', 'See all categories', '9_lang', 'lang_id', 'name'),
(67, 'new_category', 'content', 'Create new category', '9_lang', 'lang_id', 'name'),
(68, 'edit_category', 'content', 'Edit existed categories', '9_lang', 'lang_id', 'name'),
(69, 'delete_category', 'content', 'Delete existed categories', NULL, NULL, NULL),
(70, 'see_download', 'download', 'See all downloads', NULL, NULL, NULL),
(71, 'new_download', 'download', 'Create new download', NULL, NULL, NULL),
(72, 'edit_download', 'download', 'Edit existed download', NULL, NULL, NULL),
(73, 'delete_download', 'download', 'Delete existed download', NULL, NULL, NULL),
(74, 'see_recruitment', 'recruitment', 'See all recruitments', NULL, NULL, NULL),
(75, 'new_recruitment', 'recruitment', 'Create new recruitment', NULL, NULL, NULL),
(76, 'edit_recruitment', 'recruitment', 'Edit existed recruitment', NULL, NULL, NULL),
(77, 'delete_recruitment', 'recruitment', 'Delete existed recruitment', NULL, NULL, NULL),
(78, 'edit_uploader', 'user', 'Edit user uploader', NULL, NULL, NULL),
(79, 'see_my_upload', 'download', 'See my upload', NULL, NULL, NULL),
(80, 'see_uploader', 'download', 'Edit existed uploader', NULL, NULL, NULL),
(81, 'delete_uploader', 'download', 'Delete existed uploader', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `9_user`
--

CREATE TABLE IF NOT EXISTS `9_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '1',
  `last_login_date` int(11) DEFAULT NULL,
  `security_question` int(11) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `active_code` varchar(255) DEFAULT NULL,
  `active_expired_date` int(11) DEFAULT NULL,
  `forgot_password_code` varchar(255) DEFAULT NULL,
  `forgot_password_expired_date` int(11) DEFAULT NULL,
  `admin_note` tinytext,
  PRIMARY KEY (`user_id`),
  KEY `Ref_01` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `9_user`
--

INSERT INTO `9_user` (`user_id`, `group_id`, `username`, `email`, `full_name`, `first_name`, `last_name`, `password`, `created_date`, `enabled`, `last_login_date`, `security_question`, `security_answer`, `active_code`, `active_expired_date`, `forgot_password_code`, `forgot_password_expired_date`, `admin_note`) VALUES
(1, 1, 'admin', 'hitam.ntt@gmail.com', 'Admin Admin', 'Admin', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 1284310752, 1, 1386503831, NULL, NULL, NULL, NULL, NULL, NULL, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `9_content`
--
ALTER TABLE `9_content`
  ADD CONSTRAINT `9_content_ibfk_1` FOREIGN KEY (`content_category_gid`) REFERENCES `9_content_category` (`content_category_gid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `9_content_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `9_lang` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `9_content_category`
--
ALTER TABLE `9_content_category`
  ADD CONSTRAINT `9_content_category_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `9_lang` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `9_content_category_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `9_content_category` (`content_category_gid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `9_group_permission`
--
ALTER TABLE `9_group_permission`
  ADD CONSTRAINT `Ref_04` FOREIGN KEY (`group_id`) REFERENCES `9_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ref_05` FOREIGN KEY (`permission_id`) REFERENCES `9_permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `9_list`
--
ALTER TABLE `9_list`
  ADD CONSTRAINT `9_list_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `9_list` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `9_user`
--
ALTER TABLE `9_user`
  ADD CONSTRAINT `Ref_01` FOREIGN KEY (`group_id`) REFERENCES `9_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
