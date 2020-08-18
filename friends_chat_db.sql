-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2020 at 09:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friends_chat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendslist`
--

CREATE TABLE `friendslist` (
  `id` int(11) NOT NULL,
  `f_userId` int(11) NOT NULL,
  `s_userId` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendslist`
--

INSERT INTO `friendslist` (`id`, `f_userId`, `s_userId`, `active`) VALUES
(4, 2, 1, 1),
(5, 2, 3, 1),
(6, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupmembers`
--

CREATE TABLE `groupmembers` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupmembers`
--

INSERT INTO `groupmembers` (`id`, `groupId`, `userId`, `approved`, `isAdmin`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 0),
(3, 1, 3, 1, 0),
(4, 10, 1, 1, 1),
(12, 10, 2, 1, 0),
(15, 10, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `createdDate` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `photo`, `createdDate`, `active`) VALUES
(1, 'Just for Fun', '\r\nuser_img/5f3aa32fbdd8e.jpg', '0000-00-00 00:00:00', 1),
(10, 'NGNL Group1', '\r\nuser_img/5f3aa3489ddc1.jpg', '2020-08-17 21:08:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `sentDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `senderId`, `receiverId`, `groupId`, `sentDate`) VALUES
(1, 'hello', 1, 2, 0, '2020-08-17 13:37:44'),
(2, 'Hello again :)', 2, 1, 0, '2020-08-17 13:38:36'),
(3, 'lol', 1, 2, 0, '2020-08-17 13:57:52'),
(4, 'Are you okay?', 1, 2, 0, '2020-08-17 13:59:13'),
(5, 'test message', 1, 2, 0, '2020-08-17 14:10:22'),
(6, 'lol', 1, 2, 0, '2020-08-17 14:10:55'),
(7, 'testing', 1, 2, 0, '2020-08-17 14:11:23'),
(8, 'l', 1, 2, 0, '2020-08-17 14:13:35'),
(9, 'jj', 1, 2, 0, '2020-08-17 14:13:44'),
(10, 'yo', 2, 0, 1, '2020-08-17 14:57:32'),
(11, 'ahha', 2, 0, 1, '2020-08-17 14:58:45'),
(12, 'lol', 1, 0, 1, '2020-08-17 14:59:15'),
(13, 'wtf', 3, 0, 1, '2020-08-17 14:59:45'),
(14, 'yo', 3, 2, 0, '2020-08-17 18:15:57'),
(15, 'lol', 2, 3, 0, '2020-08-17 21:21:29'),
(16, 'lol', 2, 3, 0, '2020-08-17 21:22:15'),
(17, 'ss', 2, 1, 0, '2020-08-17 21:30:16'),
(18, 'ss', 2, 0, 1, '2020-08-17 21:30:29'),
(19, 'ok', 1, 0, 1, '2020-08-17 21:30:53'),
(20, 'hi', 1, 0, 10, '2020-08-17 21:31:01'),
(21, 'yo', 1, 0, 10, '2020-08-18 00:53:53'),
(22, 'haaha', 1, 0, 10, '2020-08-18 00:54:49'),
(23, 'w', 1, 0, 10, '2020-08-18 01:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `registeredDate` datetime NOT NULL,
  `isDeactive` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `gender`, `phone`, `photo`, `registeredDate`, `isDeactive`, `active`) VALUES
(1, 'lucifer_14', '202cb962ac59075b964b07152d234b70', 'tharhtetnyann@gmail.com', 'Male', '09323324423', '\r\nuser_img/5f3a10f44527c.jpg', '2020-08-17 10:43:41', 0, 1),
(2, 'ye_yint_ko', '202cb962ac59075b964b07152d234b70', 'yeyintko@gmail.com', 'Male', '09934244242', '', '2020-08-17 12:30:23', 0, 1),
(3, 'zwe_htet_naing', '202cb962ac59075b964b07152d234b70', 'zwehtetnaing@gmail.com', 'Female', '09234242', '', '2020-08-17 14:47:51', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendslist`
--
ALTER TABLE `friendslist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friendslist`
--
ALTER TABLE `friendslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groupmembers`
--
ALTER TABLE `groupmembers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
