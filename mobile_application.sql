-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2025 at 09:00 AM
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
-- Database: `mobile_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `posted_date` datetime(6) NOT NULL,
  `author` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_dir` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime(6) NOT NULL,
  `modified` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `posted_date` datetime DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_dir` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `category_id`, `posted_date`, `author`, `title`, `review`, `image`, `image_dir`, `status`, `created`, `modified`) VALUES
(14, 3, '2025-07-07 08:59:25', 'PUBG Studio', 'pubg', 'war game', 'Screenshot 2025-07-07 142251.png', 'uploads', 'active', '2025-07-07 08:59:25', '2025-07-07 08:59:25'),
(15, 1, '2025-07-07 09:00:12', 'moonton', 'mobile legend', 'goodgame', 'Screenshot 2025-07-07 143337.png', 'uploads', 'active', '2025-07-07 09:00:12', '2025-07-07 09:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created` datetime(6) NOT NULL,
  `modified` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`, `created`, `modified`) VALUES
(1, 'Strategy', 'active', '2025-07-07 07:36:39.000000', '2025-07-07 07:36:39.000000'),
(2, 'Racing', 'active', '2025-07-07 07:36:39.000000', '2025-07-07 07:36:39.000000'),
(3, 'Action', 'active', '2025-07-07 07:36:39.000000', '2025-07-07 07:36:39.000000'),
(4, 'Simulation', 'active', '2025-07-07 07:36:39.000000', '2025-07-07 07:36:39.000000'),
(5, 'Board', 'active', '2025-07-07 07:36:39.000000', '2025-07-07 07:36:39.000000');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` enum('approve','pending') NOT NULL,
  `created` datetime(6) NOT NULL,
  `modified` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `application_id`, `name`, `comment`, `rating`, `status`, `created`, `modified`) VALUES
(1, 3, 'kimak', 'padu la game ni', 4, '', '2025-07-07 07:49:09.000000', '2025-07-07 07:49:09.000000'),
(2, 3, 'Naqib sofian', 'wow', 1, '', '2025-07-07 07:49:22.000000', '2025-07-07 07:49:22.000000'),
(3, 3, 'Naqib sofian', 'mmm', 3, '', '2025-07-07 07:51:01.000000', '2025-07-07 07:51:01.000000'),
(4, 6, 'Naqib sofian', 'aaaaa', 3, '', '2025-07-07 07:56:58.000000', '2025-07-07 07:56:58.000000'),
(5, 6, 'aaaa', 'aaaa', 3, '', '2025-07-07 07:58:26.000000', '2025-07-07 07:58:26.000000'),
(6, 6, 'aaaa', 'aaaa', 3, '', '2025-07-07 07:58:38.000000', '2025-07-07 07:58:38.000000'),
(7, 6, 'dddd', 'ddd', 5, '', '2025-07-07 07:59:49.000000', '2025-07-07 07:59:49.000000'),
(8, 7, 'Naqib sofian', 'padu', 5, '', '2025-07-07 08:01:12.000000', '2025-07-07 08:01:12.000000'),
(9, 7, 'babab', 'yaahah', 4, '', '2025-07-07 08:04:13.000000', '2025-07-07 08:04:13.000000'),
(10, 8, 'Naqib sofian', 'zzz', 4, '', '2025-07-07 08:21:28.000000', '2025-07-07 08:29:44.000000'),
(11, 8, 'sssss', 'ssss', 2, '', '2025-07-07 08:21:50.000000', '2025-07-07 08:21:50.000000'),
(12, 8, 'DKSDJLJL', 'DMNJHUDJ', 3, '', '2025-07-07 08:24:25.000000', '2025-07-07 08:24:25.000000'),
(13, 9, 'Naqib sofian', 'mmmm', 2, '', '2025-07-07 08:28:40.000000', '2025-07-07 08:28:40.000000'),
(14, 9, 'sofian ibrahim', 'lwlwlw', 3, '', '2025-07-07 08:31:06.000000', '2025-07-07 08:31:06.000000'),
(15, 10, 'Naqib sofian', 'goodgame', 5, '', '2025-07-07 08:38:49.000000', '2025-07-07 08:38:49.000000'),
(16, 11, 'muna', 'kemon la tencent', 2, '', '2025-07-07 08:41:30.000000', '2025-07-07 08:41:30.000000'),
(17, 13, 'sofian ibrahim', 'wow', 5, '', '2025-07-07 08:56:02.000000', '2025-07-07 08:56:02.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
