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
CREATE DATABASE IF NOT EXISTS `feedback` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `feedback`;

-- Dumping structure for table feedback.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL DEFAULT '0',
  `staffid` varchar(12) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.feedback: 3 rows
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
REPLACE INTO `feedback` (`id`, `studentid`, `staffid`, `insertat`, `remarks`) VALUES
	(1, 16, 'CCET0003', '2024-01-21 11:43:53', 'asdfghjkl'),
	(2, 19, 'CCET0003', '2024-01-21 11:44:32', 'zxcvbnm,'),
	(3, 20, 'CCET0003', '2024-01-21 11:44:50', 'qawsedrftgyhujiko');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table feedback.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `faculty_id` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.staff: 3 rows
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
REPLACE INTO `staff` (`id`, `name`, `username`, `password`, `insertat`, `faculty_id`) VALUES
	(1, 'john aron', 'johnaron', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:55:57', 'CCET0001'),
	(2, 'maria james', 'mariajames', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:13', 'CCET0002'),
	(3, 'mathew', 'mathew', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:23', 'CCET0003');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table feedback.staff_timetable
CREATE TABLE IF NOT EXISTS `staff_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` varchar(50) NOT NULL DEFAULT '',
  `day` varchar(50) NOT NULL DEFAULT '',
  `hr1` varchar(50) NOT NULL DEFAULT '',
  `hr2` varchar(50) NOT NULL DEFAULT '',
  `hr3` varchar(50) NOT NULL DEFAULT '',
  `hr4` varchar(50) NOT NULL DEFAULT '',
  `hr5` varchar(50) NOT NULL DEFAULT '',
  `hr6` varchar(50) NOT NULL DEFAULT '',
  `hr7` varchar(50) NOT NULL DEFAULT '',
  `hr8` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table feedback.staff_timetable: 15 rows
/*!40000 ALTER TABLE `staff_timetable` DISABLE KEYS */;
REPLACE INTO `staff_timetable` (`id`, `staffid`, `day`, `hr1`, `hr2`, `hr3`, `hr4`, `hr5`, `hr6`, `hr7`, `hr8`) VALUES
	(1, '1', 'Mon', 'OS', 'CS', '', 'CD', '', 'AI', 'AM', 'SE'),
	(2, '1', 'Tue', 'AI', 'SE', 'OS', 'CD', 'DB', 'TOC', 'CS', ''),
	(3, '1', 'Wed', 'TOC', 'CD', 'DB', 'AI', 'OS', 'SE', 'CS', ''),
	(4, '1', 'Thu', 'DB', 'CS', 'AI', '', 'SE', 'OS', 'CD', ''),
	(5, '2', 'Fri', 'CD', 'TOC', 'AI', 'DB', 'CS', 'SE', '', ''),
	(6, '2', 'Mon', '', '', 'AI', 'OS', 'SE', 'TOC', 'CD', ''),
	(7, '2', 'Tue', '', '', 'DB', 'AI', 'AM', 'TOC', '', 'CD'),
	(8, '2', 'Wed', '', 'CS', 'DB', '', 'AI', 'SE', '', 'CS'),
	(9, '2', 'Thu', '', 'CS', 'AI', 'TOC', '', 'OS', '', ''),
	(10, '2', 'Fri', '', '', '', 'DB', 'CS', 'SE', 'OS', ''),
	(11, '3', 'Mon', 'AI', 'DB', '', '', 'SE', 'TOC', 'CD', 'OS'),
	(12, '3', 'Tue', '', 'OS', '', 'DB', 'CS', 'SE', 'AI', ''),
	(13, '3', 'Wed', '', 'CS', 'DB', 'AI', 'SE', '', 'TOC', ''),
	(14, '3', 'Thu', '', 'CS', 'AI', 'TOC', '', 'OS', '', 'CD'),
	(15, '3', 'Sun', '', 'TOC', 'AI', 'DB', 'CS', 'AM', 'OS', '');
/*!40000 ALTER TABLE `staff_timetable` ENABLE KEYS */;

-- Dumping structure for table feedback.student
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `initial` varchar(255) DEFAULT NULL,
  `u_name` varchar(255) DEFAULT NULL,
  `apno` varchar(255) DEFAULT NULL,
  `dept` varchar(50) NOT NULL DEFAULT '0',
  `batch` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `sem` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `focc` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `comm` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `parentmob` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tenm` varchar(255) DEFAULT NULL,
  `twvm` varchar(255) DEFAULT NULL,
  `twelthMark` varchar(255) DEFAULT NULL,
  `cutofMark` varchar(255) DEFAULT NULL,
  `ug` varchar(255) DEFAULT NULL,
  `stay` varchar(255) DEFAULT NULL,
  `bg` varchar(255) DEFAULT NULL,
  `maorco` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `photo` varchar(150) DEFAULT './student.jpg',
  `photo_old` varchar(255) DEFAULT NULL,
  `ad1` varchar(255) DEFAULT NULL,
  `ad2` varchar(255) DEFAULT NULL,
  `ad3` varchar(255) DEFAULT NULL,
  `ad4` varchar(255) DEFAULT NULL,
  `ad5` varchar(255) DEFAULT NULL,
  `lateral` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `cincharge` varchar(255) DEFAULT NULL,
  `cin_uname` varchar(255) DEFAULT NULL,
  `councellor` varchar(255) DEFAULT NULL,
  `coun_uname` varchar(255) DEFAULT NULL,
  `fg` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `dis_cont` varchar(255) DEFAULT NULL,
  `tc` varchar(255) DEFAULT NULL,
  `Adhar_No` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table feedback.student: 10 rows
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
REPLACE INTO `student` (`id`, `regno`, `name`, `initial`, `u_name`, `apno`, `dept`, `batch`, `section`, `year`, `sem`, `fname`, `focc`, `mname`, `sex`, `dob`, `comm`, `mobile`, `parentmob`, `email`, `tenm`, `twvm`, `twelthMark`, `cutofMark`, `ug`, `stay`, `bg`, `maorco`, `profile_photo`, `photo`, `photo_old`, `ad1`, `ad2`, `ad3`, `ad4`, `ad5`, `lateral`, `country`, `cincharge`, `cin_uname`, `councellor`, `coun_uname`, `fg`, `status`, `dis_cont`, `tc`, `Adhar_No`) VALUES
	(11, '21cs062', 'justien', 'I', 'justien_username', 'A123', 'cse', 'B', 'Section1', '2nd', '1st', 'John', 'Engineer', 'Mary', 'Male', '1990-01-01', 'General', '1234567890', '9876543210', 'justien@example.com', 'High School', 'Intermediate', '90%', '80%', 'B.Tech', 'Hostel', 'O+', 'Mathematics', './profile_photos/justien.jpg', './student.jpg', './photos/justien.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0001', 'dean1_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '123456789012'),
	(12, '21ee078', 'robert', 'R', 'robert_username', 'A124', 'eee', 'A', 'Section2', '3rd', '2nd', 'Michael', 'Technician', 'Sandra', 'Male', '1991-02-15', 'OBC', '2345678901', '8765432109', 'robert@example.com', 'High School', 'Intermediate', '85%', '75%', 'B.Tech', 'Day Scholar', 'AB-', 'Physics', './profile_photos/robert.jpg', './student.jpg', './photos/robert.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'USA', 'Counselor2', 'counselor2_username', 'CCET0001', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '234567890123'),
	(13, '21cs067', 'shabby', 'S', 'shabby_username', 'A125', 'cse', 'C', 'Section1', '4th', '2nd', 'George', 'Scientist', 'Isabella', 'Female', '1992-05-20', 'SC', '3456789012', '7654321098', 'shabby@example.com', 'High School', 'Intermediate', '88%', '82%', 'B.Tech', 'Hostel', 'B+', 'Chemistry', './profile_photos/shabby.jpg', './student.jpg', './photos/shabby.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0001', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '345678901234'),
	(14, '21ee080', 'stephen', 'St', 'stephen_username', 'A126', 'eee', 'B', 'Section2', '2nd', '1st', 'Daniel', 'Engineer', 'Olivia', 'Male', '1993-09-10', 'General', '4567890123', '6543210987', 'stephen@example.com', 'High School', 'Intermediate', '92%', '88%', 'B.Tech', 'Day Scholar', 'AB+', 'Physics', './profile_photos/stephen.jpg', './student.jpg', './photos/stephen.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0002', 'dean1_username', 'Indian', 'Active', 'Yes', 'Migration Certificate', '456789012345'),
	(15, '21ec090', 'richart', 'Ri', 'richart_username', 'A127', 'ece', 'A', 'Section3', '3rd', '2nd', 'William', 'Technician', 'Sophia', 'Male', '1994-04-25', 'OBC', '5678901234', '5432109876', 'richart@example.com', 'High School', 'Intermediate', '85%', '80%', 'B.Tech', 'Hostel', 'O-', 'Mathematics', './profile_photos/richart.jpg', './student.jpg', './photos/richart.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'USA', 'Counselor2', 'counselor2_username', 'CCET0002', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '567890123456'),
	(16, '21cs080', 'graven', 'G', 'graven_username', 'A128', 'cse', 'C', 'Section1', '4th', '1st', 'Joseph', 'Scientist', 'Emma', 'Male', '1995-07-15', 'SC', '6789012345', '4321098765', 'graven@example.com', 'High School', 'Intermediate', '90%', '85%', 'B.Tech', 'Day Scholar', 'A+', 'Chemistry', './profile_photos/graven.jpg', './student.jpg', './photos/graven.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0003', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '678901234567'),
	(17, '21me070', 'stark', 'St', 'stark_username', 'A129', 'mech', 'B', 'Section2', '3rd', '2nd', 'Matthew', 'Engineer', 'Ava', 'Male', '1996-11-30', 'General', '7890123456', '3210987654', 'stark@example.com', 'High School', 'Intermediate', '88%', '78%', 'B.Tech', 'Hostel', 'B-', 'Physics', './profile_photos/stark.jpg', './student.jpg', './photos/stark.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'India', 'Counselor1', 'counselor1_username', 'CCET0001', 'dean1_username', 'Indian', 'Active', 'No', 'Transfer Certificate', '789012345678'),
	(18, '21cs090', 'robin', 'R', 'robin_username', 'A130', 'cse', 'A', 'Section3', '2nd', '1st', 'Oliver', 'Technician', 'Lily', 'Female', '1997-08-05', 'OBC', '8901234567', '2109876543', 'robin@example.com', 'High School', 'Intermediate', '92%', '90%', 'B.Tech', 'Day Scholar', 'AB+', 'Mathematics', './profile_photos/robin.jpg', './student.jpg', './photos/robin.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'USA', 'Counselor2', 'counselor2_username', 'CCET0002', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '890123456789'),
	(19, '21me091', 'louis', 'L', 'louis_username', 'A131', 'mech', 'C', 'Section1', '3rd', '2nd', 'Henry', 'Scientist', 'Chloe', 'Male', '1998-02-20', 'General', '9012345678', '1098765432', 'louis@example.com', 'High School', 'Intermediate', '85%', '85%', 'B.Tech', 'Hostel', 'O+', 'Chemistry', './profile_photos/louis.jpg', './student.jpg', './photos/louis.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0003', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '901234567890'),
	(20, '21ee099', 'sam', 'S', 'sam_username', 'A132', 'eee', 'B', 'Section2', '4th', '1st', 'Michael', 'Engineer', 'Sophia', 'Male', '1999-06-15', 'SC', '9876543210', '8765432109', 'sam@example.com', 'High School', 'Intermediate', '90%', '88%', 'B.Tech', 'Day Scholar', 'A-', 'Physics', './profile_photos/sam.jpg', './student.jpg', './photos/sam.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0003', 'dean1_username', 'Indian', 'Active', 'Yes', 'Migration Certificate', '987654321098');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
