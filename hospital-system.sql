-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 11:45 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission-history`
--

CREATE TABLE `admission-history` (
  `patient-id` int(10) NOT NULL,
  `doctor-id` int(10) NOT NULL,
  `room-id` int(10) NOT NULL,
  `admission-date` datetime NOT NULL,
  `discharge-date` datetime NOT NULL,
  `status` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department-id` int(10) NOT NULL,
  `staff-head-id` int(10) NOT NULL,
  `doctor-id` int(10) NOT NULL,
  `floor` varchar(4000) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `number-of-beds` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor-schedule`
--

CREATE TABLE `doctor-schedule` (
  `id` int(10) NOT NULL,
  `datetime` datetime NOT NULL,
  `day-of-week` varchar(4000) NOT NULL,
  `visit-fees` int(10) NOT NULL,
  `percentage` int(10) NOT NULL,
  `consult-fees` int(10) NOT NULL,
  `status` varchar(4000) NOT NULL DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor-schedule`
--

INSERT INTO `doctor-schedule` (`id`, `datetime`, `day-of-week`, `visit-fees`, `percentage`, `consult-fees`, `status`) VALUES
(1, '2018-06-05 00:00:00', 'Tuesday', 500, 20, 300, 'free'),
(1, '2018-06-07 17:00:00', 'Thusrday', 500, 20, 300, 'free');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(4000) NOT NULL,
  `password` varchar(4000) NOT NULL,
  `role` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `role`) VALUES
