-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2021 at 03:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `year` varchar(32) DEFAULT NULL,
  `faculty` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `year`, `faculty`) VALUES
(2, '2017', 'Факултет по математика и информатика');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `group_id`, `content`, `user_id`) VALUES
(1, 2, 'Здравейте, колеги! Какво правите в днешно време? Искате ли да се срещнем за по едно кафе някой път?', 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(64) NOT NULL,
  `security_level` varchar(32) NOT NULL,
  `place` varchar(64) DEFAULT NULL,
  `faculty` varchar(128) NOT NULL,
  `subject` varchar(64) NOT NULL,
  `administrative_group` int(8) NOT NULL,
  `year_graduated` year(4) NOT NULL,
  `picture` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `security_level`, `place`, `faculty`, `subject`, `administrative_group`, `year_graduated`, `picture`) VALUES
(23, 'bori.plamenowa@gmail.com', '$2y$10$IxYU/iSP77f3cO4DVc7oW.1J500/a04fJtu6wSVUb9DjuHZIC4HJK', 'Боряна Пламенова Борисова', 'user', NULL, 'Факултет по математика и информатика', 'Компютърни науки', 1, 2021, NULL),
(24, 'iliyan982@gmail.com', '$2y$10$4XdLBPLl8y2iTPfYzlho5ODwAciPzQj.UE4K.TcXnC/goBL682ixq', 'Илия Драгомиров Драганов', 'user', NULL, 'Факултет по математика и информатика', 'Компютърни науки', 1, 2021, NULL),
(25, 'n.m.danailov@gmail.com', '$2y$10$GQDoGUAap/8uAL5.zOJFversIjHw.EVH0BsHaauxTRr9p3ALhTl12', 'Николай Мартинов Данаилов', 'user', NULL, 'Факултет по математика и информатика', 'Компютърни науки', 1, 2021, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
