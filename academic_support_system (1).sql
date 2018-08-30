-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2018 at 11:12 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic_support_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_staff`
--

CREATE TABLE `academic_staff` (
  `staff_id` int(11) NOT NULL,
  `designation` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `degree_id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lecture_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_allocation`
--

CREATE TABLE `lecture_allocation` (
  `lecture_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecture_hall`
--

CREATE TABLE `lecture_hall` (
  `hall_id` int(11) NOT NULL,
  `code` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `group_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `parent_group` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `code` char(7) NOT NULL,
  `name` varchar(255) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `type`) VALUES
('kaneeldias@gmail.com', 'abcd@123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `venue_allocation`
--

CREATE TABLE `venue_allocation` (
  `lecture_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_staff`
--
ALTER TABLE `academic_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lecture_id`),
  ADD KEY `degree_id` (`degree_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `lecture_allocation`
--
ALTER TABLE `lecture_allocation`
  ADD PRIMARY KEY (`lecture_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `lecture_hall`
--
ALTER TABLE `lecture_hall`
  ADD PRIMARY KEY (`hall_id`);

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `parentGroupForeign` (`parent_group`),
  ADD KEY `degree_id` (`degree_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `degreeF` (`degree_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `venue_allocation`
--
ALTER TABLE `venue_allocation`
  ADD KEY `lecture_id` (`lecture_id`),
  ADD KEY `hall_id` (`hall_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lecture_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecture_hall`
--
ALTER TABLE `lecture_hall`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`),
  ADD CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `student_group` (`group_id`);

--
-- Constraints for table `lecture_allocation`
--
ALTER TABLE `lecture_allocation`
  ADD CONSTRAINT `lecture_allocation_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`),
  ADD CONSTRAINT `lecture_allocation_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `academic_staff` (`staff_id`);

--
-- Constraints for table `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `parentGroupForeign` FOREIGN KEY (`parent_group`) REFERENCES `student_group` (`group_id`),
  ADD CONSTRAINT `student_group_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `degreeF` FOREIGN KEY (`degree_id`) REFERENCES `degree` (`degree_id`);

--
-- Constraints for table `venue_allocation`
--
ALTER TABLE `venue_allocation`
  ADD CONSTRAINT `venue_allocation_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`),
  ADD CONSTRAINT `venue_allocation_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `lecture_hall` (`hall_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
