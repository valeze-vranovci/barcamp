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

-- --------------------------------------------------------

--
-- Table structure for table `abouttext`
--

CREATE TABLE `abouttext` (
  `id` int(8) NOT NULL,
  `heading` varchar(128) NOT NULL,
  `paragrafi` varchar(512) NOT NULL,
  `photo` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abouttext`
--

INSERT INTO `abouttext` (`id`, `heading`, `paragrafi`, `photo`) VALUES
(1, 'What is BarCamp?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ultricies arcu tellus, eget convallis mi fermentum molestie. Vivamus dui est, tempus nec iaculis sed, fringilla sed libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean dignissim aliquet arcu eget vehicula. Donec eu erat tristique, rhoncus mi vel, malesuada leo. Integer at nisi suscipit, dictum enim vel, consectetur odio. Aliquam sed mollis magna. Proin sit amet maximus tortor, non convallis elit.', NULL),
(2, 'Why we started BarCamp?', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL),
(3, 'Filane Fisteku', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'images/item2.png'),
(4, 'Filan Fisteku', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'images/item1.png'),
(5, 'Filane Fisteku1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'images/item2.png'),
(6, 'Filan Fisteku2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'images/item1.png');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `Qyteti` varchar(56) NOT NULL,
  `Paragraf` text NOT NULL,
  `EmriDheMbiemri` varchar(56) NOT NULL,
  `Kompania` varchar(56) NOT NULL,
  `Description` text NOT NULL,
  `Rruga` varchar(56) NOT NULL,
  `Data` date NOT NULL,
  `Ora` varchar(56) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `Qyteti`, `Paragraf`, `EmriDheMbiemri`, `Kompania`, `Description`, `Rruga`, `Data`, `Ora`, `photo`, `name`) VALUES
(2, 'Ferizaj', 'Edicioni i 40 i Barcamp Ferizaj do te kete per teme vetedijesimin e te rinjve per perdorimin e droges dhe lendeve tjera narkotike.', 'Valeze Vranovci', 'Financial core', 'Description', 'Rr.Skenderbeu', '2017-01-19', '21:47', 'images/speakers.jpg', 'Emri'),
(3, 'Ferizaj', 'Paragraf', 'Valeze Vranovci', 'Financial core', 'Web Developer', 'Rr.Skenderbeu', '2017-01-11', '14:14', 'images/avatar3.jpg', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` int(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `photo`, `heading`, `description`, `name`) VALUES
(1, 'images/avatar3.jpg', 'Filan Fisteku', 'Kurgjo sdin ky', 'first'),
(2, 'images/avatar2.jpg', 'haha', 'ahah', 'second'),
(8, 'images/avatar3.jpg', 'namee11', 'naaame', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `website` varchar(256) NOT NULL,
  `photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `name`, `website`, `photo`) VALUES
(1, 'ipko', 'https://www.ipko.com/', 'images/IPKO_logo.png'),
(2, 'teatri oda', 'http://www.teatrioda.com/', 'images/oda_logo.jpg'),
(9, 'jakova innovation center hi', 'http://www.jic-ks.com/', 'images/JIC_logo.png'),
(14, 'brezi', 'https://www.google.com/', 'images/g-photo5.jpg'),
(15, 'kjs', 'https://www.google.com', 'images/p-photo3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `paragraph` varchar(50) NOT NULL,
  `footer` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `photo`, `paragraph`, `footer`, `name`) VALUES
(17, 'images/avatar4.jpg', 'Valeza', 'Life is good, but I cant say the same for college', 'Valeza');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(6, 'Valeze', 'vv34463@ubt-uni.net', '$2y$10$efPZwUGCPmWCqwF5CLThxu.eVffw3Klb0vJZ2P6hXr3/U3cX2YdwS', '2017-01-19 05:44:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutslider`
--
ALTER TABLE `aboutslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `abouttext`
--
ALTER TABLE `abouttext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutslider`
--
ALTER TABLE `aboutslider`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `abouttext`
--
ALTER TABLE `abouttext`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
