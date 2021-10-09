-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2021 at 06:56 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studentdb`
--
CREATE DATABASE IF NOT EXISTS `studentdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `studentdb`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `batchCode` char(4) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nic`,`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `batchCode` char(4) NOT NULL DEFAULT '',
  `courseNo` char(2) NOT NULL DEFAULT '',
  `teacherID` int(11) NOT NULL DEFAULT '0',
  `startDate` date DEFAULT NULL,
  `day` varchar(9) NOT NULL DEFAULT '',
  `fromTime` time DEFAULT NULL,
  `toTime` time DEFAULT NULL,
  `maxStd` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseNo` char(2) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `duration` int(3) NOT NULL DEFAULT '0',
  `fee` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`courseNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learningmaterial`
--

CREATE TABLE IF NOT EXISTS `learningmaterial` (
  `batchCode` char(4) NOT NULL DEFAULT '',
  `material` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `batchCode` char(4) NOT NULL DEFAULT '',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `date` date DEFAULT NULL,
  `payslip` varchar(19) NOT NULL DEFAULT '',
  PRIMARY KEY (`nic`,`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `batchCode` char(4) NOT NULL DEFAULT '',
  `mid` int(11) NOT NULL DEFAULT '0',
  `end` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nic`,`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staffID` int(11) NOT NULL DEFAULT '0',
  `nic` varchar(12) NOT NULL DEFAULT '',
  `fName` varchar(200) NOT NULL DEFAULT '',
  `lName` varchar(50) NOT NULL DEFAULT '',
  `desig` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `fName` varchar(200) NOT NULL DEFAULT '',
  `lName` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(2) NOT NULL DEFAULT '',
  `dob` date DEFAULT NULL,
  `mobile` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `aLine1` varchar(10) NOT NULL DEFAULT '',
  `aLine2` varchar(50) NOT NULL DEFAULT '',
  `aLine3` varchar(50) NOT NULL DEFAULT '',
  `aLine4` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(17) NOT NULL DEFAULT '',
  PRIMARY KEY (`nic`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentbatch`
--

CREATE TABLE IF NOT EXISTS `studentbatch` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `batchCode` char(4) NOT NULL DEFAULT '',
  `studentNo` varchar(9) NOT NULL DEFAULT '',
  PRIMARY KEY (`nic`,`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherID` int(11) NOT NULL DEFAULT '0',
  `nic` varchar(12) NOT NULL DEFAULT '',
  `fname` varchar(200) NOT NULL DEFAULT '',
  `lname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(2) NOT NULL DEFAULT '',
  `mobile` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `aLine1` varchar(10) NOT NULL DEFAULT '',
  `aLine2` varchar(50) NOT NULL DEFAULT '',
  `aLine3` varchar(50) NOT NULL DEFAULT '',
  `aLine4` varchar(50) NOT NULL DEFAULT '',
  `hignQuali` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`teacherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachercourse`
--

CREATE TABLE IF NOT EXISTS `teachercourse` (
  `teacherID` int(11) NOT NULL DEFAULT '0',
  `courseNo` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`teacherID`,`courseNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_applicant`
--

CREATE TABLE IF NOT EXISTS `temp_applicant` (
  `nic` varchar(12) NOT NULL DEFAULT '',
  `batchCode` char(4) NOT NULL,
  `courseNo` char(2) NOT NULL,
  `fName` varchar(200) NOT NULL DEFAULT '',
  `lName` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(2) NOT NULL DEFAULT '',
  `dob` date DEFAULT NULL,
  `mobile` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `aLine1` varchar(10) DEFAULT '',
  `aLine2` varchar(50) NOT NULL DEFAULT '',
  `aLine3` varchar(50) NOT NULL DEFAULT '',
  `aLine4` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(17) NOT NULL DEFAULT '',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `date` date DEFAULT NULL,
  `payslip` varchar(19) NOT NULL DEFAULT '',
  `remark` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`nic`,`batchCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT '',
  `ID` varchar(9) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
