-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2017 at 08:49 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `curriculummanagement`
--
CREATE DATABASE IF NOT EXISTS `curriculummanagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `curriculummanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionid` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `points` decimal(1,1) NOT NULL,
  `testid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_teachers`
--

CREATE TABLE `student_teachers` (
  `studentid` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `hashpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `firstname`, `lastname`, `hashpassword`) VALUES
(500000, 'Renell', 'Yonkedeh', 'happy123');

-- --------------------------------------------------------

--
-- Table structure for table `studenttest`
--

CREATE TABLE `studenttest` (
  `studentid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `response` varchar(255) NOT NULL,
  `testid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `hashpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherid`, `firstname`, `lastname`, `username`, `subject`, `hashpassword`) VALUES
(5000, 'Isabella', 'Dunkan', '', NULL, 'Happy123');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `testid` int(11) NOT NULL,
  `testname` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testresults`
--

CREATE TABLE `testresults` (
  `studentid` int(11) NOT NULL,
  `testid` int(11) NOT NULL,
  `score` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `QtestFK` (`testid`);

--
-- Indexes for table `student_teachers`
--
ALTER TABLE `student_teachers`
  ADD KEY `ststudentFK` (`studentid`),
  ADD KEY `stteacherFK` (`teacherid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `studenttest`
--
ALTER TABLE `studenttest`
  ADD PRIMARY KEY (`studentid`,`testid`,`questionid`),
  ADD KEY `STTquestionFK` (`questionid`),
  ADD KEY `STTtestFK` (`testid`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherid`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testid`),
  ADD KEY `TteacherFK` (`teacherid`);

--
-- Indexes for table `testresults`
--
ALTER TABLE `testresults`
  ADD PRIMARY KEY (`studentid`,`testid`),
  ADD KEY `TTtestFK` (`testid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500001;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5001;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `testid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `QtestFK` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`);

--
-- Constraints for table `student_teachers`
--
ALTER TABLE `student_teachers`
  ADD CONSTRAINT `ststudentFK` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`),
  ADD CONSTRAINT `stteacherFK` FOREIGN KEY (`teacherid`) REFERENCES `teachers` (`teacherid`);

--
-- Constraints for table `studenttest`
--
ALTER TABLE `studenttest`
  ADD CONSTRAINT `STTquestionFK` FOREIGN KEY (`questionid`) REFERENCES `questions` (`questionid`),
  ADD CONSTRAINT `STTstudentFK` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`),
  ADD CONSTRAINT `STTtestFK` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `TteacherFK` FOREIGN KEY (`teacherid`) REFERENCES `teachers` (`teacherid`);

--
-- Constraints for table `testresults`
--
ALTER TABLE `testresults`
  ADD CONSTRAINT `TTstudentFK` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`),
  ADD CONSTRAINT `TTtestFK` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
