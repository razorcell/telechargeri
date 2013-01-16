-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 07 Janvier 2013 à 19:58
-- Version du serveur: 5.5.27
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `telechargeri`
--

-- --------------------------------------------------------

--
-- Structure de la table `Application`
--

CREATE TABLE IF NOT EXISTS `Application` (
  `id_application` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_application` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image_link` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `insert_date` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id_category` int(10) unsigned NOT NULL,
  `id_section` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_application`),
  KEY `id_category` (`id_category`),
  KEY `id_section` (`id_section`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=936 ;

-- --------------------------------------------------------

--
-- Structure de la table `Category`
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
-- Contenu de la table `Category`
--

INSERT INTO `Category` (`id_category`, `label_category`, `id_website`, `id_os`) VALUES
(8, 'audio_et_musique', 1, 2),
(9, 'bourse_gestion_comptabilite', 1, 2),
(1, 'Bureautique', 1, 1),
(10, 'Bureautique', 1, 2),
(3, 'Internet', 1, 1),
(12, 'Internet', 1, 2),
(4, 'Multimedia', 1, 1),
(7, 'Personnaliser', 1, 1),
(2, 'Programmation', 1, 1),
(11, 'Programmation', 1, 2),
(5, 'Securite', 1, 1),
(6, 'Utilitaire', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Download_link`
--

CREATE TABLE IF NOT EXISTS `Download_link` (
  `id_download_link` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_download_link` varchar(300) CHARACTER SET utf8 NOT NULL,
  `id_application` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_download_link`),
  KEY `id_application` (`id_application`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Structure de la table `Os`
--

CREATE TABLE IF NOT EXISTS `Os` (
  `id_os` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_os` varchar(30) NOT NULL,
  `id_website` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_os`),
  UNIQUE KEY `label_os` (`label_os`,`id_website`),
  KEY `id_website` (`id_website`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Os`
--

INSERT INTO `Os` (`id_os`, `label_os`, `id_website`) VALUES
(3, 'linux', 1),
(2, 'mac', 1),
(1, 'windows', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Section`
--

CREATE TABLE IF NOT EXISTS `Section` (
  `id_section` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_section` varchar(30) NOT NULL,
  `id_category` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_section`),
  UNIQUE KEY `label_section` (`label_section`,`id_category`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `Section`
--

INSERT INTO `Section` (`id_section`, `label_section`, `id_category`) VALUES
(46, 'accessoires_pour_winamp', 4),
(16, 'active_x', 2),
(1, 'agenda', 1),
(47, 'albmums_et_visionneuses', 4),
(48, 'animation_2d_et_3d', 4),
(26, 'aspirateur', 3),
(2, 'base_de_donne', 1),
(17, 'base_de_donne', 2),
(3, 'bourse_et_finance', 1),
(4, 'calculatrice', 1),
(49, 'cao_et_dao', 4),
(50, 'capture_ecran', 4),
(19, 'cgi_et_perl', 2),
(51, 'codecs', 4),
(28, 'commerce', 3),
(29, 'communautes', 3),
(30, 'communication', 3),
(5, 'comptabilite', 1),
(31, 'connection', 3),
(6, 'convertisseur_monetaire', 1),
(32, 'courrier_email', 3),
(20, 'creation', 2),
(52, 'creation_graphique', 4),
(33, 'editeur_de_site', 3),
(7, 'editeur_de_texte', 1),
(53, 'edition_audio', 4),
(54, 'edition_video', 4),
(55, 'encodeurs_et_decodeurs', 4),
(27, 'ftp', 3),
(34, 'gadgets-windows-vista', 3),
(8, 'gestion_argent_temps', 1),
(9, 'gestion_k7_dvd_cd_vin', 1),
(35, 'gestion_site', 3),
(44, 'internet_utlitaire', 3),
(36, 'intranets', 3),
(21, 'java', 2),
(22, 'javaapplet', 2),
(23, 'javascript', 2),
(18, 'langage', 2),
(56, 'lecteurs_audio_mp3_cd', 4),
(57, 'lecteurs_video_dvd', 4),
(37, 'moteur_rech', 3),
(38, 'navigateur', 3),
(10, 'organiseurs', 1),
(58, 'outils_internet', 4),
(39, 'partage', 3),
(59, 'photo_numerique', 4),
(40, 'plugins', 3),
(60, 'plugins_audio_video', 4),
(61, 'plugins_graphiques', 4),
(11, 'police', 1),
(12, 'presentation', 1),
(24, 'referencer', 2),
(41, 'referencer', 3),
(62, 'scanner_ocr', 4),
(42, 'serveur_ftp', 3),
(25, 'sript_macro', 2),
(13, 'tableur', 1),
(43, 'tarif_internet', 3),
(14, 'telephonie', 1),
(15, 'traducteur', 1),
(45, 'vrml', 3),
(63, 'webcam_et_surveillance', 4);

-- --------------------------------------------------------

--
-- Structure de la table `Status`
--

CREATE TABLE IF NOT EXISTS `Status` (
  `scanned_apps` int(11) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `website` varchar(30) DEFAULT NULL,
  `os` varchar(30) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `section` varchar(30) DEFAULT NULL,
  `list_link` text,
  `application_link` text,
  `application_name` text CHARACTER SET utf8,
  `downloaded_pages` int(11) DEFAULT NULL,
  `applications_added` int(11) DEFAULT NULL,
  `applications_updated` int(11) DEFAULT NULL,
  `progression_section` int(11) DEFAULT NULL,
  `total_section` int(11) DEFAULT NULL,
  `progression_category` int(11) DEFAULT NULL,
  `total_category` int(11) DEFAULT NULL,
  `progression_os` int(11) DEFAULT NULL,
  `total_os` int(11) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `current_proxy` varchar(30) DEFAULT NULL,
  `total_proxies` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Status`
--

INSERT INTO `Status` (`scanned_apps`, `id`, `website`, `os`, `category`, `section`, `list_link`, `application_link`, `application_name`, `downloaded_pages`, `applications_added`, `applications_updated`, `progression_section`, `total_section`, `progression_category`, `total_category`, `progression_os`, `total_os`, `start_time`, `current_proxy`, `total_proxies`) VALUES
(33, 1, '01net.com', 'windows', 'Bureautique', 'agenda', 'www.01net.com/windows/Bureautique/agenda/index5.html', '/telecharger/windows/Bureautique/agenda/fiches/100630.html', 'Agenda, alarme, planificateur', 89, 0, 0, 0, 1, 0, 12, 0, 3, '1357577619', '173.213.108.112:3128', 25);

-- --------------------------------------------------------

--
-- Structure de la table `Website`
--

CREATE TABLE IF NOT EXISTS `Website` (
  `id_website` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label_website` varchar(70) NOT NULL,
  `language` enum('French','English') NOT NULL,
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `label_website` (`label_website`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Website`
--

INSERT INTO `Website` (`id_website`, `label_website`, `language`) VALUES
(1, '01net.com', 'French');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Application`
--
ALTER TABLE `Application`
  ADD CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Application_ibfk_2` FOREIGN KEY (`id_section`) REFERENCES `Section` (`id_section`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `Category_ibfk_1` FOREIGN KEY (`id_website`) REFERENCES `Website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Category_ibfk_2` FOREIGN KEY (`id_os`) REFERENCES `Os` (`id_os`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Download_link`
--
ALTER TABLE `Download_link`
  ADD CONSTRAINT `Download_link_ibfk_1` FOREIGN KEY (`id_application`) REFERENCES `Application` (`id_application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Os`
--
ALTER TABLE `Os`
  ADD CONSTRAINT `Os_ibfk_1` FOREIGN KEY (`id_website`) REFERENCES `Website` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Section`
--
ALTER TABLE `Section`
  ADD CONSTRAINT `Section_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
