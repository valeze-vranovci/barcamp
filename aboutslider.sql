-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2017 at 12:36 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutslider`
--

CREATE TABLE `aboutslider` (
  `id` int(6) NOT NULL,
  `image` varchar(64) NOT NULL,
  `data` varchar(11) NOT NULL,
  `texti` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutslider`
--

INSERT INTO `aboutslider` (`id`, `image`, `data`, `texti`) VALUES
(1, 'images/owl/8.jpg', 'JUL/14/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(2, 'images/owl/2.jpg', 'DEC/5/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(3, 'images/owl/3.jpg', 'NOV/12/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(4, 'images/owl/4.jpg', 'OCT/30/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(5, 'images/owl/5.jpg', 'JAN/8/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(6, 'images/owl/6.jpg', 'May/8/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.'),
(7, 'images/owl/7.jpg', 'May/8/2016', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutslider`
--
ALTER TABLE `aboutslider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutslider`
--
ALTER TABLE `aboutslider`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
