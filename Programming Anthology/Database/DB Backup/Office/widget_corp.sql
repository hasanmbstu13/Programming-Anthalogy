-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 07:31 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `widget_corp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `hashed_password`) VALUES
(1, 'Mainul Hasan', '$2y$10$Salt22CharactersOrMore/UvSPz8HErJGUfkhHlBarEkJmNyYvNm'),
(2, 'Mehedi Hasan', '$2y$10$Salt22CharactersOrMorejmU7VeIPKZQ9brPap37/55Iwm5uGP4e'),
(4, 'sabbir', '$2y$10$Salt22CharactersOrMoreB9OJG3wXN.zepo2fptzXdEfMu94jo3C'),
(5, 'faruk', '$2y$10$Salt22CharactersOrMoreT2FxJwS5lQI0/aN6spBDdIB1c8gJSs.');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(1, 1, 'Our Mission', 1, 1, '                                Our mission has always been............Continued                        '),
(2, 1, 'Our History', 2, 1, 'Founded in 1988 by two enterprising engineers...'),
(3, 2, 'Large Widgets', 1, 1, '                                        Our large widgets have to be seen to be believed...\r\n\r\nTrust me.........  ''<br>'' echo............... $............ <h1> <table>\r\n                         '),
(4, 2, 'Small Widgets', 2, 1, 'They say big things come in small packages...'),
(5, 3, 'Retrofitting', 1, 1, 'We love to replace widgets...'),
(6, 3, 'Certification', 2, 1, 'We can certify any widget, not just our own...'),
(7, 1, 'New Subject', 3, 0, '        This is new subject.........      '),
(8, 4, 'Miscellaneous', 1, 1, 'This is most miscellaneous topics and also interesting topics.........                           ');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'About Widget Corp', 1, 1),
(2, 'Products', 2, 1),
(3, 'Services', 3, 1),
(4, 'Misc', 4, 0),
(6, 'Edit me', 4, 1),
(7, 'Delete me', 4, 1),
(8, 'Today''s Widget Trivia', 4, 1),
(13, 'Sample Subject', 12, 1),
(14, 'Foods', 9, 0),
(15, 'Holiday', 1, 1),
(16, 'Eid Festival', 9, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
