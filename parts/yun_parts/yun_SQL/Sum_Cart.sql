-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 19 日 02:20
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
-- 資料表結構 `sum_cart`
--

CREATE TABLE `sum_cart` (
  `member_id` int(11) NOT NULL,
  `sum_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `sum_cart`
--

INSERT INTO `sum_cart` (`member_id`, `sum_price`) VALUES
(1, '0.00'),
(2, '0.00'),
(4, '0.00'),
(5, '0.00'),
(6, '0.00'),
(8, '0.00'),
(10, '0.00'),
(12, '198.00'),
(13, '0.00'),
(14, '0.00'),
(15, '0.00'),
(16, '0.00'),
(17, '0.00'),
(19, '99.00'),
(21, '0.00'),
(27, '0.00'),
(29, '4000.00'),
(900, '0.00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `sum_cart`
--
ALTER TABLE `sum_cart`
  ADD PRIMARY KEY (`member_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `sum_cart`
--
ALTER TABLE `sum_cart`
  ADD CONSTRAINT `sum_cart_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
