-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 04, 2024 lúc 02:48 PM
-- Phiên bản máy phục vụ: 8.0.35
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashionshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` bit(1) NOT NULL,
  `user_login_status` enum('Logout','Login') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_connection_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_account`
--

INSERT INTO `tbl_account` (`account_id`, `username`, `password`, `token`, `account_type`, `is_verified`, `user_login_status`, `user_token`, `user_connection_id`) VALUES
(1, 'admin', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'admin', b'1', 'Logout', '7b58badc729bb1f12e03aa29d6a6a09f', '108'),
(2, 'admin1', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'admin', b'1', 'Logout', NULL, NULL),
(3, 'admin2', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'admin', b'1', 'Logout', NULL, NULL),
(4, 'customer1', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', '1b58dc5810e08986fa28d4ec40fef760', '88'),
(5, 'customer2', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', '104cf7986542671fd95a014decf3601a', '93'),
(6, 'customer3', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(7, 'customer4', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(8, 'customer5', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(9, 'customer6', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(10, 'customer7', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(11, 'customer8', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(12, 'customer9', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(13, 'customer10', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(14, 'customer11', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(15, 'customer12', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(16, 'customer13', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(17, 'customer14', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(18, 'customer15', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(19, 'customer16', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(20, 'customer17', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(21, 'customer18', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(22, 'customer19', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(23, 'customer20', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(24, 'customer21', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(25, 'customer22', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(26, 'customer23', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(27, 'customer24', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(28, 'customer25', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(29, 'customer26', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(30, 'customer27', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(31, 'customer28', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(32, 'customer29', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(33, 'customer30', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(34, 'customer31', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(35, 'customer32', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(36, 'customer33', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(37, 'customer34', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(38, 'customer35', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(39, 'customer36', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(40, 'customer37', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(41, 'customer38', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(42, 'customer39', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(43, 'customer40', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(44, 'customer41', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(45, 'customer42', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(46, 'customer43', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(47, 'customer44', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(48, 'customer45', 'e6e061838856bf47e1de730719fb2609', '5620ffd5755f0f198166ea7c98c14ffc', 'user', b'1', 'Logout', NULL, NULL),
(63, 'admin123', 'e6e061838856bf47e1de730719fb2609', '', 'user', b'1', 'Logout', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account_details`
--

CREATE TABLE `tbl_account_details` (
  `account_id` int NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_account_details`
--

INSERT INTO `tbl_account_details` (`account_id`, `customer_name`, `gender`, `date_of_birth`, `address`, `phone`, `email`) VALUES
(1, 'Vũ Văn Anh', 'Nam', '2003-02-13', 'Tây Thạnh, Tân Phú, Thành phố Hồ Chí Minh', '0393222222', 'fashionshop@gmail.com'),
(2, 'Hà Tri Thủy', 'Nam', '2003-01-17', 'Tân Sơn Nhì, Tân Phú, Thành phố Hồ Chí Minh', '0393222455', 'hatrithuy@gmail.com'),
(3, 'Nguyễn Bảo Long', 'Nam', '2003-04-24', 'Phường 7, Quận 5, Thành phố Hồ Chí Minh, Việt Nam', '0393555222', 'nguyenbaolong@gmail.com'),
(4, 'Vũ Văn Ann', 'Nam', '2003-02-13', 'Số 351A Hùng Vương, Phường An Sơn, Tam Kỳ, Quảng N', '0393123456', 'vuvananh@gmail.com'),
(5, 'Trần Thái An', 'Nam', '2003-04-13', 'Ấp 6A, Tam Bình, Vĩnh Long, Việt Nam', '093755621', 'thienhuonglogistics@gmail.com'),
(6, 'Lê Bích Thủy', 'Nữ', '2003-05-13', 'Hoà Tân, Châu Thành, Đồng Tháp, Việt Nam', '0979598491', 'customer3@gmail.com'),
(7, 'Trần Mỹ Huyền', 'Nữ', '2003-06-13', 'Mỹ Hoà, Thành phố Long Xuyên, An Giang, Việt Nam', '0979598492', 'vantaiduongviet@gmail.com'),
(8, 'Lê Ly Trang Nhi', 'Nam', '2003-07-13', 'ĐT745, Uyên Hưng, Tân Uyên, Bình Dương, Việt Nam', '0393888888', 'taynambacsg@gmail.com'),
(9, 'Nguyễn Thị Thu', 'Nữ', '2003-08-13', '26B Đường Võ Văn Tần, Phú Chánh, Tân Uyên, Bình Dư', '0393888889', 'vantaivohongphat@gmail.com'),
(10, 'Phạm Hồng Thái', 'Nam', '2003-09-13', 'Ấp Xóm Đồng, xã Thanh Phước, huyện Gò Dầu, Tây Nin', '0393123457', 'customer7@gmail.com'),
(11, 'Nguyễn Văn Tú', 'Nam', '2003-10-13', '19 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123458', 'customer8@gmail.com'),
(12, 'Lê Thị Lan', 'Nữ', '2003-11-13', '20 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123459', 'customer9@gmail.com'),
(13, 'Nguyễn Minh Hiếu', 'Nam', '2003-12-13', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ ', '0393123460', 'customer10@gmail.com'),
(14, 'Trần Văn Đức', 'Nam', '2003-05-14', '21 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123461', 'customer11@gmail.com'),
(15, 'Nguyễn Thị Mai', 'Nữ', '2003-05-21', '317 Quang Trung, Trần Hưng Đạo, Quảng Ngãi, Việt N', '0393123462', 'customer12@gmail.com'),
(16, 'Lê Thị Thu', 'Nữ', '2003-05-06', 'Thị trấn, Phong Nha, Sơn Trạch, Quảng Bình, Việt N', '0393123463', 'customer13@gmail.com'),
(17, 'Phạm Văn Hải', 'Nam', '2004-05-19', '118A Hữu Nghị, Nam Lý, Đồng Hới, Quảng Bình, Việt ', '0393123464', 'customer14@gmail.com'),
(18, 'Trần Thị Nhung', 'Nữ', '2004-05-05', 'Tịnh Châu, Sơn Tịnh, Quảng Ngãi, Việt Nam', '0393123465', 'customer15@gmail.com'),
(19, 'Lê Văn Hưng', 'Nam', '2003-06-21', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thàn', '0393123466', 'customer16@gmail.com'),
(20, 'Nguyễn Thị Trinh', 'Nữ', '2003-04-09', '14 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123467', 'customer17@gmail.com'),
(21, 'Phạm Văn Thanh', 'Nam', '2003-07-19', 'Bàu Đưng, thôn Thuận Vinh, xã Thuận Đức Cuối đường', '0393123468', 'customer18@gmail.com'),
(22, 'Trần Thị Quỳnh', 'Nữ', '2003-05-31', '16 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123469', 'customer19@gmail.com'),
(23, 'Nguyễn Văn Lợi', 'Nam', '2003-04-22', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393123470', 'customer20@gmail.com'),
(24, 'Phạm Thị Ngọc', 'Nữ', '2003-03-19', 'QL24B, Tịnh Sơn, Sơn Tịnh, Quảng Ngãi, Việt Nam', '0393123471', 'customer21@gmail.com'),
(25, 'Trần Văn Nam', 'Nam', '2003-05-04', '777 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ C', '0393123472', 'customer22@gmail.com'),
(26, 'Nguyễn Thị Hồng', 'Nữ', '2003-03-11', '664 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ C', '0393123473', 'customer23@gmail.com'),
(27, 'Lê Văn Phúc', 'Nam', '2003-05-16', 'Vinh Thanh, Phú Vang, Thừa Thiên Huế, Việt Nam', '0393123474', 'customer24@gmail.com'),
(28, 'Nguyễn Thị Kim', 'Nữ', '2003-05-24', 'Nghé Vang, Thừa Thiên Huế, Việt Nam', '0393123475', 'customer25@gmail.com'),
(29, 'Nguyễn Thị Hương', 'Nữ', '2005-05-05', '85 Duy Tân, An Phú, Tam Kỳ, Quảng Nam, Việt Nam', '0393123476', 'customer26@gmail.com'),
(30, 'Trần Thị Phương', 'Nữ', '1995-05-18', '6-8 Trần Thánh Tông, Phường Tân Thạnh, Tam Kỳ, Quả', '0393123477', 'customer27@gmail.com'),
(31, 'Lê Thị Hải Yến', 'Nữ', '1994-05-13', '81 Huyền Trân Công Chúa, Hoà Hải, Ngũ Hành Sơn, Đà', '0393123478', 'customer28@gmail.com'),
(32, 'Phạm Thị Trang', 'Nữ', '1995-05-19', 'K3/12 Hà Thị Thân, An Hải Tây, Sơn Trà, Đà Nẵng, V', '0393123479', 'customer29@gmail.com'),
(33, 'Nguyễn Thị Linh', 'Nữ', '1995-05-26', '270 Võ Nguyên Giáp, Bắc Mỹ Phú, Ngũ Hành Sơn, Đà N', '0393123480', 'customer30@gmail.com'),
(34, 'Trần Thị Thuỳ Dung', 'Nữ', '2000-05-20', 'Lô e, Đường số 7, khu công nghiệp, Liên Chiểu, Đà ', '0393123481', 'customer31@gmail.com'),
(35, 'Lê Thị Thanh Hằng', 'Nữ', '2001-05-10', '89 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123482', 'customer32@gmail.com'),
(36, 'Nguyễn Thị Hà', 'Nữ', '1997-05-15', '50 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Ch', '0393123483', 'customer33@gmail.com'),
(37, 'Trần Thị Hồng Loan', 'Nữ', '1997-05-14', '43 Nguyễn Chí Thanh, Ba Đình, Thủ đô Hà Nội', '0393123484', 'customer34@gmail.com'),
(38, 'Phạm Thị Ánh Ngọc', 'Nữ', '2004-05-13', '27 Nguyễn Thái Sơn, Phường 7, Quận Gò Vấp, Thành p', '0393123485', 'customer35@gmail.com'),
(39, 'Nguyễn Thị Thảo Vy', 'Nữ', '1996-05-18', '20 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố ', '0393123486', 'customer36@gmail.com'),
(40, 'Trần Thị Hồng Nhung', 'Nữ', '1999-05-07', '100 Ng. Tất Tố,Phường 19, Bình Thạnh,Thành phố Hồ ', '0393123487', 'customer37@gmail.com'),
(41, 'Trần Thị Thu Trang', 'Nữ   ', '1999-05-14', '1210 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành ph', '0393123488', 'customer38@gmail.com'),
(42, 'Nguyễn Thị Diệu Linh', 'Nữ', '2004-05-13', '10 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố ', '0393123489', 'customer39@gmail.com'),
(43, 'Lê Thị Thanh Trúc', 'Nữ', '1994-05-28', '30 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393123490', 'customer40@gmail.com'),
(44, 'Phạm Thị Lan Anh', 'Nữ', '1994-05-11', '106 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thành', '0393123491', 'customer41@gmail.com'),
(45, 'Trần Thị Bích Ngọc', 'Nữ', '1995-05-19', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ ', '0393123492', 'customer42@gmail.com'),
(46, 'Nguyễn Thị Thanh Hương', 'Nữ', '1994-05-12', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức,', '0393123493', 'customer43@gmail.com'),
(47, 'Lê Thị Hoài Thu', 'Nữ', '1999-05-14', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ', '0393163493', 'customer44@gmail.com'),
(48, 'Phạm Thị Mỹ Linh', 'Nữ', '1996-03-06', '8 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố H', '0393123494', 'customer45@gmail.com'),
(63, 'anhh', NULL, NULL, NULL, '0393802528', 'vuvananh010203@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chat_message`
--

CREATE TABLE `tbl_chat_message` (
  `chat_message_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `chat_message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_chat_message`
--

INSERT INTO `tbl_chat_message` (`chat_message_id`, `customer_id`, `employee_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 4, NULL, 'Tôi cần hỗ trợ', '2024-06-03 15:06:08', 'Yes'),
(2, 4, 1, 'Bạn cần hỗ trợ gì', '2024-06-03 15:07:08', 'Yes'),
(3, 4, NULL, 'aaaaaaaa', '2024-06-04 10:41:08', 'Yes'),
(4, 4, NULL, 'aaaaa', '2024-06-04 10:42:32', 'Yes'),
(5, 4, NULL, 'aaaaa', '2024-06-04 10:54:05', 'Yes'),
(6, 4, NULL, 'hello', '2024-06-04 10:56:35', 'Yes'),
(7, 4, NULL, 'tôi', '2024-06-04 11:01:13', 'Yes'),
(8, 4, NULL, 'giúp tôi', '2024-06-04 11:06:36', 'Yes'),
(9, 4, NULL, 'được', '2024-06-04 12:49:44', 'Yes'),
(10, 4, NULL, 'được', '2024-06-04 12:51:05', 'Yes'),
(11, 4, 1, 'được', '2024-06-04 12:52:43', 'Yes'),
(12, 4, 1, 'tôi sẽ giúp bạn', '2024-06-04 12:53:58', 'Yes'),
(13, 4, 1, 'bạn cần gì', '2024-06-04 12:56:03', 'Yes'),
(14, 4, 1, 'tôi có thể giúp gì\n', '2024-06-04 13:17:19', 'Yes'),
(15, 4, NULL, 'Hỗ trợ đơn hàng\n', '2024-06-04 13:24:21', 'Yes'),
(16, 4, 1, 'được', '2024-06-04 13:27:47', 'Yes'),
(17, 4, 1, 'đ', '2024-06-04 13:29:12', 'Yes'),
(18, 4, NULL, 'đ', '2024-06-04 13:30:01', 'Yes'),
(19, 4, NULL, 'đ', '2024-06-04 13:30:16', 'Yes'),
(20, 4, 1, 'đ', '2024-06-04 13:34:52', 'Yes'),
(21, 4, 1, 'đ', '2024-06-04 13:40:29', 'Yes'),
(22, 4, 1, 'đ', '2024-06-04 13:42:29', 'Yes'),
(23, 4, 1, 'đ', '2024-06-04 13:43:21', 'Yes'),
(24, 4, 1, 'adadad', '2024-06-04 13:43:32', 'Yes'),
(25, 4, 1, 'aaaa', '2024-06-04 13:44:29', 'Yes'),
(26, 4, 1, 'ok', '2024-06-04 13:46:37', 'Yes'),
(27, 4, NULL, 'a', '2024-06-04 13:46:43', 'Yes'),
(28, 4, 1, 'ok', '2024-06-04 13:47:34', 'Yes'),
(29, 4, NULL, 'a', '2024-06-04 13:47:38', 'Yes'),
(30, 4, NULL, 'a', '2024-06-04 13:47:59', 'Yes'),
(31, 4, 1, 'ok', '2024-06-04 13:48:06', 'Yes'),
(32, 4, NULL, 'a', '2024-06-04 13:48:22', 'Yes'),
(33, 4, 1, 'a', '2024-06-04 13:50:06', 'Yes'),
(34, 4, 1, 'a', '2024-06-04 13:59:03', 'Yes'),
(35, 4, 1, 'a', '2024-06-04 13:59:15', 'Yes'),
(36, 4, NULL, 'a', '2024-06-04 13:59:20', 'Yes'),
(37, 4, NULL, 'a', '2024-06-04 14:01:41', 'Yes'),
(38, 4, 1, 'ok', '2024-06-04 14:03:26', 'Yes'),
(39, 4, NULL, 'h', '2024-06-04 14:03:39', 'Yes'),
(40, 4, 1, 'a', '2024-06-04 14:03:55', 'Yes'),
(41, 4, 1, 'a', '2024-06-04 14:04:46', 'Yes'),
(42, 4, 1, 'a', '2024-06-04 14:07:49', 'Yes'),
(43, 4, 1, 'Ngáp', '2024-06-04 14:08:09', 'Yes'),
(44, 5, 1, 'đi', '2024-06-04 14:08:30', 'Yes'),
(45, 4, 1, 'dd', '2024-06-04 14:10:41', 'Yes'),
(46, 4, NULL, 'ki', '2024-06-04 14:10:48', 'Yes'),
(47, 4, NULL, '1', '2024-06-04 14:11:18', 'Yes'),
(48, 4, NULL, '1', '2024-06-04 14:11:35', 'Yes'),
(49, 4, NULL, '11', '2024-06-04 14:11:48', 'Yes'),
(50, 4, 1, 'a', '2024-06-04 14:12:00', 'Yes'),
(51, 4, 1, 'a', '2024-06-04 14:13:10', 'Yes'),
(52, 4, NULL, 'a', '2024-06-04 14:13:14', 'Yes'),
(53, 4, 1, 'a', '2024-06-04 14:14:49', 'Yes'),
(54, 4, NULL, 'aaaaaa', '2024-06-04 14:14:57', 'Yes'),
(55, 4, NULL, 'aaaaaaaaaa', '2024-06-04 14:15:38', 'Yes'),
(56, 4, 1, 'a', '2024-06-04 14:16:29', 'Yes'),
(57, 4, 1, 'a', '2024-06-04 14:16:42', 'No'),
(58, 4, NULL, 'a', '2024-06-04 14:16:45', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `customer_id`, `product_id`, `rating`, `comment`) VALUES
(1, 6, 1, 5, 'Chất lượng tốt. Sẽ tiếp tục ủng hộ'),
(2, 45, 6, 5, 'Giao hàng nhanh chóng. Rất hài lòng'),
(3, 4, 2, 5, 'Hình thức thanh toán đa dạng và tiện lợi'),
(4, 12, 3, 5, 'Sản phẩm chất lượng, giá cả hợp lý'),
(5, 45, 4, 5, 'Sản phẩm tốt đúng nhưng hình ảnh hơi mờ'),
(6, 45, 6, 5, 'Dịch vụ khách hàng tốt'),
(7, 6, 26, 5, 'Chất lượng tốt. Sẽ tiếp tục ủng hộ'),
(8, 12, 8, 4, 'Giao hàng không đúng thời gian'),
(9, 4, 10, 2, 'Sản phẩm không đạt yêu cầu'),
(10, 6, 2, 5, 'Nhân viên phục vụ rất nhiệt tình');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `total` bigint NOT NULL,
  `date` datetime NOT NULL,
  `note` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `customer_id`, `total`, `date`, `note`, `address`, `phone`) VALUES
(1, 6, 4415500, '2024-04-01 00:00:00', 'Đã thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393123456),
(2, 7, 4415500, '2024-03-21 00:00:00', 'Đã thanh toán', '98 Ng. Tất Tố,Phường 19, Bình Thạnh, Thành phố Hồ Chí Minh', 393755621),
(3, 8, 4415500, '2024-04-01 00:00:00', 'Chờ thanh toán', '1026 Phạm Văn Đồng, Hiệp Bình Chánh, Thủ Đức, Thành phố Hồ Chí Minh', 979598491),
(4, 45, 4415500, '2024-04-17 00:00:00', 'Đã thanh toán', '27 Lý Thường Kiệt, Phường 7, Quận 11, Thành phố Hồ Chí Minh', 979951492),
(5, 4, 4612750, '2024-04-24 00:00:00', 'Chờ thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393888888),
(6, 12, 2199000, '2024-04-24 00:00:00', 'Đã thanh toán', '8 Đ. Trường Sa, Phường 17, Bình Thạnh, Thành phố Hồ Chí Minh', 979541478),
(7, 4, 4415500, '2024-04-24 00:00:00', 'Đã thanh toán', '12 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', 393123456),
(8, NULL, 2199000, '2024-06-04 00:00:00', 'Chờ thanh toán', '131231aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 393802528),
(11, NULL, 0, '2024-06-04 00:00:00', 'Chờ thanh toán', '131231aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 393802528),
(12, NULL, 1319000, '2024-06-04 00:00:00', 'Chờ thanh toán', '131231aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 393802528),
(13, NULL, 1319000, '2024-06-04 00:00:00', 'Chờ thanh toán', '131231aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 393802528),
(14, NULL, 3957000, '2024-06-04 00:00:00', 'Đã thanh toán', '131231aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 393802528),
(15, NULL, 2638000, '2024-06-04 00:00:00', 'Đã thanh toán', 'Phước Lập', 393802528),
(16, 4, 2199000, '2024-06-04 00:00:00', 'Đã thanh toán', 'Số 351A Hùng Vương, Phường An Sơn, Tam Kỳ, Quảng N', 393123456);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_invoice_details`
--

CREATE TABLE `tbl_invoice_details` (
  `invoice_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` bigint NOT NULL,
  `commented` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_invoice_details`
--

INSERT INTO `tbl_invoice_details` (`invoice_id`, `product_id`, `quantity`, `price`, `commented`) VALUES
(1, 1, 2, 1319000, 1),
(1, 2, 1, 2199000, 1),
(1, 26, 1, 19460000, 1),
(2, 10, 10, 359000, 0),
(3, 3, 2, 359000, 0),
(3, 9, 1, 4100000, 0),
(4, 4, 2, 790000, 1),
(4, 6, 1, 19460000, 1),
(4, 7, 1, 749000, 1),
(5, 2, 2, 2199000, 0),
(5, 4, 1, 1144000, 0),
(5, 7, 1, 4100000, 0),
(6, 3, 2, 359000, 1),
(6, 8, 1, 1319000, 1),
(7, 2, 2, 2199000, 1),
(7, 3, 2, 359000, 0),
(7, 10, 2, 519000, 1),
(8, 2, 1, 2199000, 0),
(12, 1, 1, 1319000, 0),
(13, 1, 1, 1319000, 0),
(14, 1, 3, 3957000, 0),
(15, 1, 2, 2638000, 0),
(16, 2, 1, 2199000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int NOT NULL,
  `product_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` bigint NOT NULL,
  `product_discount` int NOT NULL,
  `product_rating` int NOT NULL,
  `product_type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_discount`, `product_rating`, `product_type_id`) VALUES
(1, 'Đầm ngắn 2 dây', 'Đầm ngắn 2 dây cup ngực sang trọng, gợi cảm\\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...\\nKích thước áo: S - M - L\\nChiều dài: S : 60,5 cm - M: 62 cm - L : 63,5 cm', 1319000, 20, 5, 9),
(2, 'Blazer nam trắng', 'Áo Blazer nam phom Premio phù hợp mọi dáng người\\nGam màu trung tính, lịch lãm tạo điểm nhấn nổi bật và thời thượng', 2199000, 30, 5, 3),
(3, 'Áo 2 dây xếp li', 'Áo 2 dây xếp li thời trang, nữ tính\\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...\\nKích thước áo: S - M - L\\nS : 38.7cm &#8226; M : 39.4cm &#8226; L : 40.1cm', 359000, 15, 5, 5),
(4, 'Sơ mi tay dài', 'Áo sơ mi dài tay phom Regular fit có độ suông rộng vừa đủ\\nThiết kế chỉn chu đến từng chi tiết với tà lượn, túi ngực.', 1144000, 15, 5, 1),
(5, 'Áo blazer oversize', 'Áo blazer oversize chất liệu Tweed thời trang\\nTrang phục phù hợp dạo phố, đi làm, đi tiệc....\\nKích thước áo: S - M - L\\nS: 67.5cm - M: 68.5cm - L: 69.5cm', 790000, 20, 0, 7),
(6, 'Áo polo nam', 'Áo polo chất liệu polyester pha cafe, cổ đức tay cộc, phom regular.', 524000, 5, 5, 1),
(7, 'Chân váy midi xẻ', 'Chân váy midi xẻ nữ tính\\nTrang phục phù hợp dạo phố, thường ngày...', 749000, 25, 5, 11),
(8, 'Air Jordan I High G', 'Giày thể thao\\nTrang phục phù hợp dạo phố, thường ngày,...\\nKích thước giày: 36 &#8594; 46', 4100000, 28, 4, 4),
(9, 'Váy lửng dáng xoè', 'Váy lửng dáng xoè nữ tính\\nTrang phục phù hợp dạo phố, thường ngày,đi tiệc...', 599000, 20, 0, 10),
(10, 'Mắt Kính Polygon', 'Mắt kính polygon Classic kim loại thời trang\\nThiết kế phù hợp phối với nhiều trang phục thời trang đa dạng\\nHộp kính tam giác da PU chống nước, nắp nam châm và kèm khăn lau kính', 519000, 30, 2, 14),
(11, 'Khoác blazer oversize sọc', 'Khoác blazer oversized phối denim cá tính\\nTrang phục phù hợp dạo phố, thường ngày,...', 1689000, 30, 0, 7),
(12, 'Đầm nhung 2 dây midi', 'Đầm nhung 2 dây midi thời trang, sang trọng\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...', 874000, 25, 0, 9),
(13, 'Đầm Thun Mini Tay Lở Dáng Xoè', 'Đầm thun mini tay lở dáng xoè thiết kế basic tôn dáng\nTrang phục phù hợp dạo phố, thường ngày, đi tiệc...', 588000, 10, 0, 9),
(14, 'Đầm Mini Tay Dài, Đắp Chéo Xếp Ly', 'Đầm Đầm mini tay dài, đắp chéo xếp ly thanh lịch, ôm eo tạo điểm nhấn\nTrang phục phù hợp dạo phố, thường ngày,đi tiệc, đi làm...', 682000, 25, 0, 9),
(15, 'Set Quần Short Áo Sơ Mi Oversize Tay Phồng', 'Áo sơ mi oversize tay phồng năng động, trẻ trung\nTrang phục phù hợp đi làm, thường ngày,...', 784000, 25, 0, 5),
(16, 'Đầm 2 dây dài buộc nơ vai', 'Đầm 2 dây dài buộc nơ vai.\\nTrẻ trung - Nữ tính.\\nTrang phục dạo phố.', 799000, 10, 0, 9),
(17, 'Đầm bút chì phối Organza', 'Đầm bút chì phối Organza.\\nThanh lịch - Hiện đại..\\nTrang phục phù hợp dạo phố, đi tiệc,...', 699000, 15, 0, 9),
(18, 'Áo Thun BabyTee Tay Ngắn In Hình', 'Áo thun BabyTee tay ngắn in hình trẻ trung, năng động.\\nTrang phục phù hợp dạo phố, thường ngày, đi học...', 399000, 30, 0, 5),
(19, 'Đầm Mini Phối Ren Cúp Ngực Tay Dài', 'Đầm mini phối ren cúp ngực tay dài thời trang, gợi cảm\\nTrang phục phù hợp dạo phố, đi tiệc,...', 599000, 17, 0, 9),
(20, 'Đầm lửng bẹt vai nhún tà', 'Đầm lửng bẹt vai nhún tà.\\nTrẻ trung - Nữ tính.', 699000, 15, 0, 9),
(21, 'Áo Vest Blazer Nam Tay Dài Trơn', 'Áo vest cũng mang đến một hình ảnh chỉnh chu, sang trọng và nam tính quyến rũ\\nTrang phục phù hợp lễ cưới, sự kiện, tham gia tiệc, đi làm, hẹn hò,... ', 1400000, 8, 0, 3),
(22, 'Áo Vest Blazer Nam Kẻ Sọc Dọc', 'Áo vest cũng mang đến một hình ảnh chỉnh chu, sang trọng và nam tính quyến rũ\\nTrang phục phù hợp môi trường làm việc công sở hoặc những buổi tiệc sang trọng,... ', 1340000, 10, 0, 3),
(23, 'Áo sơ mi dài tay dây rút', 'Áo sơ mi dài tay dây rút  sành điệu, hiện đại\\nTrang phục phù hợp dạo phố, thường ngày,đi chơi... ', 599000, 10, 0, 5),
(24, 'Áo Cropped Blazer', 'Áo Cropped Blazer cá tính\\nTrang phục phù hợp dạo phố, thường ngày,...', 599000, 0, 0, 5),
(25, 'Áo Parka Hai Mặt', 'Hai phong cách trong một chiếc áo.\\nÁo parka không thấm nước để bảo vệ chống lại các yếu tố thời tiết.', 980000, 20, 0, 1),
(26, 'Đồng hồ ORIENT Star 39.3 mm Nam', 'Đến từ hãng đồng hồ Orient, thương hiệu Nhật Bản nổi tiếng với nhiều chiếc đồng hồ thời thượng\\nĐồng hồ cơ tự động, bền bỉ, không cần dùng pin, lên dây cót bằng chuyển động của cổ tay\\nVới đường kính ', 19460000, 30, 5, 20),
(27, 'Đồng hồ CITIZEN Mechanical 42 mm Nam', 'Mẫu đồng hồ đến từ thương hiệu Citizen - một trong những thương hiệu nổi tiếng và uy tín đến từ Nhật Bản\\nĐồng hồ CITIZEN Mechanical 42 mm Nam NJ0080-50E sở hữu đường kính mặt 42 mm và độ rộng dây 18 ', 11185000, 20, 0, 20),
(28, 'Áo Sơ Mi Nam Oxford Tay Dài', 'Thiết kế đặc biệt với phần cổ trụ, áo vẫn giữ nguyên được nét trang nhã và tối giản nhưng không mang lại cảm giác tẻ nhạt.\\nForm dáng ôm vừa vặn, phần thân và tay áo suông, không ôm sẽ mang đến cảm gi', 569000, 6, 0, 1),
(29, 'Áo kiểu bẹt vai tay phồng', 'Miêu tả: ÁO BẸT VAI TAY PHỒNG.\\nĐặc tính: Trẻ trung - Nữ tính - Gợi cảm.\\nThể loại: Trang phục dạo phố, tiệc.', 499000, 10, 0, 5),
(30, 'Áo cúp ngang bẹt vai', 'Miêu tả: ÁO CÚP NGANG BẸT VAI.\\nĐặc tính: Hiện đại - Nữ tính.\\nThể loại: Trang phục tiệc, dạo phố. ', 499000, 10, 0, 5),
(31, 'Áo Kiểu Dây Yếm Cổ Tay Phồng', 'Miêu tả: ÁO KIỂU DÂY YẾM CỔ TAY PHỒNG.\\nĐặc tính: Nữ tính - Cá tính.\\nThể loại: Trang phục dạo phố.', 699000, 10, 0, 5),
(32, 'Áo kiểu tay lỡ cổ gấp nếp', 'Áo kiểu tay lỡ cổ gấp nếp nữ tính, sang trọng\\nTrang phục phù hợp dạo phố, thường ngày,đi làm...', 699000, 15, 0, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_style`
--

CREATE TABLE `tbl_product_style` (
  `product_id` int NOT NULL,
  `product_color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_style`
--

INSERT INTO `tbl_product_style` (`product_id`, `product_color`, `product_image`, `product_size`) VALUES
(1, 'đen', 'product_img1_den.jpg|product_img1_compact1_den.jpg||product_img1_compact2_den.jpg', 'M|L'),
(1, 'trắng', 'product_img1.jpg|product_img1_compact1.jpg|product_img1_compact2.jpg', 'M|L'),
(2, 'trắng', 'product_img2.jpg|product_img2_compact1.jpg|product_img2_compact2.jpg', 'S|M|L|XL|XXL'),
(2, 'xanh tím than', 'product_img2_xanhtimthan.jpg|product_img2_compact1_xanhtimthan.jpg|product_img2_compact2_xanhtimthan.jpg', 'S|M|L|XL|XXL'),
(3, 'đỏ', 'product_img3_do.jpg|product_img3_compact1_do.jpg|product_img3_compact2_do.jpg', 'S|M|L'),
(3, 'kem', 'product_img3.jpg|product_img3_compact1.jpg|product_img3_compact2.jpg', 'S|M|L'),
(4, 'đen', 'product_img4.jpg|product_img4_compact1.jpg|product_img4_compact2.jpg', '38|39|40|41|42|43'),
(5, 'be', 'product_img5.jpg|product_img5_compact1.jpg|product_img5_compact2.jpg', 'M|L'),
(5, 'đen', 'product_img5_den.jpg|product_img5_compact1_den.jpg|product_img5_compact2_den.jpg', 'M|L'),
(6, 'SB194', 'product_img6.jpg|product_img6_compact1.jpg|product_img6_compact2.jpg', 'S|L|XL'),
(7, 'be', 'product_img7.jpg|product_img7_compact1.jpg|product_img7_compact2.jpg', 'S|M|L'),
(7, 'den', 'product_img7_den.jpg|product_img7_compact1_den.jpg|product_img7_compact2_den.jpg', 'S|M|L'),
(7, 'nau', 'product_img7_nau.jpg|product_img7_compact1_nau.jpg|product_img7_compact2_nau.jpg', 'S|M|L'),
(8, 'green', 'product_img8.jpg|product_img8_compact1.jpg|product_img8_compact2.jpg', '36|37|38|39|40|41|42|43|44|45|46'),
(9, 'trangxam', 'product_img9.jpg|product_img9_compact1.jpg|product_img9_compact2.jpg', 'M'),
(10, 'den', 'product_img10_den.jpg|product_img10_compact1_den.jpg|product_img10_compact2_den.jpg', ' '),
(10, 'greyblue', 'product_img10.jpg|product_img10_compact1.jpg|product_img10_compact2.jpg', ' '),
(10, 'nau', 'product_img10_nau.jpg|product_img10_compact1_nau.jpg|product_img10_compact2_nau.jpg', ''),
(11, 'Caro đen', 'product_img11_den.jpg|product_img11_compact1_den.jpg', 'S|M|L'),
(11, 'Caro nâu', 'product_img11.jpg|product_img11_compact1.jpg|product_img11_compact2.jpg', 'S|M|L'),
(12, 'đen', 'product_img12.jpg|product_img12_compact1.jpg|product_img12_compact2.jpg', 'S|M|L'),
(13, 'đen', 'product_img13_den.jpg|product_img13_compact1_den.jpg||product_img13_compact2_den.jpg', 'S|M|L'),
(13, 'xanh', 'product_img13.jpg|product_img13_compact1.jpg|product_img13_compact2.jpg', 'S|M|L'),
(14, 'tim', 'product_img14.jpg|product_img14_compact1.jpg|product_img14_compact2.jpg', 'S|M|L'),
(15, 'trang', 'product_img15.jpg|product_img15_compact1.jpg| product_img15_compact2.jpg', 'F (Freesize)'),
(16, 'do', 'product_img16.jpg|product_img16_compact1.jpg|product_img16_compact2.jpg', 'S|M|L'),
(17, 'den', 'product_img17.jpg|product_img17_compact1.jpg|product_img17_compact2.jpg', 'S|M|L'),
(18, 'trang|den', 'product_img18.jpg|product_img18_compact1.jpg| product_img18_compact2.jpg', 'S|M|L'),
(19, 'den', 'product_img19.jpg|product_img19_compact1.jpg|product_img19_compact2.jpg', 'S|M|L'),
(20, 'den|trang', 'product_img20.jpg|product_img20_compact1.jpg|product_img20_compact2.jpg', 'S|M|L'),
(21, 'den', 'product_img21.jpg|product_img21_compact1.jpg|product_img21_compact2.jpg', 'L|XL|XXL'),
(22, 'den', 'product_img22.jpg|product_img22_compact1.jpg|product_img22_compact2.jpg', 'S|M|L|XL'),
(23, 'trang|kem', 'product_img23.jpg|product_img23_compact1.jpg|product_img23_compact2.jpg', 'S|M|L'),
(24, 'den|nau', 'product_img24.jpg|product_img24_compact1.jpg|product_img24_compact2.jpg', 'S|M|L'),
(25, 'den|nau', 'product_img25.jpg|product_img25_compact1.jpg|product_img25_compact2.jpg', 'L|XL|XXL'),
(26, 'trang', 'product_img26.jpg|product_img26_compact1.jpg|product_img26_compact2.jpg', ' '),
(27, 'den', 'product_img27.jpg|product_img27_compact1.jpg|product_img27_compact2.jpg', ' '),
(28, 'den|trang', 'product_img28.jpg|product_img28_compact1.jpg|product_img28_compact2.jpg', 'L|XL|XXL'),
(29, 'xanh|cam|den|kem', 'product_img29.jpg|product_img29_compact1.jpg|product_img29_compact2.jpg', 'S|M|L'),
(30, 'den|kem', 'product_img30.jpg|product_img30_compact1.jpg|product_img30_compact2.jpg', 'S|M'),
(31, 'xanh|kem|den', 'product_img31.jpg|product_img31_compact1.jpg|product_img31_compact2.jpg', 'S|M'),
(32, 'den|trang|kem', 'product_img32.jpg|product_img32_compact1.jpg|product_img32_compact2.jpg', 'S');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_type`
--

CREATE TABLE `tbl_product_type` (
  `product_type_id` int NOT NULL,
  `product_type_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`product_type_id`, `product_type_name`, `product_category`) VALUES
(1, 'Áo nam', 'Nam'),
(2, 'Quần nam', 'Nam'),
(3, 'Vest - Blazer', 'Nam'),
(4, 'Áo khoác nam', 'Nam'),
(5, 'Áo nữ', 'Nữ'),
(6, 'Áo dài', 'Nữ'),
(7, 'Áo khoác nữ', 'Nữ'),
(8, 'Quần nữ', 'Nữ'),
(9, 'Đầm', 'Nữ'),
(10, 'Váy', 'Nữ'),
(11, 'Chân váy', 'Nữ'),
(12, 'Quần', 'Nữ'),
(13, 'Áo', 'Nữ'),
(14, 'Mắt kính', 'Phụ kiện'),
(15, 'Giày - Dép', 'Phụ kiện'),
(16, 'Mũ - Nón', 'Phụ kiện'),
(17, 'Vớ - Tất', 'Phụ kiện'),
(18, 'Túi - Ví', 'Phụ kiện'),
(19, 'Thắt lưng', 'Phụ kiện'),
(20, 'Đồng hồ', 'Phụ kiện');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `user_token_UNIQUE` (`user_token`),
  ADD UNIQUE KEY `user_connection_id_UNIQUE` (`user_connection_id`);

--
-- Chỉ mục cho bảng `tbl_account_details`
--
ALTER TABLE `tbl_account_details`
  ADD PRIMARY KEY (`account_id`);

--
-- Chỉ mục cho bảng `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  ADD PRIMARY KEY (`chat_message_id`),
  ADD KEY `FK_chatmessage_account_customer` (`customer_id`),
  ADD KEY `FK_chatmessage_account_employee` (`employee_id`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD PRIMARY KEY (`invoice_id`,`product_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Chỉ mục cho bảng `tbl_product_style`
--
ALTER TABLE `tbl_product_style`
  ADD PRIMARY KEY (`product_id`,`product_color`);

--
-- Chỉ mục cho bảng `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `tbl_account_details`
--
ALTER TABLE `tbl_account_details`
  MODIFY `account_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  MODIFY `chat_message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_product_style`
--
ALTER TABLE `tbl_product_style`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `product_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_account_details`
--
ALTER TABLE `tbl_account_details`
  ADD CONSTRAINT `frn_accountdetails_account` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_chat_message`
--
ALTER TABLE `tbl_chat_message`
  ADD CONSTRAINT `FK_chatmessage_account_customer` FOREIGN KEY (`customer_id`) REFERENCES `tbl_account` (`account_id`),
  ADD CONSTRAINT `FK_chatmessage_account_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_account` (`account_id`);

--
-- Các ràng buộc cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `frn_comment_account` FOREIGN KEY (`customer_id`) REFERENCES `tbl_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frn_comment_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD CONSTRAINT `frn_invoicedetails_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `tbl_invoice` (`invoice_id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `frn_product_producttype` FOREIGN KEY (`product_type_id`) REFERENCES `tbl_product_type` (`product_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_product_style`
--
ALTER TABLE `tbl_product_style`
  ADD CONSTRAINT `frn_productstyle_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
