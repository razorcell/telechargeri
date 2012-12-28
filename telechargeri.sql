-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2012 at 03:40 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telechargeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_category` varchar(10) NOT NULL,
  `id_website_os` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `label_category` (`label_category`),
  KEY `fk_id_website_os` (`id_website_os`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `Category`:
--   `id_website_os`
--       `Website_Os` -> `id_website_os`
--

-- --------------------------------------------------------

--
-- Table structure for table `Os`
--

CREATE TABLE IF NOT EXISTS `Os` (
  `id_os` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label_os` varchar(10) NOT NULL,
  PRIMARY KEY (`id_os`),
  UNIQUE KEY `label_os` (`label_os`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Website`
--

CREATE TABLE IF NOT EXISTS `Website` (
  `id_website` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_website` varchar(10) NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'frensh',
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `label_website` (`label_website`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Website_Os`
--

CREATE TABLE IF NOT EXISTS `Website_Os` (
  `id_website_os` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_os` int(10) unsigned NOT NULL,
  `id_website` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_website_os`),
  UNIQUE KEY `index_website_os` (`id_os`,`id_website`),
  KEY `id_website` (`id_website`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `Website_Os`:
--   `id_website`
--       `Website` -> `id_website`
--   `id_os`
--       `Os` -> `id_os`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `fk_id_website_os` FOREIGN KEY (`id_website_os`) REFERENCES `Website_Os` (`id_website_os`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Website_Os`
--
ALTER TABLE `Website_Os`
  ADD CONSTRAINT `Website_Os_ibfk_2` FOREIGN KEY (`id_website`) REFERENCES `Website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Website_Os_ibfk_1` FOREIGN KEY (`id_os`) REFERENCES `Os` (`id_os`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
