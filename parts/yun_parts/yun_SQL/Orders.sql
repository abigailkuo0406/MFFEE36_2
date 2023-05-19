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
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
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
  `ad` tinyint(1) NOT NULL,
  `order_complete` tinyint(1) NOT NULL,
  `complete_time` datetime DEFAULT NULL,
  `order_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`order_id`, `member_id`, `receiver_name`, `receiver_gender`, `receiver_address`, `receiver_email`, `receiver_tel`, `order_note`, `order_total`, `order_time`, `ad`, `order_complete`, `complete_time`, `order_status`) VALUES
(1, 1, '龎哲宇', '先生', '基隆市七堵區', 'mail739856@test.com', '0911506206', '交由管理員', '600.00', '2023-05-19 02:38:59', 1, 0, '2023-05-19 02:39:18', '已完成'),
(2, 8, '秦昱凱', '小姐', '臺北市中正區', 'mail426212@test.com', '0911482140', '阿咪陀佛', '450.00', '2023-05-19 02:41:18', 1, 0, NULL, '已取消'),
(3, 17, '何昱翔', '小姐', '新北市泰山區', 'mail354332@test.com', '0911217083', '！', '3798.00', '2023-05-19 10:16:43', 1, 0, NULL, '訂單成立');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
