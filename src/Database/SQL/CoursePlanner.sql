-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2016 at 07:15 AM
-- Server version: 5.5.52
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CoursePlanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course Feature`
--

CREATE TABLE IF NOT EXISTS `Course Feature` (
  `Feature Name` char(255) DEFAULT NULL,
  `Rating` int(5) unsigned DEFAULT NULL COMMENT 'Difficulty Rating',
  `Type` varchar(255) DEFAULT NULL COMMENT 'Category of feature',
  `Due Date` date DEFAULT NULL,
  `Course` char(7) DEFAULT NULL,
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`),
  KEY `Rating` (`Rating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE IF NOT EXISTS `Courses` (
  `Course Code` char(8) DEFAULT NULL COMMENT 'Course codes assigned by instituiton offering the course.',
  `Day(s) of Week` bit(7) DEFAULT NULL COMMENT 'Day(s) of the week the course meets',
  `Description` text,
  `Instructor` varchar(60) DEFAULT NULL,
  `Textbook` tinytext,
  `Time` time DEFAULT NULL COMMENT 'Time of the day the course meets',
  `ID` smallint(255) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique ID for each course',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Course Code` (`Course Code`),
  KEY `Day(s) of Week` (`Day(s) of Week`,`Instructor`,`Time`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`Course Code`, `Day(s) of Week`, `Description`, `Instructor`, `Textbook`, `Time`, `ID`) VALUES
('CPEN 321', b'0000000', 'Software Engineering\r\n\r\nEngineering practices for the development of non-trivial software-intensive systems including requirements specification, software architecture, implementation, verification, and maintenance. Iterative development. Recognized standards, guidelines, and models. ', 'AGHAREBPARAST, FARSHID; GOPALAKRISHNAN, SATHISH', NULL, '12:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `User Profile`
--

CREATE TABLE IF NOT EXISTS `User Profile` (
  `Name` varchar(40) DEFAULT NULL,
  `Registration Date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ID` tinyint(255) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
