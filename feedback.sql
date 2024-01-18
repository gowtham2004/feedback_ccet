-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.40 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for feedback
CREATE DATABASE IF NOT EXISTS `feedback` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `feedback`;

-- Dumping structure for table feedback.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL DEFAULT '0',
  `staffid` int(11) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.feedback: 9 rows
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
REPLACE INTO `feedback` (`ID`, `studentid`, `staffid`, `insertat`, `remarks`) VALUES
	(1, 3, 3, '2024-01-11 06:26:08', 'trtUKYVKGVKHJJhvkusvuyg7x6tuyxv'),
	(2, 4, 3, '2024-01-11 06:26:08', 'ygydvkhwbkdbhwkugvukdvkwhjbduyv'),
	(3, 6, 3, '2024-01-11 06:26:08', 'yugduygxukwvdukwvkdg'),
	(4, 3, 3, '2024-01-10 18:07:47', 'newvjuh'),
	(5, 4, 3, '2024-01-10 18:14:56', 'newyuiuhid'),
	(6, 6, 3, '2024-01-10 18:07:47', 'newiugufoihouvb'),
	(7, 3, 3, '2024-01-18 05:49:39', 'ldhhjaebejhbahldb'),
	(8, 4, 3, '2024-01-18 05:49:39', 'ohiubkje vur5viuiuerf kjbu787488999888....,?ewefkjewbfuhigyug7'),
	(9, 6, 3, '2024-01-18 05:49:39', 'fuiwiufuiewfuewehfuiewhf 48veugy uibjk kjfyubejehj ..rrurvbru');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table feedback.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL DEFAULT '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.staff: 3 rows
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
REPLACE INTO `staff` (`ID`, `name`, `username`, `password`, `insertat`) VALUES
	(1, 'john aron', 'johnaron', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:55:57'),
	(2, 'maria james', 'mariajames', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:13'),
	(3, 'mathew', 'mathew', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:23');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table feedback.student
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

-- Dumping data for table feedback.student: 10 rows
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
REPLACE INTO `student` (`ID`, `rollno`, `photo`, `name`, `dept`, `mentorid`, `insertat`) VALUES
	(1, '21cs062', './student.jpg', 'justien', 'cse', 1, '2024-01-10 08:56:34'),
	(2, '21ee078', './student.jpg', 'robert', 'eee', 2, '2024-01-10 08:56:52'),
	(3, '21cs067', './student.jpg', 'shabby', 'cse', 3, '2024-01-10 08:57:17'),
	(4, '21ee080', './student.jpg', 'stephen', 'eee', 3, '2024-01-10 08:57:35'),
	(5, '21ec090', './student.jpg', 'richart', 'ece', 1, '2024-01-10 08:57:50'),
	(6, '21cs080', './student.jpg', 'graven', 'cse', 3, '2024-01-10 08:58:15'),
	(7, '21me070', './student.jpg', 'stark', 'mech', 2, '2024-01-10 08:58:30'),
	(8, '21cs090', './student.jpg', 'robin', 'cse', 1, '2024-01-10 08:58:47'),
	(9, '21me091', './student.jpg', 'louis', 'mech', 2, '2024-01-10 08:59:22'),
	(10, '21ee099', './student.jpg', 'sam', 'eee', 1, '2024-01-10 08:59:48');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
