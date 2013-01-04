-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 02:45 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telechargeri2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Application`
--

CREATE TABLE IF NOT EXISTS `Application` (
  `id_application` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_application` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_link` varchar(300) NOT NULL,
  `version` varchar(20) NOT NULL,
  `insert_date` varchar(100) NOT NULL,
  `id_category` int(10) unsigned NOT NULL,
  `id_section` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_application`),
  KEY `id_category` (`id_category`),
  KEY `id_section` (`id_section`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `Application`:
--   `id_category`
--       `Category` -> `id_category`
--   `id_section`
--       `Section` -> `id_section`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_category` varchar(30) NOT NULL,
  `id_website` int(10) unsigned NOT NULL,
  `id_os` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `label_category` (`label_category`,`id_website`,`id_os`),
  KEY `id_website` (`id_website`),
  KEY `id_os` (`id_os`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- RELATIONS FOR TABLE `Category`:
--   `id_os`
--       `Os` -> `id_os`
--   `id_website`
--       `Website` -> `id_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `Download_link`
--

CREATE TABLE IF NOT EXISTS `Download_link` (
  `id_download_link` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_download_link` varchar(300) NOT NULL,
  `id_application` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_download_link`),
  KEY `id_application` (`id_application`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `Download_link`:
--   `id_application`
--       `Application` -> `id_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `Os`
--

CREATE TABLE IF NOT EXISTS `Os` (
  `id_os` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_os` varchar(30) NOT NULL,
  `id_website` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_os`),
  UNIQUE KEY `label_os` (`label_os`,`id_website`),
  KEY `id_website` (`id_website`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- RELATIONS FOR TABLE `Os`:
--   `id_website`
--       `Website` -> `id_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `Section`
--

CREATE TABLE IF NOT EXISTS `Section` (
  `id_section` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_section` varchar(30) NOT NULL,
  `id_category` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_section`),
  UNIQUE KEY `label_section` (`label_section`,`id_category`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- RELATIONS FOR TABLE `Section`:
--   `id_category`
--       `Category` -> `id_category`
--

-- --------------------------------------------------------

--
-- Table structure for table `Website`
--

CREATE TABLE IF NOT EXISTS `Website` (
  `id_website` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_website` varchar(70) NOT NULL,
  `language` enum('French','English') NOT NULL,
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `label_website` (`label_website`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Application`
--
ALTER TABLE `Application`
  ADD CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Application_ibfk_2` FOREIGN KEY (`id_section`) REFERENCES `Section` (`id_section`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `Category_ibfk_2` FOREIGN KEY (`id_os`) REFERENCES `Os` (`id_os`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Category_ibfk_1` FOREIGN KEY (`id_website`) REFERENCES `Website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Download_link`
--
ALTER TABLE `Download_link`
  ADD CONSTRAINT `Download_link_ibfk_1` FOREIGN KEY (`id_application`) REFERENCES `Application` (`id_application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Os`
--
ALTER TABLE `Os`
  ADD CONSTRAINT `Os_ibfk_1` FOREIGN KEY (`id_website`) REFERENCES `Website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Section`
--
ALTER TABLE `Section`
  ADD CONSTRAINT `Section_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
