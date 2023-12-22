-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 05:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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

-- --------------------------------------------------------

--
-- Table structure for table `acad_year`
--

CREATE TABLE `acad_year` (
  `rowID` int(11) NOT NULL,
  `currentYear` varchar(45) DEFAULT NULL,
  `endYear` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_year`
--

INSERT INTO `acad_year` (`rowID`, `currentYear`, `endYear`) VALUES
(1, '2022', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `AD_id` int(11) NOT NULL,
  `AD_number` varchar(45) DEFAULT NULL,
  `AD_name` varchar(45) DEFAULT NULL,
  `AD_email` varchar(45) DEFAULT NULL,
  `AD_password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`AD_id`, `AD_number`, `AD_name`, `AD_email`, `AD_password`) VALUES
(1, '5UP3R4DM1N', 'AdminAccount', 'admin1@1.com', '123'),
(8, '2023-5796', 'Camille Sabile', 'cmlsbl24@gmail.com', 'cml123'),
(9, '2023-5479', 'Hazel Cantuba', 'hazelgracecantuba@gmail.com', 'haze123'),
(10, '2023-3855', 'Steven Frilles', 'yejinvv01@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `logID` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `AD_number` varchar(45) DEFAULT NULL,
  `AD_name` varchar(45) DEFAULT NULL,
  `AD_action` varchar(100) DEFAULT NULL,
  `logDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`logID`, `acadYear`, `AD_number`, `AD_name`, `AD_action`, `logDate`) VALUES
(1, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 902839278355 as a student.', '2023-03-10 22:52:46'),
(2, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 689425702502 as a student.', '2023-03-10 22:59:37'),
(3, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 591702935736 as a student.', '2023-03-10 23:03:51'),
(4, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 039257935715 as a student.', '2023-03-10 23:06:41'),
(5, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 093751905719 as a student.', '2023-03-10 23:09:56'),
(6, '2022-2023', '2023-5796', 'Camille Sabile', 'deleted section Rose', '2023-03-10 23:10:12'),
(7, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 390572309561 as a student.', '2023-03-11 00:40:29'),
(8, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 128742095709 as a student.', '2023-03-11 00:42:54'),
(9, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 902740297528 as a student.', '2023-03-11 00:47:13'),
(10, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 562059205720 as a student.', '2023-03-11 00:50:05'),
(11, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 03590175901 as a student.', '2023-03-11 00:52:05'),
(12, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered 357501956105 as a student.', '2023-03-11 00:53:53'),
(13, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Sabile, Kristine Nicole G.  as a student.', '2023-03-11 11:45:16'),
(14, '2022-2023', '2023-5796', 'Camille Sabile', 'UPDATED INFORMATION - 357501956105', '2023-03-11 11:45:56'),
(15, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Lily', '2023-03-11 11:59:40'),
(16, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Flaminiano, Christian Paul as a student.', '2023-03-11 22:45:39'),
(17, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Francial, Hans Gabriel as a student.', '2023-03-11 22:49:08'),
(18, '2022-2023', '2023-5796', 'Camille Sabile', 'UPDATED INFORMATION - 357501956105', '2023-03-11 22:49:33'),
(19, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Olan, Aira Jean as a student.', '2023-03-11 22:53:43'),
(20, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Duran, Stephanie as a student.', '2023-03-11 23:01:14'),
(21, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered De Roxas, Gabriel Jose as a student.', '2023-03-11 23:02:57'),
(22, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Daza, Camille as a student.', '2023-03-11 23:07:01'),
(23, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Umel, Allurie as a student.', '2023-03-11 23:09:55'),
(24, '2022-2023', '2023-5796', 'Camille Sabile', ' has opened the grade encoding for the first quarter.', '2023-03-11 23:17:13'),
(25, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Reyes, William  G. Jr as a student.', '2023-03-11 23:25:15'),
(26, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Navarro, Nicole Danielle as a student.', '2023-03-12 12:55:52'),
(27, '2022-2023', '2023-5796', 'Camille Sabile', 'has successfully registered Santos, Anna Virginia as a student.', '2023-03-12 12:57:53'),
(28, '2022-2023', '2023-5796', 'Camille Sabile', 'UPDATED INFORMATION - 039257935715', '2023-03-12 13:08:40'),
(29, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Peony', '2023-03-12 13:09:26'),
(30, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Jasmine', '2023-03-12 13:09:41'),
(31, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Daffodil', '2023-03-12 13:11:06'),
(32, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Chrysanthemum', '2023-03-12 13:11:12'),
(33, '2022-2023', '2023-5796', 'Camille Sabile', 'assigned an advisor to Carnation', '2023-03-12 13:11:18'),
(34, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:00:21'),
(35, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:00:35'),
(36, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:00:50'),
(37, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:01:06'),
(38, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:01:18'),
(39, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:01:29'),
(40, '2022-2023', '2023-5796', 'Camille Sabile', 'added a schedule for Macalintal, Tessa in Pineapple', '2023-03-12 15:01:44'),
(41, '2022-2023', '2023-5796', 'Camille Sabile', 'POSTED ANNOUNCEMENT', '2023-03-12 15:39:38'),
(42, '2022-2023', '2023-5796', 'Camille Sabile', 'DELETED ANNOUNCEMENT', '2023-03-12 15:47:53'),
(43, '2022-2023', '2023-5796', 'Camille Sabile', 'OPENED ENCODING OF GRADES', '2023-03-12 16:03:40'),
(44, '2022-2023', '2023-5796', 'Camille Sabile', 'CLOSED ENCODING OF GRADES', '2023-03-12 18:28:59'),
(45, '2022-2023', '2023-5796', 'Camille Sabile', ' has opened the grade encoding for the second quarter.', '2023-03-12 18:29:38'),
(46, '2022-2023', '2023-5796', 'Camille Sabile', 'OPENED ENCODING OF GRADES', '2023-03-12 18:30:16'),
(47, '2022-2023', '2023-5796', 'Camille Sabile', 'CLOSED ENCODING OF GRADES', '2023-03-12 18:35:02'),
(48, '2022-2023', '2023-5796', 'Camille Sabile', ' has opened the grade encoding for the third quarter.', '2023-03-12 18:35:09'),
(49, '2022-2023', '2023-5796', 'Camille Sabile', 'OPENED ENCODING OF GRADES', '2023-03-12 18:35:52'),
(50, '2022-2023', '2023-5796', 'Camille Sabile', 'CLOSED ENCODING OF GRADES', '2023-03-12 18:39:18'),
(51, '2022-2023', '2023-5796', 'Camille Sabile', ' has opened the grade encoding for the fourth quarter.', '2023-03-12 18:39:21'),
(52, '2022-2023', '2023-5796', 'Camille Sabile', 'OPENED ENCODING OF GRADES', '2023-03-12 18:39:22'),
(53, '2022-2023', '2023-5796', 'Camille Sabile', ' has closed the grade encoding for the fourth quarter.', '2023-03-13 18:34:52'),
(54, '2022-2023', '5UP3R4DM1N', 'AdminAccount', 'DELETED ANNOUNCEMENT', '2023-03-15 21:51:11'),
(55, '2022-2023', '5UP3R4DM1N', 'AdminAccount', 'added subject Edukasyon sa Pagpapakatao (EsP) WITH MIN LEVEL 1 AND 3', '2023-03-15 21:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ANC_ID` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `header` varchar(45) DEFAULT NULL,
  `date_posted` date DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `msg` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ANC_ID`, `acadYear`, `header`, `date_posted`, `author`, `date`, `msg`) VALUES
(1, '2022-2023', 'School-Wide Recycling Program', NULL, '2023-5796', '2023-03-15', 'We are excited to announce the launch of our new school-wide recycling program! Starting next week, we will be implementing a recycling program throughout the school to help reduce waste and promote sustainability.\r\n\r\nAs part of this program, each classroom will have a designated recycling bin for paper, plastic, and other recyclable materials. Students will be encouraged to use these bins throughout the day, and custodial staff will collect and dispose of the recyclables on a regular basis.\r\n\r\nWe believe that this recycling program will not only help us reduce our environmental impact, but also serve as an important educational opportunity for our students. By learning about the importance of recycling and waste reduction, our students will be better equipped to make sustainable choices in their own lives.\r\n\r\nWe encourage all members of our school community to participate in this program and do their part to help create a more sustainable future for us all. Thank you for your support, and let\'s make our school a model of sustainability!'),
(2, '2022-2023', 'Save the Date! Annual School Fair Coming Soon', '2023-03-09', '2023-5796', '2023-03-15', 'We are excited to announce that our annual school fair is just around the corner! This is a highly anticipated event that brings our entire community together for a day of fun, games, and food. This year\'s fair will be held on Saturday, April 16th from 10:00 am to 4:00 pm in the school field.\r\n\r\nWe have a lot of exciting activities planned for this year\'s fair, including carnival games, face painting, a dunk tank, a bouncy castle, and more. There will also be food and drinks available for purchase, including hot dogs, popcorn, cotton candy, and snow cones.');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `A_id` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `A_date` date DEFAULT NULL,
  `A_time_IN` varchar(45) DEFAULT NULL,
  `A_time_OUT` varchar(45) DEFAULT NULL,
  `A_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`A_id`, `acadYear`, `SR_number`, `A_date`, `A_time_IN`, `A_time_OUT`, `A_status`) VALUES
