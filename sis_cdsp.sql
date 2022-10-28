-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2022 at 04:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_cdsp`
--
CREATE DATABASE IF NOT EXISTS `sis_cdsp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sis_cdsp`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `A_id` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `A_time_in` varchar(45) DEFAULT NULL,
  `A_time_out` varchar(45) DEFAULT NULL,
  `A_fetcher` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`A_id`, `SR_number`, `A_time_in`, `A_time_out`, `A_fetcher`) VALUES
(1, '2022-41544-SP', '2022-10-13 09:06:34', '2022-10-13 09:28:22', NULL),
(2, '2022-21561-SP', '2022-10-13 09:43:26', '2022-10-13 09:43:38', NULL),
(3, '', '2022-10-13 09:46:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classlist`
--

CREATE TABLE `classlist` (
  `CL_id` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `F_number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classlist`
--

INSERT INTO `classlist` (`CL_id`, `SR_number`, `SR_grade`, `SR_section`, `F_number`) VALUES
(1, '2022-41544-SP', 'Smallflower Swallow-wort', '1', '1'),
(2, '2022-72732-SP', 'Smallflower Swallow-wort', '1', '1'),
(3, '2022-12506-SP', 'Smallflower Swallow-wort', '2', '3'),
(4, '2022-71919-SP', 'Smallflower Swallow-wort', '2', '3'),
(5, '2022-21561-SP', 'Smallflower Swallow-wort', '3', '5'),
(6, '2022-90382-SP', 'Smallflower Swallow-wort', '3', '5'),
(7, '2022-79381-SP', 'Smallflower Swallow-wort', '4', '7'),
(8, '2022-45443-SP', 'Smallflower Swallow-wort', '4', '7'),
(9, '2022-13198-SP', 'Smallflower Swallow-wort', '5', '9'),
(10, '2022-88699-SP', 'Smallflower Swallow-wort', '5', '9');

-- --------------------------------------------------------

--
-- Table structure for table `classperformance`
--

CREATE TABLE `classperformance` (
  `CP_id` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `CP_quizzes` varchar(45) DEFAULT NULL,
  `CP_participation` varchar(45) DEFAULT NULL,
  `CP_attendance` varchar(45) DEFAULT NULL,
  `CP_exam` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `F_number` int(11) NOT NULL,
  `F_fname` varchar(45) DEFAULT NULL,
  `F_lname` varchar(45) DEFAULT NULL,
  `F_role` varchar(45) DEFAULT NULL,
  `F_subject` varchar(45) DEFAULT NULL,
  `F_assignedSection` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`F_number`, `F_fname`, `F_lname`, `F_role`, `F_subject`, `F_assignedSection`) VALUES
(1, 'Quintus', 'Sprules', 'F', 'math', '1'),
(2, 'Elane', 'Shaw', 'A', NULL, 'admin'),
(3, 'Sammie', 'Brownsall', 'F', 'english', '2'),
(4, 'Rodi', 'Pilbury', 'A', NULL, 'admin'),
(5, 'Benjy', 'Tort', 'F', 'science', '3'),
(6, 'Cody', 'Abbey', 'A', NULL, 'admin'),
(7, 'Di', 'Alliband', 'F', 'physicalEd', '4'),
(8, 'Courtnay', 'McQuade', 'A', NULL, 'admin'),
(9, 'Liam', 'Haston', 'F', 'history', '5'),
(10, 'Lyn', 'Minker', 'A', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `G_id` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `G_grading` varchar(45) DEFAULT NULL,
  `G_english` varchar(45) DEFAULT NULL,
  `G_math` varchar(45) DEFAULT NULL,
  `G_science` varchar(45) DEFAULT NULL,
  `G_physicaled` varchar(45) DEFAULT NULL,
  `G_finalgrade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`G_id`, `SR_number`, `G_grading`, `G_english`, `G_math`, `G_science`, `G_physicaled`, `G_finalgrade`) VALUES
(1, '2022-41544-SP', '1', '77', '82', '84', '90', NULL),
(2, '2022-72732-SP', '1', '90', '85', '83', '78', NULL),
(3, '2022-12506-SP', '1', '83', '90', '75', '81', NULL),
(4, '2022-71919-SP', '1', '80', '85', '78', '87', NULL),
(5, '2022-21561-SP', '1', '89', '87', '90', '89', NULL),
(6, '2022-90382-SP', '1', '87', '78', '77', '82', NULL),
(7, '2022-79381-SP', '1', '86', '84', '83', '83', NULL),
(8, '2022-45443-SP', '1', '90', '90', '87', '77', NULL),
(9, '2022-3198-SP', '1', '77', '75', '85', '80', NULL),
(10, '2022-88699-SP', '1', '80', '76', '89', '81', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentrecord`
--

CREATE TABLE `studentrecord` (
  `userID` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `SR_fname` varchar(45) DEFAULT NULL,
  `SR_mname` varchar(45) DEFAULT NULL,
  `SR_lname` varchar(45) DEFAULT NULL,
  `SR_gender` varchar(45) DEFAULT NULL,
  `SR_age` varchar(45) DEFAULT NULL,
  `SR_birthday` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `SR_address` varchar(45) DEFAULT NULL,
  `SR_guardian` varchar(45) DEFAULT NULL,
  `SR_email` varchar(45) DEFAULT NULL,
  `SR_password` varchar(45) DEFAULT NULL,
  `SR_contact` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentrecord`
--

INSERT INTO `studentrecord` (`userID`, `SR_number`, `SR_fname`, `SR_mname`, `SR_lname`, `SR_gender`, `SR_age`, `SR_birthday`, `SR_grade`, `SR_section`, `SR_address`, `SR_guardian`, `SR_email`, `SR_password`, `SR_contact`) VALUES
(1, '2022-41544-SP', 'Granger', 'Blazi', 'Sansom', 'Male', '19', '2015/10/19', '1', 'Smallflower Swallow-wort', '5421 Logan Parkway', 'Granger Sansom', 'srama0@cafepress.com', 'PaexedsRNMx', '(397) 9935692'),
(2, '2022-72732-SP', 'Kimberley', 'Whall', 'Pearmain', 'Female', '7', '2011/05/13', '1', 'Smallflower Swallow-wort', '424 Moland Point', 'Kimberley Pearmain', 'hnellen1@ftc.gov', 'm6LaKceuYXOU', '(670) 4034369'),
(3, '2022-12506-SP', 'Elvyn', 'Easby', 'Sconce', 'Male', '23', '2002/08/22', '2', 'Gingerleaf Cyanea', '8 Michigan Alley', 'Elvyn Sconce', 'icicero2@bbb.org', 'ypWCh2e4MLp', '(674) 6417574'),
(4, '2022-71919-SP', 'Brnaby', 'Cosh', 'Carnoghan', 'Male', '9', '2003/12/03', '2', 'Gingerleaf Cyanea', '6 Nevada Lane', 'Brnaby Carnoghan', 'ndukelow3@wikimedia.org', 'DdEEwTcF', '(111) 4274736'),
(5, '2022-21561-SP', 'Zora', 'Tolan', 'Pretious', 'Female', '19', '2002/01/28', '3', 'Wild Pennyroyal', '1 Cambridge Plaza', 'Zora Pretious', 'gbirtley4@gnu.org', 'OoOLChNdguK', '(395) 9540117'),
(6, '2022-90382-SP', 'Crawford', 'Fearnyhough', 'Scopham', 'Male', '19', '2012/03/22', '3', 'Wild Pennyroyal', '1170 Clyde Gallagher Avenue', 'Crawford Scopham', 'phann5@jalbum.net', 'U7X71LK58', '(748) 5684668'),
(7, '2022-79381-SP', 'Edwina', 'Boardman', 'Ciotti', 'Female', '24', '2001/01/29', '4', 'Arctoparmelia Lichen', '02 Grayhawk Place', 'Edwina Ciotti', 'mdorie6@ezinearticles.com', 'Im9c8KSRG', '(763) 2147010'),
(8, '2022-45443-SP', 'Marijn', 'Bummfrey', 'Yeandel', 'Male', '9', '1999/06/22', '4', 'Arctoparmelia Lichen', '6 Golden Leaf Way', 'Marijn Yeandel', 'bleavry7@google.de', 'FDZbbJ', '(605) 2308213'),
(9, '2022-3198-SP', 'Gwenni', 'Gwilliam', 'Bennie', 'Female', '5', '2001/08/15', '5', 'Roundseed Panicgrass', '281 Oak Valley Park', 'Gwenni Bennie', 'nwalden8@geocities.jp', 'VkwXlRf5nCRM', '(340) 8205729'),
(10, '2022-88699-SP', 'Lia', 'Seymark', 'Bountiff', 'Female', '10', '2011/09/23', '5', 'Roundseed Panicgrass', '1668 Kennedy Road', 'Lia Bountiff', 'tbryning9@ustream.tv', 'Qishwjo', '(834) 5220158');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userID` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userID`, `username`, `password`, `role`) VALUES
(1, 'srama0@cafepress.com', 'PaexedsRNMx', 'student'),
(2, 'hnellen1@ftc.gov', 'm6LaKceuYXOU', NULL),
(3, 'icicero2@bbb.org', 'ypWCh2e4MLp', NULL),
(4, 'ndukelow3@wikimedia.org', 'DdEEwTcF', NULL),
(5, 'gbirtley4@gnu.org', 'OoOLChNdguK', NULL),
(6, 'phann5@jalbum.net', 'U7X71LK58', NULL),
(7, 'mdorie6@ezinearticles.com', 'Im9c8KSRG', NULL),
(8, 'bleavry7@google.de', 'FDZbbJ', NULL),
(9, 'nwalden8@geocities.jp', 'VkwXlRf5nCRM', NULL),
(10, 'tbryning9@ustream.tv', 'Qishwjo', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `classlist`
--
ALTER TABLE `classlist`
  ADD PRIMARY KEY (`CL_id`);

--
-- Indexes for table `classperformance`
--
ALTER TABLE `classperformance`
  ADD PRIMARY KEY (`CP_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`F_number`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`G_id`);

--
-- Indexes for table `studentrecord`
--
ALTER TABLE `studentrecord`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentrecord`
--
ALTER TABLE `studentrecord`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
