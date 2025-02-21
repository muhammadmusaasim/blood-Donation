-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2025 at 06:15 AM
-- Server version: 8.0.41
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodlines_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auditlogs`
--

CREATE TABLE `auditlogs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `performed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int NOT NULL,
  `patient_id` int NOT NULL,
  `blood_type` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `quantity` int NOT NULL,
  `required_date` date NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `donor_id` int DEFAULT NULL,
  `donor_info_shared` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `patient_id`, `blood_type`, `quantity`, `required_date`, `status`, `created_at`, `donor_id`, `donor_info_shared`) VALUES
(1, 5, 'O+', 1, '2025-01-22', 'Accepted', '2025-01-16 19:30:32', NULL, 0),
(2, 5, 'A+', 1, '2025-01-23', 'Rejected', '2025-01-16 19:50:48', NULL, 0),
(3, 5, 'O-', 2, '2025-01-20', 'Rejected', '2025-01-16 20:09:57', NULL, 0),
(4, 5, 'B+', 2, '2025-01-29', 'Accepted', '2025-01-17 17:21:09', 3, 1),
(5, 5, 'AB+', 5, '2025-01-22', 'Accepted', '2025-01-19 15:03:41', 3, 1),
(6, 5, 'AB-', 3, '2025-01-29', 'Accepted', '2025-01-21 19:13:55', 3, 1),
(7, 5, 'B+', 5, '2025-01-29', 'Rejected', '2025-01-23 18:15:17', NULL, 0),
(8, 5, 'B-', 21, '2025-02-28', 'Rejected', '2025-02-19 16:53:19', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `last_donation_date` date DEFAULT NULL,
  `availability` enum('Available','Unavailable') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `user_id` int DEFAULT NULL,
  `ngo_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `name`, `blood_group`, `last_donation_date`, `availability`, `contact`, `address`, `user_id`, `ngo_id`) VALUES
