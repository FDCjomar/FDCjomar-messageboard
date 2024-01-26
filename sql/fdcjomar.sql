-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 19, 2024 at 02:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `activity1`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user1_id`, `user2_id`, `created`) VALUES
(1, 8, 1, '2024-01-18 17:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `created_at`) VALUES
(1, 1, 8, 'OSFHSJBSDCBSKJCBKJBKjbkjkjscbscs\r\nsdfsdfdsfsdfsfdsfdsfs', '2024-01-18 17:21:48'),
(2, 1, 1, 'wwewhahahahaha', '2024-01-18 17:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20240116001544, 'CreateUsers', '2024-01-16 17:52:43', '2024-01-16 17:52:43', 0),
(20240116082609, 'AddUserLastLoginToUsers', '2024-01-16 17:52:43', '2024-01-16 17:52:43', 0),
(20240117003055, 'AddProfileFieldsToUsers', '2024-01-16 17:52:43', '2024-01-16 17:52:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hobby` tinytext DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `birthdate`, `hobby`, `profile_img`, `created`, `modified`, `user_last_login`) VALUES
(1, 'sddh1231', 'sadha@gmail.com', '$2y$10$70Rd/6oPnVuakcuXf6YsPednfeVX47mIy2SQF6D0j.fgEmVsZvZ6i', NULL, NULL, NULL, NULL, '2024-01-17 02:38:32', '2024-01-17 02:38:34', '2024-01-17 02:38:34'),
(2, 'user1', 'usersssss@afa.com', '$2y$10$0Yr6IBYeOp60hbEJDY7fkeAVTCEUcyoLUdxWfSb4P8eUtRcdO2grS', 'M', '2024-01-23', 'eewfewffs', '2f960217-1ef8-453d-943d-a32f323ddad6.7309681.jpg', '2024-01-17 02:39:11', '2024-01-18 03:34:55', '2024-01-18 02:18:51'),
(3, 'jomar', 'jomar@gmail.com', '$2y$10$.bZNWphjGBIisXQfmJS4Ye3IuwVTug1CzZgqwMqo9KcFxMRwuLTpe', 'M', NULL, 'bdbcvvcbcv', '3b007795-080b-4eaf-8a4a-d6482e4e916b.7309681.jpg', '2024-01-17 02:54:29', '2024-01-18 05:14:25', '2024-01-18 05:14:25'),
(4, 'james214242', 'james@gmail.com', '$2y$10$2A2Yb3YLj1CMkbdOFHoswOgAvZ4RwHJ3U8eU0mD4l5PB1XbtlM5Ii', 'F', '2024-01-19', 'fwesfsefefesfsfdadfa', 'b352c75a-2927-4ef8-afd4-e8ba60aafb47.7309681.jpg', '2024-01-17 08:27:16', '2024-01-19 01:28:07', '2024-01-19 01:28:07'),
(5, 'joona', 'jona@gmail.com', '$2y$10$Q9NtokcRak5ZMp098433genXBWKEuZA.4mqjQTWsoghlQ23l4yHPm', 'M', '2024-01-23', 'fsfsfsdfs', 'e510920d-f551-4945-88d9-24ead57cfff0.7309681.jpg', '2024-01-17 08:30:18', '2024-01-17 08:30:46', '2024-01-17 08:30:46'),
(6, 'jom21', 'jom@gmail.com', '$2y$10$yYQQCMdtMyXcQHxcBx9LOurFJY4Y5vSgMk5mX.S7mZDhRwXIhRgoS', 'M', '2024-01-01', 'erterterte', '26018aea-eba6-4fa0-918a-5dcfe062cab6.7309681.jpg', '2024-01-17 08:34:21', '2024-01-17 08:36:49', '2024-01-17 08:36:49'),
(7, 'jomaew', 'joma2@gmail.com', '$2y$10$N28dCy9GkP8DpqbzKtalzOWdHfNuJeyVd9akw.BdWOI1u70.XMBG2', 'F', '2024-01-23', 'ssfsdfdsf', '0378d11d-1ce7-4f7e-979d-28af44a04528.7309681.jpg', '2024-01-17 08:39:29', '2024-01-17 08:40:23', '2024-01-17 08:39:29'),
(8, 'jomada', 'jj@gmail.com', '$2y$10$OrlDbyazKIBLglkhCutnaeTu3EPXle3ae3StiomdG3.8RlsmO.8I2', 'M', '2024-01-15', 'sdfdsfds', '98893edc-4be7-4040-9224-82a9d9b663e7.7309681.jpg', '2024-01-17 08:40:44', '2024-01-17 08:40:58', '2024-01-17 08:40:44'),
(9, 'nKASDA', 'jaa@gmail.com', '$2y$10$ZKpM30WkbViOTrVcWpjgcOTuRWm5ws8ymTV8aY7q5VZ.v0OII3GuK', '', NULL, '', NULL, '2024-01-17 08:42:01', '2024-01-17 08:42:10', '2024-01-17 08:42:01'),
(10, 'sdsfs', 'kk@gmail.com', '$2y$10$JBdSA5E5BKbyxqgwjleUVOFfweqamQY2x7DEncOpaHGJAwdz/oqkS', 'M', '2024-01-19', '', '0552b8b8-ede0-44b7-9231-5fb5fcc234d8.7309681.jpg', '2024-01-17 09:20:24', '2024-01-17 09:38:03', '2024-01-17 09:20:24'),
(11, 'jomar', 'joshua@gmail.com', '$2y$10$Ti9nitOCLUkQafZRMrhvheVN3gH7snMSdM0A.pTxCWmeXeKHSGTQO', NULL, NULL, NULL, NULL, '2024-01-18 03:53:22', '2024-01-18 03:55:43', '2024-01-18 03:55:43'),
(12, 'jomar', 'jomar21@gmail.com', '$2y$10$93jtYuDlJH90r759XpGKhuyvoivdfNGZyXGd8kTkjHLLZ2PTFoneS', NULL, NULL, NULL, NULL, '2024-01-18 05:15:20', '2024-01-18 05:15:20', '2024-01-18 05:15:20'),
(13, 'JAMES', 'james11@gmail.com', '$2y$10$YVlUVxcA6kbM132pjHVz3O4GQYet1LMBHsO8S3MKpl.ZnDhcjjcRy', NULL, NULL, NULL, NULL, '2024-01-18 09:53:36', '2024-01-18 09:53:36', '2024-01-18 09:53:36'),
(14, 'jom12', 'jom12@gmail.com', '$2y$10$TFMmp.7I2G9faFatAx.UXO53re52EO7EzO8caqJEQfS6jz5bxMjAe', NULL, NULL, NULL, NULL, '2024-01-19 00:59:27', '2024-01-19 00:59:27', '2024-01-19 00:59:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
