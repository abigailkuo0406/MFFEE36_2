-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 03:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mid-term`
--

-- --------------------------------------------------------

--
-- Table structure for table `whopost`
--

CREATE TABLE `whopost` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whopost`
--

INSERT INTO `whopost` (`id`, `name`, `email`, `post`) VALUES
(8, 'Peter', 'peter@gmail.com', '我愛耶穌'),
(9, 'Steve', 'steve@gmail.com', '星期五要守齋'),
(10, 'Stark', 'tony@gmail.com', '耶穌復活了！！'),
(11, 'Mark', 'mark@gmail.com', '阿門'),
(14, '光頭強', 'nohair@gmail.com', '我是光頭強'),
(15, 'Gucci', 'gucci@gmail.com', 'luxury stuff'),
(16, 'Jerry', 'jerry@yahoo.com', '守齋比較好啦！'),
(17, '黑面蔡', 'amao@yahoo.com', '耶穌復活了！！'),
(18, '光頭強', 'nohair@gmail.com', '請問哪裡有賣便宜的假髮？');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `whopost`
--
ALTER TABLE `whopost`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `whopost`
--
ALTER TABLE `whopost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
