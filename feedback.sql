-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2024 at 04:09 PM
-- Server version: 5.7.40
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL DEFAULT '0',
  `staffid` int(11) NOT NULL DEFAULT '0',
  `feedback` text NOT NULL,
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `studentid`, `staffid`, `feedback`, `insertat`) VALUES
(1, 1, 1, 'good', '2024-01-10 13:20:45'),
(2, 1, 1, '123', '2024-01-10 13:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `name`, `username`, `password`, `insertat`) VALUES
(1, 'john aron', 'johnaron', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:55:57'),
(2, 'maria james', 'mariajames', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:13'),
(3, 'mathew', 'mathew', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` varchar(10) NOT NULL,
  `photo` varchar(150) DEFAULT './student.jpg',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `dept` varchar(50) NOT NULL DEFAULT '0',
  `mentorid` int(11) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `rollno` (`rollno`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `rollno`, `photo`, `name`, `dept`, `mentorid`, `insertat`) VALUES
(1, '21cs062', './student.jpg', 'justien', 'cse', 1, '2024-01-10 08:56:34'),
(2, '21ee078', './student.jpg', 'robert', 'eee', 2, '2024-01-10 08:56:52'),
(3, '21cs067', './student.jpg', 'shabby', 'cse', 0, '2024-01-10 08:57:17'),
(4, '21ee080', './student.jpg', 'stephen', 'eee', 0, '2024-01-10 08:57:35'),
(5, '21ec090', './student.jpg', 'richart', 'ece', 1, '2024-01-10 08:57:50'),
(6, '21cs080', './student.jpg', 'graven', 'cse', 0, '2024-01-10 08:58:15'),
(7, '21me070', './student.jpg', 'stark', 'mech', 2, '2024-01-10 08:58:30'),
(8, '21cs090', './student.jpg', 'robin', 'cse', 1, '2024-01-10 08:58:47'),
(9, '21me091', './student.jpg', 'louis', 'mech', 2, '2024-01-10 08:59:22'),
(10, '21ee099', './student.jpg', 'sam', 'eee', 1, '2024-01-10 08:59:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
