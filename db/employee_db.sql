-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 12:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `atlog`
--

CREATE TABLE `atlog` (
  `atlog_id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `atlog_date` date DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `am_in` time DEFAULT NULL,
  `am_out` time DEFAULT NULL,
  `pm_in` time DEFAULT NULL,
  `pm_out` time DEFAULT NULL,
  `am_late` time DEFAULT NULL,
  `am_undertime` time DEFAULT NULL,
  `pm_late` time DEFAULT NULL,
  `pm_undertime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `atlog`
--

INSERT INTO `atlog` (`atlog_id`, `employee_id`, `full_name`, `atlog_date`, `shift_id`, `am_in`, `am_out`, `pm_in`, `pm_out`, `am_late`, `am_undertime`, `pm_late`, `pm_undertime`) VALUES
(2, NULL, 'Mark Elthon MaÃ±oza Omanga', '2023-12-17', 1, '04:24:53', '04:25:02', '04:25:07', '04:25:13', '04:24:53', '00:59:58', '00:00:00', '00:59:14'),
(3, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-16', 1, '13:14:56', '13:14:59', '13:15:02', '13:15:04', '13:14:56', '00:59:01', '00:00:00', '00:59:05'),
(4, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', 5, '13:46:37', '13:46:40', '13:46:43', '13:46:46', '04:16:37', '01:29:20', '07:46:43', '12:59:14'),
(5, NULL, 'John Alvan Blanco Bernal', '2023-12-19', 6, '14:31:11', '14:31:27', '14:32:10', '14:32:21', '07:31:11', '01:59:33', '00:32:10', '01:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `avatar` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `full_name`, `gender`, `contact_number`, `email`, `department`, `position`, `shift_id`, `avatar`) VALUES
(3, '2023-7291', 'Geryme AcuÃ±a Mendez', 'Male', '09398263167', 'gerymeacuÃ±a.mendez@bicol-u.edu.ph', 'HUMAN RESOURCES', 'ADMIN', 1, 0x323032332d373239312e6a7067),
(4, '2023-2549', 'Kim Allen Rabe Bolata', 'Male', '09398263167', 'kimallenrabe.bolata@bicol-u.edu.ph', 'HUMAN RESOURCES', 'ADMIN', 5, 0x323032332d323534392e6a7067),
(5, '2024-7348', 'Admin A Admin', 'Male', '09111111111', 'admin@gmail.com', 'INFORMATION TECHNOLOGY', 'ADMIN', 1, 0x323032342d373334382e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `log_report`
--

CREATE TABLE `log_report` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `logout_date` date DEFAULT NULL,
  `logout_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_report`
--

INSERT INTO `log_report` (`id`, `employee_id`, `full_name`, `login_date`, `login_time`, `department`, `position`, `status`, `logout_date`, `logout_time`) VALUES
(1, NULL, 'Geryme AcuÃ±a, Mendez', '2023-12-19', '12:08:00', 'CUSTOMER SERVICE', 'ADMIN', 'Logged Out', '2023-12-19', '00:09:13'),
(3, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:42:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '01:42:35'),
(4, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:42:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '01:43:22'),
(5, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:43:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '01:44:40'),
(7, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '03:40:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '04:24:41'),
(8, NULL, 'Mark Elthon MaÃ±oza Omanga', '2023-12-19', '04:24:00', 'FINANCE', 'ADMIN', 'Logged Out', '2023-12-19', '04:25:20'),
(9, NULL, 'Mark Elthon MaÃ±oza Omanga', '2023-12-19', '04:25:00', 'FINANCE', 'ADMIN', 'Logged Out', '2023-12-19', '04:42:01'),
(10, NULL, 'Mark Elthon MaÃ±oza Omanga', '2023-12-19', '04:42:00', 'FINANCE', 'ADMIN', 'Logged Out', '2023-12-19', '09:26:24'),
(11, NULL, 'Mark Elthon MaÃ±oza Omanga', '2023-12-19', '09:26:00', 'FINANCE', 'ADMIN', 'Logged Out', '2023-12-19', '12:36:19'),
(12, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '12:37:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:15:13'),
(13, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:15:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:17:21'),
(14, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:17:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:27:40'),
(15, '2023-7291', 'Geryme AcuÃ±a Mendez', '2023-12-19', '01:27:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:45:26'),
(16, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', '01:45:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:46:52'),
(17, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', '01:47:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '13:55:20'),
(18, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', '02:08:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '14:10:29'),
(19, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', '02:12:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '14:26:17'),
(20, NULL, 'John Alvan Blanco Bernal', '2023-12-19', '02:27:00', 'INFORMATION TECHNOLOGY', 'MANAGER', 'Logged Out', '2023-12-19', '14:29:09'),
(21, NULL, 'John Alvan Blanco Bernal', '2023-12-19', '02:30:00', 'INFORMATION TECHNOLOGY', 'MANAGER', 'Logged Out', '2023-12-19', '14:32:40'),
(22, '2023-2549', 'Kim Allen Rabe Bolata', '2023-12-19', '02:33:00', 'HUMAN RESOURCES', 'ADMIN', 'Logged Out', '2023-12-19', '14:35:21'),
(23, '2023-2549', 'Kim Allen Rabe Bolata', '2024-04-21', '05:28:00', 'HUMAN RESOURCES', 'ADMIN', 'Active Admin', NULL, NULL),
(24, '2023-2549', 'Kim Allen Rabe Bolata', '2024-05-01', '04:39:00', 'HUMAN RESOURCES', 'ADMIN', 'Active Admin', NULL, NULL),
(25, '2023-2549', 'Kim Allen Rabe Bolata', '2024-05-06', '01:11:00', 'HUMAN RESOURCES', 'ADMIN', 'Active Admin', NULL, NULL),
(26, '2023-2549', 'Kim Allen Rabe Bolata', '2024-05-06', '06:00:00', 'HUMAN RESOURCES', 'ADMIN', 'Active Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `am_start` time NOT NULL,
  `am_end` time NOT NULL,
  `pm_start` time NOT NULL,
  `pm_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `am_start`, `am_end`, `pm_start`, `pm_end`) VALUES
(1, '00:00:00', '01:00:00', '14:07:00', '15:07:00'),
(2, '08:00:00', '11:00:00', '17:00:00', '19:00:00'),
(3, '08:00:00', '11:00:00', '17:00:00', '19:00:00'),
(4, '08:00:00', '11:00:00', '17:00:00', '19:00:00'),
(5, '09:30:00', '11:00:00', '06:00:00', '19:00:00'),
(6, '07:00:00', '09:00:00', '14:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`) VALUES
(4, '2023-7291', 'geryme', '$2y$10$IoEI0iZDPIqoFoZQlRnLfe510ssHS28BFvqbhFrzHS0/z2eox752S'),
(5, '2023-2549', 'kimallen', '$2y$10$3HNaH/BsuvmPH0L4UOiT4eYziyXfL1fBw7C6FL0lzR1pfH7xRaSp6'),
(7, '2024-7348', 'admin', '$2y$10$kgCH197YUZ2oAs35VXIBe.E2zwkK38qdhsICXlWibaZDLiDg//cUy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atlog`
--
ALTER TABLE `atlog`
  ADD PRIMARY KEY (`atlog_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `employee_id_2` (`employee_id`);

--
-- Indexes for table `log_report`
--
ALTER TABLE `log_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atlog`
--
ALTER TABLE `atlog`
  MODIFY `atlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_report`
--
ALTER TABLE `log_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atlog`
--
ALTER TABLE `atlog`
  ADD CONSTRAINT `atlog_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `atlog_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`id`);

--
-- Constraints for table `log_report`
--
ALTER TABLE `log_report`
  ADD CONSTRAINT `log_report_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
