-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 01:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employe`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_name`, `role`, `city`, `state`, `number`, `email`, `created_at`) VALUES
(1, 'John Doe', 'Software Engineer', 'Mumbai', 'Maharashtra', '9876543210', 'john.doe@example.com', '2024-09-24 05:16:26'),
(2, 'John', 'Software Engineer', 'Mumbai', 'Maharashtra', '9876543210', 'do@example.com', '2024-09-24 05:16:26'),
(3, 'Kabir Singh', 'Data Analyst', 'Delhi', 'Delhi', '9123456789', 'kabir.singh@example.com', '2024-09-24 05:16:26'),
(4, 'Meera Iyer', 'HR Executive', 'Chennai', 'Tamil Nadu', '9871234567', 'meera.iyer@example.com', '2024-09-24 05:16:26'),
(5, 'Ravi Kumar', 'Sales Executive', 'Hyderabad', 'Telangana', '9988123456', 'ravi.kumar@example.com', '2024-09-24 05:16:26'),
(16, 'lax Sharma', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'arm@example.com', '2024-09-24 06:01:04'),
(20, 'lax Sharma', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'max@example.com', '2024-09-24 06:03:46'),
(21, ' Sharma', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'ax@example.com', '2024-09-24 06:56:56'),
(22, ' ma', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'laxman@example.com', '2024-09-24 08:34:59'),
(23, ' sumit', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'lax@example.com', '2024-09-24 12:12:13'),
(26, ' sumit', 'Software Engineer', 'Bangalore', 'Karnataka', '9876543210', 'x@example.com', '2024-09-25 04:55:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
