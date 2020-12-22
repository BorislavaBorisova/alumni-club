-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 03:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
(18, 'bori.plamenowa@gmail.com', '$2y$10$vdOrWFaYLwqnaFVdiyCYjuPjBMN.O6wug/nFLYzVO3duQychJKrMW', 'Боряна Пламенова Борисова', 'user', NULL, 'Факултет по математика и информатика', 'Компютърни науки', 1, 2021, NULL),
(19, 'iliyan982@gmail.com', '$2y$10$u93en./Cbok1PEmZyxFVne9bJQ00/m9Z6dt7tZzXp6oOKa012JDMC', 'Илия Драгомиров Драганов', 'user', NULL, 'Факултет по математика и информатика', 'Компютърни науки', 1, 2021, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
