-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 16 日 07:27
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
-- 資料表結構 `Payment`
--

CREATE TABLE `Payment` (
  `order_id` int(11) NOT NULL,
  `point_have` int(11) NOT NULL,
  `point_get` int(11) NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `card_num` varchar(16) NOT NULL,
  `card_security` varchar(3) NOT NULL,
  `card_ex` varchar(4) NOT NULL,
  `card_name` varchar(25) NOT NULL,
  `pickup_method` varchar(25) NOT NULL,
  `pay_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Payment`
--

INSERT INTO `Payment` (`order_id`, `point_have`, `point_get`, `pay_method`, `card_num`, `card_security`, `card_ex`, `card_name`, `pickup_method`, `pay_time`) VALUES
(999991, 50, 2, '信用卡', '1111111111111111', '999', '0426', 'BOBNUMONE', '郵寄', '2023-05-15 01:33:31');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
