-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
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
CREATE DATABASE IF NOT EXISTS `feedback` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `feedback`;

-- Dumping structure for table feedback.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `studentid` int NOT NULL DEFAULT '0',
  `staffid` int NOT NULL DEFAULT '0',
  `feedback` text NOT NULL,
  `insertat` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.feedback: 0 rows
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table feedback.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.staff: 3 rows
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`ID`, `name`, `insertat`) VALUES
	(1, 'john aron', '2024-01-10 08:55:57'),
	(2, 'maria james', '2024-01-10 08:56:13'),
	(3, 'mathew', '2024-01-10 08:56:23');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table feedback.student
CREATE TABLE IF NOT EXISTS `student` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `dept` varchar(50) NOT NULL DEFAULT '0',
  `mentor id` int NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.student: 10 rows
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`ID`, `name`, `dept`, `mentor id`, `insertat`) VALUES
	(1, 'justien', 'cse', 1, '2024-01-10 08:56:34'),
	(2, 'robert', 'eee', 2, '2024-01-10 08:56:52'),
	(3, 'shabby', 'cse', 0, '2024-01-10 08:57:17'),
	(4, 'stephen', 'eee', 0, '2024-01-10 08:57:35'),
	(5, 'richart', 'ece', 1, '2024-01-10 08:57:50'),
	(6, 'graven', 'cse', 0, '2024-01-10 08:58:15'),
	(7, 'stark', 'mech', 2, '2024-01-10 08:58:30'),
	(8, 'robin', 'cse', 1, '2024-01-10 08:58:47'),
	(9, 'louis', 'mech', 2, '2024-01-10 08:59:22'),
	(10, 'sam', 'eee', 1, '2024-01-10 08:59:48');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
