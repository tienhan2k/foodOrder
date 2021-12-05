-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2021 lúc 06:17 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `foodorder`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'tien', 'tien', '2a26569e98b26668f39e98e6baef2d54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagine_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `imagine_name`, `featured`, `active`) VALUES
(8, 'Ăn sáng', 'Food_Category_388.jpg', 'Yes', 'Yes'),
(12, 'Ăn trưa', 'Food_Category_569.jpg', 'Yes', 'Yes'),
(13, 'Ăn tối', 'Food_Category_350.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `imagine_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `imagine_name`, `category_id`, `featured`, `active`) VALUES
(18, 'Bún bò giò heo', 'Cực kỳ ngon ạ.', '50000', 'Food-Name-1326.jpg', 8, 'Yes', 'Yes'),
(19, 'Cháo lòng', 'Trời lạnh ăn tô cháo lòng thì khỏi hỏi nheng cả nhà yêu của kemmmmmm.', '40000', 'Food-Name-1471.jpg', 8, 'Yes', 'Yes'),
(20, 'Cháo sườn non', 'Siu phẩm phải có mặt ở dạ dày trong hôm nayyy', '40000', 'Food-Name-3830.jpg', 8, 'Yes', 'Yes'),
(21, 'Miến gà', 'Ối dồi ôi  luôn đó cả nhà ạ.', '55000', 'Food-Name-4444.jpg', 8, 'Yes', 'Yes'),
(22, 'Mì Quảng', 'Siu ngon có tôm thịt đồ ngon  lắm', '45000', 'Food-Name-8776.jpg', 8, 'Yes', 'Yes'),
(23, 'Cơm phần 1', '', '150000', 'Food-Name-9464.jpg', 12, 'Yes', 'Yes'),
(24, 'Cơm phần 2', '', '150000', 'Food-Name-6780.jpg', 12, 'Yes', 'Yes'),
(25, 'Cơm phần 3', '', '150000', 'Food-Name-4627.jpg', 12, 'Yes', 'Yes'),
(26, 'Cơm phần 4', '', '150000', 'Food-Name-7994.jpg', 12, 'Yes', 'Yes'),
(27, 'Cơm phần 5', '', '150000', 'Food-Name-4224.jpg', 12, 'Yes', 'Yes'),
(28, 'Cơm tối ngon 1', '', '200000', 'Food-Name-127.jpg', 13, 'Yes', 'Yes'),
(29, 'Cơm tối ngon 2', '', '200000', 'Food-Name-9226.jpg', 13, 'Yes', 'Yes'),
(30, 'Cơm tối ngon 3', '', '200000', 'Food-Name-3001.jpg', 13, 'Yes', 'Yes'),
(31, 'Cơm tối ngon 4', '', '200000', 'Food-Name-5948.jpg', 13, 'Yes', 'Yes'),
(32, 'Cơm tối ngon 5', '', '200000', 'Food-Name-2439.jpg', 13, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(10, 'Bún bò giò heo', '50000', 1, '50000', '2021-05-16 05:30:23', 'Đã đặt hàng', 'nguyễn bá qq', '545487777', 'badao3k5@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng'),
(11, 'Cơm phần 1', '150000', 1, '150000', '2021-05-16 05:47:01', 'Đã nhận', 'nguyễn bá đạo', '454', 'badao3k5@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng'),
(12, 'Mì Quảng', '45000', 1, '45000', '2021-05-16 05:47:13', 'Đã huỷ', 'Tiến Nguyễn', '435', 'tienvannguyen2589@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng'),
(13, 'Cháo sườn non', '40000', 1, '40000', '2021-05-16 05:56:20', 'Đã nhận', 'nguyễn bá đạo', 'sa', 'badao3k5@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng'),
(14, 'Cơm tối ngon 4', '200000', 1, '200000', '2021-05-16 05:56:54', 'Đã nhận', 'nguyễn bá đạoákdj', '5855', 'badao3k5@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng'),
(15, 'Cơm tối ngon 3', '200000', 1, '200000', '2021-05-16 06:06:45', 'Đã đặt hàng', 'Tiến Nguyễn', 'q', 'tienvannguyen2589@gmail.com', 'Ktx sư phạm, hòa khánh nam, liên chiểu, đà nẵng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
