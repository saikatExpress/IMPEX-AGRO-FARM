-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2023 at 01:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `impex-agro-farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `slug`, `branch_email`, `branch_address`, `branch_image`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Uttara', 'uttara', 'uttara@gmail.com', 'Uttara,Dhaka,Bangladesh', '1703407639.jpg', '1', '0', NULL, '2023-12-24 02:47:20', '2023-12-24 02:47:20'),
(2, 'Gazipur', 'gazipur', 'gazipur@gmail.com', 'Gazipur,Dhaka,Bangladesh', '1703407731.webp', '1', '0', NULL, '2023-12-24 02:48:51', '2023-12-24 02:48:51'),
(3, 'Malibagh', 'malibagh', 'malibagh@gmail.com', 'Malibagh,Dhaka,Bangladesh', '1703407822.jpg', '1', '0', NULL, '2023-12-24 02:50:22', '2023-12-24 02:50:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
