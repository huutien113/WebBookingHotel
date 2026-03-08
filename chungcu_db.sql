-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 08, 2026 lúc 02:35 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chungcu_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `apartments`
--

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `area` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `apartments`
--

INSERT INTO `apartments` (`id`, `title`, `description`, `area`, `price`, `location`, `status`, `image_url`) VALUES
(2, 'Diên hi cung', 'co cai con cac haha haha:))', '3690m2', '36 tỷ', 'Ní Hảo', 'Đang mở bán', '1772973665_hi.jpg'),
(3, 'Cầu Vàng', 'đẹp vl', 'to lắm ', 'vô giá', 'Việt Nam', 'Đã bàn giao', '1772975215_cauvang.webp'),
(4, 'Hồ Gươm', 'hồ to có con rùa nhỏ', 'hơi to thôi không to lắm', 'vô giá', 'Hà Nội', 'Đã bàn giao', '1772975284_hohuom.jpg'),
(5, 'Sapa', 'đẹp vaiiii có tiền phải đi liền', 'siêu to', 'vô giá', 'Việt Nam', 'Đã bàn giao', '1772975331_sapa.jpg'),
(6, 'Kinh Thành Thăng Long', 'Nghìn năm văn hiến Thăng Long\r\nRồng bay rực rỡ soi dòng sử xanh', 'siêu to', 'vô giá', 'Đại Việt', 'Đã bàn giao', '1772975473_thanglong.jpg'),
(7, 'Văn Miếu Quốc Tử ', 'Cửa thiền lấp lánh sao Khuê,\r\nNghìn năm bia đá còn ghi bảng vàng', 'siêu to', 'vô giá', 'Việt Nam', 'Đã bàn giao', '1772975525_Mieu.jpg'),
(8, 'Huế', 'Ta về thăm Huế mộng mơ,\r\nCâu thơ ai thả lững lờ trên sông', 'siêu to', 'vô giá', 'Việt Nam', 'Đã bàn giao', '1772975566_Hue.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'Sân•Hận', '0928241700', 'kellydao002@gmail.com', 'hi', '2026-03-08 12:56:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
