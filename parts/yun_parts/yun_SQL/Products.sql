-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 05 月 19 日 02:19
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
-- 資料表結構 `products`
--

CREATE TABLE `products` (
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
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_brief`, `product_category`, `product_launch`, `product_discon`, `product_main_img`, `product_description`, `product_post`, `product_update`, `product_upload`) VALUES
(1, '冒險之旅鑰匙扣', '100.00', '跟旅伴發動剛偷來機車的神奇鑰匙', '旅行', '2023-05-18 18:04:00', '2023-05-27 02:06:00', '0898e3d4d06df7bbdf204a18300dad29a6ee0cdc.jpg', '看起來舊舊阿罵的鑰匙', 'oldkey', '2023-05-19 10:13:58', '2023-05-19'),
(2, '友誼地圖杯墊', '125.00', '旅行放假牙的杯墊', '旅行', '2023-05-18 18:08:00', '2023-05-27 02:09:00', '042baa71089ba1ae4d11644d342574b0a2489317.jpg', '大杯墊', 'baidein', '2023-05-19 02:10:33', '2023-05-19'),
(3, '友誼手機殼', '1200.00', '賺你錢的手機殼', '品牌周邊', '2023-05-18 18:14:00', '2023-05-20 02:14:00', '20d5a2298a9234d2a24700c4ba48f7367aa1747d.jpg', '超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼超強手機殼', 'coolphonecase', '2023-05-19 02:28:48', '2023-05-19'),
(4, '探索旅行筆記本', '99.00', '抄旅途美食小抄的筆記本', '禮物', '2023-05-19 18:19:00', '2023-06-22 02:20:00', '82b474e916504020166becccbd79a82b25aafeea.jpg', '筆記本超超超', 'book', '2023-05-19 10:19:05', '2023-05-19'),
(5, '品牌旅行迷你相機', '10.00', '留下快樂回憶！', '品牌周邊', '2023-05-20 18:22:00', '2023-05-29 02:22:00', '4df93468af44c5477c1cbd2ea5721fb4e03620c9.jpg', '超強皮超強配件付發票', '123', '2023-05-19 10:18:26', '2023-05-19'),
(6, '地圖手鍊', '99.00', '愛之手鍊', '品牌周邊', '2023-05-18 18:24:00', '2023-05-27 02:24:00', '', '缺貨中，需等待100天才可出貨，柬埔寨進口手工地圖手鍊', 'chain', '2023-05-19 02:25:32', '2023-05-19'),
(7, '山-溫泉大飯店早餐券', '2000.00', '陽明山五星級！', '超值票券', '2023-05-18 18:25:00', '2023-05-27 02:26:00', '', 'XXX飯店，地址為台北市XX區XX路，用餐時段為中午12:00到下午18:00，不可轉贈', 'ticket', '2023-05-19 10:12:13', '2023-05-19'),
(8, '健康補給飲料', '20.00', '旅行中補充體力', '外出小點', '2023-05-18 18:27:00', '2023-05-27 02:28:00', '', '超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的超好喝的', 'drink', '2023-05-19 02:28:28', '2023-05-19'),
(9, '旅行小車車', '20.00', '老天保佑', '品牌周邊', '2023-05-18 18:29:00', '2023-05-27 02:29:00', '8b3d94056dd3121de2d91eed00e416b2dfeec2fb.jpg', '保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康保佑旅行愉快萬事如意身體健康', 'aaaaa', '2023-05-19 10:18:00', '2023-05-19'),
(10, '旅行瓶', '200.00', '旅行可裝水喝', '品牌周邊', '2023-05-23 18:32:00', '2023-05-30 02:32:00', '1c65c4bba0240df4eb9bcce6e8f37a16dff7a862.jpg', '相機相機超超超', 'water', '2023-05-19 10:15:30', '2023-05-19'),
(11, '冒險耳機', '500.00', '和心儀的旅伴一起聽音樂！', '旅行', '2023-05-18 18:33:00', '2023-05-23 02:34:00', 'e2af7467a57a9e1c32e074af0ffb5753854db80a.jpg', '黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全黃黃的走在馬路上比較安全', 'unb', '2023-05-19 10:14:55', '2023-05-19'),
(12, '旅行文具組', '210.00', '旅行文具組', '禮物', '2023-05-18 18:35:00', '2023-06-14 02:35:00', '', '缺貨中！預計到貨日期不確定，請謹慎下標', '', '2023-05-19 02:36:17', '2023-05-19'),
(13, '旅行免洗襪', '300.00', '竹炭纖維', '旅行', '2023-05-18 18:36:00', '2023-05-25 02:36:00', '94beb87ffcf7b56f240e5130fd2f21795e384cba.jpg', '吵好穿', 'ddd', '2023-05-19 02:37:19', '2023-05-19');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
