-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2017 at 04:53 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_activation` (IN `id` INT(11), IN `activation_code` VARCHAR(50))  NO SQL
UPDATE `user` SET `activation_code`=activation_code WHERE user.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_file` (IN `user_id` INT(11), IN `file_name` VARCHAR(50))  NO SQL
INSERT INTO `files`(`user_id`, `filename`) VALUES (user_id,file_name)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_activation` (IN `activation_code` VARCHAR(50))  NO SQL
SELECT * FROM `user` WHERE  user.activation_code=activation_code$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_email` (IN `email` VARCHAR(50))  NO SQL
SELECT * FROM `user` WHERE user.email = email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `check_password` (IN `email` VARCHAR(50), IN `password` VARCHAR(50))  NO SQL
SELECT * FROM `user` WHERE user.email = email AND user.password = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `name` VARCHAR(50), IN `email` VARCHAR(50), IN `password` VARCHAR(50))  NO SQL
INSERT INTO `user`(`name`, `email`, `password`) VALUES (name,email,password)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_password` (IN `id` INT(11), IN `password` VARCHAR(50))  NO SQL
UPDATE `user` SET `password`=password WHERE user.id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activation_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
