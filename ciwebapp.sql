-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2021 at 03:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciwebapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(9) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$i3qinKUNgJEBUHhsc6.2xOWEWzcTjsO5zZ9goXkRswz5fe3ZLjzEK');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(9) NOT NULL,
  `category_id` int(9) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varbinary(255) NOT NULL,
  `author` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `status` int(9) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `description`, `image`, `author`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Developer.com: Technical Information for Software Developers', '<p><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">Developer</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">.com, the Flagship of the&nbsp;</span><spa', 0x38346131366363633364383332616531366134396235356366636162346662362e6a7067, 'Google Developers', '1', 1, '2021-02-22 12:12:47', '2021-02-22 11:12:47'),
(2, 0, 'The 34 Best Task Management Software for Startups in 2021 .', '<p><span style=\"color: inherit; font-family: inherit; font-size: 20px; background-color: rgb(255, 0, 0);\"><b>The 34 Best Task Management Software for Startups in 2021 .</b></span></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; ', 0x62316636613432656461656431613231333339653731373237376661393235612e6a7067, 'Tasks That Can Be Automated - OnDeck', '2', 1, '2021-02-22 12:17:25', '2021-02-22 11:17:25'),
(3, 0, 'Product Categories,Category, Type and Item', '<p><span class=\"f\" style=\"color: rgb(112, 117, 122); line-height: 1.58; font-family: arial, sans-serif; font-size: 14px;\">06-Feb-2015 —&nbsp;</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">We are starting to r', 0x66623736333233366362326439366166643138653734353530383638646332632e6a7067, 'BMC software', '4', 1, '2021-02-22 15:05:35', '2021-02-22 14:05:35'),
(4, 0, 'How to Classify Incidents - itSM Solutions LLC', '<div class=\"g\" style=\"width: 600px; margin-top: 0px; margin-bottom: 28px; font-family: arial, sans-serif; font-size: 14px; line-height: 1.2; color: rgb(32, 33, 36);\"><div class=\"tF2Cxc\" data-hveid=\"CAEQAA\" data-ved=\"2ahUKEwjhv5_m0_3uAhUv63MBHcYmDQUQFSgAMA', '', 'JIRA Plugins', '3', 1, '2021-02-22 15:06:52', '2021-02-22 14:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(9) NOT NULL,
  `name` text NOT NULL,
  `image` varbinary(255) NOT NULL,
  `status` int(9) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 0x33626437636430353466356636636336323739386665636130363237363664372e6a7067, 1, '2021-02-22 12:02:12', '2021-02-22 16:32:12'),
(2, 'Business Track', 0x66346632333235316161393966646534376530333134383934323461613730662e6a7067, 1, '2021-02-22 12:06:06', '2021-02-22 12:07:04'),
(3, 'Classify Incidents', 0x32376538316166396532356633656435363036366438633933343935663063352e6a7067, 1, '2021-02-22 15:02:07', '2021-02-22 19:32:07'),
(4, 'Feed Detail - BMC Software', 0x34656363626366633665376538373233663961346131323861323535383764622e6a7067, 1, '2021-02-22 15:03:55', '2021-02-22 19:33:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
