-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 31, 2023 lúc 08:03 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db_complete`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `use_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_product`
--

CREATE TABLE `menu_product` (
  `id` int(11) NOT NULL,
  `type_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_product`
--

INSERT INTO `menu_product` (`id`, `type_product`) VALUES
(11, 'Điện thoại'),
(12, 'Đồng hồ'),
(13, 'Bút máy'),
(14, 'GPU'),
(15, 'CPU');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `use_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `use_id`, `name`, `email`, `number`, `message`, `rating`) VALUES
(10, 14, 'ngo thanh canh', 'ngothanhcanh03@gmail.com', 858116654, '0', 50),
(11, 14, 'thanh cảnh', 'canh1@gmail.com', 2584465, '0', 70),
(12, 14, 'ntcanh', 'canh1@gmail.com', 2131231412, '0', 30),
(13, 14, 'cảnh', 'ngothanhcanh@gmail.com', 2423, 'afs', 50),
(14, 14, 'cảnh', 'ngothanhcanh@gmail.com', 100000, 'shop ok', 90),
(15, 14, 'cảnh', 'ngothanhcanh@gmail.com', 2147483647, 'shop rất đẹp', 80),
(16, 18, 'ngo thanh canh', 'canh113@gmail.com', 858116654, 'shop cũng được', 50),
(17, 18, 'ngo thanh canh', 'canh@gmail.com', 858116654, 'shop cũng được', 80);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `use_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Đợi duyệt'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `use_id`, `name`, `number`, `email`, `method`, `adress`, `total_price`, `placed_on`, `payment_status`) VALUES
(43, 19, 'Dương Thắng', '0357052176', 'a@gmail.com', 'thanh toán khi nhận hàng', 'Bình An', '90.625.000', '30-Jul-2023', 'Đang Giao'),
(44, 18, 'canh', '0978979', 'ngothanhcanh2001@gmail.com', 'thanh toán khi nhận hàng', 'a15', '465.925.000', '31-Jul-2023', 'Đợi duyệt'),
(45, 18, 'canh123', '12441244125', 'ngothanhcanh2001@gmail.com', 'thanh toán khi nhận hàng', 'adaffa', '558.325.000', '31-Jul-2023', 'Đợi duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `id_order`, `id_product`, `quantity`, `price`) VALUES
(35, 27, 41, '4', '124241'),
(34, 26, 42, '1', '0'),
(33, 26, 43, '1', '1234'),
(32, 26, 41, '4', '124241'),
(31, 25, 42, '1', '0'),
(30, 25, 43, '1', '1234'),
(29, 25, 41, '4', '124241'),
(28, 24, 42, '2', '0'),
(27, 24, 43, '3', '1234'),
(26, 24, 41, '4', '124241'),
(36, 27, 43, '1', '1234'),
(37, 27, 42, '1', '0'),
(38, 28, 41, '1', '124241'),
(39, 28, 42, '1', '0'),
(40, 28, 43, '1', '1234'),
(41, 29, 42, '1', '0'),
(42, 29, 43, '1', '1234'),
(43, 29, 41, '1', '124241'),
(44, 29, 40, '1', '1234'),
(45, 30, 40, '1', '1234'),
(46, 30, 41, '1', '124241'),
(47, 30, 42, '1', '0'),
(48, 30, 43, '1', '1234'),
(49, 31, 38, '1', '1234'),
(50, 31, 41, '1', '124241'),
(51, 31, 47, '1', '123000'),
(52, 31, 44, '1', '13000'),
(53, 31, 43, '1', '1234'),
(54, 31, 45, '1', '13000'),
(55, 31, 42, '1', '0'),
(56, 32, 43, '1', '1234'),
(57, 32, 41, '1', '124241'),
(58, 32, 48, '1', '41414'),
(59, 32, 45, '1', '13000'),
(60, 32, 43, '1', '1234'),
(61, 32, 48, '1', '41414'),
(62, 32, 41, '1', '124241'),
(63, 33, 37, '1', '1234'),
(64, 33, 38, '1', '1234'),
(65, 34, 37, '1', '1234'),
(66, 34, 38, '1', '1234'),
(67, 35, 37, '1', '1234'),
(68, 35, 38, '1', '1234'),
(69, 36, 37, '1', '1234'),
(70, 36, 38, '1', '1234'),
(71, 37, 37, '1', '1234'),
(72, 37, 38, '1', '1234'),
(73, 38, 37, '1', '1234'),
(74, 38, 38, '1', '1234'),
(75, 39, 39, '1', '14'),
(76, 39, 38, '1', '1234'),
(77, 39, 37, '1', '1234'),
(78, 40, 37, '1', '1234'),
(79, 41, 37, '1', '1234'),
(80, 41, 38, '1', '1234'),
(81, 42, 56, '1', '11000000'),
(82, 42, 66, '1', '48000000'),
(83, 42, 61, '1', '1300000'),
(84, 42, 71, '1', '28000000'),
(85, 42, 76, '1', '2300000'),
(86, 43, 76, '1', '2300000'),
(87, 43, 71, '1', '28000000'),
(88, 43, 66, '1', '48000000'),
(89, 43, 56, '1', '11000000'),
(90, 43, 61, '1', '1300000'),
(91, 44, 63, '3', '140000000'),
(92, 44, 61, '3', '1300000'),
(93, 44, 60, '1', '9000000'),
(94, 44, 56, '1', '11000000'),
(95, 44, 57, '1', '22000000'),
(96, 45, 56, '1', '11000000'),
(97, 45, 62, '1', '12000000'),
(98, 45, 57, '3', '22000000'),
(99, 45, 60, '1', '9000000'),
(100, 45, 61, '1', '1300000'),
(101, 45, 63, '3', '140000000'),
(102, 45, 58, '3', '13000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `old_price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `type_product` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `old_price`, `new_price`, `product_detail`, `type_product`, `method`, `image`) VALUES
(62, 'CITIZEN TSUYOSA NJ0154-80H', 15000000, 12000000, 'Tiền nào của đó', 'Đồng hồ', '', '1690711793.webp'),
(61, 'Casio World Time AE', 1500000, 1300000, 'Xem giờ rất chuẩn', 'Đồng hồ', 'Sale', '1690711689.webp'),
(60, 'iPhone 11 Pro Max', 10000000, 9000000, 'Yếu', 'Điện thoại', '', '1690711427.webp'),
(59, 'iPhone 13 Pro Max', 15000000, 14000000, 'VIP', 'Điện thoại', '', '1690710770.webp'),
(57, 'iPhone 14 Pro Max', 24000000, 22000000, 'Mạnh', 'Điện thoại', '', '1690710013.png'),
(58, 'iphone 12 Pro Max', 15000000, 13000000, 'OK', 'Điện thoại', '', '1690710787.webp'),
(56, 'iPhone SE 2022', 12000000, 11000000, 'Nothing', 'Điện thoại', 'Sale', '1690709428.webp'),
(63, 'DOXA GRANDEMETRE D154RWH', 150000000, 140000000, 'Tiền nào của nấy', 'Đồng hồ', '', '1690712038.webp'),
(64, 'ORIENT OPEN HEART RA-AR0001S10B', 13000000, 11000000, 'Cũng vip', 'Đồng hồ', '', '1690712103.webp'),
(65, 'TISSOT LE LOCLE POWERMATIC', 24000000, 23000000, 'Chống nước', 'Đồng hồ', '', '1690712158.webp'),
(66, 'Bút máy Duofold 100th Years LE Blue GT', 50000000, 48000000, 'Viết rất nét', 'Bút máy', 'Sale', '1690712779.png'),
(67, 'Bút máy Duofold 100th Years LE Red GT', 50000000, 48000000, 'Nghe mùi tiền', 'Bút máy', '', '1690712458.png'),
(68, 'Bút máy Parker Duofold PST Blue Chevron GT', 24000000, 22000000, 'Rẻ', 'Bút máy', '', '1690712561.png'),
(69, 'Bút dạ bi Parker Duofold PST Blue Chevron GT', 22000000, 20000000, 'Viết không bao giờ hết mực', 'Bút máy', '', '1690712606.png'),
(70, 'Bút bi Parker Duofold PST Blue Chevron GT', 16000000, 14000000, 'Rất rẻ', 'Bút máy', '', '1690712680.png'),
(71, 'MSI RTX 4070 TI SUPRIM X 12G', 30000000, 28000000, 'Tiền nào của nấy', 'GPU', 'Sale', '1690713257.jpg'),
(72, 'MSI RTX 4090 Gaming X Intro', 50000000, 48000000, 'Không biết lag là gì', 'GPU', '', '1690713469.jpg'),
(73, 'MSI RTX 4070 GAMING X TRIO 12G', 20000000, 18000000, 'VIP', 'GPU', '', '1690713367.jpg'),
(74, 'MSI RTX 4070 TI GAMING X TRIO 12G', 27000000, 25000000, 'Chơi game thoải mái', 'GPU', '', '1690713554.jpg'),
(75, 'COLORFUL IGAME RTX 3060 ULTRA', 10000000, 8000000, 'Card giá rẻ', 'GPU', '', '1690713914.jpg'),
(76, 'CPU Intel Core i3-12100F', 3000000, 2300000, 'Ngon trong tầm giá', 'CPU', 'Sale', '1690714336.webp'),
(77, 'CPU Intel Core i3-12100', 3500000, 2900000, 'Khá ổn', 'CPU', '', '1690714390.webp'),
(78, 'CPU Intel Core i3-13100F', 3700000, 3000000, 'Cũng ok', 'CPU', '', '1690714417.webp'),
(79, 'CPU AMD Ryzen 5 5600 3.5GHz', 4200000, 3800000, 'AMD Ryzen thì khỏi bàn', 'CPU', '', '1690714457.webp'),
(80, 'CPU AMD Ryzen 5 5600G 3.9GHz', 4300000, 3500000, 'Giảm giá mạnh , mua nhanh đi ạ', 'CPU', '', '1690714496.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `OTP` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `OTP`) VALUES
(18, 'canh', 'ngothanhcanh2001@gmail.com', '123456', 'user', 101029),
(13, 'ngo thanh canh', 'admin@gmail.com', '123', 'admin', 0),
(15, 'ngothanhcanh', 'canh@gmail.com', '123', 'user', 0),
(16, 'ngothanhcanh', 'canhss@gmail.com', '123', 'user', 0),
(17, 'ngothanhcanh', 'canhddd@gmail.com', '123', 'user', 0),
(19, 'thang', 'a@gmail.com', 'a', 'user', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `use_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid_cart` (`pid`);

--
-- Chỉ mục cho bảng `menu_product`
--
ALTER TABLE `menu_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wishlist` (`pid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT cho bảng `menu_product`
--
ALTER TABLE `menu_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
