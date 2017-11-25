-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 10:16 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` int(10) UNSIGNED NOT NULL,
  `eventname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventdetails` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hostadmin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventdate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `eventname`, `eventdetails`, `hostadmin`, `venue`, `status`, `eventdate`, `created_at`, `updated_at`) VALUES
(1, 'Donation of Winter Wear', 'Aiub Shomoy Club will donate winter Clothes in Rangpur.', 'anne', 'Rangpur', 'Pending', '2017-11-25', '2017-11-18 13:46:40', '2017-11-24 08:22:23'),
(2, 'Help For Rohingga', 'Help For Rohingga event will held in Cox\'s Bazar', 'anne', 'Cox\'s  Bazar', 'Completed', '2017-11-30', '2017-11-18 13:47:53', '2017-11-18 18:58:41'),
(3, 'Flood affected People', 'We will go to help the flood affected People of Kishorgonj.', 'anne', 'Kishorgonj', 'Pending', '2017-11-30', '2017-11-18 13:50:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_10_23_021155_create_users_table', 1),
(2, '2017_10_23_022919_create_profiles_table', 1),
(3, '2017_11_13_033533_create_my_events_table', 1),
(4, '2017_11_17_033809_create_requestevents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `userId` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`userId`, `fullname`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Anne', 'anne@example.com', NULL, NULL),
(2, 'Bob', 'bob@example.com', NULL, NULL),
(3, 'Chloe', 'chloe@example.com', NULL, NULL),
(4, 'David', 'david@example.com', NULL, NULL),
(5, 'tuhin', 'tuhin', NULL, NULL),
(6, 'Rana', 'raselrana68@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requestevents`
--

CREATE TABLE `requestevents` (
  `reqId` int(10) UNSIGNED NOT NULL,
  `eventId` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statuss` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requestevents`
--

INSERT INTO `requestevents` (`reqId`, `eventId`, `username`, `statuss`) VALUES
(104, 1, 'bob', 2),
(105, 2, 'bob', 1),
(106, 3, 'bob', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `type`, `lastLogin`) VALUES
(1, 'anne', 'anne', 'Admin', '2017-11-24 15:09:38'),
(2, 'bob', 'bob', 'User', '2017-11-24 15:09:28'),
(3, 'chloe', 'chloe', 'User', '2017-11-19 00:56:01'),
(4, 'david', 'david', 'Admin', '2017-11-19 00:56:33'),
(5, 'tuhin', 'tuhin', 'User', '2017-11-18 20:47:26'),
(6, 'rana', 'rana', 'User', '2017-11-18 20:54:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `requestevents`
--
ALTER TABLE `requestevents`
  ADD PRIMARY KEY (`reqId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `userId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requestevents`
--
ALTER TABLE `requestevents`
  MODIFY `reqId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
