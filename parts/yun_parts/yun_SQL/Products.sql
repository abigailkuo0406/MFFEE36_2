-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 18 日 05:37
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
-- 資料表結構 `Products`
--

CREATE TABLE `Products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_brief` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_launch` datetime NOT NULL,
  `product_discon` datetime NOT NULL,
  `product_main_img` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_post` varchar(20) NOT NULL,
  `product_update` datetime NOT NULL,
  `product_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Products`
--

INSERT INTO `Products` (`product_id`, `product_name`, `product_price`, `product_brief`, `product_category`, `product_launch`, `product_discon`, `product_main_img`, `product_description`, `product_post`, `product_update`, `product_upload`) VALUES
(55555, '大蟑螂', '12.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55556, '玩具車', '23.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55557, '大爆滿基安大禮包漢堡', '99.00', '大爆滿基安大禮包', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '', 'product1', '2023-05-16 15:09:35', '2023-05-15'),
(55559, '麥當勞叔叔', '100.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55560, '天線寶寶玩具', '87.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55561, '塔利班火箭筒', '9999.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55562, '水溝蓋', '80.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '', 'product1', '2023-05-16 15:09:21', '2023-05-15'),
(55563, '桶裝矽利康', '650.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '', 'product1', '2023-05-16 15:08:07', '2023-05-15'),
(55564, '全糖珍奶', '30.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '', 'product1', '2023-05-16 15:07:54', '2023-05-15'),
(55565, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55566, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55567, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55568, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55569, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55570, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55571, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55572, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55573, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55574, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55575, '商品1 name', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '商品1 description', 'product1', '2023-05-15 01:05:14', '2023-05-15'),
(55576, '商品1 name的', '99.00', '商品1 brief', '品牌周邊', '2023-05-15 01:05:14', '2023-05-15 01:05:14', '商品1 img', '', 'product1', '2023-05-15 20:47:04', '2023-05-15'),
(55577, 'abca1', '12.00', 'abc', '品牌周邊', '2023-05-09 15:17:00', '2023-05-25 15:17:00', '552401390626dfc7c8394f7e1c55ae866a6edb91.jpg', '', 'ddddddddd', '2023-05-16 13:15:17', '2023-05-15'),
(55581, 'monkey', '123.00', 'monkey', '品牌周邊', '2023-05-09 11:36:00', '2023-05-25 11:37:00', '81952bb5f77922dfee010568be605583e7f8749a.jpg', 'monkey', 'monkey', '2023-05-16 11:37:05', '2023-05-16'),
(55582, '測試大青蛙', '99.00', '青蛙', '禮物', '2023-05-01 13:05:00', '2023-05-26 13:05:00', '1f1e4368f2b86c29d10e7e4dc21445ebb948dd83.jpg', '', 'abb', '2023-05-16 13:30:17', '2023-05-16'),
(55583, 'ddd', '123.00', '123', 'travel', '2023-05-12 13:26:00', '2023-06-02 13:26:00', '', 'd', 'd', '2023-05-16 13:26:39', '2023-05-16'),
(55584, '111', '111.00', '123', '品牌周邊', '2023-05-10 13:40:00', '2023-05-26 13:40:00', '9f964121c5241fbe9e711f09fe6850d32eae0d4a.jpg', '123', '123', '2023-05-16 13:40:15', '2023-05-16'),
(55585, '123', '123.00', '123', '品牌周邊', '2023-05-18 13:41:00', '2023-05-25 13:41:00', '92fe83bcec19ac4794818ef75a03f4a72392c2f0.jpg', '123', '123', '2023-05-16 13:42:05', '2023-05-16'),
(55586, '2222222', '123.00', '123123123', '品牌周邊', '2023-05-12 13:42:00', '2023-05-16 18:42:00', 'dab20f5213c57879f1ecb48efc3767caef19630d.jpg', '', '2', '2023-05-16 15:54:40', '2023-05-16'),
(55587, '阿婆麵線', '11222.00', '12312122', '外出小點', '2023-05-18 13:43:00', '2023-05-20 13:43:00', '', '', '123123', '2023-05-16 15:56:39', '2023-05-16');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`product_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Products`
--
ALTER TABLE `Products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55588;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
