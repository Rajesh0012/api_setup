-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2018 at 08:30 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firtsName` varchar(100) NOT NULL,
  `lastName` text NOT NULL,
  `userImage` varchar(255) NOT NULL,
  `mobile` bigint(12) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint(3) UNSIGNED NOT NULL COMMENT '1=>Male,2=>Female,3=>Other',
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '0=>inactive,1=>Active',
  `accessToken` varchar(255) NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL COMMENT '1=>Admin,2=>users',
  `otp` mediumint(8) UNSIGNED DEFAULT NULL,
  `emailStatus` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=>not verified,1=>verified',
  `date_registered` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User and admin';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