(2, 'arjunroy', '84d769573391b6f7f47de67d0399c038', 'Receptionist'),
(3, 'ankitasaha', 'a6fc15dc4d87237149d228d861f5e062', 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `nurse-duty`
--

CREATE TABLE `nurse-duty` (
  `nurse-id` int(10) NOT NULL,
  `shift` varchar(4000) NOT NULL,
  `holiday` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(10) NOT NULL,
  `name` varchar(4000) NOT NULL,
  `date-of-birth` date NOT NULL,
  `sex` varchar(4000) NOT NULL,
  `address` varchar(4000) NOT NULL,
  `email-id` varchar(4000) NOT NULL,
  `contact-number` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient-history`
--

CREATE TABLE `patient-history` (
  `patient-id` int(10) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `session-number` int(10) NOT NULL,
  `item-id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price-chart`
--

CREATE TABLE `price-chart` (
  `id` int(10) NOT NULL,
  `type` varchar(4000) NOT NULL,
  `calculated-as` varchar(4000) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room-id` int(10) NOT NULL,
  `department-id` int(10) NOT NULL,
  `room-type` varchar(4000) NOT NULL,
  `status` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary-sheet`
--

CREATE TABLE `salary-sheet` (
  `id` int(10) NOT NULL,
  `salary` int(10) NOT NULL,
  `account-number` int(10) NOT NULL,
  `ifsc` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff-details`
--

CREATE TABLE `staff-details` (
  `id` int(10) NOT NULL,
  `name` varchar(4000) NOT NULL,
  `role` varchar(4000) NOT NULL,
  `contact` varchar(4000) NOT NULL,
  `address` varchar(4000) NOT NULL,
  `specialization` varchar(4000) NOT NULL,
  `degree` varchar(4000) NOT NULL,
  `sex` varchar(4000) NOT NULL,
  `salary` int(10) NOT NULL,
  `date-of-birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff-details`
--

INSERT INTO `staff-details` (`id`, `name`, `role`, `contact`, `address`, `specialization`, `degree`, `sex`, `salary`, `date-of-birth`) VALUES
(1, 'Sourabh Gupta', 'Doctor', '9834059812', '6A/2, Gouri Bari, Kolkata - 700394', 'Neurosurgeon', 'MBBS, MD', 'Male', 200000, '1994-10-11'),
(2, 'Arjun Roy', 'Receptionist', '9845825849', 'H-1, Rajan Villa, Kolkata - 700032', '', '', 'Male', 20000, '1992-01-14'),
(3, 'Ankita Saha', 'Receptionist', '8959602943', 'G-7, Rajendra Abason, Sector 3, Kolkata 700034', '', '', 'Female', 20000, '1995-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `credit` int(10) NOT NULL,
  `debit` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `details` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treatment-details`
--

CREATE TABLE `treatment-details` (
  `patient-id` int(10) NOT NULL,
  `doctor-id` int(10) NOT NULL,
  `session-number` int(10) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `doctor-type` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission-history`
--
ALTER TABLE `admission-history`
  ADD KEY `patient-id` (`patient-id`),
  ADD KEY `doctor-id` (`doctor-id`),
  ADD KEY `room-id` (`room-id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD KEY `id` (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department-id`,`staff-head-id`,`doctor-id`),
  ADD KEY `staff-head-id` (`staff-head-id`),
  ADD KEY `doctor-id` (`doctor-id`);

--
-- Indexes for table `doctor-schedule`
--
ALTER TABLE `doctor-schedule`
  ADD PRIMARY KEY (`id`,`datetime`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse-duty`
--
ALTER TABLE `nurse-duty`
  ADD KEY `nurse-id` (`nurse-id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient-history`
--
ALTER TABLE `patient-history`
  ADD PRIMARY KEY (`patient-id`,`datetime`,`session-number`),
  ADD KEY `item-id` (`item-id`);

--
-- Indexes for table `price-chart`
--
ALTER TABLE `price-chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room-id`),
  ADD KEY `department-id` (`department-id`);

--
-- Indexes for table `salary-sheet`
--
ALTER TABLE `salary-sheet`
  ADD KEY `id` (`id`);

--
-- Indexes for table `staff-details`
--
ALTER TABLE `staff-details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`datetime`);

--
-- Indexes for table `treatment-details`
--
ALTER TABLE `treatment-details`
  ADD KEY `patient-id` (`patient-id`),
  ADD KEY `doctor-id` (`doctor-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department-id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price-chart`
--
ALTER TABLE `price-chart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room-id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff-details`
--
ALTER TABLE `staff-details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission-history`
--
ALTER TABLE `admission-history`
  ADD CONSTRAINT `admission-history_ibfk_1` FOREIGN KEY (`patient-id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `admission-history_ibfk_2` FOREIGN KEY (`doctor-id`) REFERENCES `staff-details` (`id`),
  ADD CONSTRAINT `admission-history_ibfk_3` FOREIGN KEY (`room-id`) REFERENCES `rooms` (`room-id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`staff-head-id`) REFERENCES `staff-details` (`id`),
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`doctor-id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `doctor-schedule`
--
ALTER TABLE `doctor-schedule`
  ADD CONSTRAINT `doctor-schedule_ibfk_1` FOREIGN KEY (`id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `nurse-duty`
--
ALTER TABLE `nurse-duty`
  ADD CONSTRAINT `nurse-duty_ibfk_1` FOREIGN KEY (`nurse-id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `patient-history`
--
ALTER TABLE `patient-history`
  ADD CONSTRAINT `patient-history_ibfk_1` FOREIGN KEY (`patient-id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `patient-history_ibfk_2` FOREIGN KEY (`item-id`) REFERENCES `price-chart` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`department-id`) REFERENCES `department` (`department-id`);

--
-- Constraints for table `salary-sheet`
--
ALTER TABLE `salary-sheet`
  ADD CONSTRAINT `salary-sheet_ibfk_1` FOREIGN KEY (`id`) REFERENCES `staff-details` (`id`);

--
-- Constraints for table `treatment-details`
--
ALTER TABLE `treatment-details`
  ADD CONSTRAINT `treatment-details_ibfk_1` FOREIGN KEY (`patient-id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `treatment-details_ibfk_2` FOREIGN KEY (`doctor-id`) REFERENCES `staff-details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
