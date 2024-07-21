-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 03:10 AM
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
-- Database: `event_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `time`, `location`, `category`, `image`, `created_by`, `created_at`) VALUES
(9, 'sxbkA', 'SABHXA,JS', '2024-07-19', '17:01:00', 'AXVHJA', 'xhjAX', 'images/12.jpg', 'user3', '2024-07-21 00:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `rsvps`
--

CREATE TABLE `rsvps` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_number` varchar(15) DEFAULT NULL,
  `reset_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `phone_number`, `reset_code`) VALUES
(1, 'user1', 'example@gmail.com', '$2y$10$p6dEjfsQ6tIlr7Cz9Bp0D.vsSCi1eKZX8RPfMNdJ05psm62Vo62Je', '2024-07-20 12:49:18', '6478933825', NULL),
(2, 'user2', 'user2@gmail.com', '$2y$10$egSYgMVbOt1.yRACHA7zMOM.6qqqOZgUiD6UhlZBTTRB6FMOJDYOm', '2024-07-20 13:03:11', '6478933825', NULL),
(3, 'user3', 'user3@gmail.com', '$2y$10$ZXlLJazaUNFThGlkczsHsOL9ds26y4AX.ZrZmFKPlKcw/Y8L2WKmO', '2024-07-20 13:04:29', '6478933825', NULL),
(4, 'kirti', 'kirti03@gmail.com', '$2y$10$z.vulsXvePsLGvgDkoYpdO3vjgaW9yG3JfJeyH2Zt/gN4Mn.pT326', '2024-07-20 22:39:43', '6478933825', NULL),
(5, 'nidhi', 'nidhi03@algomau.ca', '$2y$10$vmZP.0K3Qi.tCgrs9c4/4.HTwTKvCp83hiORErf0GImV05TU8/WGe', '2024-07-20 23:48:16', '6478933825', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `rsvps`
--
ALTER TABLE `rsvps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rsvps`
--
ALTER TABLE `rsvps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `rsvps`
--
ALTER TABLE `rsvps`
  ADD CONSTRAINT `rsvps_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rsvps_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
