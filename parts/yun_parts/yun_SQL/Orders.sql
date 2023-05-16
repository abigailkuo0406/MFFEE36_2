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
-- 資料表結構 `Orders`
--

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `receiver_name` varchar(20) NOT NULL,
  `receiver_gender` varchar(10) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_tel` varchar(255) NOT NULL,
  `order_note` varchar(255) DEFAULT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_time` datetime NOT NULL,
  `ads` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Orders`
--

INSERT INTO `Orders` (`order_id`, `member_id`, `receiver_name`, `receiver_gender`, `receiver_address`, `receiver_email`, `receiver_tel`, `order_note`, `order_total`, `order_time`, `ads`) VALUES
(999991, 99999111, '我是收件者', '先生', '我家地址', 'abc123@gmail.com', '0988888888', '交送給大樓管理員', '198.00', '2023-05-15 01:30:08', 1),
(9999912, 878787, '我是收件者', '先生', '我家地址', 'abc123@gmail.com', '0988888888', '交送給大樓管理員', '198.00', '2023-05-15 01:30:08', 1),
(9999913, 123, '123', '123', '123', '123', '123', '123', '999.00', '2023-05-16 02:19:04', 1),
(9999914, 111111, '', '', '', '', '', '', '999.00', '2023-05-16 02:20:00', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Orders`
--
ALTER TABLE `Orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9999915;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
