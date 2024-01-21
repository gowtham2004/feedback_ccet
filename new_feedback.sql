-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2024 at 03:45 AM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL DEFAULT '0',
  `staffid` int(11) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `studentid`, `staffid`, `insertat`, `remarks`) VALUES
(1, 13, 3, '2024-01-11 06:26:08', 'trtUKYVKGVKHJJhvkusvuyg7x6tuyxv'),
(2, 14, 3, '2024-01-11 06:26:08', 'ygydvkhwbkdbhwkugvukdvkwhjbduyv'),
(3, 16, 3, '2024-01-11 06:26:08', 'yugduygxukwvdukwvkdg'),
(4, 13, 3, '2024-01-10 18:07:47', 'newvjuh'),
(5, 14, 3, '2024-01-10 18:14:56', 'newyuiuhid'),
(6, 16, 3, '2024-01-10 18:07:47', 'newiugufoihouvb'),
(7, 13, 3, '2024-01-18 05:49:39', 'ldhhjaebejhbahldb'),
(8, 14, 3, '2024-01-18 05:49:39', 'ohiubkje vur5viuiuerf kjbu787488999888....,?ewefkjewbfuhigyug7'),
(9, 16, 3, '2024-01-18 05:49:39', 'fuiwiufuiewfuewehfuiewhf 48veugy uibjk kjfyubejehj ..rrurvbru'),
(10, 13, 3, '2024-01-18 09:54:01', NULL),
(11, 14, 3, '2024-01-18 09:54:01', NULL),
(12, 16, 3, '2024-01-18 09:54:01', NULL),
(13, 13, 3, '2024-01-18 09:54:38', NULL),
(14, 14, 3, '2024-01-18 09:54:38', NULL),
(15, 16, 3, '2024-01-18 09:54:38', NULL),
(22, 14, 3, '2024-01-19 08:12:08', 'srdfgvhibih'),
(21, 13, 3, '2024-01-19 08:11:51', '2rfghjk'),
(23, 16, 3, '2024-01-19 08:12:14', 'tdugvukgv');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
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

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `username`, `password`, `insertat`, `faculty_id`) VALUES
(1, 'john aron', 'johnaron', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:55:57', 'CCET0001'),
(2, 'maria james', 'mariajames', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:13', 'CCET0002'),
(3, 'mathew', 'mathew', '$2y$10$nOP3MM04pvirwJwN.F.2KuhYfOikJQxWuXtZtX2F5nxR9dAdcecfy', '2024-01-10 08:56:23', 'CCET0003');

-- --------------------------------------------------------

--
-- Table structure for table `staff_timetable`
--

DROP TABLE IF EXISTS `staff_timetable`;
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

--
-- Dumping data for table `staff_timetable`
--

INSERT INTO `staff_timetable` (`id`, `staffid`, `day`, `hr1`, `hr2`, `hr3`, `hr4`, `hr5`, `hr6`, `hr7`, `hr8`) VALUES
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
(15, '3', 'Fri', '', 'TOC', 'AI', 'DB', 'CS', 'AM', 'OS', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) NOT NULL,
  `photo` varchar(150) DEFAULT './student.jpg',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `dept` varchar(50) NOT NULL DEFAULT '0',
  `councellor` int(11) NOT NULL DEFAULT '0',
  `insertat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `initial` varchar(255) DEFAULT NULL,
  `u_name` varchar(255) DEFAULT NULL,
  `apno` varchar(255) DEFAULT NULL,
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

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `regno`, `photo`, `name`, `dept`, `councellor`, `insertat`, `initial`, `u_name`, `apno`, `batch`, `section`, `year`, `sem`, `fname`, `focc`, `mname`, `sex`, `dob`, `comm`, `mobile`, `parentmob`, `email`, `tenm`, `twvm`, `twelthMark`, `cutofMark`, `ug`, `stay`, `bg`, `maorco`, `profile_photo`, `photo_old`, `ad1`, `ad2`, `ad3`, `ad4`, `ad5`, `lateral`, `country`, `cincharge`, `cin_uname`, `councellor`, `coun_uname`, `fg`, `status`, `dis_cont`, `tc`, `Adhar_No`) VALUES
(11, '21cs062', './student.jpg', 'justien', 'cse', 1, '2024-01-19 10:52:09', 'I', 'justien_username', 'A123', 'B', 'Section1', '2nd', '1st', 'John', 'Engineer', 'Mary', 'Male', '1990-01-01', 'General', '1234567890', '9876543210', 'justien@example.com', 'High School', 'Intermediate', '90%', '80%', 'B.Tech', 'Hostel', 'O+', 'Mathematics', './profile_photos/justien.jpg', './photos/justien.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0001', 'dean1_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '123456789012'),
(12, '21ee078', './student.jpg', 'robert', 'eee', 2, '2024-01-19 10:52:09', 'R', 'robert_username', 'A124', 'A', 'Section2', '3rd', '2nd', 'Michael', 'Technician', 'Sandra', 'Male', '1991-02-15', 'OBC', '2345678901', '8765432109', 'robert@example.com', 'High School', 'Intermediate', '85%', '75%', 'B.Tech', 'Day Scholar', 'AB-', 'Physics', './profile_photos/robert.jpg', './photos/robert.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'USA', 'Counselor2', 'counselor2_username', 'CCET0001', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '234567890123'),
(13, '21cs067', './student.jpg', 'shabby', 'cse', 3, '2024-01-19 10:52:09', 'S', 'shabby_username', 'A125', 'C', 'Section1', '4th', '2nd', 'George', 'Scientist', 'Isabella', 'Female', '1992-05-20', 'SC', '3456789012', '7654321098', 'shabby@example.com', 'High School', 'Intermediate', '88%', '82%', 'B.Tech', 'Hostel', 'B+', 'Chemistry', './profile_photos/shabby.jpg', './photos/shabby.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0001', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '345678901234'),
(14, '21ee080', './student.jpg', 'stephen', 'eee', 3, '2024-01-19 10:52:09', 'St', 'stephen_username', 'A126', 'B', 'Section2', '2nd', '1st', 'Daniel', 'Engineer', 'Olivia', 'Male', '1993-09-10', 'General', '4567890123', '6543210987', 'stephen@example.com', 'High School', 'Intermediate', '92%', '88%', 'B.Tech', 'Day Scholar', 'AB+', 'Physics', './profile_photos/stephen.jpg', './photos/stephen.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0002', 'dean1_username', 'Indian', 'Active', 'Yes', 'Migration Certificate', '456789012345'),
(15, '21ec090', './student.jpg', 'richart', 'ece', 1, '2024-01-19 10:52:09', 'Ri', 'richart_username', 'A127', 'A', 'Section3', '3rd', '2nd', 'William', 'Technician', 'Sophia', 'Male', '1994-04-25', 'OBC', '5678901234', '5432109876', 'richart@example.com', 'High School', 'Intermediate', '85%', '80%', 'B.Tech', 'Hostel', 'O-', 'Mathematics', './profile_photos/richart.jpg', './photos/richart.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'USA', 'Counselor2', 'counselor2_username', 'CCET0002', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '567890123456'),
(16, '21cs080', './student.jpg', 'graven', 'cse', 3, '2024-01-19 10:52:09', 'G', 'graven_username', 'A128', 'C', 'Section1', '4th', '1st', 'Joseph', 'Scientist', 'Emma', 'Male', '1995-07-15', 'SC', '6789012345', '4321098765', 'graven@example.com', 'High School', 'Intermediate', '90%', '85%', 'B.Tech', 'Day Scholar', 'A+', 'Chemistry', './profile_photos/graven.jpg', './photos/graven.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0003', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '678901234567'),
(17, '21me070', './student.jpg', 'stark', 'mech', 2, '2024-01-19 10:52:09', 'St', 'stark_username', 'A129', 'B', 'Section2', '3rd', '2nd', 'Matthew', 'Engineer', 'Ava', 'Male', '1996-11-30', 'General', '7890123456', '3210987654', 'stark@example.com', 'High School', 'Intermediate', '88%', '78%', 'B.Tech', 'Hostel', 'B-', 'Physics', './profile_photos/stark.jpg', './photos/stark.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'India', 'Counselor1', 'counselor1_username', 'CCET0001', 'dean1_username', 'Indian', 'Active', 'No', 'Transfer Certificate', '789012345678'),
(18, '21cs090', './student.jpg', 'robin', 'cse', 1, '2024-01-19 10:52:09', 'R', 'robin_username', 'A130', 'A', 'Section3', '2nd', '1st', 'Oliver', 'Technician', 'Lily', 'Female', '1997-08-05', 'OBC', '8901234567', '2109876543', 'robin@example.com', 'High School', 'Intermediate', '92%', '90%', 'B.Tech', 'Day Scholar', 'AB+', 'Mathematics', './profile_photos/robin.jpg', './photos/robin.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'USA', 'Counselor2', 'counselor2_username', 'CCET0002', 'dean2_username', 'Indian', 'Inactive', 'Yes', 'Migration Certificate', '890123456789'),
(19, '21me091', './student.jpg', 'louis', 'mech', 2, '2024-01-19 10:52:09', 'L', 'louis_username', 'A131', 'C', 'Section1', '3rd', '2nd', 'Henry', 'Scientist', 'Chloe', 'Male', '1998-02-20', 'General', '9012345678', '1098765432', 'louis@example.com', 'High School', 'Intermediate', '85%', '85%', 'B.Tech', 'Hostel', 'O+', 'Chemistry', './profile_photos/louis.jpg', './photos/louis.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'No', 'Australia', 'Counselor3', 'counselor3_username', 'CCET0003', 'dean3_username', 'Foreign', 'Active', 'No', 'Transfer Certificate', '901234567890'),
(20, '21ee099', './student.jpg', 'sam', 'eee', 1, '2024-01-19 10:52:09', 'S', 'sam_username', 'A132', 'B', 'Section2', '4th', '1st', 'Michael', 'Engineer', 'Sophia', 'Male', '1999-06-15', 'SC', '9876543210', '8765432109', 'sam@example.com', 'High School', 'Intermediate', '90%', '88%', 'B.Tech', 'Day Scholar', 'A-', 'Physics', './profile_photos/sam.jpg', './photos/sam.jpg', 'Address1', 'Address2', 'Address3', 'Address4', 'Address5', 'Lateral Entry', 'India', 'Counselor1', 'counselor1_username', 'CCET0003', 'dean1_username', 'Indian', 'Active', 'Yes', 'Migration Certificate', '987654321098');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
