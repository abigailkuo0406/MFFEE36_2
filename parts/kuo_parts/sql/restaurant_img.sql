-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2023-05-15 10:21:12
-- 伺服器版本： 5.7.24
-- PHP 版本： 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `project_mi`
--

-- --------------------------------------------------------

--
-- 資料表結構 `restaurant_img`
--

CREATE TABLE `restaurant_img` (
  `rest_img_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `rest_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `restaurant_img`
--
ALTER TABLE `restaurant_img`
  ADD PRIMARY KEY (`rest_img_id`),
  ADD KEY `rest_id` (`rest_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `restaurant_img`
--
ALTER TABLE `restaurant_img`
  MODIFY `rest_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `restaurant_img`
--
ALTER TABLE `restaurant_img`
  ADD CONSTRAINT `restaurant_img_ibfk_1` FOREIGN KEY (`rest_id`) REFERENCES `restaurant_list` (`rest_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
