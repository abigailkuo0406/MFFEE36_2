-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 18 日 13:53
-- 伺服器版本： 5.7.39
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `Mid-term`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Itinerary`
--

CREATE TABLE `Itinerary` (
  `itin_id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `public` varchar(20) NOT NULL,
  `ppl` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `Itinerary`
--

INSERT INTO `Itinerary` (`itin_id`, `date`, `name`, `description`, `public`, `ppl`, `member_id`, `create_at`) VALUES
('S001', '2023-05-01', '台北好好玩', '台北象山一日遊', '公開', 2, 1, '2023-05-17 23:44:31'),
('S002', '2023-05-02', '台北好好玩', '台北象山一日遊', '公開', 2, 2, '2023-05-17 23:55:45'),
('S003', '2023-05-03', '淡水看夕陽', '走走停停', '公開', 4, 3, '2023-05-17 23:55:45'),
('S004', '2023-05-04', '基隆廟口', '吃吃喝喝', '公開', 3, 6, '2023-05-17 23:55:45'),
('S005', '2023-05-05', '四四南村', '逛逛市集', '不公開', 3, 5, '2023-05-17 23:55:45'),
('S006', '2023-05-06', '大稻埕碼頭', '踏青～～', '公開', 2, 7, '2023-05-17 23:55:45'),
('S007', '2023-05-07', '九份老街', '神隱少女景點場景', '不公開', 2, 8, '2023-05-17 23:55:45'),
('S008', '2023-05-08', '野柳', '看看快斷的女王頭', '公開', 2, 9, '2023-05-17 23:55:45'),
('S009', '2023-05-09', '陽明山', '遠離塵囂', '不公開', 2, 10, '2023-05-17 23:55:45'),
('S010', '2023-05-10', '深坑一日遊', '吃吃臭豆腐', '公開', 2, 1, '2023-05-17 23:55:45'),
('S111', '2023-05-16', '基隆走透透', '美食吃到飽', '公開', 2, 11, '2023-05-15 23:38:57'),
('S118', '2023-05-26', '十分一日遊', '十分瀑布公園,天然美景壯觀令人震撼,台灣的尼加拉瓜瀑布美名..', '公開', 6, 22, '2023-05-15 23:20:55'),
('S124', '2023-05-22', '基隆吃吃喝喝', '美食吃到爆', '公開', 6, 99, '2023-05-18 10:06:14'),
('S129', '2023-05-15', '西門町半日遊～', '必拍彩虹跑道', '公開', 3, 10, '2023-05-18 10:38:23');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Itinerary`
--
ALTER TABLE `Itinerary`
  ADD PRIMARY KEY (`itin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;