-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 07:30 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photo_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photograph_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photograph_id` (`photograph_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photograph_id`, `created`, `author`, `body`) VALUES
(2, 7, '2015-12-19 15:32:59', 'Mainul', 'Awesome!!!'),
(4, 8, '2015-12-21 11:59:39', 'Mainul', 'I love this picture!!!'),
(5, 12, '2016-01-27 09:49:34', 'Mainul Hasan', 'Nice picture!!!!'),
(6, 2, '2016-02-28 10:51:13', 'Zaky', 'I like it....');

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE IF NOT EXISTS `photographs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`id`, `filename`, `type`, `size`, `caption`) VALUES
(2, 'roof.jpg', 'image/jpeg', 524574, 'Roof'),
(7, 'bamboo.jpg', 'image/jpeg', 455568, 'Bamboo'),
(8, 'wood.jpg', 'image/jpeg', 564389, 'Wood'),
(9, 'flowers.jpg', 'image/jpeg', 664947, 'Flowers'),
(10, 'buddhas.jpg', 'image/jpeg', 456234, 'Buddhas'),
(11, 'wall.jpg', 'image/jpeg', 607118, 'Wall'),
(12, '35.jpg', 'image/jpeg', 132027, 'Islamic Image'),
(13, '11392824_676346859136461_137689609580673717_n.jpg', 'image/jpeg', 61937, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`) VALUES
(3, 'sabbir', '456', 'Mahmudul', 'Hasan'),
(4, 'johnsmith', '456', 'John', 'Smith'),
(5, 'Mainul', '456', 'Mainul', 'Hasan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