(1, '2022-2023', '840202737491', '2023-03-12', '06:52 PM', '06:54 PM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_student_report`
--

CREATE TABLE `attendance_student_report` (
  `reportID` int(11) NOT NULL,
  `F_number` varchar(45) DEFAULT NULL,
  `subjectName` varchar(45) DEFAULT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `RP_reportDate` date DEFAULT NULL,
  `RP_reportTime` varchar(45) DEFAULT NULL,
  `RP_attendanceReport` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `behavior`
--

CREATE TABLE `behavior` (
  `B_ID` int(11) NOT NULL,
  `F_number` varchar(45) DEFAULT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `CV_Area` varchar(45) DEFAULT NULL,
  `CV_valueQ1` varchar(45) DEFAULT NULL,
  `CV_valueQ2` varchar(45) DEFAULT NULL,
  `CV_valueQ3` varchar(45) DEFAULT NULL,
  `CV_valueQ4` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `behavior`
--

INSERT INTO `behavior` (`B_ID`, `F_number`, `acadYear`, `SR_number`, `SR_grade`, `SR_section`, `CV_Area`, `CV_valueQ1`, `CV_valueQ2`, `CV_valueQ3`, `CV_valueQ4`) VALUES
(1, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(2, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(3, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(4, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(5, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(6, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(7, '2023-00001-F', '2022-2023', '902839278355', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO'),
(8, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(9, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(10, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(11, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(12, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(13, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(14, '2023-00001-F', '2022-2023', '689425702502', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO'),
(15, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(16, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(17, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(18, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(19, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(20, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(21, '2023-00001-F', '2022-2023', '591702935736', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO'),
(22, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(23, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(24, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(25, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(26, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(27, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(28, '2023-00001-F', '2022-2023', '039257935715', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO'),
(29, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(30, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(31, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(32, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(33, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(34, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(35, '2023-00001-F', '2022-2023', '093751905719', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO'),
(36, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Maka-Diyos1', 'AO', 'AO', 'AO', 'AO'),
(37, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Maka-Diyos2', 'AO', 'AO', 'AO', 'AO'),
(38, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Makatao1', 'AO', 'AO', 'AO', 'AO'),
(39, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Makatao2', 'AO', 'AO', 'AO', 'AO'),
(40, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Makabansa1', 'AO', 'AO', 'AO', 'AO'),
(41, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Makabansa2', 'AO', 'AO', 'AO', 'AO'),
(42, '2023-00001-F', '2022-2023', '840202737491', '6', 'Pineapple', 'Makalikasan	', 'AO', 'AO', 'AO', 'AO');

-- --------------------------------------------------------

--
-- Table structure for table `behavior_category`
--

CREATE TABLE `behavior_category` (
  `B_ID` int(11) NOT NULL,
  `core_value_area` varchar(45) DEFAULT NULL,
  `core_value_subheading` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `behavior_category`
--

INSERT INTO `behavior_category` (`B_ID`, `core_value_area`, `core_value_subheading`) VALUES
(1, 'Maka-Diyos1', 'Expresses one spiritual beliefs while respecting the spiritual beliefs of others.'),
(2, 'Maka-Diyos2', 'Show adherence to ethical principle by upholding truth.'),
(3, 'Makatao1', 'Is sensitive to individual, social, and cultural differences.'),
(4, 'Makatao2', 'Demonstrates contributions toward solidarity.'),
(5, 'Makabansa1', 'Demonstrates pride in being a Filipino, exercises the rights and responsibilities of a Filipino citizen.'),
(6, 'Makabansa2', 'Demonstrates appropriate behavior in carrying out activities in the school, community and country.	'),
(7, 'Makalikasan	', 'Cares for the environment and utilizes resources wisely, judiously and economically.');

-- --------------------------------------------------------

--
-- Table structure for table `cityprovregion`
--

CREATE TABLE `cityprovregion` (
  `ID_cpr` int(11) NOT NULL,
  `zip_code` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `region` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cityprovregion`
--

INSERT INTO `cityprovregion` (`ID_cpr`, `zip_code`, `city`, `state`, `region`) VALUES
(1, '1405', '1st Ave. to 7th Ave. - West', 'Metro Manila', 'NCR (National Capital Region)'),
(2, '5302', 'Aborlan', 'Palawan', 'Region 4B (MIMAROPA)'),
(3, '5108', 'Abra de Ilog', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(4, '2114', 'Abucay', 'Bataan', 'Region 3 (Central Luzon)'),
(5, '3517', 'Abulug', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(6, '1474', 'Acacia', 'Metro Manila', 'NCR (National Capital Region)'),
(7, '2922', 'Adams', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(8, '1714', 'Aeropark Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(9, '4304', 'Agdangan', 'Quezon', 'Region 4A (CALABARZON)'),
(10, '3403', 'Aglipay', 'Quirino', 'Region 2 (Cagayan Valley)'),
(11, '2408', 'Agno', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(12, '4211', 'Agoncillo', 'Batangas', 'Region 4A (CALABARZON)'),
(13, '2504', 'Agoo', 'La Union', 'Region 1 (Ilocos Region)'),
(14, '1620', 'Aguho', 'Metro Manila', 'NCR (National Capital Region)'),
(15, '2415', 'Aguilar', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(16, '3606', 'Aguinaldo', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(17, '5320', 'Agutaya', 'Palawan', 'Region 4B (MIMAROPA)'),
(18, '4333', 'Alabat', 'Quezon', 'Region 4A (CALABARZON)'),
(19, '9501', 'Alabel', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(20, '9413', 'Alamada', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(21, '2404', 'Alaminos', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(22, '4001', 'Alaminos', 'Laguna', 'Region 4A (CALABARZON)'),
(23, '2425', 'Alcala', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(24, '3507', 'Alcala', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(25, '5509', 'Alcantara', 'Romblon', 'Region 4B (MIMAROPA)'),
(26, '8425', 'Alegria', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(27, '9415', 'Aleosan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(28, '4123', 'Alfonso', 'Cavite', 'Region 4A (CALABARZON)'),
(29, '3714', 'Alfonso Castañeda', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(30, '3608', 'Alfonso Lista (formerly Potia)', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(31, '3111', 'Aliaga', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(32, '1105', 'Alicia', 'Metro Manila', 'NCR (National Capital Region)'),
(33, '3306', 'Alicia', 'Isabela', 'Region 2 (Cagayan Valley)'),
(34, '2716', 'Alilem', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(35, '4205', 'Alitagtag', 'Batangas', 'Region 4A (CALABARZON)'),
(36, '3523', 'Allacapan', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(37, '6724', 'Almagro', 'Samar', 'Region 8 (Eastern Visayas)'),
(38, '1750', 'Almanza', 'Metro Manila', 'NCR (National Capital Region)'),
(39, '7206', 'Aloran', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(40, '9018', 'Alubijid', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(41, '4119', 'Amadeo', 'Cavite', 'Region 4A (CALABARZON)'),
(42, '3701', 'Ambaguio', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(43, '1102', 'Amihan', 'Metro Manila', 'NCR (National Capital Region)'),
(44, '1425', 'Amparo Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(45, '3505', 'Amulung', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(46, '2310', 'Anao', 'Tarlac', 'Region 3 (Central Luzon)'),
(47, '2405', 'Anda', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(48, '3307', 'Angadanan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(49, '3012', 'Angat', 'Bulacan', 'Region 3 (Central Luzon)'),
(50, '1749', 'Angela Village', 'Metro Manila', 'NCR (National Capital Region)'),
(51, '2009', 'Angeles City', 'Pampanga', 'Region 3 (Central Luzon)'),
(52, '1930', 'Angono', 'Rizal', 'Region 4A (CALABARZON)'),
(53, '9414', 'Antipas', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(54, '1870', 'Antipolo', 'Rizal', 'Region 4A (CALABARZON)'),
(55, '2016', 'Apalit', 'Pampanga', 'Region 3 (Central Luzon)'),
(56, '3515', 'Aparri', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(57, '1106', 'Apolonio Samson', 'Metro Manila', 'NCR (National Capital Region)'),
(58, '5311', 'Araceli', 'Palawan', 'Region 4B (MIMAROPA)'),
(59, '9417', 'Arakan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(60, '1476', 'Araneta Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(61, '2012', 'Arayat', 'Pampanga', 'Region 3 (Central Luzon)'),
(62, '2503', 'Aringay', 'La Union', 'Region 1 (Ilocos Region)'),
(63, '3704', 'Aritao', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(64, '1444', 'Arkong Bato-Rincon-Pasolo-Malanday-Mabolo-Polo', 'Metro Manila', 'NCR (National Capital Region)'),
(65, '5414', 'Aroroy', 'Masbate', 'Region 5 (Bicol Region)'),
(66, '3610', 'Asipulo', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(67, '8102', 'Asuncion (formerly Saug)', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(68, '8016', 'Ateneo', 'Davao del Sur', 'Region 11 (Davao Region)'),
(69, '4331', 'Atimonan', 'Quezon', 'Region 4A (CALABARZON)'),
(70, '2612', 'Atok', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(71, '3316', 'Aurora', 'Isabela', 'Region 2 (Cagayan Valley)'),
(72, '1226', 'Ayala - Paseo De Roxas', 'Metro Manila', 'NCR (National Capital Region)'),
(73, '1799', 'Ayala Alabang P.O. Boxes', 'Metro Manila', 'NCR (National Capital Region)'),
(74, '1780', 'Ayala Alabang Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(75, '4432', 'Baao', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(76, '8118', 'Babak', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(77, '4509', 'Bacacay', 'Albay', 'Region 5 (Bicol Region)'),
(78, '2916', 'Bacarra', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(79, '1702', 'Baclaran', 'Metro Manila', 'NCR (National Capital Region)'),
(80, '2515', 'Bacnotan', 'La Union', 'Region 1 (Ilocos Region)'),
(81, '5201', 'Baco', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(82, '9205', 'Bacolod', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(83, '2001', 'Bacolor', 'Pampanga', 'Region 3 (Central Luzon)'),
(84, '4701', 'Bacon', 'Sorsogon', 'Region 5 (Bicol Region)'),
(85, '4102', 'Bacoor', 'Cavite', 'Region 4A (CALABARZON)'),
(86, '8408', 'Bacuag', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(87, '2904', 'Badoc', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(88, '1106', 'Baesa', 'Metro Manila', 'NCR (National Capital Region)'),
(89, '1401', 'Baesa', 'Metro Manila', 'NCR (National Capital Region)'),
(90, '3711', 'Bagabag', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(91, '2107', 'Bagac', 'Bataan', 'Region 3 (Central Luzon)'),
(92, '4807', 'Bagamanoc', 'Catanduanes', 'Region 5 (Bicol Region)'),
(93, '8204', 'Baganga', 'Davao Oriental', 'Region 11 (Davao Region)'),
(94, '1116', 'Bagbag', 'Metro Manila', 'NCR (National Capital Region)'),
(95, '3506', 'Baggao', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(96, '1110', 'Bagong Bayan', 'Metro Manila', 'NCR (National Capital Region)'),
(97, '1109', 'Bagong Buhay', 'Metro Manila', 'NCR (National Capital Region)'),
(98, '1111', 'Bagong Lipunan', 'Metro Manila', 'NCR (National Capital Region)'),
(99, '1872', 'Bagong Nayon (Cogeo)', 'Rizal', 'Region 4A (CALABARZON)'),
(100, '1105', 'Bagong Pag-asa', 'Metro Manila', 'NCR (National Capital Region)'),
(101, '1428', 'Bagong Silang', 'Metro Manila', 'NCR (National Capital Region)'),
(102, '1119', 'Bagong Silangan', 'Metro Manila', 'NCR (National Capital Region)'),
(103, '2600', 'Baguio City', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(104, '2512', 'Bagulin', 'La Union', 'Region 1 (Ilocos Region)'),
(105, '9810', 'Bagumbayan', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(106, '1421', 'Bagumbong/Pag-asa', 'Metro Manila', 'NCR (National Capital Region)'),
(107, '1106', 'Bahay Toro', 'Metro Manila', 'NCR (National Capital Region)'),
(108, '2610', 'Bakun', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(109, '5307', 'Balabac', 'Palawan', 'Region 4B (MIMAROPA)'),
(110, '3016', 'Balagtas', 'Bulacan', 'Region 3 (Central Luzon)'),
(111, '2100', 'Balanga', 'Bataan', 'Region 3 (Central Luzon)'),
(112, '1445', 'Balangkas-Caloong', 'Metro Manila', 'NCR (National Capital Region)'),
(113, '2517', 'Balaoan', 'La Union', 'Region 1 (Ilocos Region)'),
(114, '4436', 'Balatan', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(115, '4213', 'Balayan', 'Batangas', 'Region 4A (CALABARZON)'),
(116, '3801', 'Balbalan', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(117, '5413', 'Baleno', 'Masbate', 'Region 5 (Bicol Region)'),
(118, '3200', 'Baler', 'Aurora', 'Region 3 (Central Luzon)'),
(119, '4219', 'Balete', 'Batangas', 'Region 4A (CALABARZON)'),
(120, '7211', 'Baliangao', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(121, '1115', 'Balingasa', 'Metro Manila', 'NCR (National Capital Region)'),
(122, '9005', 'Balingasag', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(123, '9011', 'Balingoan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(124, '9011', 'Balingoan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(125, '3006', 'Baliuag', 'Bulacan', 'Region 3 (Central Luzon)'),
(126, '3516', 'Ballesteros', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(127, '9217', 'Baloi', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(128, '5412', 'Balud', 'Masbate', 'Region 5 (Bicol Region)'),
(129, '1106', 'Balumbato', 'Metro Manila', 'NCR (National Capital Region)'),
(130, '2317', 'Bamban', 'Tarlac', 'Region 3 (Central Luzon)'),
(131, '3702', 'Bambang', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(132, '3601', 'Banaue', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(133, '8208', 'Banaybanay', 'Davao Oriental', 'Region 11 (Davao Region)'),
(134, '2708', 'Banayoyo', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(135, '9511', 'Banga', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(136, '2519', 'Bangar', 'La Union', 'Region 1 (Ilocos Region)'),
(137, '1233', 'Bangkal', 'Metro Manila', 'NCR (National Capital Region)'),
(138, '2800', 'Bangued', 'Abra', 'CAR (Cordillera Administrative Region)'),
(139, '2920', 'Bangui', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(140, '9416', 'Banisilan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(141, '1426', 'Bankers Village', 'Metro Manila', 'NCR (National Capital Region)'),
(142, '2908', 'Banna (formerly Espiritu)', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(143, '8005', 'Bansalan', 'Davao del Sur', 'Region 11 (Davao Region)'),
(144, '5210', 'Bansud', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(145, '2727', 'Bantay', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(146, '5515', 'Banton (Jones)', 'Romblon', 'Region 4B (MIMAROPA)'),
(147, '1803', 'Barangka', 'Metro Manila', 'NCR (National Capital Region)'),
(148, '4803', 'Baras', 'Catanduanes', 'Region 5 (Bicol Region)'),
(149, '1970', 'Baras', 'Rizal', 'Region 4A (CALABARZON)'),
(150, '4712', 'Barcelona', 'Sorsogon', 'Region 5 (Bicol Region)'),
(151, '8309', 'Barobo', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(152, '9210', 'Baroy', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(153, '2007', 'Basa airbase', 'Pampanga', 'Region 3 (Central Luzon)'),
(154, '3900', 'Basco', 'Batanes', 'Region 2 (Cagayan Valley)'),
(155, '6720', 'Basey', 'Samar', 'Region 8 (Eastern Visayas)'),
(156, '8413', 'Basilisa (formerly Rizal)', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(157, '4608', 'Basud', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(158, '2906', 'Batac', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(159, '4200', 'Batangas City', 'Batangas', 'Region 4A (CALABARZON)'),
(160, '1126', 'Batasan Hills', 'Metro Manila', 'NCR (National Capital Region)'),
(161, '5306', 'Batazara', 'Palawan', 'Region 4B (MIMAROPA)'),
(162, '4801', 'Bato', 'Catanduanes', 'Region 5 (Bicol Region)'),
(163, '4435', 'Bato', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(164, '5415', 'Batuan', 'Masbate', 'Region 5 (Bicol Region)'),
(165, '4201', 'Bauan', 'Batangas', 'Region 4A (CALABARZON)'),
(166, '2501', 'Bauang', 'La Union', 'Region 1 (Ilocos Region)'),
(167, '4033', 'Bay', 'Laguna', 'Region 4A (CALABARZON)'),
(168, '1636', 'Bay Breeze Exec. Village', 'Metro Manila', 'NCR (National Capital Region)'),
(169, '8303', 'Bayabas', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(170, '1772', 'Bayanan/Putatan', 'Metro Manila', 'NCR (National Capital Region)'),
(171, '1109', 'Bayanihan', 'Metro Manila', 'NCR (National Capital Region)'),
(172, '3700', 'Bayombong', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(173, '8502', 'Bayugan', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(174, '1209', 'Bel-air', 'Metro Manila', 'NCR (National Capital Region)'),
(175, '3331', 'Benito Soliven', 'Isabela', 'Region 2 (Cagayan Valley)'),
(176, '1711', 'Better Living Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(177, '1120', 'BF Homes', 'Metro Manila', 'NCR (National Capital Region)'),
(178, '1720', 'Bf Homes 1', 'Metro Manila', 'NCR (National Capital Region)'),
(179, '1718', 'Bf Homes 2', 'Metro Manila', 'NCR (National Capital Region)'),
(180, '1631', 'Bicutan', 'Metro Manila', 'NCR (National Capital Region)'),
(181, '1632', 'Bicutan Lower', 'Metro Manila', 'NCR (National Capital Region)'),
(182, '1633', 'Bicutan Upper', 'Metro Manila', 'NCR (National Capital Region)'),
(183, '1630', 'Bicutan Western', 'Metro Manila', 'NCR (National Capital Region)'),
(184, '4024', 'Biñan', 'Laguna', 'Region 4A (CALABARZON)'),
(185, '1940', 'Binangonan', 'Rizal', 'Region 4A (CALABARZON)'),
(186, '9008', 'Binuangan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(187, '8311', 'Bislig', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(188, '1109', 'Blue Ridge', 'Metro Manila', 'NCR (National Capital Region)'),
(189, '4900', 'Boac', 'Marinduque', 'Region 4B (MIMAROPA)'),
(190, '3018', 'Bocaue', 'Bulacan', 'Region 3 (Central Luzon)'),
(191, '2605', 'Bokod', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(192, '2815', 'Boliney', 'Abra', 'CAR (Cordillera Administrative Region)'),
(193, '4404', 'Bombon', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(194, '3128', 'Bongabon', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(195, '5211', 'Bongabong', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(196, '7215', 'Bonifacio', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(197, '1635', 'Bonifacio Global City', 'Metro Manila', 'NCR (National Capital Region)'),
(198, '8206', 'Boston', 'Davao Oriental', 'Region 11 (Davao Region)'),
(199, '1101', 'Botocan', 'Metro Manila', 'NCR (National Capital Region)'),
(200, '4006', 'Botocan', 'Laguna', 'Region 4A (CALABARZON)'),
(201, '2202', 'Botolan', 'Zambales', 'Region 3 (Central Luzon)'),
(202, '8106', 'Braulio E. Dujali', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(203, '5305', 'Brooke\'s Point', 'Palawan', 'Region 4B (MIMAROPA)'),
(204, '2805', 'Bucay', 'Abra', 'CAR (Cordillera Administrative Region)'),
(205, '2817', 'Bucloc', 'Abra', 'CAR (Cordillera Administrative Region)'),
(206, '4904', 'Buenavista', 'Marinduque', 'Region 4B (MIMAROPA)'),
(207, '4320', 'Buenavista', 'Quezon', 'Region 4A (CALABARZON)'),
(208, '8601', 'Buenavista', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(209, '3511', 'Buguey', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(210, '2607', 'Buguias', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(211, '4433', 'Buhi', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(212, '4430', 'Bula', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(213, '3017', 'Bulacan', 'Bulacan', 'Region 3 (Central Luzon)'),
(214, '5214', 'Bulalacao', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(215, '4706', 'Bulan', 'Sorsogon', 'Region 5 (Bicol Region)'),
(216, '1771', 'Bule/Cupang', 'Metro Manila', 'NCR (National Capital Region)'),
(217, '4704', 'Bulusan', 'Sorsogon', 'Region 5 (Bicol Region)'),
(218, '8506', 'Bunawan', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(219, '8017', 'Bunawan', 'Davao del Sur', 'Region 11 (Davao Region)'),
(220, '1105', 'Bungad', 'Metro Manila', 'NCR (National Capital Region)'),
(221, '4340', 'Burdeos', 'Quezon', 'Region 4A (CALABARZON)'),
(222, '2510', 'Burgos', 'La Union', 'Region 1 (Ilocos Region)'),
(223, '2724', 'Burgos', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(224, '2918', 'Burgos', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(225, '8424', 'Burgos', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(226, '3322', 'Burgos', 'Isabela', 'Region 2 (Cagayan Valley)'),
(227, '3007', 'Bustos', 'Bulacan', 'Region 3 (Central Luzon)'),
(228, '5317', 'Busuanga', 'Palawan', 'Region 4B (MIMAROPA)'),
(229, '8600', 'Butuan City', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(230, '2502', 'Caba', 'La Union', 'Region 1 (Ilocos Region)'),
(231, '8605', 'Cabadbaran', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(232, '3328', 'Cabagan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(233, '3100', 'Cabanatuan City', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(234, '2203', 'Cabangan', 'Zambales', 'Region 3 (Central Luzon)'),
(235, '3400', 'Cabarroguis', 'Quirino', 'Region 2 (Cagayan Valley)'),
(236, '3315', 'Cabatuan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(237, '2109', 'Cabcaben', 'Bataan', 'Region 3 (Central Luzon)'),
(238, '3107', 'Cabiao', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(239, '2732', 'Cabugao', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(240, '4406', 'Cabusao', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(241, '4025', 'Cabuyao', 'Laguna', 'Region 4A (CALABARZON)'),
(242, '9000', 'Cagayan de Oro City', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(243, '5321', 'Cagayancillo', 'Palawan', 'Region 4B (MIMAROPA)'),
(244, '8411', 'Cagdianao', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(245, '8304', 'Cagwait', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(246, '1900', 'Cainta', 'Rizal', 'Region 4A (CALABARZON)'),
(247, 'Cajidiocan', 'Cajidiocan', 'Romblon', 'Region 4B (MIMAROPA)'),
(248, '4405', 'Calabanga', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(249, '4212', 'Calaca', 'Batangas', 'Region 4A (CALABARZON)'),
(250, '4027', 'Calamba', 'Laguna', 'Region 4A (CALABARZON)'),
(251, '7210', 'Calamba', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(252, '3814', 'Calanasan', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(253, '5200', 'Calapan', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(254, '4215', 'Calatagan', 'Batangas', 'Region 4A (CALABARZON)'),
(255, '5503', 'Calatrava', 'Romblon', 'Region 4B (MIMAROPA)'),
(256, '4318', 'Calauag', 'Quezon', 'Region 4A (CALABARZON)'),
(257, '3520', 'Calayan', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(258, '6710', 'Calbayog City', 'Samar', 'Region 8 (Eastern Visayas)'),
(259, '6715', 'Calbiga', 'Samar', 'Region 8 (Eastern Visayas)'),
(260, '8018', 'Calinan', 'Davao del Sur', 'Region 11 (Davao Region)'),
(261, '5102', 'Calintaan', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(262, '1400', 'Caloocan City CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(263, '4012', 'Caluan', 'Laguna', 'Region 4A (CALABARZON)'),
(264, '3003', 'Calumpit', 'Bulacan', 'Region 3 (Central Luzon)'),
(265, '3510', 'Camalaniugan', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(266, '4502', 'Camalig', 'Albay', 'Region 5 (Bicol Region)'),
(267, '4401', 'Camaligan', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(268, '2306', 'Camiling', 'Tarlac', 'Region 3 (Central Luzon)'),
(269, '1110', 'Camp. Aguinaldo', 'Metro Manila', 'NCR (National Capital Region)'),
(270, '4402', 'Canaman', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(271, '2013', 'Candaba', 'Pampanga', 'Region 3 (Central Luzon)'),
(272, '4323', 'Candelaria', 'Quezon', 'Region 4A (CALABARZON)'),
(273, '2212', 'Candelaria', 'Zambales', 'Region 3 (Central Luzon)'),
(274, '2710', 'Candon', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(275, '1606', 'Caniogan', 'Metro Manila', 'NCR (National Capital Region)'),
(276, '8317', 'Cantilan', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(277, '2702', 'Caoayan', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(278, '4607', 'Capalonga', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(279, '2315', 'Capas', 'Tarlac', 'Region 3 (Central Luzon)'),
(280, '1126', 'Capitol Hills/Park', 'Metro Manila', 'NCR (National Capital Region)'),
(281, '1424', 'Capitol Parkland Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(282, '1117', 'Capri', 'Metro Manila', 'NCR (National Capital Region)'),
(283, '8203', 'Caraga', 'Davao Oriental', 'Region 11 (Davao Region)'),
(284, '4429', 'Caramoan', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(285, '4808', 'Caramoran', 'Catanduanes', 'Region 5 (Bicol Region)'),
(286, '2911', 'Carasi', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(287, '1950', 'Cardona', 'Rizal', 'Region 4A (CALABARZON)'),
(288, '8315', 'Carmen', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(289, '8603', 'Carmen', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(290, '9408', 'Carmen', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(291, '8101', 'Carmen', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(292, '4116', 'Carmona', 'Cavite', 'Region 4A (CALABARZON)'),
(293, '3123', 'Carrangalan', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(294, '8318', 'Carrascal', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(295, '4702', 'Casiguran', 'Sorsogon', 'Region 5 (Bicol Region)'),
(296, '3204', 'Casiguran', 'Aurora', 'Region 3 (Central Luzon)'),
(297, '4713', 'Castilla', 'Sorsogon', 'Region 5 (Bicol Region)'),
(298, '2208', 'Castillejos', 'Zambales', 'Region 3 (Central Luzon)'),
(299, '5405', 'Cataingan', 'Masbate', 'Region 5 (Bicol Region)'),
(300, '4311', 'Catanauan', 'Quezon', 'Region 4A (CALABARZON)'),
(301, '9104', 'Catarman', 'Camiguin', 'Region 10 (Northern Mindanao)'),
(302, '6700', 'Catbalogan', 'Samar', 'Region 8 (Eastern Visayas)'),
(303, '8205', 'Cateel', 'Davao Oriental', 'Region 11 (Davao Region)'),
(304, '4013', 'Cavinti', 'Laguna', 'Region 4A (CALABARZON)'),
(305, '4100', 'Cavite City', 'Cavite', 'Region 4A (CALABARZON)'),
(306, '5409', 'Cawayan', 'Masbate', 'Region 5 (Bicol Region)'),
(307, '1214', 'Cembo', 'Metro Manila', 'NCR (National Capital Region)'),
(308, '3120', 'Central Luzon State University', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(309, '2718', 'Cervantes', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(310, '3305', 'City of Cauayan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(311, '3300', 'City of Ilagan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(312, '7201', 'Clarin', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(313, '1102', 'Claro', 'Metro Manila', 'NCR (National Capital Region)'),
(314, '8410', 'Claver', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(315, '5419', 'Claveria', 'Masbate', 'Region 5 (Bicol Region)'),
(316, '9004', 'Claveria', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(317, '3519', 'Claveria', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(318, '4031', 'College Los Baños', 'Laguna', 'Region 4A (CALABARZON)'),
(319, '9801', 'Columbio', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(320, '1217', 'Comembo', 'Metro Manila', 'NCR (National Capital Region)'),
(321, '1224', 'Commercial Center', 'Metro Manila', 'NCR (National Capital Region)'),
(322, '1121', 'Commonwealth', 'Metro Manila', 'NCR (National Capital Region)'),
(323, '8803', 'Compostela', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(324, '5516', 'Concepcion', 'Romblon', 'Region 4B (MIMAROPA)'),
(325, '2316', 'Concepcion', 'Tarlac', 'Region 3 (Central Luzon)'),
(326, '7213', 'Concepcion', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(327, '1807', 'Concepcion 1', 'Metro Manila', 'NCR (National Capital Region)'),
(328, '1811', 'Concepcion 2', 'Metro Manila', 'NCR (National Capital Region)'),
(329, '3807', 'Conner', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(330, '5514', 'Corcuera', 'Romblon', 'Region 4B (MIMAROPA)'),
(331, '3312', 'Cordon', 'Isabela', 'Region 2 (Cagayan Valley)'),
(332, '5316', 'Coron', 'Palawan', 'Region 4B (MIMAROPA)'),
(333, '8313', 'Cortez', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(334, '1111', 'Crame', 'Metro Manila', 'NCR (National Capital Region)'),
(335, '3025', 'Cruz Na Daan', 'Bulacan', 'Region 3 (Central Luzon)'),
(336, '2023', 'CSEZ, Clark', 'Pampanga', 'Region 3 (Central Luzon)'),
(337, '1109', 'Cubao', 'Metro Manila', 'NCR (National Capital Region)'),
(338, '4222', 'Cuenca', 'Batangas', 'Region 4A (CALABARZON)'),
(339, '1128', 'Culiat', 'Metro Manila', 'NCR (National Capital Region)'),
(340, '5315', 'Culion', 'Palawan', 'Region 4B (MIMAROPA)'),
(341, '2903', 'Currimao', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(342, '1743', 'Cut-cut', 'Metro Manila', 'NCR (National Capital Region)'),
(343, '3117', 'Cuyapo', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(344, '5318', 'Cuyo', 'Palawan', 'Region 4B (MIMAROPA)'),
(345, '4600', 'Daet', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(346, '2816', 'Daguioman', 'Abra', 'CAR (Cordillera Administrative Region)'),
(347, '1443', 'Dalandan - West Canumay', 'Metro Manila', 'NCR (National Capital Region)'),
(348, '1115', 'Damar', 'Metro Manila', 'NCR (National Capital Region)'),
(349, '1104', 'Damayan', 'Metro Manila', 'NCR (National Capital Region)'),
(350, '1112', 'Damayan Lagi', 'Metro Manila', 'NCR (National Capital Region)'),
(351, '1123', 'Damong Maliit', 'Metro Manila', 'NCR (National Capital Region)'),
(352, '1480', 'Dampalit', 'Metro Manila', 'NCR (National Capital Region)'),
(353, '2825', 'Danglas', 'Abra', 'CAR (Cordillera Administrative Region)'),
(354, '8417', 'Dapa', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(355, '4501', 'Daraga (Locsin)', 'Albay', 'Region 5 (Bicol Region)'),
(356, '6722', 'Daram', 'Samar', 'Region 8 (Eastern Visayas)'),
(357, '4114', 'Dasmariñas', 'Cavite', 'Region 4A (CALABARZON)'),
(358, '4115', 'Dasmariñas Resettlement Area', 'Cavite', 'Region 4A (CALABARZON)'),
(359, '1221', 'Dasmarinas Village (North)', 'Metro Manila', 'NCR (National Capital Region)'),
(360, '1222', 'Dasmarinas Village (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(361, '2026', 'Dau, Mabalacat', 'Pampanga', 'Region 3 (Central Luzon)'),
(362, '8000', 'Davao City', 'Davao del Sur', 'Region 11 (Davao Region)'),
(363, '8019', 'Davao International Airport', 'Davao del Sur', 'Region 11 (Davao Region)'),
(364, '8418', 'Del Carmen', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(365, '4411', 'Del Gallego', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(366, '1105', 'Del Monte', 'Metro Manila', 'NCR (National Capital Region)'),
(367, '3326', 'Delfin Albano', 'Isabela', 'Region 2 (Cagayan Valley)'),
(368, '3712', 'Diadi', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(369, '3401', 'Diffun', 'Quirino', 'Region 2 (Cagayan Valley)'),
(370, '8002', 'Digos', 'Davao del Sur', 'Region 11 (Davao Region)'),
(371, '3205', 'Dilasag', 'Aurora', 'Region 3 (Central Luzon)'),
(372, '1101', 'Diliman', 'Metro Manila', 'NCR (National Capital Region)'),
(373, '5403', 'Dimasalang', 'Masbate', 'Region 5 (Bicol Region)'),
(374, '8412', 'Dinagat', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(375, '3206', 'Dinalungan', 'Aurora', 'Region 3 (Central Luzon)'),
(376, '2110', 'Dinalupihan', 'Bataan', 'Region 3 (Central Luzon)'),
(377, '3336', 'Dinapigue', 'Isabela', 'Region 2 (Cagayan Valley)'),
(378, '3207', 'Dingalan', 'Aurora', 'Region 3 (Central Luzon)'),
(379, '2913', 'Dingras', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(380, '1109', 'Dioquino Zobel', 'Metro Manila', 'NCR (National Capital Region)'),
(381, '3203', 'Dipaculao', 'Aurora', 'Region 3 (Central Luzon)'),
(382, '3335', 'Divilacan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(383, '2801', 'Dolores', 'Abra', 'CAR (Cordillera Administrative Region)'),
(384, '4326', 'Dolores', 'Quezon', 'Region 4A (CALABARZON)'),
(385, '1301', 'Domestic Airport PO', 'Metro Manila', 'NCR (National Capital Region)'),
(386, '1113', 'Don Manuel', 'Metro Manila', 'NCR (National Capital Region)'),
(387, '8013', 'Don Marcelino', 'Davao Occidental', 'Region 11 (Davao Region)'),
(388, '7216', 'Don Victoriano Chiongbian', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(389, '1113', 'Doña Aurora', 'Metro Manila', 'NCR (National Capital Region)'),
(390, '1125', 'Doña Faustina Subd.', 'Metro Manila', 'NCR (National Capital Region)'),
(391, '1113', 'Doña Imelda', 'Metro Manila', 'NCR (National Capital Region)'),
(392, '1113', 'Doña Josefa', 'Metro Manila', 'NCR (National Capital Region)'),
(393, '3009', 'Doña Remedios Trinidad', 'Bulacan', 'Region 3 (Central Luzon)'),
(394, '4715', 'Donsol', 'Sorsogon', 'Region 5 (Bicol Region)'),
(395, '2921', 'Dumalneg', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(396, '5310', 'Dumaran', 'Palawan', 'Region 4B (MIMAROPA)'),
(397, '3706', 'Dupax del Norte', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(398, '3707', 'Dupax del Sur', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(399, '1102', 'Duyan-duyan', 'Metro Manila', 'NCR (National Capital Region)'),
(400, '1102', 'E. Rodriguez', 'Metro Manila', 'NCR (National Capital Region)'),
(401, '1447', 'East Canumay - Lawang Bato Pun', 'Metro Manila', 'NCR (National Capital Region)'),
(402, '1554', 'East Edsa', 'Metro Manila', 'NCR (National Capital Region)'),
(403, '3309', 'Echague', 'Isabela', 'Region 2 (Cagayan Valley)'),
(404, '1504', 'Eisenhower-Crame', 'Metro Manila', 'NCR (National Capital Region)'),
(405, '5313', 'El Nido (Baquit)', 'Palawan', 'Region 4B (MIMAROPA)'),
(406, '9017', 'El Salvador', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(407, '3501', 'Enrile', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(408, '1000', 'Ermita', 'Metro Manila', 'NCR (National Capital Region)'),
(409, '1109', 'Escopa', 'Metro Manila', 'NCR (National Capital Region)'),
(410, '5407', 'Esperanza', 'Masbate', 'Region 5 (Bicol Region)'),
(411, '8513', 'Esperanza', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(412, '9806', 'Esperanza (Ampatuan)', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(413, '1710', 'Executive Heights Subd.', 'Metro Manila', 'NCR (National Capital Region)'),
(414, '2106', 'FAB (Freefort Area of Bataan)', 'Bataan', 'Region 3 (Central Luzon)'),
(415, '1118', 'Fairview', 'Metro Manila', 'NCR (National Capital Region)'),
(416, '1121', 'Fairview (North)', 'Metro Manila', 'NCR (National Capital Region)'),
(417, '1122', 'Fairview (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(418, '4021', 'Famy', 'Laguna', 'Region 4A (CALABARZON)'),
(419, '4218', 'Fernando Airbase', 'Batangas', 'Region 4A (CALABARZON)'),
(420, '5506', 'Ferrol', 'Romblon', 'Region 4B (MIMAROPA)'),
(421, '1781', 'Filinvest Corp. City', 'Metro Manila', 'NCR (National Capital Region)'),
(422, '1411', 'Fish Market', 'Metro Manila', 'NCR (National Capital Region)'),
(423, '1411', 'Fish Market', 'Metro Manila', 'NCR (National Capital Region)'),
(424, '3810', 'Flora', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(425, '1471', 'Flores', 'Metro Manila', 'NCR (National Capital Region)'),
(426, '2006', 'Floridablanca', 'Pampanga', 'Region 3 (Central Luzon)'),
(427, '1219', 'Forbes Park (North)', 'Metro Manila', 'NCR (National Capital Region)'),
(428, '1220', 'Forbes Park (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(429, '1202', 'Fort Bonifacio Naval Stn.', 'Metro Manila', 'NCR (National Capital Region)'),
(430, '3130', 'Fort Magsaysay', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(431, '1812', 'Fortune', 'Metro Manila', 'NCR (National Capital Region)'),
(432, '1442', 'Fortune Vil. - Paso De Blas - Gen. T. De Leon', 'Metro Manila', 'NCR (National Capital Region)'),
(433, '3131', 'Gabaldon', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(434, '4412', 'Gainza', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(435, '2709', 'Galimuyod', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(436, '3301', 'Gamu', 'Isabela', 'Region 2 (Cagayan Valley)'),
(437, '6706', 'Gandara', 'Samar', 'Region 8 (Eastern Visayas)'),
(438, '3105', 'Gapan City', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(439, '4428', 'Garchitorena', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(440, '4905', 'Gasan', 'Marinduque', 'Region 4B (MIMAROPA)'),
(441, '1745', 'Gatchalian Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(442, '3508', 'Gattaran', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(443, '4124', 'Gen. Aguinaldo (Bailen)', 'Cavite', 'Region 4A (CALABARZON)'),
(444, '8419', 'Gen. Luna', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(445, '3125', 'Gen. M. Natividad', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(446, '4117', 'Gen. Mariano Alvarez', 'Cavite', 'Region 4A (CALABARZON)'),
(447, '9500', 'Gen. Santos City', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(448, '3104', 'Gen. Tinio', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(449, '4107', 'Gen. Trias', 'Cavite', 'Region 4A (CALABARZON)'),
(450, '4310', 'General Luna', 'Quezon', 'Region 4A (CALABARZON)'),
(451, '4338', 'General Nakar', 'Quezon', 'Region 4A (CALABARZON)'),
(452, '2302', 'Gerona', 'Tarlac', 'Region 3 (Central Luzon)'),
(453, '8409', 'Gigaquit', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(454, '4804', 'Gigmoto', 'Catanduanes', 'Region 5 (Bicol Region)'),
(455, '9014', 'Gingoog City', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(456, '1114', 'Gintong Silahis', 'Metro Manila', 'NCR (National Capital Region)'),
(457, '9020', 'Gitagum', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(458, '9517', 'Glan', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(459, '5209', 'Gloria', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(460, '4422', 'Goa', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(461, '3513', 'Gonzaga', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(462, '8210', 'Gov. Generoso', 'Davao Oriental', 'Region 11 (Davao Region)'),
(463, '1403', 'Grace Park (East)', 'Metro Manila', 'NCR (National Capital Region)'),
(464, '1406', 'Grace Park (West)', 'Metro Manila', 'NCR (National Capital Region)'),
(465, '1612', 'Green Park', 'Metro Manila', 'NCR (National Capital Region)'),
(466, '1228', 'Greenbelt', 'Metro Manila', 'NCR (National Capital Region)'),
(467, '1503', 'Greenhills North', 'Metro Manila', 'NCR (National Capital Region)'),
(468, '1502', 'Greenhills PO', 'Metro Manila', 'NCR (National Capital Region)'),
(469, '1556', 'Greenhills South', 'Metro Manila', 'NCR (National Capital Region)'),
(470, '2720', 'Gregorio del Pilar (Concepcion)', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(471, '1212', 'Guadalupe Nuevo (Inc. Visayan)', 'Metro Manila', 'NCR (National Capital Region)'),
(472, '1211', 'Guadalupe Viejo (Inc. Palm Vil)', 'Metro Manila', 'NCR (National Capital Region)'),
(473, '2003', 'Guagua', 'Pampanga', 'Region 3 (Central Luzon)'),
(474, '4710', 'Gubat', 'Sorsogon', 'Region 5 (Bicol Region)'),
(475, '3015', 'Guiguinto', 'Bulacan', 'Region 3 (Central Luzon)'),
(476, '3115', 'Guimba', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(477, '4319', 'Guinayangan', 'Quezon', 'Region 4A (CALABARZON)'),
(478, '4503', 'Guinobatan', 'Albay', 'Region 5 (Bicol Region)'),
(479, '9102', 'Guinsiliban', 'Camiguin', 'Region 10 (Northern Mindanao)'),
(480, '1117', 'Gulod', 'Metro Manila', 'NCR (National Capital Region)'),
(481, '4307', 'Gumaca', 'Quezon', 'Region 4A (CALABARZON)'),
(482, '3002', 'Hagonoy', 'Bulacan', 'Region 3 (Central Luzon)'),
(483, '8006', 'Hagonoy', 'Davao del Sur', 'Region 11 (Davao Region)'),
(484, '2111', 'Hermosa', 'Bataan', 'Region 3 (Central Luzon)'),
(485, '6713', 'Hinabangan', 'Samar', 'Region 8 (Eastern Visayas)'),
(486, '8310', 'Hinatuan', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(487, '3607', 'Hingyon', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(488, '1127', 'Holy Spirit', 'Metro Manila', 'NCR (National Capital Region)'),
(489, '4317', 'Hondagua', 'Quezon', 'Region 4A (CALABARZON)'),
(490, '1112', 'Horseshoe', 'Metro Manila', 'NCR (National Capital Region)'),
(491, '3603', 'Hungduan', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(492, '2201', 'Iba', 'Zambales', 'Region 3 (Central Luzon)'),
(493, '4230', 'Ibaan', 'Batangas', 'Region 4A (CALABARZON)'),
(494, '3504', 'Iguig', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(495, '9200', 'Iligan City', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(496, '1111', 'Immaculate Concepcion', 'Metro Manila', 'NCR (National Capital Region)'),
(497, '4103', 'Imus', 'Cavite', 'Region 4A (CALABARZON)'),
(498, '4122', 'Indang', 'Cavite', 'Region 4A (CALABARZON)'),
(499, '1802', 'Industrial Valley', 'Metro Manila', 'NCR (National Capital Region)'),
(500, '4336', 'Infanta', 'Quezon', 'Region 4A (CALABARZON)'),
(501, '9022', 'Initao', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(502, '1002', 'Intramuros', 'Metro Manila', 'NCR (National Capital Region)'),
(503, '1714', 'Ireneville Ii', 'Metro Manila', 'NCR (National Capital Region)'),
(504, '1719', 'Ireneville Subdivision I & Ii', 'Metro Manila', 'NCR (National Capital Region)'),
(505, '4431', 'Iriga City', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(506, '4707', 'Irosin', 'Sorsogon', 'Region 5 (Bicol Region)'),
(507, '1412', 'Isla De Cocomo', 'Metro Manila', 'NCR (National Capital Region)'),
(508, '1412', 'Isla de Cocomo', 'Metro Manila', 'NCR (National Capital Region)'),
(509, '9805', 'Isulan', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(510, '3905', 'Itbayat', 'Batanes', 'Region 2 (Cagayan Valley)'),
(511, '2604', 'Itogon', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(512, '3902', 'Ivana', 'Batanes', 'Region 2 (Cagayan Valley)'),
(513, '5301', 'Iwahig Penal Colony', 'Palawan', 'Region 4B (MIMAROPA)'),
(514, '1804', 'J. De La Peña', 'Metro Manila', 'NCR (National Capital Region)'),
(515, '8607', 'Jabonga', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(516, '3109', 'Jaen', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(517, '1990', 'Jalajala', 'Rizal', 'Region 4A (CALABARZON)'),
(518, '9003', 'Jasaan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(519, '6701', 'Jiabong', 'Samar', 'Region 8 (Eastern Visayas)'),
(520, '7204', 'Jimenez', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(521, '4342', 'Jomalig', 'Quezon', 'Region 4A (CALABARZON)'),
(522, '3313', 'Jones', 'Isabela', 'Region 2 (Cagayan Valley)'),
(523, '8014', 'Jose Abad Santos', 'Davao Occidental', 'Region 11 (Davao Region)'),
(524, '4606', 'Jose Panganiban', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(525, '4515', 'Jovellar', 'Albay', 'Region 5 (Bicol Region)'),
(526, '4703', 'Juban', 'Sorsogon', 'Region 5 (Bicol Region)'),
(527, '9407', 'Kabacan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(528, '2606', 'Kabayan', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(529, '3809', 'Kabugao', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(530, '9808', 'Kalamansig', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(531, '5322', 'Kalayaan', 'Palawan', 'Region 4B (MIMAROPA)'),
(532, '4015', 'Kalayaan', 'Laguna', 'Region 4A (CALABARZON)'),
(533, '1112', 'Kalusugan', 'Metro Manila', 'NCR (National Capital Region)'),
(534, '1102', 'Kamias', 'Metro Manila', 'NCR (National Capital Region)'),
(535, '1103', 'Kamuning', 'Metro Manila', 'NCR (National Capital Region)'),
(536, '8113', 'Kapalong', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(537, '2613', 'Kapangan', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(538, '9214', 'Kapatagan', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(539, '1413', 'Kapitbahayan (East)', 'Metro Manila', 'NCR (National Capital Region)'),
(540, '1413', 'Kapitbahayan (East)', 'Metro Manila', 'NCR (National Capital Region)'),
(541, '1603', 'Kapitolyo', 'Metro Manila', 'NCR (National Capital Region)'),
(542, '8120', 'Kaputian', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(543, '1441', 'Karuhatan', 'Metro Manila', 'NCR (National Capital Region)'),
(544, '3703', 'Kasibu', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(545, '1206', 'Kasilawan', 'Metro Manila', 'NCR (National Capital Region)'),
(546, '1105', 'Katipunan', 'Metro Manila', 'NCR (National Capital Region)'),
(547, '1111', 'Kaunlaran', 'Metro Manila', 'NCR (National Capital Region)'),
(548, '1409', 'Kaunlaran Village', 'Metro Manila', 'NCR (National Capital Region)'),
(549, '1409', 'Kaunlaran Village', 'Metro Manila', 'NCR (National Capital Region)'),
(550, '1409', 'Kaunlaran Village', 'Metro Manila', 'NCR (National Capital Region)'),
(551, '9202', 'Kauswagan', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(552, '4104', 'Kawit', 'Cavite', 'Region 4A (CALABARZON)'),
(553, '3708', 'Kayapa', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(554, '1420', 'Kaybiga/Deparo', 'Metro Manila', 'NCR (National Capital Region)'),
(555, '9514', 'Kiamba', 'Agusan del Norte', 'Region 12 (SOCCSKSARGEN)'),
(556, '3604', 'Kiangan', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(557, '8008', 'Kiblawan', 'Davao del Sur', 'Region 11 (Davao Region)'),
(558, '2611', 'Kibungan', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(559, '9400', 'Kidapawan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(560, '9010', 'Kinoguitan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(561, '8716', 'Kitaotao', 'Agusan del Norte', 'Region 10 (Northern Mindanao)'),
(562, '8609', 'Kitcharao', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(563, '9207', 'Kolambugan', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(564, '9506', 'Koronadal', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(565, '1112', 'Kristong Hari', 'Metro Manila', 'NCR (National Capital Region)'),
(566, '1101', 'Krus Na Ligas', 'Metro Manila', 'NCR (National Capital Region)'),
(567, '1114', 'La Loma', 'Metro Manila', 'NCR (National Capital Region)'),
(568, '2826', 'La Paz', 'Abra', 'CAR (Cordillera Administrative Region)'),
(569, '8508', 'La Paz', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(570, '2314', 'La Paz', 'Tarlac', 'Region 3 (Central Luzon)'),
(571, '1204', 'La Paz-Singkamas-Tejeros', 'Metro Manila', 'NCR (National Capital Region)'),
(572, '2601', 'La Trinidad', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(573, '8810', 'Laak (formerly San Vicente)', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(574, '4604', 'Labo', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(575, '2821', 'Lacub', 'Abra', 'CAR (Cordillera Administrative Region)'),
(576, '2802', 'Lagangilang', 'Abra', 'CAR (Cordillera Administrative Region)'),
(577, '3600', 'Lagawe', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(578, '2824', 'Lagayan', 'Abra', 'CAR (Cordillera Administrative Region)'),
(579, '9006', 'Lagonglong', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(580, '4425', 'Lagonoy', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(581, '9019', 'Laguindingan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(582, '4034', 'Laguna Technopark', 'Laguna', 'Region 4A (CALABARZON)'),
(583, '9518', 'Lake Sebu', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(584, '9211', 'Lala', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(585, '3509', 'Lal-lo', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(586, '2104', 'Lamao', 'Bataan', 'Region 3 (Central Luzon)'),
(587, '3605', 'Lamut', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(588, '1874', 'Langhaya', 'Rizal', 'Region 4A (CALABARZON)'),
(589, '2807', 'Langiden', 'Abra', 'CAR (Cordillera Administrative Region)'),
(590, '1103', 'Langing Handa', 'Metro Manila', 'NCR (National Capital Region)'),
(591, '8722', 'Lantapan', 'Agusan del Norte', 'Region 10 (Northern Mindanao)'),
(592, '8314', 'Lanuza', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(593, '2900', 'Laoag City', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(594, '8610', 'Las Nieves', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(595, '1740', 'Las Piñas CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(596, '3524', 'Lasam', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(597, '3129', 'Laur', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(598, '4221', 'Laurel', 'Batangas', 'Region 4A (CALABARZON)'),
(599, '9807', 'Lebak (Salaman)', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(600, '1229', 'Legaspi Village', 'Metro Manila', 'NCR (National Capital Region)'),
(601, '4500', 'Legazpi City', 'Albay', 'Region 5 (Bicol Region)'),
(602, '4209', 'Lemery', 'Batangas', 'Region 4A (CALABARZON)'),
(603, '4216', 'Lian', 'Batangas', 'Region 4A (CALABARZON)'),
(604, '8307', 'Lianga', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(605, '9021', 'Libertad', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(606, '1110', 'Libis', 'Metro Manila', 'NCR (National Capital Region)'),
(607, '8414', 'Libjo (formerly Albor', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(608, '4407', 'Libmanan', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(609, '4507', 'Libon', 'Albay', 'Region 5 (Bicol Region)'),
(610, '8706', 'Libona', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(611, '9411', 'Libungan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(612, '3112', 'Licab', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(613, '2819', 'Licuan-Baay', 'Abra', 'CAR (Cordillera Administrative Region)'),
(614, '2723', 'Lidlidda', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(615, '4504', 'Ligao', 'Albay', 'Region 5 (Bicol Region)'),
(616, '4004', 'Liliw', 'Laguna', 'Region 4A (CALABARZON)'),
(617, '1423', 'Lilles Ville Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(618, '2103', 'Limay', 'Bataan', 'Region 3 (Central Luzon)'),
(619, '9201', 'Linamon', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(620, '5314', 'Linapacan', 'Palawan', 'Region 4B (MIMAROPA)'),
(621, '8312', 'Lingig', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(622, '1446', 'Lingunan', 'Metro Manila', 'NCR (National Capital Region)'),
(623, '4217', 'Lipa City', 'Batangas', 'Region 4A (CALABARZON)'),
(624, '3126', 'Llanera', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(625, '4229', 'Lobo', 'Batangas', 'Region 4A (CALABARZON)'),
(626, '1472', 'Longos', 'Metro Manila', 'NCR (National Capital Region)'),
(627, '5507', 'Looc', 'Romblon', 'Region 4B (MIMAROPA)'),
(628, '5111', 'Looc', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(629, '4316', 'Lopez', 'Quezon', 'Region 4A (CALABARZON)'),
(630, '7208', 'Lopez Jaena', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(631, '8415', 'Loreto', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(632, '8507', 'Loreto', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(633, '4030', 'Los Baños', 'Laguna', 'Region 4A (CALABARZON)'),
(634, '1114', 'Lourdes', 'Metro Manila', 'NCR (National Capital Region)'),
(635, '1108', 'Loyola Heights', 'Metro Manila', 'NCR (National Capital Region)'),
(636, '2813', 'Luba', 'Abra', 'CAR (Cordillera Administrative Region)'),
(637, '5109', 'Lubang', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(638, '2005', 'Lubao', 'Pampanga', 'Region 3 (Central Luzon)'),
(639, '3802', 'Lubuagan', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(640, '4328', 'Lucban', 'Quezon', 'Region 4A (CALABARZON)'),
(641, '4301', 'Lucena City', 'Quezon', 'Region 4A (CALABARZON)'),
(642, '9025', 'Lugait', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(643, '4032', 'Luisiana', 'Laguna', 'Region 4A (CALABARZON)'),
(644, '4014', 'Lumban', 'Laguna', 'Region 4A (CALABARZON)'),
(645, '2518', 'Luna', 'La Union', 'Region 1 (Ilocos Region)'),
(646, '3813', 'Luna', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(647, '3304', 'Luna', 'Isabela', 'Region 2 (Cagayan Valley)'),
(648, '3122', 'Lupao', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(649, '4409', 'Lupi', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(650, '8207', 'Lupon', 'Davao Oriental', 'Region 11 (Davao Region)'),
(651, '9803', 'Lutayan', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(652, '9502', 'Maasim', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(653, '2010', 'Mabalacat', 'Pampanga', 'Region 3 (Central Luzon)'),
(654, '4202', 'Mabini', 'Batangas', 'Region 4A (CALABARZON)'),
(655, '8807', 'Mabini', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(656, '4020', 'Mabitac', 'Laguna', 'Region 4A (CALABARZON)'),
(657, '2018', 'Macabebe', 'Pampanga', 'Region 3 (Central Luzon)'),
(658, '4309', 'Macalelon', 'Quezon', 'Region 4A (CALABARZON)'),
(659, '8806', 'Maco', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(660, '3333', 'Maconacon', 'Isabela', 'Region 2 (Cagayan Valley)'),
(661, '3404', 'Maddela', 'Quirino', 'Region 2 (Cagayan Valley)'),
(662, '8316', 'Madrid', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(663, '2011', 'Magalang', 'Pampanga', 'Region 3 (Central Luzon)'),
(664, '4705', 'Magallanes', 'Sorsogon', 'Region 5 (Bicol Region)'),
(665, '8604', 'Magallanes', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(666, '4113', 'Magallanes', 'Cavite', 'Region 4A (CALABARZON)'),
(667, '1232', 'Magallanes Village', 'Metro Manila', 'NCR (National Capital Region)'),
(668, '4403', 'Magarao', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(669, '4007', 'Magdalena', 'Laguna', 'Region 4A (CALABARZON)'),
(670, '5511', 'Magdiwang', 'Romblon', 'Region 4B (MIMAROPA)'),
(671, '9404', 'Magpet', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(672, '5319', 'Magsaysay', 'Palawan', 'Region 4B (MIMAROPA)'),
(673, '5101', 'Magsaysay', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(674, '8004', 'Magsaysay', 'Davao del Sur', 'Region 11 (Davao Region)'),
(675, '9015', 'Magsaysay', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(676, '9221', 'Magsaysay', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(677, '2730', 'Magsingal', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(678, '1114', 'Maharlika', 'Metro Manila', 'NCR (National Capital Region)'),
(679, '3901', 'Mahatao', 'Batanes', 'Region 2 (Cagayan Valley)'),
(680, '9101', 'Mahinog', 'Camiguin', 'Region 10 (Northern Mindanao)'),
(681, '9206', 'Maigo', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(682, '8407', 'Mainit', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(683, '9515', 'Maitum', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(684, '4005', 'Majayjay', 'Laguna', 'Region 4A (CALABARZON)'),
(685, '1200', 'Makati CPO (Inc, Buendia Up To)', 'Metro Manila', 'NCR (National Capital Region)'),
(686, '9401', 'Makilala', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(687, '1470', 'Malabon', 'Metro Manila', 'NCR (National Capital Region)'),
(688, '8010', 'Malalag', 'Davao del Sur', 'Region 11 (Davao Region)'),
(689, '1805', 'Malanday', 'Metro Manila', 'NCR (National Capital Region)'),
(690, '9516', 'Malapatan', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(691, '1004', 'Malate', 'Metro Manila', 'NCR (National Capital Region)'),
(692, '1101', 'Malaya', 'Metro Manila', 'NCR (National Capital Region)'),
(693, '8700', 'Malaybalay', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(694, '2820', 'Malibcong', 'Abra', 'CAR (Cordillera Administrative Region)'),
(695, '4510', 'Malilipot', 'Albay', 'Region 5 (Bicol Region)'),
(696, '8402', 'Malimono', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(697, '4512', 'Malinao', 'Albay', 'Region 5 (Bicol Region)'),
(698, '1440', 'Malinta CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(699, '8012', 'Malita', 'Davao Occidental', 'Region 11 (Davao Region)'),
(700, '8704', 'Malitbog', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(701, '8319', 'Malixi', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(702, '3323', 'Mallig', 'Isabela', 'Region 2 (Cagayan Valley)');
INSERT INTO `cityprovregion` (`ID_cpr`, `zip_code`, `city`, `state`, `region`) VALUES
(703, '3000', 'Malolos', 'Bulacan', 'Region 3 (Central Luzon)'),
(704, '9503', 'Malungon', 'Sarangani', 'Region 12 (SOCCSKSARGEN)'),
(705, '4233', 'Malvar', 'Batangas', 'Region 4A (CALABARZON)'),
(706, '1875', 'Mambagat', 'Rizal', 'Region 4A (CALABARZON)'),
(707, '9100', 'Mambajao', 'Camiguin', 'Region 10 (Northern Mindanao)'),
(708, '5106', 'Mamburao', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(709, '2810', 'Manabo', 'Abra', 'CAR (Cordillera Administrative Region)'),
(710, '8202', 'Manay', 'Davao Oriental', 'Region 11 (Davao Region)'),
(711, '1550', 'Mandaluyong CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(712, '5411', 'Mandaon', 'Masbate', 'Region 5 (Bicol Region)'),
(713, '8020', 'Mandug', 'Davao del Sur', 'Region 11 (Davao Region)'),
(714, '2432', 'Mangaldan', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(715, '2413', 'Mangatarem', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(716, '1109', 'Mangga', 'Metro Manila', 'NCR (National Capital Region)'),
(717, '1611', 'Manggahan', 'Metro Manila', 'NCR (National Capital Region)'),
(718, '1308', 'Manila Bay (Reclamation)', 'Metro Manila', 'NCR (National Capital Region)'),
(719, '1748', 'Manila Doctors Village', 'Metro Manila', 'NCR (National Capital Region)'),
(720, '1717', 'Manila Memorial Park', 'Metro Manila', 'NCR (National Capital Region)'),
(721, '4514', 'Manito', 'Albay', 'Region 5 (Bicol Region)'),
(722, '2608', 'Mankayan', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(723, '8703', 'Manolo Fortich', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(724, '1115', 'Manresa', 'Metro Manila', 'NCR (National Capital Region)'),
(725, '5213', 'Mansalay', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(726, '9024', 'Manticao', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(727, '1744', 'Manuyo', 'Metro Manila', 'NCR (National Capital Region)'),
(728, '2429', 'Mapandan', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(729, '1448', 'Mapulang Lupa', 'Metro Manila', 'NCR (National Capital Region)'),
(730, '6721', 'Marabut', 'Samar', 'Region 8 (Eastern Visayas)'),
(731, '4112', 'Maragondon', 'Cavite', 'Region 4A (CALABARZON)'),
(732, '8808', 'Maragusan (formerly San Mariano)', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(733, '8714', 'Maramag', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(734, '2907', 'Marcos', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(735, '3202', 'Maria Aurora', 'Aurora', 'Region 3 (Central Luzon)'),
(736, '1112', 'Mariana', 'Metro Manila', 'NCR (National Capital Region)'),
(737, '9802', 'Mariano Marcos', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(738, '1104', 'Mariblo', 'Metro Manila', 'NCR (National Capital Region)'),
(739, '8306', 'Marihatag', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(740, '1800', 'Marikina CPO - Sta. Elena - Sto. Niño', 'Metro Manila', 'NCR (National Capital Region)'),
(741, '1810', 'Marikina Heights', 'Metro Manila', 'NCR (National Capital Region)'),
(742, '1109', 'Marilag', 'Metro Manila', 'NCR (National Capital Region)'),
(743, '3019', 'Marilao', 'Bulacan', 'Region 3 (Central Luzon)'),
(744, '1703', 'Marina Subd. (Reclamation)', 'Metro Manila', 'NCR (National Capital Region)'),
(745, '1109', 'Masagana', 'Metro Manila', 'NCR (National Capital Region)'),
(746, '1115', 'Masambong', 'Metro Manila', 'NCR (National Capital Region)'),
(747, '2017', 'Masantol', 'Pampanga', 'Region 3 (Central Luzon)'),
(748, '5400', 'Masbate', 'Masbate', 'Region 5 (Bicol Region)'),
(749, '4223', 'Mataas na Kahoy', 'Batangas', 'Region 4A (CALABARZON)'),
(750, '1114', 'Matalahib', 'Metro Manila', 'NCR (National Capital Region)'),
(751, '9406', 'Matalam', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(752, '8003', 'Matanao', 'Davao del Sur', 'Region 11 (Davao Region)'),
(753, '1119', 'Matandang Balara', 'Metro Manila', 'NCR (National Capital Region)'),
(754, '8200', 'Mati', 'Davao Oriental', 'Region 11 (Davao Region)'),
(755, '8021', 'Matina', 'Davao del Sur', 'Region 11 (Davao Region)'),
(756, '4708', 'Matnog', 'Sorsogon', 'Region 5 (Bicol Region)'),
(757, '6708', 'Matuguinao', 'Samar', 'Region 8 (Eastern Visayas)'),
(758, '9203', 'Matungao', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(759, '4330', 'Mauban', 'Quezon', 'Region 4A (CALABARZON)'),
(760, '8802', 'Mawab', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(761, '1871', 'Mayamot', 'Rizal', 'Region 4A (CALABARZON)'),
(762, '2304', 'Mayantoc', 'Tarlac', 'Region 3 (Central Luzon)'),
(763, '1607', 'Maybunga', 'Metro Manila', 'NCR (National Capital Region)'),
(764, '3602', 'Mayoyao', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(765, '1410', 'Maypajo', 'Metro Manila', 'NCR (National Capital Region)'),
(766, '1477', 'Maysilo', 'Metro Manila', 'NCR (National Capital Region)'),
(767, '1719', 'Maywood I', 'Metro Manila', 'NCR (National Capital Region)'),
(768, '1716', 'Maywood Village Ii', 'Metro Manila', 'NCR (National Capital Region)'),
(769, '9013', 'Medina', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(770, '4121', 'Mendez', 'Cavite', 'Region 4A (CALABARZON)'),
(771, '4601', 'Mercedes', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(772, '1709', 'Merville Park', 'Metro Manila', 'NCR (National Capital Region)'),
(773, '2021', 'Mexico', 'Pampanga', 'Region 3 (Central Luzon)'),
(774, '3020', 'Meycauayan', 'Bulacan', 'Region 3 (Central Luzon)'),
(775, '9410', 'Midsayap', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(776, '5410', 'Milagros', 'Masbate', 'Region 5 (Bicol Region)'),
(777, '1109', 'Milagrosa', 'Metro Manila', 'NCR (National Capital Region)'),
(778, '4413', 'Milaor', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(779, '4414', 'Minalabac', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(780, '2019', 'Minalin', 'Pampanga', 'Region 3 (Central Luzon)'),
(781, '8022', 'Mintal', 'Davao del Sur', 'Region 11 (Davao Region)'),
(782, '1712', 'Miramar Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(783, '9402', 'M\'lang', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(784, '5401', 'Mobo', 'Masbate', 'Region 5 (Bicol Region)'),
(785, '4901', 'Mogpog', 'Marinduque', 'Region 4B (MIMAROPA)'),
(786, '4135', 'Molino', 'Cavite', 'Region 4A (CALABARZON)'),
(787, '2308', 'Moncada', 'Tarlac', 'Region 3 (Central Luzon)'),
(788, '8805', 'Monkayo', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(789, '5418', 'Monreal', 'Masbate', 'Region 5 (Bicol Region)'),
(790, '8801', 'Montevista', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(791, '1709', 'Moonwalk', 'Metro Manila', 'NCR (National Capital Region)'),
(792, '1960', 'Morong', 'Rizal', 'Region 4A (CALABARZON)'),
(793, '6702', 'Motiong', 'Samar', 'Region 8 (Eastern Visayas)'),
(794, '4312', 'Mulanay', 'Quezon', 'Region 4A (CALABARZON)'),
(795, '1708', 'Multinational Village', 'Metro Manila', 'NCR (National Capital Region)'),
(796, '9219', 'Munai', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(797, '3119', 'Muñoz', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(798, '1770', 'Muntinlupa CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(799, '8710', 'Musuan', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(800, '1479', 'Muzon', 'Metro Manila', 'NCR (National Capital Region)'),
(801, '9023', 'Naawan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(802, '4434', 'Nabua', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(803, '8800', 'Nabunturan', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(804, '4400', 'Naga City', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(805, '2725', 'Nagbukel', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(806, '4002', 'Nagcarlan', 'Laguna', 'Region 4A (CALABARZON)'),
(807, '1125', 'Nagkaisang Nayon', 'Metro Manila', 'NCR (National Capital Region)'),
(808, '3405', 'Nagtipunan', 'Quirino', 'Region 2 (Cagayan Valley)'),
(809, '2511', 'Naguilian', 'La Union', 'Region 1 (Ilocos Region)'),
(810, '3302', 'Naguillan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(811, '4110', 'Naic', 'Cavite', 'Region 4A (CALABARZON)'),
(812, '3116', 'Nampicuan', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(813, '1808', 'Nangka', 'Metro Manila', 'NCR (National Capital Region)'),
(814, '5303', 'Narra (Panacan)', 'Palawan', 'Region 4B (MIMAROPA)'),
(815, '2704', 'Narvacan', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(816, '8602', 'Nasipit', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(817, '4231', 'Nasugbu', 'Batangas', 'Region 4A (CALABARZON)'),
(818, '2446', 'Natividad', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(819, '5204', 'Naujan', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(820, '1485', 'Navotas', 'Metro Manila', 'NCR (National Capital Region)'),
(821, '1104', 'Nayon Kaunlaran', 'Metro Manila', 'NCR (National Capital Region)'),
(822, '8804', 'New Bataan', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(823, '8104', 'New Corella', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(824, '1107', 'New Era', 'Metro Manila', 'NCR (National Capital Region)'),
(825, '1705', 'Ninoy Aquino Int’l. Airport', 'Metro Manila', 'NCR (National Capital Region)'),
(826, '9508', 'Norala', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(827, '3013', 'Norzagaray', 'Bulacan', 'Region 3 (Central Luzon)'),
(828, '1422', 'Novaliches North (Camarin North)', 'Metro Manila', 'NCR (National Capital Region)'),
(829, '1121', 'Novaliches Proper', 'Metro Manila', 'NCR (National Capital Region)'),
(830, '4105', 'Noveleta', 'Cavite', 'Region 4A (CALABARZON)'),
(831, '2909', 'Nueva Era', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(832, '9216', 'Nunungan', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(833, '4505', 'Oas', 'Albay', 'Region 5 (Bicol Region)'),
(834, '3021', 'Obando', 'Bulacan', 'Region 3 (Central Luzon)'),
(835, '1103', 'Obrero', 'Metro Manila', 'NCR (National Capital Region)'),
(836, '4419', 'Ocampo', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(837, '5505', 'Odiongan', 'Romblon', 'Region 4B (MIMAROPA)'),
(838, '1101', 'Old Capitol Site', 'Metro Manila', 'NCR (National Capital Region)'),
(839, '2200', 'Olongapo City', 'Zambales', 'Region 3 (Central Luzon)'),
(840, '1207', 'Olympia And Carmona', 'Metro Manila', 'NCR (National Capital Region)'),
(841, '9016', 'Opol', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(842, '7207', 'Oroquieta City', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(843, '1605', 'Ortigas PO', 'Metro Manila', 'NCR (National Capital Region)'),
(844, '7200', 'Ozamis City', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(845, '1114', 'Paang Bundok', 'Metro Manila', 'NCR (National Capital Region)'),
(846, '1007', 'Paco', 'Metro Manila', 'NCR (National Capital Region)'),
(847, '8007', 'Padada', 'Davao del Sur', 'Region 11 (Davao Region)'),
(848, '4303', 'Padre Burgos', 'Quezon', 'Region 4A (CALABARZON)'),
(849, '4224', 'Padre Garcia', 'Batangas', 'Region 4A (CALABARZON)'),
(850, '4016', 'Paete', 'Laguna', 'Region 4A (CALABARZON)'),
(851, '4302', 'Pagbilao', 'Quezon', 'Region 4A (CALABARZON)'),
(852, '1115', 'Pag-ibig Sa Nayon', 'Metro Manila', 'NCR (National Capital Region)'),
(853, '6705', 'Pagsanghan', 'Samar', 'Region 8 (Eastern Visayas)'),
(854, '4008', 'Pagsanjan', 'Laguna', 'Region 4A (CALABARZON)'),
(855, '2919', 'Pagudpud', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(856, '4017', 'Pakil', 'Laguna', 'Region 4A (CALABARZON)'),
(857, '1235', 'Palanan', 'Metro Manila', 'NCR (National Capital Region)'),
(858, '3334', 'Palanan', 'Isabela', 'Region 2 (Cagayan Valley)'),
(859, '5404', 'Palanas', 'Masbate', 'Region 5 (Bicol Region)'),
(860, '5107', 'Palauan', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(861, '2210', 'Palauig', 'Zambales', 'Region 3 (Central Luzon)'),
(862, '3132', 'Palayan City', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(863, '1103', 'Paligsahan', 'Metro Manila', 'NCR (National Capital Region)'),
(864, '9809', 'Palimbang', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(865, '1105', 'Paltok', 'Metro Manila', 'NCR (National Capital Region)'),
(866, '4416', 'Pamplona', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(867, '3522', 'Pamplona', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(868, '8105', 'Panabo', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(869, '7205', 'Panaon', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(870, '1011', 'Pandacan', 'Metro Manila', 'NCR (National Capital Region)'),
(871, '1011', 'Pandacan', 'Metro Manila', 'NCR (National Capital Region)'),
(872, '4809', 'Pandan', 'Catanduanes', 'Region 5 (Bicol Region)'),
(873, '3014', 'Pandi', 'Bulacan', 'Region 3 (Central Luzon)'),
(874, '4806', 'Panganiban', 'Catanduanes', 'Region 5 (Bicol Region)'),
(875, '8717', 'Pangantucan', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(876, '4018', 'Pangil', 'Laguna', 'Region 4A (CALABARZON)'),
(877, '2307', 'Paniqui', 'Tarlac', 'Region 3 (Central Luzon)'),
(878, '1108', 'Pansol', 'Metro Manila', 'NCR (National Capital Region)'),
(879, '3124', 'Pantabangan', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(880, '9208', 'Pantao Ragat', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(881, '9218', 'Pantar', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(882, '8809', 'Pantukan', 'Davao De Oro (Formerly Compostela Valley)', 'Region 11 (Davao Region)'),
(883, '4337', 'Panukulan', 'Quezon', 'Region 4A (CALABARZON)'),
(884, '2902', 'Paoay', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(885, '3001', 'Paombong', 'Bulacan', 'Region 3 (Central Luzon)'),
(886, '4605', 'Paracale', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(887, '1104', 'Paraiso', 'Metro Manila', 'NCR (National Capital Region)'),
(888, '1700', 'Parañaque CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(889, '1809', 'Parang', 'Metro Manila', 'NCR (National Capital Region)'),
(890, '4417', 'Pasacao', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(891, '1300', 'Pasay City CPO Malibay', 'Metro Manila', 'NCR (National Capital Region)'),
(892, '1600', 'Pasig CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(893, '3803', 'Pasil', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(894, '1118', 'Pasong Putik', 'Metro Manila', 'NCR (National Capital Region)'),
(895, '1107', 'Pasong Tamo', 'Metro Manila', 'NCR (National Capital Region)'),
(896, '1231', 'Pasong Tamo 2000 Up, Ecology V', 'Metro Manila', 'NCR (National Capital Region)'),
(897, '2917', 'Pasuquin', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(898, '4341', 'Patnanungan', 'Quezon', 'Region 4A (CALABARZON)'),
(899, '1119', 'Payatas', 'Metro Manila', 'NCR (National Capital Region)'),
(900, '1775', 'Pearl Heights', 'Metro Manila', 'NCR (National Capital Region)'),
(901, '1218', 'Pembo', 'Metro Manila', 'NCR (National Capital Region)'),
(902, '3502', 'Peñablanca', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(903, '3103', 'Peñaranda', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(904, '2804', 'Peñarrubia', 'Abra', 'CAR (Cordillera Administrative Region)'),
(905, '4334', 'Perez', 'Quezon', 'Region 4A (CALABARZON)'),
(906, '1553', 'Phil. Natl. Mental Hospital', 'Metro Manila', 'NCR (National Capital Region)'),
(907, '1104', 'Phil-am', 'Metro Manila', 'NCR (National Capital Region)'),
(908, '2602', 'Philippine Military Academy (PMA)', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(909, '8705', 'Phillips', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(910, '3527', 'Piat', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(911, '1307', 'PICC (Reclamation Area)', 'Metro Manila', 'NCR (National Capital Region)'),
(912, '2912', 'Piddig', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(913, '2806', 'Pidigan', 'Abra', 'CAR (Cordillera Administrative Region)'),
(914, '9412', 'Pigkawayan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(915, '9409', 'Pikit', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(916, '4010', 'Pila', 'Laguna', 'Region 4A (CALABARZON)'),
(917, '2812', 'Pilar', 'Abra', 'CAR (Cordillera Administrative Region)'),
(918, '4714', 'Pilar', 'Sorsogon', 'Region 5 (Bicol Region)'),
(919, '8420', 'Pilar', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(920, '4418', 'Pili', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(921, '1910', 'Pililla', 'Rizal', 'Region 4A (CALABARZON)'),
(922, '6716', 'Pinabacdao', 'Samar', 'Region 8 (Eastern Visayas)'),
(923, '1602', 'Pinagbuhatan', 'Metro Manila', 'NCR (National Capital Region)'),
(924, '1111', 'Pinagkaisahan', 'Metro Manila', 'NCR (National Capital Region)'),
(925, '1213', 'Pinagkaisahan-pitogo', 'Metro Manila', 'NCR (National Capital Region)'),
(926, '1100', 'Piñahan', 'Metro Manila', 'NCR (National Capital Region)'),
(927, '5208', 'Pinamalayan', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(928, '2905', 'Pinili', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(929, '3806', 'Pinukpok', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(930, '1230', 'Pio Del Pilar', 'Metro Manila', 'NCR (National Capital Region)'),
(931, '4516', 'Pio Duran (Malacbalac)', 'Albay', 'Region 5 (Bicol Region)'),
(932, '5406', 'Pio V. Corpuz', 'Masbate', 'Region 5 (Bicol Region)'),
(933, '4308', 'Pitogo', 'Quezon', 'Region 4A (CALABARZON)'),
(934, '5408', 'Placer', 'Masbate', 'Region 5 (Bicol Region)'),
(935, '8405', 'Placer', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(936, '4306', 'Plaridel', 'Quezon', 'Region 4A (CALABARZON)'),
(937, '3004', 'Plaridel', 'Bulacan', 'Region 3 (Central Luzon)'),
(938, '7209', 'Plaridel', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(939, '1777', 'Pleasant Village', 'Metro Manila', 'NCR (National Capital Region)'),
(940, '1776', 'Poblacion', 'Metro Manila', 'NCR (National Capital Region)'),
(941, '1210', 'Poblacion', 'Metro Manila', 'NCR (National Capital Region)'),
(942, '5206', 'Pola', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(943, '4506', 'Polangui', 'Albay', 'Region 5 (Bicol Region)'),
(944, '4339', 'Polilio', 'Quezon', 'Region 4A (CALABARZON)'),
(945, '9504', 'Polomolok', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(946, '9204', 'Poona Piagapo', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(947, '2008', 'Porac', 'Pampanga', 'Region 3 (Central Luzon)'),
(948, '1018', 'Port Area (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(949, '1475', 'Potrero', 'Metro Manila', 'NCR (National Capital Region)'),
(950, '2435', 'Pozorrubio', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(951, '9405', 'Pre. Roxas', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(952, '9804', 'Pres. Quirino', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(953, '4424', 'Presentacion', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(954, '4711', 'Prieto Diaz', 'Sorsogon', 'Region 5 (Bicol Region)'),
(955, '1109', 'Project 4', 'Metro Manila', 'NCR (National Capital Region)'),
(956, '1100', 'Project 6', 'Metro Manila', 'NCR (National Capital Region)'),
(957, '1105', 'Project 7', 'Metro Manila', 'NCR (National Capital Region)'),
(958, '1106', 'Project 8', 'Metro Manila', 'NCR (National Capital Region)'),
(959, '8500', 'Prosperidad', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(960, '3812', 'Pudtol', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(961, '5203', 'Puerto Galera', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(962, '5300', 'Puerto Princesa City', 'Palawan', 'Region 4B (MIMAROPA)'),
(963, '2508', 'Pugo', 'La Union', 'Region 1 (Ilocos Region)'),
(964, '1742', 'Pulang Lupa', 'Metro Manila', 'NCR (National Capital Region)'),
(965, '3005', 'Pulilan', 'Bulacan', 'Region 3 (Central Luzon)'),
(966, '1706', 'Pulo', 'Metro Manila', 'NCR (National Capital Region)'),
(967, '2312', 'Pura', 'Tarlac', 'Region 3 (Central Luzon)'),
(968, '5304', 'Quezon', 'Palawan', 'Region 4B (MIMAROPA)'),
(969, '4332', 'Quezon', 'Quezon', 'Region 4A (CALABARZON)'),
(970, '3113', 'Quezon', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(971, '3713', 'Quezon', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(972, '3324', 'Quezon', 'Isabela', 'Region 2 (Cagayan Valley)'),
(973, '8715', 'Quezon', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(974, '4300', 'Quezon Capitol', 'Quezon', 'Region 4A (CALABARZON)'),
(975, '1100', 'Quezon City', 'Metro Manila', 'NCR (National Capital Region)'),
(976, '1100', 'Quezon City CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(977, '1001', 'Quiapo', 'Metro Manila', 'NCR (National Capital Region)'),
(978, '3321', 'Quirino', 'Isabela', 'Region 2 (Cagayan Valley)'),
(979, '2721', 'Quirino (Angkaki)', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(980, '1102', 'Quirino Dist. (Proj. 2 & 3)', 'Metro Manila', 'NCR (National Capital Region)'),
(981, '4410', 'Ragay', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(982, '3319', 'Ramon', 'Isabela', 'Region 2 (Cagayan Valley)'),
(983, '1105', 'Ramon Magsaysay', 'Metro Manila', 'NCR (National Capital Region)'),
(984, '2311', 'Ramos', 'Tarlac', 'Region 3 (Central Luzon)'),
(985, '4517', 'Rapu-Rapu', 'Albay', 'Region 5 (Bicol Region)'),
(986, '4335', 'Real', 'Quezon', 'Region 4A (CALABARZON)'),
(987, '3303', 'Reina Mercedes', 'Isabela', 'Region 2 (Cagayan Valley)'),
(988, '1741', 'Remarville Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(989, '1216', 'Rembo (East) & Malapad Na Bato', 'Metro Manila', 'NCR (National Capital Region)'),
(990, '1215', 'Rembo (West)', 'Metro Manila', 'NCR (National Capital Region)'),
(991, '8611', 'Remedios T. Romualdez', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(992, '3808', 'Rizal', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(993, '5103', 'Rizal', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(994, '4003', 'Rizal', 'Laguna', 'Region 4A (CALABARZON)'),
(995, '3127', 'Rizal', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(996, '3526', 'Rizal', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(997, '5323', 'Rizal (Marcos)', 'Palawan', 'Region 4B (MIMAROPA)'),
(998, '1860', 'Rodriguez (Montalban)', 'Rizal', 'Region 4A (CALABARZON)'),
(999, '5500', 'Romblon', 'Romblon', 'Region 4B (MIMAROPA)'),
(1000, '2441', 'Rosales', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1001, '2506', 'Rosario', 'La Union', 'Region 1 (Ilocos Region)'),
(1002, '1609', 'Rosario', 'Metro Manila', 'NCR (National Capital Region)'),
(1003, '8504', 'Rosario', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1004, '4106', 'Rosario', 'Cavite', 'Region 4A (CALABARZON)'),
(1005, '4225', 'Rosario', 'Batangas', 'Region 4A (CALABARZON)'),
(1006, '5308', 'Roxas', 'Palawan', 'Region 4B (MIMAROPA)'),
(1007, '5212', 'Roxas', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(1008, '3320', 'Roxas', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1009, '1103', 'Roxas District', 'Metro Manila', 'NCR (National Capital Region)'),
(1010, '2614', 'Sablan', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(1011, '5104', 'Sablayan', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(1012, '3904', 'Sabtang', 'Batanes', 'Region 2 (Cagayan Valley)'),
(1013, '1103', 'Sacred Heart', 'Metro Manila', 'NCR (National Capital Region)'),
(1014, '9103', 'Sagay', 'Camiguin', 'Region 10 (Northern Mindanao)'),
(1015, '4421', 'Sagnay', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1016, '3402', 'Saguday', 'Quirino', 'Region 2 (Cagayan Valley)'),
(1017, '9007', 'Salay', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(1018, '2711', 'Salcedo (Baugen)', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1019, '1227', 'Salcedo Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1020, '2818', 'Sallapadan', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1021, '1106', 'Salumbato', 'Metro Manila', 'NCR (National Capital Region)'),
(1022, '1114', 'Salvacion', 'Metro Manila', 'NCR (National Capital Region)'),
(1023, '9212', 'Salvador', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1024, '8119', 'Samal', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(1025, '4329', 'Sampaloc', 'Quezon', 'Region 4A (CALABARZON)'),
(1026, '1008', 'Sampaloc (East)', 'Metro Manila', 'NCR (National Capital Region)'),
(1027, '1015', 'Sampaloc (West)', 'Metro Manila', 'NCR (National Capital Region)'),
(1028, '1117', 'San Agustin', 'Metro Manila', 'NCR (National Capital Region)'),
(1029, '5501', 'San Agustin', 'Romblon', 'Region 4B (MIMAROPA)'),
(1030, '8305', 'San Agustin', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(1031, '3314', 'San Agustin', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1032, '4810', 'San Andres', 'Catanduanes', 'Region 5 (Bicol Region)'),
(1033, '5504', 'San Andres', 'Romblon', 'Region 4B (MIMAROPA)'),
(1034, '4314', 'San Andres', 'Quezon', 'Region 4A (CALABARZON)'),
(1035, '1017', 'San Andres Bukid', 'Metro Manila', 'NCR (National Capital Region)'),
(1036, '1105', 'San Antonio', 'Metro Manila', 'NCR (National Capital Region)'),
(1037, '4324', 'San Antonio', 'Quezon', 'Region 4A (CALABARZON)'),
(1038, '2206', 'San Antonio', 'Zambales', 'Region 3 (Central Luzon)'),
(1039, '3108', 'San Antonio', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1040, '1707', 'San Antonio Valley 11 & 12', 'Metro Manila', 'NCR (National Capital Region)'),
(1041, '1715', 'San Antonio Valley I', 'Metro Manila', 'NCR (National Capital Region)'),
(1042, '1203', 'San Antonio Village (Inc. Malu)', 'Metro Manila', 'NCR (National Capital Region)'),
(1043, '1116', 'San Bartolome', 'Metro Manila', 'NCR (National Capital Region)'),
(1044, '8423', 'San Benito', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1045, '2420', 'San Carlos City', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1046, '2305', 'San Clemente', 'Tarlac', 'Region 3 (Central Luzon)'),
(1047, '2722', 'San Emilio', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1048, '2706', 'San Esteban', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1049, '2433', 'San Fabian', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1050, '2204', 'San Felipe', 'Zambales', 'Region 3 (Central Luzon)'),
(1051, '5416', 'San Fernando', 'Masbate', 'Region 5 (Bicol Region)'),
(1052, '4415', 'San Fernando', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1053, '5513', 'San fernando', 'Romblon', 'Region 4B (MIMAROPA)'),
(1054, '2000', 'San Fernando', 'Pampanga', 'Region 3 (Central Luzon)'),
(1055, '8711', 'San Fernando', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(1056, '2500', 'San Fernando City', 'La Union', 'Region 1 (Ilocos Region)'),
(1057, '4315', 'San Francisco', 'Quezon', 'Region 4A (CALABARZON)'),
(1058, '8401', 'San Francisco', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1059, '8501', 'San Francisco', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1060, '2513', 'San Gabriel', 'La Union', 'Region 1 (Ilocos Region)'),
(1061, '3308', 'San Guillermo', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1062, '2728', 'San Ildefonso', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1063, '3010', 'San Ildefonso', 'Bulacan', 'Region 3 (Central Luzon)'),
(1064, '1113', 'San Isidro', 'Metro Manila', 'NCR (National Capital Region)'),
(1065, '1306', 'San Isidro', 'Metro Manila', 'NCR (National Capital Region)'),
(1066, '1234', 'San Isidro', 'Metro Manila', 'NCR (National Capital Region)'),
(1067, '2809', 'San Isidro', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1068, '8421', 'San Isidro', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1069, '3106', 'San Isidro', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1070, '8209', 'San Isidro', 'Davao Oriental', 'Region 11 (Davao Region)'),
(1071, '8121', 'San Isidro', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(1072, '3310', 'San Isidro', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1073, '1114', 'San Isidro Labrador', 'Metro Manila', 'NCR (National Capital Region)'),
(1074, '5417', 'San Jacinto', 'Masbate', 'Region 5 (Bicol Region)'),
(1075, '2431', 'San Jacinto', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1076, '1601', 'San Joaquin', 'Metro Manila', 'NCR (National Capital Region)'),
(1077, '6707', 'San Jorge', 'Samar', 'Region 8 (Eastern Visayas)'),
(1078, '1115', 'San Jose', 'Metro Manila', 'NCR (National Capital Region)'),
(1079, '1305', 'San Jose', 'Metro Manila', 'NCR (National Capital Region)'),
(1080, '1404', 'San Jose', 'Metro Manila', 'NCR (National Capital Region)'),
(1081, '4423', 'San Jose', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1082, '5510', 'San Jose', 'Romblon', 'Region 4B (MIMAROPA)'),
(1083, '5100', 'San Jose', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(1084, '8427', 'San Jose', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(1085, '2318', 'San Jose', 'Tarlac', 'Region 3 (Central Luzon)'),
(1086, '4227', 'San Jose', 'Batangas', 'Region 4A (CALABARZON)'),
(1087, '3121', 'San Jose City', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1088, '6723', 'San Jose de Buan', 'Samar', 'Region 8 (Eastern Visayas)'),
(1089, '3023', 'San Jose Del Monte', 'Bulacan', 'Region 3 (Central Luzon)'),
(1090, '2514', 'San Juan', 'La Union', 'Region 1 (Ilocos Region)'),
(1091, '2823', 'San Juan', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1092, '4226', 'San Juan', 'Batangas', 'Region 4A (CALABARZON)'),
(1093, '2731', 'San Juan (Lapog)', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1094, '1500', 'San Juan CPO', 'Metro Manila', 'NCR (National Capital Region)'),
(1095, '3102', 'San Leonardo', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1096, '4610', 'San Lorenzo Ruiz (formerly Imelda)', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1097, '1223', 'San Lorenzo Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1098, '8511', 'San Luis', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1099, '2014', 'San Luis', 'Pampanga', 'Region 3 (Central Luzon)'),
(1100, '4210', 'San Luis', 'Batangas', 'Region 4A (CALABARZON)'),
(1101, '3201', 'San Luis', 'Aurora', 'Region 3 (Central Luzon)'),
(1102, '2309', 'San Manuel', 'Tarlac', 'Region 3 (Central Luzon)'),
(1103, '3317', 'San Manuel', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1104, '2438', 'San Manuel', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1105, '2207', 'San Marcelino', 'Zambales', 'Region 3 (Central Luzon)'),
(1106, '3332', 'San Mariano', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1107, '1850', 'San Mateo', 'Rizal', 'Region 4A (CALABARZON)'),
(1108, '3318', 'San Mateo', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1109, '4802', 'San Miguel', 'Catanduanes', 'Region 5 (Bicol Region)'),
(1110, '8301', 'San Miguel', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(1111, '3011', 'San Miguel', 'Bulacan', 'Region 3 (Central Luzon)'),
(1112, '4313', 'San Narciso', 'Quezon', 'Region 4A (CALABARZON)'),
(1113, '2205', 'San Narciso', 'Zambales', 'Region 3 (Central Luzon)'),
(1114, '2901', 'San Nicolas', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(1115, '1010', 'San Nicolas', 'Metro Manila', 'NCR (National Capital Region)'),
(1116, '4207', 'San Nicolas', 'Batangas', 'Region 4A (CALABARZON)'),
(1117, '2447', 'San Nicolas', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1118, '3329', 'San Pablo', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1119, '4000', 'San Pablo City', 'Laguna', 'Region 4A (CALABARZON)'),
(1120, '5420', 'San Pascual', 'Masbate', 'Region 5 (Bicol Region)'),
(1121, '4204', 'San Pascual', 'Batangas', 'Region 4A (CALABARZON)'),
(1122, '4023', 'San Pedro', 'Laguna', 'Region 4A (CALABARZON)'),
(1123, '2808', 'San Quintin', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1124, '2444', 'San Quintin', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1125, '1302', 'San Rafael', 'Metro Manila', 'NCR (National Capital Region)'),
(1126, '3008', 'San Rafael', 'Bulacan', 'Region 3 (Central Luzon)'),
(1127, '1109', 'San Roque', 'Metro Manila', 'NCR (National Capital Region)'),
(1128, '1303', 'San Roque', 'Metro Manila', 'NCR (National Capital Region)'),
(1129, '1801', 'San Roque - Calumpang', 'Metro Manila', 'NCR (National Capital Region)'),
(1130, '6714', 'San Sebastian', 'Samar', 'Region 8 (Eastern Visayas)'),
(1131, '2015', 'San Simon', 'Pampanga', 'Region 3 (Central Luzon)'),
(1132, '5202', 'San Teodoro', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(1133, '2726', 'San Vicente', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1134, '1101', 'San Vicente', 'Metro Manila', 'NCR (National Capital Region)'),
(1135, '4609', 'San Vicente', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1136, '5309', 'San Vicente', 'Palawan', 'Region 4B (MIMAROPA)'),
(1137, '3518', 'Sanchez-Mira', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1138, '1116', 'Sangandaan', 'Metro Manila', 'NCR (National Capital Region)'),
(1139, '1408', 'Sangandaan', 'Metro Manila', 'NCR (National Capital Region)'),
(1140, '2703', 'Santa', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1141, '2022', 'Santa Ana', 'Pampanga', 'Region 3 (Central Luzon)'),
(1142, '2419', 'Santa Barbara', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1143, '2701', 'Santa Catalina', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1144, '1304', 'Santa Clara', 'Metro Manila', 'NCR (National Capital Region)'),
(1145, '2713', 'Santa Cruz', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1146, '1104', 'Santa Cruz', 'Metro Manila', 'NCR (National Capital Region)'),
(1147, '8001', 'Santa Cruz', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1148, '2025', 'Santa Cruz, Lubao', 'Pampanga', 'Region 3 (Central Luzon)'),
(1149, '2712', 'Santa Lucia', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1150, '1117', 'Santa Lucia', 'Metro Manila', 'NCR (National Capital Region)'),
(1151, '3811', 'Santa Marcela', 'Apayao', 'CAR (Cordillera Administrative Region)'),
(1152, '2705', 'Santa Maria', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1153, '8011', 'Santa Maria', 'Davao Occidental', 'Region 11 (Davao Region)'),
(1154, '2440', 'Santa Maria', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1155, '1117', 'Santa Monica', 'Metro Manila', 'NCR (National Capital Region)'),
(1156, '3521', 'Santa Praxedes', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1157, '2002', 'Santa Rita', 'Pampanga', 'Region 3 (Central Luzon)'),
(1158, '1114', 'Santa Teresita', 'Metro Manila', 'NCR (National Capital Region)'),
(1159, '2707', 'Santiago', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1160, '8608', 'Santiago', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(1161, '3311', 'Santiago CIty', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1162, '2729', 'Santo Domingo', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1163, '3525', 'Santo Niño', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1164, '2505', 'Santo Tomas', 'La Union', 'Region 1 (Ilocos Region)'),
(1165, '2020', 'Santo Tomas', 'Pampanga', 'Region 3 (Central Luzon)'),
(1166, '8112', 'Santo Tomas', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(1167, '2426', 'Santo Tomas', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1168, '2516', 'Santol', 'La Union', 'Region 1 (Ilocos Region)'),
(1169, '1113', 'Santol', 'Metro Manila', 'NCR (National Capital Region)'),
(1170, '1610', 'Santolan', 'Metro Manila', 'NCR (National Capital Region)'),
(1171, '1478', 'Santolan', 'Metro Manila', 'NCR (National Capital Region)'),
(1172, '9213', 'Sapad', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1173, '7212', 'Sapang dalaga', 'Aurora', 'Region 10 (Northern Mindanao)'),
(1174, '3024', 'Sapang Palay', 'Bulacan', 'Region 3 (Central Luzon)'),
(1175, '8015', 'Sarangani', 'Davao Occidental', 'Region 11 (Davao Region)'),
(1176, '4322', 'Sariaya', 'Quezon', 'Region 4A (CALABARZON)'),
(1177, '2914', 'Sarrat', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(1178, '2004', 'Sasmuan', 'Pampanga', 'Region 3 (Central Luzon)'),
(1179, '1116', 'Sauyo', 'Metro Manila', 'NCR (National Capital Region)'),
(1180, '9811', 'Sen. Ninoy Aquino', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(1181, '1552', 'Shaw Boulevard', 'Metro Manila', 'NCR (National Capital Region)'),
(1182, '8503', 'Sibagat', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1183, '1114', 'Sienna', 'Metro Manila', 'NCR (National Capital Region)'),
(1184, '2719', 'Sigay', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1185, '1101', 'Sikatuna Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1186, '4118', 'Silang', 'Cavite', 'Region 4A (CALABARZON)'),
(1187, '1102', 'Silangan', 'Metro Manila', 'NCR (National Capital Region)'),
(1188, '7203', 'Sinacaban', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(1189, '2733', 'Sinait', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1190, '4019', 'Siniloan', 'Laguna', 'Region 4A (CALABARZON)'),
(1191, '4408', 'Sipocot', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1192, '4427', 'Siruma', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1193, '8404', 'Sison', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1194, '2434', 'Sison', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1195, '1109', 'Socorro', 'Metro Manila', 'NCR (National Capital Region)'),
(1196, '5207', 'Socorro', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(1197, '8416', 'Socorro', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1198, '5324', 'Sofronio Española', 'Palawan', 'Region 4B (MIMAROPA)'),
(1199, '3503', 'Solana', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1200, '3709', 'Solano', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(1201, '1752', 'Soldiers Hills Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(1202, '2910', 'Solsona', 'Ilocos Norte', 'Region 1 (Ilocos Region)'),
(1203, '4700', 'Sorsogon', 'Sorsogon', 'Region 5 (Bicol Region)'),
(1204, '1709', 'South Admiral Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1205, '1103', 'South Triangle', 'Metro Manila', 'NCR (National Capital Region)'),
(1206, '1110', 'St. Ignatius', 'Metro Manila', 'NCR (National Capital Region)'),
(1207, '1111', 'St. Martin De Porres', 'Metro Manila', 'NCR (National Capital Region)'),
(1208, '1114', 'St. Peter', 'Metro Manila', 'NCR (National Capital Region)'),
(1209, '1621', 'Sta. Ana', 'Metro Manila', 'NCR (National Capital Region)'),
(1210, '1009', 'Sta. Ana', 'Metro Manila', 'NCR (National Capital Region)'),
(1211, '3514', 'Sta. Ana', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1212, '1205', 'Sta. Cruz', 'Metro Manila', 'NCR (National Capital Region)'),
(1213, '5105', 'Sta. Cruz', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(1214, '4902', 'Sta. Cruz', 'Marinduque', 'Region 4B (MIMAROPA)'),
(1215, '4009', 'Sta. Cruz', 'Laguna', 'Region 4A (CALABARZON)'),
(1216, '2213', 'Sta. Cruz', 'Zambales', 'Region 3 (Central Luzon)'),
(1217, '1014', 'Sta. Cruz (North)', 'Metro Manila', 'NCR (National Capital Region)'),
(1218, '1003', 'Sta. Cruz (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(1219, '4611', 'Sta. Elena', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1220, '5508', 'Sta. Fe', 'Romblon', 'Region 4B (MIMAROPA)'),
(1221, '3705', 'Sta. Fe', 'Nueva Vizcaya', 'Region 2 (Cagayan Valley)'),
(1222, '2303', 'Sta. Ignacia', 'Tarlac', 'Region 3 (Central Luzon)'),
(1223, '8512', 'Sta. Josefa', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1224, '1608', 'Sta. Lucia', 'Metro Manila', 'NCR (National Capital Region)'),
(1225, '4709', 'Sta. Magdalena', 'Sorsogon', 'Region 5 (Bicol Region)'),
(1226, '6709', 'Sta. Margarita', 'Samar', 'Region 8 (Eastern Visayas)'),
(1227, '4022', 'Sta. Maria', 'Laguna', 'Region 4A (CALABARZON)'),
(1228, '3022', 'Sta. Maria', 'Bulacan', 'Region 3 (Central Luzon)'),
(1229, '3330', 'Sta. Maria', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1230, '5502', 'Sta. Maria (formerly Imelda)', 'Romblon', 'Region 4B (MIMAROPA)'),
(1231, '1016', 'Sta. Mesa', 'Metro Manila', 'NCR (National Capital Region)'),
(1232, '8422', 'Sta. Monica', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1233, '1402', 'Sta. Quiteria', 'Metro Manila', 'NCR (National Capital Region)'),
(1234, '6718', 'Sta. Rita', 'Samar', 'Region 8 (Eastern Visayas)'),
(1235, '4026', 'Sta. Rosa', 'Laguna', 'Region 4A (CALABARZON)'),
(1236, '3101', 'Sta. Rosa', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1237, '4206', 'Sta. Teresita', 'Batangas', 'Region 4A (CALABARZON)'),
(1238, '3512', 'Sta. Teresita', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1239, '1105', 'Sto. Cristo', 'Metro Manila', 'NCR (National Capital Region)'),
(1240, '4508', 'Sto. Domingo', 'Albay', 'Region 5 (Bicol Region)'),
(1241, '3133', 'Sto. Domingo', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1242, '1113', 'Sto. Nino', 'Metro Manila', 'NCR (National Capital Region)'),
(1243, '1704', 'Sto. Nino', 'Metro Manila', 'NCR (National Capital Region)'),
(1244, '6711', 'Sto. Niño', 'Samar', 'Region 8 (Eastern Visayas)'),
(1245, '9509', 'Sto. Niño', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(1246, '4234', 'Sto. Tomas', 'Batangas', 'Region 4A (CALABARZON)'),
(1247, '3327', 'Sto. Tomas', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1248, '2403', 'Sual', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1249, '2209', 'Subic', 'Zambales', 'Region 3 (Central Luzon)'),
(1250, '2520', 'Sudipen', 'La Union', 'Region 1 (Ilocos Region)'),
(1251, '9009', 'Sugbongcogon', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(1252, '2717', 'Sugpon', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1253, '8009', 'Sulop', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1254, '9215', 'Sultan Naga Dimaporo (formerly Karomatan)', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1255, '8701', 'Sumilao', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(1256, '9512', 'Surallah', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(1257, '8400', 'Surigao City', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1258, '1774', 'Susana Heights', 'Metro Manila', 'NCR (National Capital Region)'),
(1259, '2715', 'Suyo', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1260, '1751', 'T. S. Cruz Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(1261, '4208', 'Taal', 'Batangas', 'Region 4A (CALABARZON)'),
(1262, '4511', 'Tabaco', 'Albay', 'Region 5 (Bicol Region)'),
(1263, '3800', 'Tabuk City', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(1264, '9800', 'Tacurong', 'Sultan Kudarat', 'Region 12 (SOCCSKSARGEN)'),
(1265, '8403', 'Tagana-an', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1266, '6712', 'Tagapul-an', 'Samar', 'Region 8 (Eastern Visayas)'),
(1267, '4120', 'Tagaytay', 'Cavite', 'Region 4A (CALABARZON)'),
(1268, '8308', 'Tagbina', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(1269, '4321', 'Tagkawayan', 'Quezon', 'Region 4A (CALABARZON)'),
(1270, '8302', 'Tago', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(1271, '9001', 'Tagoloan', 'Aurora', 'Region 10 (Northern Mindanao)'),
(1272, '9222', 'Tagoloan', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1273, '2714', 'Tagudin', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1274, '8100', 'Tagum', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(1275, '1109', 'Tagumpay', 'Metro Manila', 'NCR (National Capital Region)'),
(1276, '1427', 'Tala Leprosarium', 'Metro Manila', 'NCR (National Capital Region)'),
(1277, '8510', 'Talacogon', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1278, '8107', 'Talaingod', 'Davao Del Norte', 'Region 11 (Davao Region)'),
(1279, '8708', 'Talakag', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(1280, '6719', 'Talalora', 'Samar', 'Region 8 (Eastern Visayas)'),
(1281, '1110', 'Talampas', 'Metro Manila', 'NCR (National Capital Region)'),
(1282, '3114', 'Talavera', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1283, '1104', 'Talayan', 'Metro Manila', 'NCR (National Capital Region)'),
(1284, '1116', 'Talipapa', 'Metro Manila', 'NCR (National Capital Region)'),
(1285, '4602', 'Talisay', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1286, '4220', 'Talisay', 'Batangas', 'Region 4A (CALABARZON)'),
(1287, '9012', 'Talisayan', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(1288, '8023', 'Talomo', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1289, '1747', 'Talon, Moonwalk', 'Metro Manila', 'NCR (National Capital Region)'),
(1290, '3118', 'Talugtog', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1291, '1701', 'Tambo', 'Metro Manila', 'NCR (National Capital Region)'),
(1292, '9507', 'Tampakan', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(1293, '4232', 'Tanauan', 'Batangas', 'Region 4A (CALABARZON)'),
(1294, '1980', 'Tanay', 'Rizal', 'Region 4A (CALABARZON)'),
(1295, '8300', 'Tandag', 'Surigao Del Sur', 'Region 13 (Caraga Region)'),
(1296, '1116', 'Tandang Sora', 'Metro Manila', 'NCR (National Capital Region)'),
(1297, '9220', 'Tangcal', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1298, '1489', 'Tangos', 'Metro Manila', 'NCR (National Capital Region)'),
(1299, '7214', 'Tangub City', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(1300, '1803', 'Tañong', 'Metro Manila', 'NCR (National Capital Region)'),
(1301, '9510', 'Tantangan', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(1302, '3805', 'Tanudan', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(1303, '1490', 'Tanza', 'Metro Manila', 'NCR (National Capital Region)'),
(1304, '4108', 'Tanza', 'Cavite', 'Region 4A (CALABARZON)'),
(1305, '6704', 'Tarangnan', 'Samar', 'Region 8 (Eastern Visayas)'),
(1306, '2300', 'Tarlac', 'Tarlac', 'Region 3 (Central Luzon)'),
(1307, '8201', 'Tarragona', 'Davao Oriental', 'Region 11 (Davao Region)'),
(1308, '1113', 'Tatalon', 'Metro Manila', 'NCR (National Capital Region)'),
(1309, '4327', 'Tayabas', 'Quezon', 'Region 4A (CALABARZON)'),
(1310, '4228', 'Taysan', 'Batangas', 'Region 4A (CALABARZON)'),
(1311, '5312', 'Taytay', 'Palawan', 'Region 4B (MIMAROPA)'),
(1312, '1920', 'Taytay', 'Rizal', 'Region 4A (CALABARZON)'),
(1313, '2445', 'Tayug', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1314, '2803', 'Tayum', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1315, '9513', 'T\'boli', 'Agusan del Norte', 'Region 12 (SOCCSKSARGEN)'),
(1316, '1101', 'Teachers Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1317, '1880', 'Teresa', 'Rizal', 'Region 4A (CALABARZON)'),
(1318, '4111', 'Ternate', 'Cavite', 'Region 4A (CALABARZON)'),
(1319, '4325', 'Tiaong', 'Quezon', 'Region 4A (CALABARZON)'),
(1320, '8024', 'Tibungco', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1321, '4420', 'Tigaon', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1322, '5110', 'Tilik', 'Occidental Mindoro', 'Region 4B (MIMAROPA)'),
(1323, '4426', 'Tinambac', 'Camarines Sur (Camsur)', 'Region 5 (Bicol Region)'),
(1324, '2822', 'Tineg', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1325, '3804', 'Tinglayan', 'Kalinga', 'CAR (Cordillera Administrative Region)'),
(1326, '4203', 'Tingloy', 'Batangas', 'Region 4A (CALABARZON)'),
(1327, '3609', 'Tinoc', 'Ifugao', 'CAR (Cordillera Administrative Region)'),
(1328, '4513', 'Tiwi', 'Albay', 'Region 5 (Bicol Region)'),
(1329, '1013', 'Tondo (North)', 'Metro Manila', 'NCR (National Capital Region)'),
(1330, '1012', 'Tondo (South)', 'Metro Manila', 'NCR (National Capital Region)'),
(1331, '1473', 'Tonsuya', 'Metro Manila', 'NCR (National Capital Region)'),
(1332, '8025', 'Toril', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1333, '4903', 'Torrijos', 'Marinduque', 'Region 4B (MIMAROPA)'),
(1334, '4109', 'Trece Martirez City', 'Cavite', 'Region 4A (CALABARZON)'),
(1335, '8505', 'Trento', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1336, '3528', 'Tuao', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1337, '2603', 'Tuba', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(1338, '8426', 'Tubajon', 'Dinagat Islands', 'Region 13 (Caraga Region)'),
(1339, '2509', 'Tubao', 'La Union', 'Region 1 (Ilocos Region)'),
(1340, '8606', 'Tubay', 'Agusan del Norte', 'Region 13 (Caraga Region)'),
(1341, '2615', 'Tublay', 'Benguet', 'CAR (Cordillera Administrative Region)'),
(1342, '2814', 'Tubo', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1343, '8406', 'Tubod', 'Surigao del Norte', 'Region 13 (Caraga Region)'),
(1344, '9209', 'Tubod', 'Lanao del Norte', 'Region 10 (Northern Mindanao)'),
(1345, '7202', 'Tudela', 'Misamis Occidental', 'Region 10 (Northern Mindanao)'),
(1346, '3500', 'Tuguegarao City', 'Cagayan', 'Region 2 (Cagayan Valley)'),
(1347, '1637', 'Tuktukan', 'Metro Manila', 'NCR (National Capital Region)'),
(1348, '4612', 'Tulay na Lupa', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1349, '9403', 'Tulunan', 'Cotabato (North)', 'Region 12 (SOCCSKSARGEN)'),
(1350, '1806', 'Tumana', 'Metro Manila', 'NCR (National Capital Region)'),
(1351, '3325', 'Tumauini', 'Isabela', 'Region 2 (Cagayan Valley)'),
(1352, '1773', 'Tunasan', 'Metro Manila', 'NCR (National Capital Region)'),
(1353, '9505', 'Tupi', 'South Cotabato', 'Region 12 (SOCCSKSARGEN)'),
(1354, '4214', 'Tuy', 'Batangas', 'Region 4A (CALABARZON)'),
(1355, '1604', 'Ugong', 'Metro Manila', 'NCR (National Capital Region)'),
(1356, '1110', 'Ugong Norte', 'Metro Manila', 'NCR (National Capital Region)'),
(1357, '2443', 'Umingan', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1358, '1106', 'Unang Sigaw', 'Metro Manila', 'NCR (National Capital Region)'),
(1359, '4305', 'Unisan', 'Quezon', 'Region 4A (CALABARZON)'),
(1360, '1713', 'United Subd.', 'Metro Manila', 'NCR (National Capital Region)'),
(1361, '1101', 'Univ. of the Phils. PO', 'Metro Manila', 'NCR (National Capital Region)'),
(1362, '1407', 'University Hills', 'Metro Manila', 'NCR (National Capital Region)'),
(1363, '8026', 'University of Mindanao', 'Davao del Sur', 'Region 11 (Davao Region)'),
(1364, '1101', 'UP Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1365, '2414', 'Urbiztondo', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1366, '2428', 'Urdaneta', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1367, '1225', 'Urdaneta Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1368, '5402', 'Uson', 'Masbate', 'Region 5 (Bicol Region)'),
(1369, '1639', 'Ususan', 'Metro Manila', 'NCR (National Capital Region)'),
(1370, '3903', 'Uyugan', 'Batanes', 'Region 2 (Cagayan Valley)'),
(1371, '1112', 'Valencia', 'Metro Manila', 'NCR (National Capital Region)'),
(1372, '8709', 'Valencia', 'Bukidnon', 'Region 10 (Northern Mindanao)'),
(1373, '1208', 'Valenzuela (Inc. Santiago, San Miguel & Rizal Vill.)', 'Metro Manila', 'NCR (National Capital Region)'),
(1374, '1469', 'Valenzuela P.O. Boxes', 'Metro Manila', 'NCR (National Capital Region)'),
(1375, '1128', 'Vasra', 'Metro Manila', 'NCR (National Capital Region)'),
(1376, '1746', 'Verdant Acres Subdivision', 'Metro Manila', 'NCR (National Capital Region)'),
(1377, '1551', 'Vergara', 'Metro Manila', 'NCR (National Capital Region)'),
(1378, '8509', 'Veruela', 'Agusan del Sur', 'Region 13 (Caraga Region)'),
(1379, '1105', 'Veterans Village', 'Metro Manila', 'NCR (National Capital Region)'),
(1380, '5205', 'Victoria', 'Oriental Mindoro', 'Region 4B (MIMAROPA)'),
(1381, '4011', 'Victoria', 'Laguna', 'Region 4A (CALABARZON)'),
(1382, '2313', 'Victoria', 'Tarlac', 'Region 3 (Central Luzon)'),
(1383, '1427', 'Victory Heights', 'Metro Manila', 'NCR (National Capital Region)'),
(1384, '4805', 'Viga', 'Catanduanes', 'Region 5 (Bicol Region)'),
(1385, '2700', 'Vigan', 'Ilocos Sur', 'Region 1 (Ilocos Region)'),
(1386, '1109', 'Villa Maria Clara', 'Metro Manila', 'NCR (National Capital Region)'),
(1387, '1309', 'Villamor Airbase', 'Metro Manila', 'NCR (National Capital Region)'),
(1388, '9002', 'Villanueva', 'Misamis Oriental', 'Region 10 (Northern Mindanao)'),
(1389, '6717', 'Villareal', 'Samar', 'Region 8 (Eastern Visayas)'),
(1390, '2427', 'Villasis', 'Pangasinan', 'Region 1 (Ilocos Region)'),
(1391, '2811', 'Villaviciosa', 'Abra', 'CAR (Cordillera Administrative Region)'),
(1392, '2915', 'Vintar', 'Ilocos Norte', 'Region 1 (Ilocos Region)');
INSERT INTO `cityprovregion` (`ID_cpr`, `zip_code`, `city`, `state`, `region`) VALUES
(1393, '4603', 'Vinzons', 'Camarines Norte', 'Region 5 (Bicol Region)'),
(1394, '4800', 'Virac', 'Catanduanes', 'Region 5 (Bicol Region)'),
(1395, '1555', 'Wack Wack Golf', 'Metro Manila', 'NCR (National Capital Region)'),
(1396, '6703', 'Wright', 'Samar', 'Region 8 (Eastern Visayas)'),
(1397, '1742', 'Zapote', 'Metro Manila', 'NCR (National Capital Region)'),
(1398, '3110', 'Zaragoza', 'Nueva Ecija', 'Region 3 (Central Luzon)'),
(1399, '6725', 'Zumarraga', 'Samar', 'Region 8 (Eastern Visayas)');

-- --------------------------------------------------------

--
-- Table structure for table `classlist`
--

CREATE TABLE `classlist` (
  `CL_id` int(11) NOT NULL,
  `acadYear` varchar(45) NOT NULL,
  `SR_number` varchar(45) NOT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `F_number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classlist`
--

INSERT INTO `classlist` (`CL_id`, `acadYear`, `SR_number`, `SR_grade`, `SR_section`, `F_number`) VALUES
(1, '2022-2023', '902839278355', '6', 'Pineapple', NULL),
(2, '2022-2023', '689425702502', '6', 'Pineapple', NULL),
(3, '2022-2023', '591702935736', '6', 'Pineapple', NULL),
(4, '2022-2023', '039257935715', '6', 'Pineapple', NULL),
(5, '2022-2023', '093751905719', '6', 'Pineapple', NULL),
(6, '2022-2023', '390572309561', '5', 'Peony', '2023-00003-F'),
(7, '2022-2023', '128742095709', '5', 'Peony', '2023-00003-F'),
(8, '2022-2023', '902740297528', '5', 'Peony', '2023-00003-F'),
(9, '2022-2023', '562059205720', '5', 'Peony', '2023-00003-F'),
(10, '2022-2023', '03590175901', '5', 'Peony', '2023-00003-F'),
(11, '2022-2023', '357501956105', '5', 'Peony', '2023-00003-F'),
(12, '2022-2023', '840202737491', '6', 'Pineapple', '2023-00002-F'),
(13, '2022-2023', '357105719571', '4', 'Lily', NULL),
(14, '2022-2023', '156801561571', '4', 'Lily', NULL),
(15, '2022-2023', '235971967136', '4', 'Lily', NULL),
(16, '2022-2023', '309571957319', '3', 'Jasmine', '2023-00004-F'),
(17, '2022-2023', '371957195731', '3', 'Jasmine', '2023-00004-F'),
(18, '2022-2023', '295195697671', '3', 'Jasmine', '2023-00004-F'),
(19, '2022-2023', '238619561906', '2', 'Daffodil', '2023-00008-F'),
(20, '2022-2023', '937592759759', '2', 'Daffodil', '2023-00008-F'),
(21, '2022-2023', '120561095671', '2', 'Daffodil', '2023-00008-F'),
(22, '2022-2023', '172957297157', '1', 'Chrysanthemum', '2023-00009-F');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `F_ID` int(11) NOT NULL,
  `F_profile_img` varchar(100) DEFAULT NULL,
  `F_number` varchar(45) DEFAULT NULL,
  `F_status` varchar(45) DEFAULT NULL,
  `F_lname` varchar(45) DEFAULT NULL,
  `F_fname` varchar(45) DEFAULT NULL,
  `F_mname` varchar(45) DEFAULT NULL,
  `F_suffix` varchar(45) DEFAULT NULL,
  `F_age` varchar(45) DEFAULT NULL,
  `F_birthday` date DEFAULT NULL,
  `F_gender` varchar(45) DEFAULT NULL,
  `F_religion` varchar(45) DEFAULT NULL,
  `F_citizenship` varchar(45) DEFAULT NULL,
  `F_address` varchar(45) DEFAULT NULL,
  `F_barangay` varchar(45) DEFAULT NULL,
  `F_city` varchar(45) DEFAULT NULL,
  `F_state` varchar(45) DEFAULT NULL,
  `F_postal` varchar(45) DEFAULT NULL,
  `F_contactNumber` varchar(45) DEFAULT NULL,
  `F_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`F_ID`, `F_profile_img`, `F_number`, `F_status`, `F_lname`, `F_fname`, `F_mname`, `F_suffix`, `F_age`, `F_birthday`, `F_gender`, `F_religion`, `F_citizenship`, `F_address`, `F_barangay`, `F_city`, `F_state`, `F_postal`, `F_contactNumber`, `F_email`) VALUES
(1, '', '2023-00001-F', 'active', 'Macalintal', 'Tessa', '', '', '32', '1990-10-12', 'Female', 'Roman Catholic', 'Filipino', 'Magnolia Ice Cream', 'Selecta', 'Alabel', 'Sarangani', '9501', '(0973) 859-3293', 'haileymarry52@gmail.com'),
(2, '', '2023-00002-F', 'active', 'Manalili', 'Anne Lucrecia', 'Tumulak ', '', '41', '1981-08-04', 'Female', 'Roman Catholic', 'Filipino', 'Nashville Tennessee', 'Rosario', 'Port Area (South)', 'Metro Manila', '1018', '(0947) 304-8032', 'parkjihon78@gmail.com'),
(3, '', '2023-00003-F', 'active', 'España', 'Jaden Jeffrey', 'Chionglo', '', '41', '1981-12-25', 'Male', 'Roman Catholic', 'Filipino', 'New Jersey Orleans', 'California', 'San Antonio Valley 11 & 12', 'Metro Manila', '1707', '(0973) 929-4294', 'corn92551@gmail.com'),
(4, '', '2023-00004-F', 'active', 'Navarro', 'Zion', 'Manalili', '', '27', '1995-10-08', 'Male', 'Roman Catholic', 'Filipino', 'Handmade Flower St', 'Bug', 'Victoria', 'Oriental Mindoro', '5205', '(0909) 281-4682', 'alevtinakp@onlinecmail.com'),
(5, '', '2023-00005-F', 'active', 'Guevarra', 'GiancarloCorbin ', 'Corbin', '', '37', '1985-10-09', 'Male', 'Roman Catholic', 'Filipino', 'Adobo Rice', 'Pork', 'Hinatuan', 'Surigao Del Sur', '8310', '(0909) 382-4728', 'stvnfrlls@gmail.com'),
(6, '', '2023-00006-F', 'active', 'Bautista', 'Clifton Vernon ', 'Calunod', '', '38', '1984-12-01', 'Male', 'Roman Catholic', 'Filipino', 'San Pedro St. 0910', 'Lupain', 'Kabacan', 'Cotabato (North)', '9407', '(0908) 210-9471', 'verylen@rjostre.com'),
(7, '', '2023-00007-F', 'active', 'González', 'Warren Sean', 'Aliguyon ', '', '43', '1979-12-10', 'Male', 'Roman Catholic', 'Filipino', 'Hotdog Tender Juicy #09', 'Longganisa', 'Paang Bundok', 'Metro Manila', '1114', '(0950) 238-9729', 'jpeart@gmailos.com'),
(8, '', '2023-00008-F', 'active', 'Manalastas', 'Juliette Skyla', 'Ishii ', '', '52', '1970-12-09', 'Female', 'Christian', 'Filipino', 'Uratex 990', 'Wheelchair', 'Daet', 'Camarines Norte', '4600', '(0950) 237-5923', 'sattarovairina@scurmail.com'),
(9, '', '2023-00009-F', 'active', 'Abaya', 'Iris Maryam', 'Inoue ', '', '38', '1985-01-24', 'Female', 'Roman Catholic', 'Filipino', 'Santolan Kabisote', 'Bulagtas', 'Gabaldon', 'Nueva Ecija', '3131', '(0909) 248-9712', 'adjie@qwiklabsme.me'),
(10, '', '2023-00010-F', 'active', 'Alonzo', 'Rachelle Avery', 'Makadaan ', '', '32', '1990-08-06', 'Female', 'Roman Catholic', 'Filipino', 'Bondee 9324', 'Applegreen', 'Hagonoy', 'Bulacan', '3002', '(0960) 238-9572', 'oksiproksi7@jewu.cf'),
(11, '', '2023-00011-F', 'active', 'Paguio', 'Kristin Aubrie', 'Ishiizu ', '', '23', '1999-09-09', 'Female', 'Christian', 'Filipino', 'Royal Kludge', 'Rakrakan', 'Valencia', 'Metro Manila', '1112', '(0909) 328-9467', 'kirilusanov@greendike.com'),
(12, '', '2023-00012-F', 'active', 'Magalona', 'Jonas Chayo', 'Amerol', '', '34', '1988-08-08', 'Male', 'Roman Catholic', 'Filipino', 'Free Wolf 399', 'Mouse', 'Iba', 'Zambales', '2201', '(0903) 297-8274', 'fgh123lk@hearkn.com');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `G_id` int(11) NOT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `SR_gradeLevel` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `G_learningArea` varchar(45) DEFAULT NULL,
  `G_gradesQ1` varchar(45) DEFAULT NULL,
  `G_gradesQ2` varchar(45) DEFAULT NULL,
  `G_gradesQ3` varchar(45) DEFAULT NULL,
  `G_gradesQ4` varchar(45) DEFAULT NULL,
  `G_finalgrade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`G_id`, `SR_number`, `acadYear`, `SR_gradeLevel`, `SR_section`, `G_learningArea`, `G_gradesQ1`, `G_gradesQ2`, `G_gradesQ3`, `G_gradesQ4`, `G_finalgrade`) VALUES
(1, '902839278355', '2022-2023', '6', 'Pineapple', 'Filipino', '94', '93', '90', '90', NULL),
(2, '689425702502', '2022-2023', '6', 'Pineapple', 'Filipino', '94', '93', '90', '90', NULL),
(3, '591702935736', '2022-2023', '6', 'Pineapple', 'Filipino', '93', '93', '90', '90', NULL),
(4, '039257935715', '2022-2023', '6', 'Pineapple', 'Filipino', '92', '95', '90', '90', NULL),
(5, '093751905719', '2022-2023', '6', 'Pineapple', 'Filipino', '92', '96', '90', '90', NULL),
(6, '840202737491', '2022-2023', '6', 'Pineapple', 'Filipino', '94', '96', '90', '90', NULL),
(7, '902839278355', '2022-2023', '6', 'Pineapple', 'English', '96', '94', '90', '90', NULL),
(8, '689425702502', '2022-2023', '6', 'Pineapple', 'English', '98', '97', '90', '90', NULL),
(9, '591702935736', '2022-2023', '6', 'Pineapple', 'English', '92', '97', '90', '90', NULL),
(10, '039257935715', '2022-2023', '6', 'Pineapple', 'English', '93', '94', '90', '90', NULL),
(11, '093751905719', '2022-2023', '6', 'Pineapple', 'English', '94', '97', '90', '90', NULL),
(12, '840202737491', '2022-2023', '6', 'Pineapple', 'English', '98', '93', '90', '90', NULL),
(13, '902839278355', '2022-2023', '6', 'Pineapple', 'Math', '96', '93', '90', '90', NULL),
(14, '689425702502', '2022-2023', '6', 'Pineapple', 'Math', '93', '96', '90', '90', NULL),
(15, '591702935736', '2022-2023', '6', 'Pineapple', 'Math', '95', '97', '90', '90', NULL),
(16, '039257935715', '2022-2023', '6', 'Pineapple', 'Math', '97', '94', '90', '90', NULL),
(17, '093751905719', '2022-2023', '6', 'Pineapple', 'Math', '92', '98', '90', '90', NULL),
(18, '840202737491', '2022-2023', '6', 'Pineapple', 'Math', '93', '94', '90', '90', NULL),
(19, '902839278355', '2022-2023', '6', 'Pineapple', 'Science', '98', '93', '90', '90', NULL),
(20, '689425702502', '2022-2023', '6', 'Pineapple', 'Science', '92', '95', '90', '90', NULL),
(21, '591702935736', '2022-2023', '6', 'Pineapple', 'Science', '90', '98', '90', '90', NULL),
(22, '039257935715', '2022-2023', '6', 'Pineapple', 'Science', '93', '96', '90', '90', NULL),
(23, '093751905719', '2022-2023', '6', 'Pineapple', 'Science', '93', '96', '90', '90', NULL),
(24, '840202737491', '2022-2023', '6', 'Pineapple', 'Science', '94', '97', '90', '90', NULL),
(25, '902839278355', '2022-2023', '6', 'Pineapple', 'MAPEH', '99', '90', '90', '90', NULL),
(26, '689425702502', '2022-2023', '6', 'Pineapple', 'MAPEH', '93', '90', '90', '90', NULL),
(27, '591702935736', '2022-2023', '6', 'Pineapple', 'MAPEH', '95', '90', '90', '90', NULL),
(28, '039257935715', '2022-2023', '6', 'Pineapple', 'MAPEH', '96', '90', '90', '90', NULL),
(29, '093751905719', '2022-2023', '6', 'Pineapple', 'MAPEH', '93', '90', '90', '90', NULL),
(30, '840202737491', '2022-2023', '6', 'Pineapple', 'MAPEH', '94', '90', '90', '90', NULL),
(31, '902839278355', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(32, '689425702502', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(33, '591702935736', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(34, '039257935715', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(35, '093751905719', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(36, '840202737491', '2022-2023', '6', 'Pineapple', 'Araling Panlipunan', '90', '90', '90', '90', NULL),
(37, '902839278355', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '94', '90', '90', '90', NULL),
(38, '689425702502', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '96', '90', '90', '90', NULL),
(39, '591702935736', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '93', '90', '90', '90', NULL),
(40, '039257935715', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '95', '90', '90', '90', NULL),
(41, '093751905719', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '97', '90', '90', '90', NULL),
(42, '840202737491', '2022-2023', '6', 'Pineapple', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '94', '90', '90', '90', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `gradeID` int(11) NOT NULL,
  `gradeLevel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`gradeID`, `gradeLevel`) VALUES
(1, 'KINDER'),
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5'),
(7, '6');

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `g_id` int(11) NOT NULL,
  `G_guardianOfStudent` varchar(45) DEFAULT NULL,
  `G_lname` varchar(45) DEFAULT NULL,
  `G_fname` varchar(45) DEFAULT NULL,
  `G_mname` varchar(45) DEFAULT NULL,
  `G_suffix` varchar(45) DEFAULT NULL,
  `G_address` varchar(45) DEFAULT NULL,
  `G_barangay` varchar(45) DEFAULT NULL,
  `G_city` varchar(45) DEFAULT NULL,
  `G_state` varchar(45) DEFAULT NULL,
  `G_postal` varchar(45) DEFAULT NULL,
  `G_email` varchar(45) DEFAULT NULL,
  `G_relationshipStudent` varchar(45) DEFAULT NULL,
  `G_telephone` varchar(45) DEFAULT NULL,
  `G_contact` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`g_id`, `G_guardianOfStudent`, `G_lname`, `G_fname`, `G_mname`, `G_suffix`, `G_address`, `G_barangay`, `G_city`, `G_state`, `G_postal`, `G_email`, `G_relationshipStudent`, `G_telephone`, `G_contact`) VALUES
(1, '902839278355', 'Novilla', 'Marlito', '', '', 'Blk 12 Lot 6 Mahogany St. Southern Heights 2A', 'United Bayanihan', 'San Pedro', 'Laguna', '4023', 'mauriceangelo.11@gmail.com', 'Father', '', '(0909) 251-3546'),
(2, '689425702502', 'Fabia', 'Jess', '', '', '55 Rizal Street', 'Poblacion', 'San Pedro', 'Laguna', '4023', 'nicolemadronero25@gmail.com', 'Mother', '', '(0909) 345-2627'),
(3, '591702935736', 'Baluyot', 'Eopseo', '', '', 'NBP Reservation', 'Poblacion', 'Muntinlupa CPO', 'Metro Manila', '1770', 'ericson.baluyot20@gmail.com', 'Father', '', '(0909) 783-6489'),
(4, '039257935715', 'Gardi', 'Jessi', '', '', '137-B Rizal St.', 'Poblacion', 'Muntinlupa CPO', 'Metro Manila', '1770', 'sicadanda12@gmail.com', 'Mother', '', '(0909) 346-2478'),
(5, '093751905719', 'Gumayagay', 'Luanne', '', '', 'Sitio Crossing, Magsaysay rd.', 'San Antonio', 'San Pedro', 'Laguna', '4023', 'mcdongumayagay@gmail.com', 'Mother', '', '(0909) 572-4724'),
(6, '390572309561', 'Perez', 'Joshua', 'Jeremia', '', 'B10 L6 Pearl Street Juana 1 Subdivision ', 'San Francisco', 'Biñan', 'Laguna', '4024', 'trishaisabellacperez@gmail.com', 'Father', '', '(0909) 373-7337'),
(7, '128742095709', 'Gonzales', 'Abigail', 'Hernandez', '', '#17, 6th St, Phase 1-A', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', 'byhgonzales@live.mcl.edu.ph', 'Mother', '', '(0909) 357-3732'),
(8, '902740297528', 'Abesamis', 'Narcisa', '', '', 'PH 1A Colegio de San Pedro', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', '', 'Mother', '', '(0909) 363-6828'),
(9, '562059205720', 'Deverala', 'Felicita', '', '', 'Phase 7 Block 12 Lot 6A P. Ocampo St', 'Pacita 1', 'San Pedro', 'Laguna', '4023', 'sophia_marie_deverala@dlsu.edu.ph', 'Mother', '', '(0909) 298-4671'),
(10, '03590175901', 'Simon', 'Ollie', '', '', '541 Hacienda Rosario Purok 2', 'Sucat', 'Muntinlupa CPO', 'Metro Manila', '1770', 'simonceline231@gmail.com', 'Father', '', '(0909) 284-1844'),
(11, '357501956105', 'Estrella', 'Mercy', '', '', 'Blk 19 Lot 17 Sta. Fe st.', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', 'estrella.elginangelo11@gmail.com', 'Mother', '', '(0909) 920-7491'),
(12, '840202737491', 'Sabile', 'Kevin Paulo', 'Gaintano', '', 'Blk 4E Lot 32 Claret St. Sapphire Hills', 'Tunasan', 'Muntinlupa CPO', 'Metro Manila', '1770', 'paulo.g.sabile@gmail.com', 'Father', '', '(0909) 628-4828'),
(13, '357105719571', 'Flaminiano', 'Kris', '', '', 'Blk 6 Lot 4 Visayas Drive', 'Macaria Villaga', 'Biñan', 'Laguna', '4024', 'Macaria Villaga', 'Father', '', '(0926) 102-9471'),
(14, '156801561571', 'Basabe', 'Nelva', '', '', 'Sitio Purok 1', 'Poblacion', 'Biñan', 'Laguna', '4024', 'ayawkonagrabe123@gmail.com', 'Mother', '', '(0909) 247-1904'),
(15, '235971967136', 'Olan', 'Jessica', '', '', ' Block 7 Lot 41, Talisay Street, Phase 1, Sou', 'Landayan', 'San Pedro', 'Laguna', '4023', '', 'Mother', '', '(0909) 473-7727'),
(16, '309571957319', 'Duran', 'Analinda', '', '', 'BLK 8 LOT 18', 'ROSARIO COMPLEX', 'San Pedro', 'Laguna', '4023', 'steptepxduran05@gmail.com', 'Mother', '', '(0909) 274-1941'),
(17, '371957195731', 'De Roxas', 'Necy', '', '', 'B11 L23 SFHC', 'Landayan', 'San Pedro', 'Laguna', '4023', 'gbldrcoins@gmail.com', 'Mother', '', '(0909) 246-1094'),
(18, '295195697671', 'Daza', 'Nora', '', '', '0572 Piña St. Val. Ext.', 'Sta Mesa', 'Manila Memorial Park', 'Metro Manila', '1717', '', 'Mother', '', '(0909) 384-6104'),
(19, '238619561906', 'Umel', 'Rizalita', '', '', 'Purok 5', 'Pagudpud', 'San Fernando City', 'La Union', '2500', 'allurieumelmd@gmail.com', 'Mother', '', '(0909) 216-4018'),
(20, '937592759759', 'Reyes', 'Rosemarie', '', '', '2795 Aloha st. Bruger Subdivision', 'Putatan', 'Muntinlupa CPO', 'Metro Manila', '1770', 'jaegwaps15@gmail.com', 'Mother', '', '(0998) 210-9471'),
(21, '120561095671', 'Navarro', 'Angelica', '', '', '5 Camino Real St Pilar Village', 'Purok 5', 'Las Piñas CPO', 'Metro Manila', '1740', 'navarronicoledanielle@gmail.com', 'Mother', '', '(0909) 128-6481'),
(22, '172957297157', 'Santos', 'Aronvin', '', '', 'Ramirez St.', 'Poblacion', 'San Pedro', 'Laguna', '4023', 'annavirginiapsantos@gmail.com', 'Father', '', '(0909) 128-9461');

-- --------------------------------------------------------

--
-- Table structure for table `quartertable`
--

CREATE TABLE `quartertable` (
  `quarterID` int(11) NOT NULL,
  `quarterTag` varchar(45) DEFAULT NULL,
  `quarterStatus` varchar(45) DEFAULT NULL,
  `quarterFormStatus` varchar(45) DEFAULT NULL,
  `gradeStatus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quartertable`
--

INSERT INTO `quartertable` (`quarterID`, `quarterTag`, `quarterStatus`, `quarterFormStatus`, `gradeStatus`) VALUES
(1, '1', '', 'disabled', 'visible'),
(2, '2', '', 'disabled', 'visible'),
(3, '3', '', 'disabled', 'visible'),
(4, '4', '', 'disabled', 'visible'),
(5, 'FORMS', '', 'disabled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminderID` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `date_posted` varchar(45) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `forsection` varchar(45) DEFAULT NULL,
  `msg` longtext DEFAULT NULL,
  `deadline` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_status`
--

CREATE TABLE `reminder_status` (
  `rmd_id` int(11) NOT NULL,
  `reminderID` varchar(45) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `rmd_status` varchar(45) DEFAULT NULL,
  `viewed_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder_status`
--

INSERT INTO `reminder_status` (`rmd_id`, `reminderID`, `author`, `SR_number`, `rmd_status`, `viewed_date`) VALUES
(1, '7', '2023-00001-F', '902839278355', NULL, '2023-03-15 14:58 PM');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionID` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `S_yearLevel` varchar(45) DEFAULT NULL,
  `S_name` varchar(45) DEFAULT NULL,
  `S_adviser` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionID`, `acadYear`, `S_yearLevel`, `S_name`, `S_adviser`) VALUES
(1, '2022-2023', 'KINDER', 'Carnation', '2023-00006-F'),
(2, '2022-2023', '1', 'Chrysanthemum', '2023-00009-F'),
(3, '2022-2023', '2', 'Daffodil', '2023-00008-F'),
(4, '2022-2023', '3', 'Jasmine', '2023-00004-F'),
(5, '2022-2023', '4', 'Lily', '2023-00002-F'),
(6, '2022-2023', '5', 'Peony', '2023-00003-F'),
(7, '2022-2023', '6', 'Pineapple', '2023-00001-F');

-- --------------------------------------------------------

--
-- Table structure for table `studentrecord`
--

CREATE TABLE `studentrecord` (
  `SR_ID` int(11) NOT NULL,
  `SR_profile_img` varchar(100) DEFAULT NULL,
  `SR_number` varchar(45) DEFAULT NULL,
  `SR_fname` varchar(45) DEFAULT NULL,
  `SR_mname` varchar(45) DEFAULT NULL,
  `SR_lname` varchar(45) DEFAULT NULL,
  `SR_suffix` varchar(45) DEFAULT NULL,
  `SR_gender` varchar(45) DEFAULT NULL,
  `SR_age` varchar(45) DEFAULT NULL,
  `SR_birthday` date DEFAULT NULL,
  `SR_birthplace` varchar(45) DEFAULT NULL,
  `SR_religion` varchar(45) DEFAULT NULL,
  `SR_citizenship` varchar(45) DEFAULT NULL,
  `SR_status` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `SR_address` varchar(45) DEFAULT NULL,
  `SR_barangay` varchar(45) DEFAULT NULL,
  `SR_city` varchar(45) DEFAULT NULL,
  `SR_state` varchar(45) DEFAULT NULL,
  `SR_postal` varchar(45) DEFAULT NULL,
  `SR_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentrecord`
--

INSERT INTO `studentrecord` (`SR_ID`, `SR_profile_img`, `SR_number`, `SR_fname`, `SR_mname`, `SR_lname`, `SR_suffix`, `SR_gender`, `SR_age`, `SR_birthday`, `SR_birthplace`, `SR_religion`, `SR_citizenship`, `SR_status`, `SR_grade`, `SR_section`, `SR_address`, `SR_barangay`, `SR_city`, `SR_state`, `SR_postal`, `SR_email`) VALUES
(1, '', '902839278355', 'Maurice Angelo', '', 'Novilla', '', 'Male', '12', '2011-01-27', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '6', 'Pineapple', 'Blk 12 Lot 6 Mahogany St. Southern Heights 2A', 'United Bayanihan', 'San Pedro', 'Laguna', '4023', 'mastermau.13@gmail.com'),
(2, '', '689425702502', 'Nicole Reim', '', 'Madronero', '', 'Female', '11', '2011-11-25', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '6', 'Pineapple', '55 Rizal Street', 'Poblacion', 'San Pedro', 'Laguna', '4023', 'nicolereim.fabia25@gmail.com'),
(3, '', '591702935736', 'Ericson', '', 'Baluyot', '', 'Male', '11', '2011-09-20', 'Muntinlupa City', 'Roman Catholic', 'Filipino ', NULL, '6', 'Pineapple', 'NBP Reservation', 'Poblacion', 'Muntinlupa CPO', 'Metro Manila', '1770', 'ericson.baluyot20@gmail.com'),
(4, '', '039257935715', 'Jessica', 'Gardi', 'Salvador', '', 'Female', '11', '2011-09-12', 'Muntinlupa City', 'Roman Catholic', 'Filipino', NULL, '6', 'Pineapple', '137-B Rizal St.', 'Poblacion', 'Muntinlupa CPO', 'Metro Manila', '1770', 'sicadanda12@gmail.com'),
(5, '', '093751905719', 'Mc Don', '', 'Gumayagay', '', 'Male', '11', '2011-12-07', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '6', 'Pineapple', 'Sitio Crossing, Magsaysay rd.', 'San Antonio', 'San Pedro', 'Laguna', '4023', 'gumayagay.mcdonpup@gmail.com'),
(6, '', '390572309561', 'Trisha Isabella', 'Caralde', 'Perez', '', 'Female', '11', '2012-02-14', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '5', 'Peony', 'B10 L6 Pearl Street Juana 1 Subdivision ', 'San Francisco', 'Biñan', 'Laguna', '4024', 'trishaisabella.p@gmail.com'),
(7, '', '128742095709', 'Bianca Ysabelle', 'Hernandez', 'Gonzales', '', 'Female', '11', '2011-09-10', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '5', 'Peony', '#17, 6th St, Phase 1-A', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', 'byhgonzales@gmail.com'),
(8, '', '902740297528', 'Niña Maxine', '', 'Abesamis', '', 'Female', '11', '2011-08-07', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '5', 'Peony', 'PH 1A Colegio de San Pedro', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', 'maxinenma0701@gmail.com'),
(9, '', '562059205720', 'Sophia Marie', '', 'Deverala', '', 'Female', '11', '2012-02-01', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '5', 'Peony', 'Phase 7 Block 12 Lot 6A P. Ocampo St', 'Pacita 1', 'San Pedro', 'Laguna', '4023', 'deveralasophia@gmail.com'),
(10, '', '03590175901', 'Celine', '', 'Simon', '', 'Female', '11', '2011-11-11', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '5', 'Peony', '541 Hacienda Rosario Purok 2', 'Sucat', 'Muntinlupa CPO', 'Metro Manila', '1770', 'simon.celinee@gmail.com'),
(11, '', '357501956105', 'Elgin Angelo', '', 'Estrella', '', 'Male', '11', '2011-11-06', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '4', 'Lily', 'Blk 19 Lot 17 Sta. Fe st.', 'Pacita Complex 1', 'San Pedro', 'Laguna', '4023', 'estrella.elginangelo11@gmail.com'),
(12, '', '840202737491', 'Kristine Nicole', 'Gaintanong', 'Sabile', '', 'Female', '11', '2012-03-02', 'Muntinlupa City', 'Roman Catholic', 'Filipino', NULL, '6', 'Pineapple', 'Blk 4E Lot 32 Claret St. Sapphire Hills', 'Tunasan', 'Muntinlupa CPO', 'Metro Manila', '1770', 'sabile.camillepup@gmail.com'),
(13, '', '357105719571', 'Christian Paul', '', 'Flaminiano', '', 'Male', '10', '2012-06-25', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '4', 'Lily', 'Blk 6 Lot 4 Visayas Drive', 'Macaria Villaga', 'Biñan', 'Laguna', '4024', 'chrispflaminiano@gmail.com'),
(14, '', '156801561571', 'Hans Gabriel', '', 'Francial', '', 'Male', '10', '2012-05-25', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '4', 'Lily', 'Sitio Purok 1', 'Poblacion', 'Biñan', 'Laguna', '4024', 'gabrielfrancial03@gmail.com'),
(15, '', '235971967136', 'Aira Jean', '', 'Olan', '', 'Female', '11', '2012-01-08', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '4', 'Lily', ' Block 7 Lot 41, Talisay Street, Phase 1, Sou', 'Landayan', 'San Pedro', 'Laguna', '4023', 'airaolan1824@gmail.com'),
(16, '', '309571957319', 'Stephanie', '', 'Duran', '', 'Female', '9', '2013-06-05', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '3', 'Jasmine', 'BLK 8 LOT 18', 'ROSARIO COMPLEX', 'San Pedro', 'Laguna', '4023', 'steptepxduran05@gmail.com'),
(17, '', '371957195731', 'Gabriel Jose', '', 'De Roxas', '', 'Male', '9', '2013-10-15', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '3', 'Jasmine', 'B11 L23 SFHC', 'Landayan', 'San Pedro', 'Laguna', '4023', 'gbldr514@gmail.com'),
(18, '', '295195697671', 'Camille', '', 'Daza', '', 'Female', '9', '2013-09-05', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '3', 'Jasmine', '0572 Piña St. Val. Ext.', 'Sta Mesa', 'Manila Memorial Park', 'Metro Manila', '1717', 'cmdaza17@gmail.com'),
(19, '', '238619561906', 'Allurie', '', 'Umel', '', 'Male', '8', '2014-05-06', 'San Pedro, Laguna', 'Roman Catholic', 'Filipino', NULL, '2', 'Daffodil', 'Purok 5', 'Pagudpud', 'San Fernando City', 'La Union', '2500', 'allurieumel@gmail.com'),
(20, '', '937592759759', 'William ', 'Geli', 'Reyes', 'Jr', 'Male', '8', '2014-05-15', 'Muntinlupa City', 'Roman Catholic', 'Filipino', NULL, '2', 'Daffodil', '2795 Aloha st. Bruger Subdivision', 'Putatan', 'Muntinlupa CPO', 'Metro Manila', '1770', 'williamreyesjr15@gmail.com'),
(21, '', '120561095671', 'Nicole Danielle', '', 'Navarro', '', 'Female', '8', '2014-08-26', 'San Pedro, Laguna', 'Christian', 'Filipino', NULL, '2', 'Daffodil', '5 Camino Real St Pilar Village', 'Purok 5', 'Las Piñas CPO', 'Metro Manila', '1740', 'navarronicoledanielle@gmail.com'),
(22, '', '172957297157', 'Anna Virginia', '', 'Santos', '', 'Female', '7', '2015-08-18', 'San Pedro, Laguna', 'Christian', 'Filipino', NULL, '1', 'Chrysanthemum', 'Ramirez St.', 'Poblacion', 'San Pedro', 'Laguna', '4023', 'annavirginiapsantos@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subjectperyear`
--

CREATE TABLE `subjectperyear` (
  `subjectID` int(11) NOT NULL,
  `subjectName` varchar(45) DEFAULT NULL,
  `minYearLevel` varchar(45) DEFAULT NULL,
  `maxYearLevel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjectperyear`
--

INSERT INTO `subjectperyear` (`subjectID`, `subjectName`, `minYearLevel`, `maxYearLevel`) VALUES
(1, 'Character Building Activities', '0', '3'),
(2, 'Mother Tongue', '1', '3'),
(3, 'Edukasyon sa Pagpapakatao', '1', '3'),
(4, 'Filipino', '0', '6'),
(5, 'English', '0', '6'),
(6, 'Math', '0', '6'),
(7, 'Science', '0', '6'),
(8, 'Araling Panlipunan', '0', '6'),
(9, 'MAPEH', '0', '6'),
(10, 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '4', '6'),
(14, 'Edukasyon sa Pagpapakatao (EsP)', '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userID` int(11) NOT NULL,
  `SR_email` varchar(45) DEFAULT NULL,
  `SR_password` varchar(45) DEFAULT NULL,
  `OTP` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userID`, `SR_email`, `SR_password`, `OTP`, `role`) VALUES
(1, 'mastermau.13@gmail.com', 'G?l!92Xf', NULL, 'student'),
(2, 'nicolereim.fabia25@gmail.com', 'P_(OE3JM', NULL, 'student'),
(3, 'ericson.baluyot20@gmail.com', ':pSk5C+!', NULL, 'student'),
(4, 'sicadanda12@gmail.com', '12345', NULL, 'student'),
(5, 'gumayagay.mcdonpup@gmail.com', 'Q&cDsxAXy#5$a+L$Q9sHEkWA@tpX5QerTjaA!&h=L5!^2', NULL, 'student'),
(6, 'trishaisabella.p@gmail.com', '?4sxm;Zy', NULL, 'student'),
(7, 'byhgonzales@gmail.com', '0rfIY;G.', NULL, 'student'),
(8, 'maxinenma0701@gmail.com', 'KwU3V4^9', NULL, 'student'),
(9, 'deveralasophia@gmail.com', 'S1dY2^OV', NULL, 'student'),
(10, 'simon.celinee@gmail.com', '3$)(1CLS', NULL, 'student'),
(11, 'estrella.elginangelo11@gmail.com', '2a:P:tkZ', NULL, 'student'),
(12, 'haileymarry52@gmail.com', '123', NULL, 'faculty'),
(13, 'parkjihon78@gmail.com', '123', NULL, 'faculty'),
(14, 'corn92551@gmail.com', '123', NULL, 'faculty'),
(15, 'alevtinakp@onlinecmail.com', '123', NULL, 'faculty'),
(16, 'stvnfrlls@gmail.com', 'Frilles03.', NULL, 'faculty'),
(17, 'verylen@rjostre.com', '123', NULL, 'faculty'),
(18, 'jpeart@gmailos.com', '123', NULL, 'faculty'),
(19, 'sattarovairina@scurmail.com', '123', NULL, 'faculty'),
(20, 'adjie@qwiklabsme.me', '123', NULL, 'faculty'),
(21, 'oksiproksi7@jewu.cf', '123', NULL, 'faculty'),
(22, 'kirilusanov@greendike.com', '123', NULL, 'faculty'),
(23, 'fgh123lk@hearkn.com', '123', NULL, 'faculty'),
(24, 'sabile.camillepup@gmail.com', 'cml123', NULL, 'student'),
(25, 'chrispflaminiano@gmail.com', 'IwAL7(Lv', NULL, 'student'),
(26, 'gabrielfrancial03@gmail.com', 'gb*9EVUz', NULL, 'student'),
(27, 'airaolan1824@gmail.com', 'j27z!nJU', NULL, 'student'),
(28, 'steptepxduran05@gmail.com', '!4^$K^^Z', NULL, 'student'),
(29, 'gbldr514@gmail.com', 'c!h0kNta', NULL, 'student'),
(30, 'cmdaza17@gmail.com', 'MYGS=d3M', NULL, 'student'),
(31, 'allurieumel@gmail.com', '%n)c9&zP', NULL, 'student'),
(32, 'williamreyesjr15@gmail.com', 'EI1f;PcR', NULL, 'student'),
(33, 'navarronicoledanielle@gmail.com', 't#Fv3S.J', NULL, 'student'),
(34, 'annavirginiapsantos@gmail.com', '-x%79:*A', NULL, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `workschedule`
--

CREATE TABLE `workschedule` (
  `WS_ID` int(11) NOT NULL,
  `acadYear` varchar(45) DEFAULT NULL,
  `F_number` varchar(45) DEFAULT NULL,
  `S_subject` varchar(45) DEFAULT NULL,
  `SR_grade` varchar(45) DEFAULT NULL,
  `SR_section` varchar(45) DEFAULT NULL,
  `WS_start_time` varchar(45) DEFAULT NULL,
  `WS_end_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workschedule`
--

INSERT INTO `workschedule` (`WS_ID`, `acadYear`, `F_number`, `S_subject`, `SR_grade`, `SR_section`, `WS_start_time`, `WS_end_time`) VALUES
(1, '2022-2023', '2023-00001-F', 'Filipino', '6', 'Pineapple', '07:00', '07:44'),
(2, '2022-2023', '2023-00001-F', 'English', '6', 'Pineapple', '07:45', '08:29'),
(3, '2022-2023', '2023-00001-F', 'Math', '6', 'Pineapple', '08:30', '09:14'),
(4, '2022-2023', '2023-00001-F', 'Science', '6', 'Pineapple', '09:30', '10:14'),
(5, '2022-2023', '2023-00001-F', 'Araling Panlipunan', '6', 'Pineapple', '10:15', '10:59'),
(6, '2022-2023', '2023-00001-F', 'MAPEH', '6', 'Pineapple', '11:00', '11:44'),
(7, '2022-2023', '2023-00001-F', 'Edukasyong Pantahanan at Pangkabuhayan (EPP)', '6', 'Pineapple', '11:45', '12:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acad_year`
--
ALTER TABLE `acad_year`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`AD_id`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ANC_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `attendance_student_report`
--
ALTER TABLE `attendance_student_report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `behavior`
--
ALTER TABLE `behavior`
  ADD PRIMARY KEY (`B_ID`);

--
-- Indexes for table `behavior_category`
--
ALTER TABLE `behavior_category`
  ADD PRIMARY KEY (`B_ID`);

--
-- Indexes for table `cityprovregion`
--
ALTER TABLE `cityprovregion`
  ADD PRIMARY KEY (`ID_cpr`);

--
-- Indexes for table `classlist`
--
ALTER TABLE `classlist`
  ADD PRIMARY KEY (`CL_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`F_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`G_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`gradeID`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `quartertable`
--
ALTER TABLE `quartertable`
  ADD PRIMARY KEY (`quarterID`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminderID`);

--
-- Indexes for table `reminder_status`
--
ALTER TABLE `reminder_status`
  ADD PRIMARY KEY (`rmd_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `studentrecord`
--
ALTER TABLE `studentrecord`
  ADD PRIMARY KEY (`SR_ID`);

--
-- Indexes for table `subjectperyear`
--
ALTER TABLE `subjectperyear`
  ADD PRIMARY KEY (`subjectID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `workschedule`
--
ALTER TABLE `workschedule`
  ADD PRIMARY KEY (`WS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acad_year`
--
ALTER TABLE `acad_year`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `AD_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ANC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_student_report`
--
ALTER TABLE `attendance_student_report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `behavior`
--
ALTER TABLE `behavior`
  MODIFY `B_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `behavior_category`
--
ALTER TABLE `behavior_category`
  MODIFY `B_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cityprovregion`
--
ALTER TABLE `cityprovregion`
  MODIFY `ID_cpr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1400;

--
-- AUTO_INCREMENT for table `classlist`
--
ALTER TABLE `classlist`
  MODIFY `CL_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `F_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `G_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `gradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `quartertable`
--
ALTER TABLE `quartertable`
  MODIFY `quarterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reminder_status`
--
ALTER TABLE `reminder_status`
  MODIFY `rmd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studentrecord`
--
ALTER TABLE `studentrecord`
  MODIFY `SR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subjectperyear`
--
ALTER TABLE `subjectperyear`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `workschedule`
--
ALTER TABLE `workschedule`
  MODIFY `WS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
