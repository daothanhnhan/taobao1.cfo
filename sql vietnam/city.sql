-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 12, 2023 lúc 03:34 PM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB
-- Phiên bản PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `batdongs_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Hồ Chí Minh'),
(2, 'Hà Nội'),
(3, 'Đà Nẵng'),
(4, 'An Giang'),
(5, 'Bà Rịa Vũng Tàu'),
(6, 'Bình Dương'),
(7, 'Bình Phước'),
(8, 'Bình Thuận  '),
(9, 'Bình Định'),
(10, 'Bạc Liêu'),
(11, 'Bắc Giang'),
(12, 'Bắc Kạn'),
(13, 'Bắc Ninh'),
(14, 'Bến Tre'),
(15, 'Cao Bằng'),
(16, 'Cà Mau'),
(17, 'Cần Thơ'),
(18, 'Gia Lai'),
(19, 'Hà Giang'),
(20, 'Hà Nam'),
(21, 'Hà Tĩnh'),
(22, 'Hòa Bình'),
(23, 'Hưng Yên'),
(24, 'Hải Dương'),
(25, 'Hải Phòng'),
(26, 'Hậu Giang'),
(27, 'Khánh Hòa'),
(28, 'Kiên Giang'),
(29, 'Kon Tum'),
(30, 'Lai Châu'),
(31, 'Long An'),
(32, 'Lào Cai'),
(33, 'Lâm Đồng'),
(34, 'Lạng Sơn'),
(35, 'Nam Định'),
(36, 'Nghệ An'),
(37, 'Ninh Bình'),
(38, 'Ninh Thuận'),
(39, 'Phú Thọ'),
(40, 'Phú Yên'),
(41, 'Quảng Bình'),
(42, 'Quảng Nam'),
(43, 'Quảng Ngãi'),
(44, 'Quảng Ninh'),
(45, 'Quảng Trị'),
(46, 'Sóc Trăng'),
(47, 'Sơn La'),
(48, 'Thanh Hóa'),
(49, 'Thái Bình'),
(50, 'Thái Nguyên'),
(51, 'Thừa Thiên Huế'),
(52, 'Tiền Giang'),
(53, 'Trà Vinh'),
(54, 'Tuyên Quang'),
(55, 'Tây Ninh'),
(56, 'Vĩnh Long'),
(57, 'Vĩnh Phúc'),
(58, 'Yên Bái'),
(59, 'Điện Biên'),
(60, 'Đắk Lắk'),
(61, 'Đắk Nông'),
(62, 'Đồng Nai'),
(63, 'Đồng Tháp');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
