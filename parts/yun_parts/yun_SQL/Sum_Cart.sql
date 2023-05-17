-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 17 日 07:36
-- 伺服器版本： 5.7.39
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mid-term`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Sum_Cart`
--

CREATE TABLE `Sum_Cart` (
  `member_id` int(11) NOT NULL,
  `sum_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Sum_Cart`
--

INSERT INTO `Sum_Cart` (`member_id`, `sum_price`) VALUES
(1, '963.00'),
(2, '22444.00'),
(4, '806.00'),
(10, '0.00'),
(14, '0.00'),
(16, '0.00'),
(27, '0.00'),
(900, '0.00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Sum_Cart`
--
ALTER TABLE `Sum_Cart`
  ADD PRIMARY KEY (`member_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `Sum_Cart`
--
ALTER TABLE `Sum_Cart`
  ADD CONSTRAINT `sum_cart_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