(1, 'Mark Wilson', 'A+', '2023-11-01', 'Available', '678-123-4567', '123 Elm St, City, Country', 1, 1),
(2, 'Rachel Green', 'B-', '2023-10-10', 'Available', '789-234-5678', '456 Birch St, City, Country', 2, 1),
(3, 'David Lee', 'O+', '2023-09-05', 'Available', '890-345-6789', '789 Cedar St, City, Country', 3, 2),
(4, 'Jessica Taylor', 'AB+', '2023-08-30', 'Available', '901-456-7890', '101 Pine St, City, Country', 4, 2),
(5, 'Chris Martin', 'O-', '2023-07-15', 'Unavailable', '102-567-8901', '202 Oak St, City, Country', 5, 3),
(6, 'Haider Pasha', 'A-', '2025-01-21', 'Available', '0092-5462987', '7th road', NULL, 1),
(7, 'Haider Pasha', 'AB+', '2025-01-07', 'Available', '0092-5462987', '7th road', NULL, 1),
(8, 'haider avcon', 'B-', '2025-03-03', 'Available', '0092-5462987', 'na-15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donors_copy1`
--

CREATE TABLE `donors_copy1` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_donation_date` date DEFAULT NULL,
  `availability` enum('Available','Unavailable') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Available',
  `contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `user_id` int DEFAULT NULL,
  `ngo_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `donors_copy1`
--

INSERT INTO `donors_copy1` (`id`, `name`, `blood_group`, `last_donation_date`, `availability`, `contact`, `address`, `user_id`, `ngo_id`) VALUES
(1, 'Donor ali', 'A+', '2024-10-10', 'Available', '9876543210', '456 Another St, City B', 3, 1),
(2, 'Donor ham', 'O-', '2024-09-05', 'Available', '9876543211', '789 Next St, City C', 4, NULL),
(3, 'Micheal', 'B+', '2024-12-30', 'Available', '0092-5462987', 'KKH', NULL, 1),
(4, 'Micheal', 'B+', '2024-12-30', 'Available', '0092-5462987', 'KKH', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ngos`
--

CREATE TABLE `ngos` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `user_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ngo_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ngos`
--

INSERT INTO `ngos` (`id`, `name`, `contact`, `address`, `user_id`, `image`, `ngo_image`) VALUES
(1, 'NGO A', '1234567890', '123 Main St, City A', 2, 'images/ngo1.jpeg', 'ngo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ngo_id` int DEFAULT NULL,
  `required_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Pending',
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `name`, `blood_group`, `contact`, `address`, `ngo_id`, `required_date`, `status`, `email`) VALUES
(1, 'John Doe', 'A+', '123-456-7890', '123 Main St, City, Country', 1, '2024-01-20', 'Pending', 'patient2@xyz.com'),
(2, 'Jane Smith', 'B-', '234-567-8901', '456 Oak St, City, Country', 1, '2024-01-22', 'Pending', 'patient1@xyz.com'),
(3, 'Emily Johnson', 'O+', '345-678-9012', '789 Pine St, City, Country', 2, '2024-02-10', 'Pending', 'patient3@example.com'),
(4, 'Michael Brown', 'AB+', '456-789-0123', '101 Maple St, City, Country', 2, '2024-02-15', 'Pending', 'patient4@example.com'),
(5, 'Sarah Davis', 'O-', '567-890-1234', '202 Birch St, City, Country', 3, '2024-01-25', 'Pending', 'patient5@example.com'),
(6, 'haider avcon', 'A+', '0092-5462987', 'na-15', 0, '2025-01-27', 'Pending', 'patient6@example.com'),
(7, 'haider avconss', 'B-', '0092-5462987', 'na-15', NULL, '2025-02-13', 'Pending', 'patient12@xyz.com'),
(8, 'haider avcon', 'B-', '0092-5462987', 'na-15', NULL, '2025-02-27', 'Pending', 'patient11@xyz.com'),
(11, 'haider avcon', 'AB+', '0092-5462987', 'na-15', NULL, '2025-02-23', 'Pending', 'patient15@xyz.com');

-- --------------------------------------------------------

--
-- Table structure for table `patients_copy1`
--

CREATE TABLE `patients_copy1` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `required_date` date NOT NULL,
  `priority` enum('High','Medium','Low') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Medium',
  `status` enum('Pending','Fulfilled','Cancelled') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Pending',
  `ngo_id` int DEFAULT NULL,
  `age` int DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `patients_copy1`
--

INSERT INTO `patients_copy1` (`id`, `name`, `blood_group`, `required_date`, `priority`, `status`, `ngo_id`, `age`, `contact`, `address`) VALUES
(1, 'Patient 1', 'A+', '2024-12-15', 'High', 'Pending', 1, 25, '', ''),
(2, 'Patient 2', 'O-', '2024-12-20', 'Medium', 'Pending', 1, 15, '', ''),
(3, 'Patient 3', 'B+', '2024-12-18', 'High', 'Fulfilled', 1, 18, '', ''),
(4, 'Patient 4', 'A+', '2024-12-11', 'Medium', 'Pending', 1, 23, '', ''),
(5, 'ali mustafa', 'B+', '2025-01-09', 'Medium', 'Pending', NULL, NULL, '0092-5462987', 'KKH');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` enum('Admin','NGO','Donor','Patient') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@system.com', 'hashed_admin_pw', 'Admin', '2024-12-10 19:58:28'),
(2, 'NGO A User', 'ngoa@ngo.com', 'hashed_ngo_pw', 'NGO', '2024-12-10 19:58:28'),
(3, 'Donor Ali', 'donor1@xyz.com', '123', 'Donor', '2024-12-10 19:58:28'),
(4, 'Donor Ham', 'patient2@xyz.com', '321', 'Patient', '2024-12-10 19:58:28'),
(5, 'saqi', 'patient1@xyz.com', '123', 'Patient', '2025-01-13 20:26:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditlogs`
--
ALTER TABLE `auditlogs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `patient_id` (`patient_id`) USING BTREE;

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`) USING BTREE;

--
-- Indexes for table `donors_copy1`
--
ALTER TABLE `donors_copy1`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `ngos`
--
ALTER TABLE `ngos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients_copy1`
--
ALTER TABLE `patients_copy1`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ngo_id` (`ngo_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditlogs`
--
ALTER TABLE `auditlogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donors_copy1`
--
ALTER TABLE `donors_copy1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ngos`
--
ALTER TABLE `ngos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patients_copy1`
--
ALTER TABLE `patients_copy1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auditlogs`
--
ALTER TABLE `auditlogs`
  ADD CONSTRAINT `auditlogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `donors_copy1`
--
ALTER TABLE `donors_copy1`
  ADD CONSTRAINT `donors_copy1_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `patients_copy1`
--
ALTER TABLE `patients_copy1`
  ADD CONSTRAINT `patients_copy1_ibfk_1` FOREIGN KEY (`ngo_id`) REFERENCES `ngos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
